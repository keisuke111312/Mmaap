<?php

namespace App\Http\Controllers;

use App\Models\PartnerIndustry;
use Illuminate\Http\Request;
use App\Models\Official;
use App\Models\OfficialTerm;
use App\Models\OfficialPosition;
use Illuminate\Support\Facades\Validator;

class OfficialController extends Controller
{


    public function index()
    {

        $partners = PartnerIndustry::all();
        $currentTerm = OfficialTerm::orderByDesc('year_start')->first();
        $officials = $currentTerm
            ? Official::with('position')
                ->where('term_id', $currentTerm->id)
                ->orderBy('position_id')
                ->get()
            : collect();

        $typeLabels = [
            'industry' => 'Industry Member',
            'academe' => 'Academe Member',
            'vendor' => 'Vendor Member',
            'affiliate' => 'Professional Affiliate',
            'partners' => 'Partner',
        ];


        return view('pages.about', compact('officials', 'currentTerm', 'partners', 'typeLabels'));
    }

    public function history()
    {
        // Show all past officials grouped by term
        $terms = OfficialTerm::with(['officials.position'])->orderByDesc('year_start')->get();

        return view('officials.history', compact('terms'));
    }

    public function create()
    {
        $positions = OfficialPosition::all();
        $terms = OfficialTerm::orderByDesc('year_start')->get();

        return view('officials.create', compact('positions', 'terms'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title_abbreviation' => 'required',
            'name' => 'required|string|max:255',
            'position_id' => 'required|exists:official_positions,id',
            'term_id' => 'required|exists:official_terms,id',
            'photo_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bio' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $data = $request->only([
                'title_abbreviation',
                'name',
                'position_id',
                'term_id',
                'bio',
            ]);

            if ($request->hasFile('photo_url')) {
                $path = $request->file('photo_url')->store('avatars', 'public');
                $data['photo_url'] = $path;
            }

            Official::create($data);

            return redirect()->route('officials.index')->with('success', 'Official added.');

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again.')->withInput();
        }
    }

    public function officialManagement()
    {

        $currentTerm = OfficialTerm::orderByDesc('year_start')->first();
        $officials = $currentTerm
            ? Official::with('position')
                ->where('term_id', $currentTerm->id)
                ->orderBy('position_id')
                ->get()
            : collect();

        $positions = OfficialPosition::all();
        $terms = OfficialTerm::orderByDesc('year_start')->get();

        return view('admin.official', compact('officials', 'currentTerm', 'positions', 'terms'));

    }


    public function partner()
    {
        $partners = PartnerIndustry::all();
        return view('officials.partner', compact('partners'));
    }

    public function partnerStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:industry,academe,vendor,affiliate,partners',
            'description' => 'required|string',
            'image_path' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('image_path')) {
            $path = $request->file('image_path')->store('partners', 'public');
            $validated['logo_url'] = 'storage/' . $path;
        }

        unset($validated['image_path']);

        PartnerIndustry::create($validated);

        return redirect()->back()->with('success', 'Member created successfully!');
    }






}
