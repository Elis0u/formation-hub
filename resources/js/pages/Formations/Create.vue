<script setup lang="ts">
import FormationForm from '@/components/FormationForm.vue';

interface User { id: number; name: string; }
defineProps<{ trainers: User[] }>();
</script>

<template>
    <FormationForm :trainers="trainers" action="/formations" method="post" />
</template>