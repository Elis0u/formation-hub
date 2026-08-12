<script setup lang="ts">
import { Form } from '@inertiajs/vue3';

interface User {
    id: number;
    name: string;
}

interface FormationSessionData {
    title?: string;
    description?: string | null;
    start_at?: string;
    end_at?: string;
    location?: string;
    max_capacity?: number;
    trainer_id?: number;
}

defineProps<{
    trainers: User[];
    action: string;
    method: 'post' | 'put';
    formation?: FormationSessionData;
}>();
</script>

<template>
    <Form :action="action" :method="method" class="mx-auto flex max-w-xl flex-col gap-4 p-4">
        <div class="flex flex-col gap-1">
            <label for="title" class="text-sm font-medium">Titre</label>
            <input id="title" type="text" name="title" :value="formation?.title" class="rounded-md border border-input bg-background px-3 py-2 text-sm shadow-sm" />
        </div>

        <div class="flex flex-col gap-1">
            <label for="description" class="text-sm font-medium">Description</label>
            <textarea id="description" name="description" rows="4" class="rounded-md border border-input bg-background px-3 py-2 text-sm shadow-sm">{{ formation?.description }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div class="flex flex-col gap-1">
                <label for="start_at" class="text-sm font-medium">Début</label>
                <input id="start_at" type="datetime-local" name="start_at" :value="formation?.start_at?.slice(0, 16)" class="rounded-md border border-input bg-background px-3 py-2 text-sm shadow-sm" />
            </div>
            <div class="flex flex-col gap-1">
                <label for="end_at" class="text-sm font-medium">Fin</label>
                <input id="end_at" type="datetime-local" name="end_at" :value="formation?.end_at?.slice(0, 16)" class="rounded-md border border-input bg-background px-3 py-2 text-sm shadow-sm" />
            </div>
        </div>

        <div class="flex flex-col gap-1">
            <label for="location" class="text-sm font-medium">Lieu</label>
            <input id="location" type="text" name="location" :value="formation?.location" class="rounded-md border border-input bg-background px-3 py-2 text-sm shadow-sm" />
        </div>

        <div class="flex flex-col gap-1">
            <label for="max_capacity" class="text-sm font-medium">Capacité max</label>
            <input id="max_capacity" type="number" name="max_capacity" :value="formation?.max_capacity" class="rounded-md border border-input bg-background px-3 py-2 text-sm shadow-sm" />
        </div>

        <div class="flex flex-col gap-1">
            <label for="trainer_id" class="text-sm font-medium">Formateur</label>
            <select id="trainer_id" name="trainer_id" :value="formation?.trainer_id" class="rounded-md border border-input bg-background px-3 py-2 text-sm shadow-sm">
                <option v-for="trainer in trainers" :key="trainer.id" :value="trainer.id">{{ trainer.name }}</option>
            </select>
        </div>

        <button type="submit" class="mt-2 inline-flex items-center justify-center rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground shadow hover:bg-primary/90">
            {{ method === 'post' ? 'Créer la formation' : 'Mettre à jour' }}
        </button>
    </Form>
</template>