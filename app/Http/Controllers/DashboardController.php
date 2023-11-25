<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'content'   => 'index'
        ];
        return view('layouts.wrapper', $data);
    }
}
