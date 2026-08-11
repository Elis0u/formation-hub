<?php

namespace App\Http\Controllers;

use App\Models\FormationSession;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FormationSessionController extends Controller
{
    public function index()
    {
        $formations = FormationSession::all();

        return Inertia::render('Formations/Index', [
            'formations' => $formations,
        ]);
    }
}
