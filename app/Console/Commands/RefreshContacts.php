<?php

namespace App\Console\Commands;

use App\Services\ContactService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

#[Signature('contacts:refresh')]
#[Description('Force refresh the cached list of contacts from the external API')]
class RefreshContacts extends Command
{
    public function handle(ContactService $contactService)
    {
        Cache::forget('contacts');

        $contacts = Cache::remember('contacts', now()->addMinutes(10), function () use ($contactService) {
            return $contactService->getContacts();
        });

        $this->info('Contacts refreshed: '.$contacts->count().' contact(s) loaded.');
    }
}