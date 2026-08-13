<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrationRequest;
use App\Models\FormationSession;
use App\Models\Registration;
use App\Services\ContactService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class RegistrationController extends Controller
{
    public function create($contactId, ContactService $contactService)
    {
        Gate::authorize('create', Registration::class);

        $sessions = FormationSession::all();

        $contacts = Cache::remember('contacts', now()->addMinutes(10), function () use ($contactService) {
            return $contactService->getContacts();
        });

        $contact = $contacts->firstWhere('id', $contactId);

        return Inertia::render('Registrations/Create', [
            'sessions' => $sessions,
            'contact' => $contact,
        ]);
    }

    public function store(StoreRegistrationRequest $request)
    {
        Gate::authorize('create', Registration::class);
        $validated = $request->validated();
        $validated['status'] = 'registered';

        $registeredCount = Registration::where('session_id', $validated['session_id'])
                            ->where('status', 'registered')
                            ->count();

        $sessionCapacity = FormationSession::find($validated['session_id'])->max_capacity;

        if ($registeredCount >= $sessionCapacity) {
            return back()->withErrors(['error' => 'Max capacity !']);
        }

        $alreadyRegistered = Registration::where('session_id', $validated['session_id'])
            ->where('external_contact_id', $validated['external_contact_id'])
            ->exists();

        if ($alreadyRegistered) {
            return back()->withErrors(['error' => 'Ce contact est déjà inscrit à cette session.']);
        }

        Registration::create($validated);
        return redirect()->route('contacts.index');
    }
}