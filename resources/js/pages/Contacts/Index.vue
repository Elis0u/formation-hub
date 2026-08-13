<script setup lang="ts">
import { create } from '@/routes/registrations';
import { Head, Link } from '@inertiajs/vue3';

interface Contact {
    id: number;
    name: string;
    email: string;
    phone: string;
}

defineProps<{
    contacts: Contact[];
}>();

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Contacts',
                href: '/contacts',
            },
        ],
    },
});
</script>

<template>
    <Head title="Contacts" />

    <div class="flex flex-col gap-4 p-4">
        <h1 class="text-xl font-semibold">Contacts</h1>

        <div v-if="contacts.length === 0">Aucun contact disponible pour le moment.</div>

        <ul v-else class="flex flex-col gap-2">
            <li
                v-for="contact in contacts"
                :key="contact.id"
                class="rounded-xl border p-4"
            >
                <p class="font-medium">{{ contact.name }}</p>
                <p class="text-sm text-muted-foreground">{{ contact.email }}</p>
                <Link
                    :href="create(contact.id)"
                    class="inline-flex items-center justify-center rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground shadow transition-colors hover:bg-primary/90"
                >
                    Ajouter à une session
                </Link>
            </li>
        </ul>
    </div>
</template>