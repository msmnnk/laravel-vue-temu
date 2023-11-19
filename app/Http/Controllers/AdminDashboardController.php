<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminDashboardController extends Controller
{
    public function index() {
        if (!Auth::user()->hasRole('admin')) {
            abort(403);
        } else {
            return Inertia::render('AdminDashboard', [
                'charities' => CharityController::index()
            ]);
        }
    }
}
