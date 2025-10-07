<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = [
            'Admin' => [
                'users.manage',
                'plans.manage',
                'payments.manage',
                'schedule.manage',
                'schedule.assign_trainer',
                'attendance.view_all',
                'attendance.track',
                'equipment.manage',
                'equipment.view_all',
                'workout.manage',
            ],
        ];

        return view('roles-permissions.index', compact('roles'));
    }
}
