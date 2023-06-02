<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $settings = app(MainController::class)->helper('settings');
        return view('about', compact('settings'));
    }
}
