<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFormationSessionRequest;
use App\Models\FormationSession;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class FormationSessionController extends Controller
{
    public function index()
    {
        $formations = FormationSession::all();

        return Inertia::render('Formations/Index', [
            'formations' => $formations,
        ]);
    }

    public function create()
    {
        $trainers = User::where('role', 'trainer')->get();

        return Inertia::render('Formations/Create',['trainers' => $trainers]);
    }

    public function store(StoreFormationSessionRequest $request)
    {
        $validated = $request->validated();
        FormationSession::create($validated);
        return redirect()->route('formations.index');
    }
}
