<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFormationSessionRequest;
use App\Http\Requests\UpdateFormationSessionRequest;
use App\Models\FormationSession;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
        Gate::authorize('create', FormationSession::class);

        $trainers = User::where('role', 'trainer')->get();

        return Inertia::render('Formations/Create',['trainers' => $trainers]);
    }

    public function store(StoreFormationSessionRequest $request)
    {
        Gate::authorize('create', FormationSession::class);
        $validated = $request->validated();
        FormationSession::create($validated);
        return redirect()->route('formations.index');
    }

    public function edit(FormationSession $formation)
    {

        Gate::authorize('update', $formation);
        $trainers = User::where('role', 'trainer')->get();

        return Inertia::render('Formations/Edit', ['formation' =>  $formation, 'trainers' => $trainers]);
    }

    public function update(UpdateFormationSessionRequest $request, FormationSession $formation)
    {

        Gate::authorize('update', $formation);
        $validated = $request->validated();
        $formation->update($validated);
        return redirect()->route('formations.index');
    }
}
