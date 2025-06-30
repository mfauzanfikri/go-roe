<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TutorController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Tutors'
        ];

        return view('pages.tutors.index', $data);
    }

    public function details()
    {
        $data = [
            'title' => 'Tutors'
        ];

        return view('pages.tutors.details', $data);
    }
}
