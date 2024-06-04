<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {defineProps} from 'vue';

const props = defineProps ({
    exams: Array
});

</script>

<template>
    <AuthenticatedLayout>
        <a :href="'/exam-solutions/'+exam.id" v-for="exam in exams" :key="exam.id" class="bg-gray-800 p-4 text-white rounded-md flex justify-between m-8">

            <p>{{ exam.name }}</p>
            <p>{{ exam.correct_questions }} / {{ exam.total_questions }}</p>
            <span v-if = "exam.correct_questions / exam.total_questions >= 0.75" class="bg-green-200 text-black px-2 rounded-md">Aprobado</span>
            <span class="bg-red-200 text-black px-2 rounded-md" v-else>Suspendido</span>

        </a>
    </AuthenticatedLayout>
</template>
