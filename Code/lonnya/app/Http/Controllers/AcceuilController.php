<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AcceuilController extends Controller
{
    public function home(){
        return view('home');
    }
}
