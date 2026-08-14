<script setup lang="ts">
import { create } from '@/routes/formations';
import { Head, Link, usePage } from '@inertiajs/vue3';

interface Registration {
    id: number;
    external_contact_name: string;
    status: string;
}

interface FormationSessionData {
    id: number;
    title: string;
    location: string;
    max_capacity: number;
    registrations: Registration[];
}

defineProps<{
    formations: FormationSessionData[];
}>();

const page = usePage();
const isAdmin = page.props.auth.user.role === 'admin';
</script>

<template>
    <Head title="Formations" />

    <div class="flex flex-col gap-4 p-4">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold">Formations</h1>
            <Link
                v-if="isAdmin"
                :href="create()"
                class="inline-flex items-center justify-center rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground shadow hover:bg-primary/90"
            >
                Nouvelle session
            </Link>
        </div>

        <div v-if="formations.length === 0">Aucune session pour le moment.</div>

        <ul v-else class="flex flex-col gap-4">
            <li v-for="formation in formations" :key="formation.id" class="rounded-xl border p-4">
                <p class="font-medium">{{ formation.title }}</p>
                <p class="text-sm text-muted-foreground">{{ formation.location }}</p>

                <div class="mt-2">
                    <p class="text-sm font-medium">Inscrits ({{ formation.registrations.length }}/{{ formation.max_capacity }})</p>
                    <ul v-if="formation.registrations.length" class="mt-1 flex flex-col gap-1">
                        <li v-for="registration in formation.registrations" :key="registration.id" class="text-sm text-muted-foreground">
                            {{ registration.external_contact_name }} — {{ registration.status }}
                        </li>
                    </ul>
                    <p v-else class="text-sm text-muted-foreground">Aucun inscrit.</p>
                </div>
            </li>
        </ul>
    </div>
</template>