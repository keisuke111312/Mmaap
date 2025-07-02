<?php

namespace App\Http\Controllers;

use App\Models\Filter;
use App\Models\Jobs;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function index(Request $request)
    {
        $jobs = Jobs::with('tags')
            ->when($request->filled('type'), fn($q) => $q->whereIn('type', $request->type))
            ->when(
                $request->filled('experience'),
                fn($q) =>
                $q->whereHas('filters', fn($q) => $q->where('type', 'experience')->whereIn('label', $request->experience))
            )
            ->latest()
            ->paginate(10);

        $filters = Filter::all()->groupBy('type');

        $stats = [
            'active_jobs' => Jobs::count(),
            'freelance_projects' => Jobs::where('type', 'freelance')->count(),
            'companies' => Jobs::distinct('company_name')->count('company_name'),
            'professionals' => 12000 // static or pulled from user table if available
        ];

        return view('member.job-board', compact('jobs', 'filters', 'stats'));
    }

    public function filter(Request $request)
    {
        $filters = $request->input('filters', []);
        $query = Jobs::with('tags');

        // Map filter keys to actual DB columns
        $filterMap = [
            'job_type' => 'type',
            // 'experience' => 'experience_level',
        // 'salary_range' => 'salary_range',
        ];

        if (!empty($filters)) {
            $query->where(function ($q) use ($filters, $filterMap) {
                foreach ($filters as $type => $values) {
                    if (!empty($values) && isset($filterMap[$type])) {
                        $q->orWhereIn($filterMap[$type], $values);
                    }
                }
            });
        }

        $jobs = $query->latest()->get();

        return view('member.partials.job-cards', compact('jobs'))->render();
    }


    public function jobList()
    {
        $jobs = Jobs::orderByDesc('posted_at')->paginate(5);

        return view('admin.jobs', compact('jobs'));
    }


    public function storeJobs(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'type' => 'required|in:full-time,freelance,contract,part-time',
            'description' => 'required|string',
            'salary_min' => 'nullable|integer|min:0',
            'salary_max' => 'nullable|integer|min:0|gte:salary_min',
            'salary_unit' => 'required|in:annual,hourly',
            'is_featured' => 'nullable|boolean',
            'posted_at' => 'nullable|date',
        ]);

        // Checkbox: if not checked, default to false
        $validated['is_featured'] = $request->has('is_featured');

        Jobs::create($validated);

        return redirect()->route('job-list')->with('success', 'Job listing created successfully.');
    }
}
