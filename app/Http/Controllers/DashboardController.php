<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Handle dashboard redirection based on user role
     */
    public function index(): View
    {
        /** @var User $user */
        $user = Auth::user();
        
        // Redirect based on user role
        if ($user->isAdmin()) {
            return view('dashboard.admin');
        } elseif ($user->isTrainer()) {
            return view('dashboard.trainer');
        } elseif ($user->isMember()) {
            return view('dashboard.member');
        }
        
        // Default fallback dashboard
        return view('dashboard');
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
        
        return view('dashboard.admin');
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
        
        return view('dashboard.trainer');
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
        
        return view('dashboard.member');
    }
}