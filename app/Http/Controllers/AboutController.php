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

    public function downloadCV()
    {
        $settings = app(MainController::class)->helper('settings');

        $file = public_path(). "/assets/cv/CV.pdf";

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download($file, 'CV.pdf', $headers);
    }
}
