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

    <div class="py-12" >
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4" v-for="exam in exams" :key="exam.id">
                <a :href="'/exam-solutions/'+exam.id">
                <div class="bg-white overflow-hidden flex justify-between shadow-sm sm:rounded-lg px-4 ">
                    <div class="p-6 text-gray-900">{{ exam.name }}</div>
                    <div class="p-6 text-gray-900">{{ exam.correct_questions }} / {{ exam.total_questions }}</div>
                    <div class="p-6 text-gray-900">
                        <span v-if = "exam.correct_questions / exam.total_questions >= 0.75" class="bg-green-200 text-black px-2 rounded-md">Aprobado</span>
                        <span class="bg-red-200 text-black px-2 rounded-md" v-else>Suspendido</span>
                    </div>
                </div>
                </a>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
