<?php

namespace App\Http\Controllers\Suivi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuiviController extends Controller
{
    public function index(){
        return view('suivi.index');
    }
}
