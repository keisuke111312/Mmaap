<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Jobs;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $user = Auth::user();

        $events = Event::all();

        $upcomingEvents = Event::where('start', '>', Carbon::now())
            ->orderBy('start', 'asc')
            ->take(4)
            ->get();

        $recentUsers = User::whereHas('manualPayments', function ($query) {
            $query->where('status', 'approved')
                ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
        })
            ->with([
                'manualPayments' => function ($query) {
                    $query->where('status', 'approved')
                        ->latest();
                },
                'accessLevel'
            ])
            ->latest()
            ->take(10)
            ->get();

        // Count by access level name
        $studentCount = $recentUsers->filter(fn($u) => $u->accessLevel?->name === 'Student')->count();
        $professionalCount = $recentUsers->filter(fn($u) => $u->accessLevel?->name === 'Professional')->count();





        switch ($user->role) {

            case 'admin':
                return view('admin.dashboard', compact('upcomingEvents', 'recentUsers', 'studentCount', 'professionalCount'));

            default:
                return view('member.event', compact('events'));
        }
    }

    public function getSalesChartData()
    {
        $startDate = now()->subDays(6)->startOfDay();

        // Join manual_payments with access_levels to get the price per payment
        $payments = DB::table('manual_payments')
            ->join('access_levels', 'manual_payments.access_level_id', '=', 'access_levels.id')
            ->selectRaw('DATE(manual_payments.created_at) as date, SUM(access_levels.price) as total')
            ->where('manual_payments.status', 'approved')
            ->where('manual_payments.created_at', '>=', $startDate)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = [];
        $totals = [];
        $weekTotal = 0;

        for ($i = 0; $i < 7; $i++) {
            $date = now()->subDays(6 - $i)->toDateString();
            $labels[] = \Carbon\Carbon::parse($date)->format('D'); // e.g. 'Mon', 'Tue'

            $match = $payments->firstWhere('date', $date);
            $amount = $match ? (float) $match->total : 0;

            $totals[] = $amount;
            $weekTotal += $amount;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $totals,
            'week_total' => $weekTotal
        ]);
    }


    public function getMembershipDistribution()
    {
        $data = DB::table('manual_payments')
            ->join('access_levels', 'manual_payments.access_level_id', '=', 'access_levels.id')
            ->select('access_levels.name as label', DB::raw('COUNT(*) as count'))
            ->where('manual_payments.status', 'approved')
            ->groupBy('access_levels.name')
            ->get();

        return response()->json([
            'labels' => $data->pluck('label'),
            'data' => $data->pluck('count')
        ]);
    }


    public function getTotalResources()
    {
        $data = DB::table('resources')
            ->select('category', DB::raw('COUNT(*) as count'))
            ->groupBy('category')
            ->get();

        return response()->json([
            'labels' => $data->pluck('category'),
            'data' => $data->pluck('count'),
            'total' => $data->pluck('count')->sum(),
        ]);
    }

    public function jobChart()
    {
        $labels = collect(range(6, 0))->map(function ($daysAgo) {
            return now()->subDays($daysAgo)->format('M d');
        });

        $data = collect(range(6, 0))->map(function ($daysAgo) {
            return Jobs::whereDate('posted_at', now()->subDays($daysAgo))->count();
        });

        return response()->json([
            'labels' => $labels,
            'data' => $data,
            'total' => $data->sum(), // 👈 Include total job count
        ]);
    }






    public function home()
    {

        return view('membership.index');
    }
}
