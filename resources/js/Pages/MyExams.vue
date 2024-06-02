<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {defineProps} from 'vue';

const props = defineProps ({
    exams: Array
});

console.log(props.exams);

</script>

<template>
    <AuthenticatedLayout>
        <div v-for="exam in exams" :key="exam.id" class="examens">
            <p>{{ exam.name }}</p>
            <p>{{ exam.correct_questions }}</p>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
    .examens {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        border-bottom: 1px solid #ccc;
    }
    .examens p {
        margin: 0;
    }
</style>