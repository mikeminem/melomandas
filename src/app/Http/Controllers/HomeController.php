<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //this is like a route controller,
        //if the user is admin, redirect to admin dashboard,
        //if the user is company, redirect to company dashboard,
        //if the user is client, redirect to client dashboard
        //echo auth()->user()->type;

            if (auth()->user()->type === 'admin') {
                return $this->adminDashboard();
            }
            elseif (auth()->user()->type === 'company') {
                return $this->companyDashboard();
            } elseif (auth()->user()->type === 'client') {
                return redirect()->route('client.dashboard');
            }

        //return redirect()->route('company.dashboard');
        //return view('home');
    }

    public function adminDashboard()
    {
        //add the logic to get the data for the admin dashboard
        return view('dashboards.admin');
    }

    public function companyDashboard()
    {
        //add the logic to get the data for the company dashboard
        return view('dashboards.company');
    }
}
