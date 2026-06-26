<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ContactMessage;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\ToLetAdvertisement;
use App\Models\Policy;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers        = User::count();
        $totalProperties   = ToLetAdvertisement::count();
        $pendingProperties = ToLetAdvertisement::pending()->count();
        $approvedProperties = ToLetAdvertisement::approved()->count();
        $rejectedProperties = ToLetAdvertisement::rejected()->count();
        $totalMessages     = ContactMessage::count();
        $unreadMessages    = ContactMessage::whereNull('admin_reply')->count();
        $totalTestimonials = Testimonial::count();
        $activeTestimonials = Testimonial::active()->count();
        $totalFaqs         = Faq::count();
        $activeFaqs        = Faq::active()->count();
        $totalPolicies     = Policy::count();
        $activePolicies    = Policy::active()->count();

        $recentMessages    = ContactMessage::latest()->take(5)->get();
        $recentProperties  = ToLetAdvertisement::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalProperties', 'pendingProperties',
            'approvedProperties', 'rejectedProperties',
            'totalMessages', 'unreadMessages',
            'totalTestimonials', 'activeTestimonials',
            'totalFaqs', 'activeFaqs',
            'totalPolicies', 'activePolicies',
            'recentMessages', 'recentProperties'
        ));
    }
}
