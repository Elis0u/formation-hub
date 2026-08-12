<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

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
            </li>
        </ul>
    </div>
</template>