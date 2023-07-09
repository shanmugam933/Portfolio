<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ResumeController extends Controller
{
    public function downloadResume()
    {
        $resumePath = public_path('assets/resume/Shanmugam_Resume.pdf');
        
        return Response::download($resumePath, 'Shanmugam_Resume.pdf');
    }

    public function showResume()
    {
        $resumePath = public_path('assets/resume/Shanmugam_Resume.pdf');
        
        return response()->file($resumePath);
    }
}
