<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\APIController;
use Auth;

class DashboardController extends APIController
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function home()
    {
        $user = Auth::user() ?? $this->user;
        return view('dashboard.home', compact('user'));
    }

    public function adminHome()
    {
        $user = Auth::user() ?? $this->user;
        return view('api_key.dashboard', compact('user'));
    }
}
