<script setup lang="ts">
import { Form } from '@inertiajs/vue3';

interface ContactData { id: number; name: string; }
interface FormationSessionData {
    id: string;
    title: string;
}
defineProps<{ sessions :  FormationSessionData[], contact: ContactData}>();
</script>

<template>
    <Form action="/registrations" method="post" v-slot="{ errors }" class="mx-auto flex max-w-xl flex-col gap-4 p-4">
        <h3>Ajouter {{ contact.name }} à une formation</h3>
        <div class="flex flex-col gap-1">
            <input type="hidden" name="external_contact_id" :value="contact.id">
        </div>
        <div class="flex flex-col gap-1">
            <input type="hidden" name="external_contact_name" :value="contact.name">
        </div>
        <div class="flex flex-col gap-1">
            <label for="session_id" class="text-sm font-medium">Formation</label>
            <select id="session_id" name="session_id" class="rounded-md border border-input bg-background px-3 py-2 text-sm shadow-sm">
                <option v-for="session in sessions" :key="session.id" :value="session.id">{{ session.title }}</option>
            </select>
        </div>
        <div v-if="errors.error" class="text-red-600 text-sm">{{ errors.error }}</div>
        <button type="submit" class="mt-2 inline-flex items-center justify-center rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground shadow hover:bg-primary/90">
            Ajouter à la formation
        </button>
    </Form>
</template>