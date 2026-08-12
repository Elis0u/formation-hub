<?php

namespace App\Http\Controllers;

use App\Services\ContactService;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function index(ContactService $contactService)
    {
        $contacts = Cache::remember('contacts', now()->addMinutes(10), function () use ($contactService) {
            return $contactService->getContacts();
        });

        return Inertia::render('Contacts/Index', [
            'contacts' => $contacts,
        ]);
    }
}