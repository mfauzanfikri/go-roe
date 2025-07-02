<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use Illuminate\Http\Request;

class TutorController extends Controller
{
    public function index(Request $request)
    {
        $query = Tutor::with('user');

        // Filter berdasarkan keyword nama
        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        // Filter berdasarkan subject
        if ($request->filled('subject')) {
            $query->where('subject', $request->subject);
        }

        $tutors = $query->get();

        $subjects = Tutor::select('subject')->distinct()->pluck('subject');

        return view('pages.tutors.index', [
            'title' => 'Tutors',
            'tutors' => $tutors,
            'subjects' => $subjects,
            'request' => $request,
        ]);
    }

    public function details()
    {
        $data = [
            'title' => 'Tutors'
        ];

        return view('pages.tutors.details', $data);
    }
}
