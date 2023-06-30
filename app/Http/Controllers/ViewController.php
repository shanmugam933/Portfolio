<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ViewController extends Controller
{
    public function index(){

        $skills =  DB::table('skills')->get();
        return view('index')->with('skills',$skills);

    }
}
