<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            return view('admin.index');
        } elseif(Auth::user()->role == 'pegawai') {
            return view('pegawai.index');
        } elseif (Auth::user()->role == 'owner') {
            return view('owner.index');
        }
        
    }
}
