<script setup lang="ts">
import FormationForm from '@/components/FormationForm.vue';

interface User { id: number; name: string; }
interface FormationSession {
    id: number; title: string; description: string | null;
    start_at: string; end_at: string; location: string;
    max_capacity: number; trainer_id: number;
}

const props = defineProps<{ trainers: User[]; formation: FormationSession }>();
</script>

<template>
    <FormationForm :trainers="trainers" :formation="formation" :action="`/formations/${props.formation.id}`" method="put" />
</template>