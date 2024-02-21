<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Avatar;

class DashboardController extends Controller {
    public function index(): View {
        return view('dashboard.index');
    }
}
