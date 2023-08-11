<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $getId = $user->id;
        if ($user && $user->hasRole('orang_tua') && $user->parent->student->nim === '000000000') {
            return redirect('admin/parents/get-profile/'.$getId);
        }
        return view('homeLTE');
    }
}