<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Contact;
use App\Models\Email;
use App\Models\SmtpConfig;

class DashboardController extends Controller
{
    protected $groups;
    protected $drafts;
    protected $contacts;
    // protected $smtpConfig;
    public function __construct()
    {
        $this->groups = Group::count();
        $this->contacts = Contact::count();
        $this->drafts = Email::where('is_draft', 1)->count();
    }


    // public function index()
    // {
    //     $groupCount  =  $this->groups;
    //     $contactCount  =  $this->contacts;
    //     $draftCount = $this->drafts;


    //     // Current 7 days
    //     $currentGroups = Group::where('created_at', '>=', now()->subDays(7))->count();

    //     // Previous 7 days
    //     $previousGroups = Group::whereBetween('created_at', [now()->subDays(14), now()->subDays(7)])->count();

    //     // Calculate percentage change
    //     if ($previousGroups > 0) {
    //         $groupGrowth = (($currentGroups - $previousGroups) / $previousGroups) * 100;
    //     } else {
    //         $groupGrowth = $currentGroups > 0 ? 100 : 0;
    //     }

    //     // Example: Get daily created groups for last 7 days
    //     $groupsChart = Group::selectRaw('DATE(created_at) as date, COUNT(*) as total')
    //         ->where('created_at', '>=', now()->subDays(7))
    //         ->groupBy('date')
    //         ->orderBy('date', 'ASC')
    //         ->get();

    //     // Format for ApexCharts
    //     $chartData = [
    //         'dates' => $groupsChart->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('M d Y')),
    //         'totals' => $groupsChart->pluck('total'),
    //     ];

    //     // return view('dashboard', compact('groupCount', 'contactCount', 'draftCount'));
    //     return view('dashboard', compact('groupCount', 'contactCount', 'draftCount', 'chartData', 'groupGrowth'));
    // }

    public function index()
    {
        $groupCount  = $this->groups;
        $contactCount  = $this->contacts;
        $draftCount = $this->drafts;

        /** ---------------- Groups Growth ---------------- */
        $currentGroups = Group::where('created_at', '>=', now()->subDays(7))->count();
        $previousGroups = Group::whereBetween('created_at', [now()->subDays(14), now()->subDays(7)])->count();
        $groupGrowth = $previousGroups > 0
            ? (($currentGroups - $previousGroups) / $previousGroups) * 100
            : ($currentGroups > 0 ? 100 : 0);

        $groupsChart = Group::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        $groupsChartData = [
            'dates' => $groupsChart->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('M d Y')),
            'totals' => $groupsChart->pluck('total'),
        ];

        /** ---------------- Contacts Growth ---------------- */
        $currentContacts = Contact::where('created_at', '>=', now()->subDays(7))->count();
        $previousContacts = Contact::whereBetween('created_at', [now()->subDays(14), now()->subDays(7)])->count();
        $contactGrowth = $previousContacts > 0
            ? (($currentContacts - $previousContacts) / $previousContacts) * 100
            : ($currentContacts > 0 ? 100 : 0);

        $contactsChart = Contact::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        $contactsChartData = [
            'dates' => $contactsChart->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('M d Y')),
            'totals' => $contactsChart->pluck('total'),
        ];


         /** ---------------- Draft Growth ---------------- */
        $currentDrafts = Email::where('is_draft', 1)->where('created_at', '>=', now()->subDays(7))->count();
        $previousDrafts = Email::where('is_draft', 1)->whereBetween('created_at', [now()->subDays(14), now()->subDays(7)])->count();
        $draftGrowth = $previousDrafts > 0
            ? (($currentDrafts - $previousDrafts) / $previousDrafts) * 100
            : ($currentDrafts > 0 ? 100 : 0);

        $draftsChart = Email::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->where('is_draft', 1)
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        $draftsChartData = [
            'dates' => $draftsChart->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('M d Y')),
            'totals' => $draftsChart->pluck('total'),
        ];

        return view('dashboard', compact(
            'groupCount',
            'contactCount',
            'draftCount',
            'groupsChartData',
            'contactsChartData',
            'draftsChartData',
            'groupGrowth',
            'contactGrowth',
            'draftGrowth'
        ));
    }
}
