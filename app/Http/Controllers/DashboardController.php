<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Handle dashboard redirection based on user role
     */
    public function index(): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        // Redirect to role-specific route (routes/web.php defines these names)
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isTrainer()) {
            return redirect()->route('trainer.dashboard');
        } elseif ($user->isMember()) {
            return redirect()->route('member.dashboard');
        }

        // Default fallback
        return redirect('/');
    }

    /**
     * Admin Dashboard
     */
    public function admin(): View
    {
        /** @var User $user */
        $user = Auth::user();

        if (!$user->isAdmin()) {
            abort(403, 'You do not have permission to access admin dashboard.');
        }

    return view('admin.dashboard');
    }

    /**
     * Trainer Dashboard
     */
    public function trainer(): View
    {
        /** @var User $user */
        $user = Auth::user();

        if (!$user->isTrainer()) {
            abort(403, 'You do not have permission to access trainer dashboard.');
        }

        return view('pages.dashboard.trainer.trainerDashboard');
    }

    /**
     * Member Dashboard
     */
    public function member(): View
    {
        /** @var User $user */
        $user = Auth::user();

        if (!$user->isMember()) {
            abort(403, 'You do not have permission to access member dashboard.');
        }

        return view('pages.dashboard.member.memberDashboard');
    }
}