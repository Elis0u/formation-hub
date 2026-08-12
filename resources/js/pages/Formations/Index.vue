<script setup lang="ts">
import { create, edit, index } from '@/routes/formations';
import { Head, Link } from '@inertiajs/vue3';

interface FormationSession {
    id: number;
    title: string;
    description: string | null;
    start_at: string;
    end_at: string;
    location: string;
    max_capacity: number;
    trainer_id: number;
}

defineProps<{
    formations: FormationSession[];
}>();

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Formations',
                href: index(),
            },
        ],
    },
});
</script>

<template>
    <Head title="Formations" />

    <div class="flex flex-col gap-4 p-4">
        <h1 class="text-xl font-semibold">Sessions de formation</h1>
        <Link
            :href="create()"
            class="inline-flex items-center justify-center rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground shadow transition-colors hover:bg-primary/90"
        >
            Nouvelle session
        </Link>

        <div v-if="formations.length === 0">Aucune session pour le moment.</div>

        <ul v-else class="flex flex-col gap-2">
            <li
                v-for="formation in formations"
                :key="formation.id"
                class="rounded-xl border p-4"
            >
                <p class="font-medium">{{ formation.title }}</p>
                <p class="text-sm text-muted-foreground">{{ formation.location }}</p>
                <Link
                    :href="edit(formation.id)"
                    class="inline-flex items-center justify-center rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground shadow transition-colors hover:bg-primary/90"
                >
                    Editer
                </Link>
            </li>
        </ul>
    </div>
</template>