<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {defineProps} from 'vue';
import {onMounted} from 'vue';

const props = defineProps ({
    exam: Array,

});

onMounted(() => {
    props.exam.questions.forEach((question, index) => {
        question.index = index + 1;
    });
});



</script>
<template>
    <AuthenticatedLayout>
        
        
        

    <div class='flex items-center justify-center min-h-screen from-blue-100 via-blue-300 to-blue-500 bg-gradient-to-br '>
    <div class='w-full max-w-7xl md:px-10 py-8 mx-auto bg-white md:rounded-lg shadow-xl md:mt-8'>

    <div class="border-b block md:flex justify-between pb-2 mb-4 mx-4">
            <p>{{ exam.name }}</p>
            <p>{{ exam.correct_questions }} / {{ exam.total_questions }}</p>
            <span v-if = "exam.correct_questions / exam.total_questions >= 0.75" class="bg-green-300 px-2 rounded-md">Aprobado</span>
            <span class="bg-red-200 px-2 rounded-md" v-else>Suspendido</span>
    </div>
        
    <div v-for="question in exam.questions" :key="question.id" class="m-4">
            <div class="bg-gray-800 text-white p-5 rounded-md">{{ question.index }}. {{ question.content.pregunta }}</div>

<ul class="grid w-full mt-2">
    <li v-if="question.respuesta_correcta === 'a' && question.respuesta_usuario === 'a'" class="mb-2">
        <label for="option_a" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-green-200 border border-gray-200 rounded-lg">                           
            <div class="block">
                <div class="w-full">{{question.content.respuesta_a }}</div>
            </div>
            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/>
            </svg>
        </label>
    </li>
    <li v-else-if="question.respuesta_correcta === 'a' && question.respuesta_usuario != 'a'" class="mb-2">
        <label for="option_a" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-yellow-200 border border-gray-200 rounded-lg">                           
            <div class="block">
                <div class="w-full">{{question.content.respuesta_a }}</div>
            </div>
            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/>
            </svg>
        </label>
    </li>
    <li v-else-if="question.respuesta_correcta != 'a' && question.respuesta_usuario === 'a'" class="mb-2">
        <label for="option_a" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-red-200 border border-gray-200 rounded-lg">                           
            <div class="block">
                <div class="w-full">{{question.content.respuesta_a }}</div>
            </div>
            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
            </svg>
        </label>
    </li>
    <li v-else class="mb-2">
        <label for="option_a" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg">                           
            <div class="block">
                <div class="w-full">{{question.content.respuesta_a }}</div>
            </div>
        </label>
    </li>


    <li v-if="question.respuesta_correcta === 'b' && question.respuesta_usuario === 'b'" class="mb-2">
        <label for="option_b" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-green-200 border border-gray-200 rounded-lg">                           
            <div class="block">
                <div class="w-full">{{ question.content.respuesta_b }}</div>
            </div>
            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/>
            </svg>
        </label>
    </li>

    <li v-else-if="question.respuesta_correcta === 'b' && question.respuesta_usuario != 'b'" class="mb-2">
        <label for="option_b" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-yellow-200 border border-gray-200 rounded-lg">                           
            <div class="block">
                <div class="w-full">{{ question.content.respuesta_b }}</div>
            </div>
            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/>
            </svg>
        </label>
    </li>

    <li v-else-if="question.respuesta_correcta != 'b' && question.respuesta_usuario === 'b'" class="mb-2">
        <label for="option_b" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-red-200 border border-gray-200 rounded-lg">                           
            <div class="block">
                <div class="w-full">{{ question.content.respuesta_b }}</div>
            </div>
            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
            </svg>
        </label>
    </li>

    <li v-else class="mb-2">
        <label for="option_b" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg">                           
            <div class="block">
                <div class="w-full">{{ question.content.respuesta_b }}</div>
            </div>
        </label>
    </li>

    <li v-if="question.respuesta_correcta === 'c' && question.respuesta_usuario === 'c'" class="mb-2">
        <label for="option_c" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-green-200 border border-gray-200 rounded-lg">                           
            <div class="block">
                <div class="w-full">{{ question.content.respuesta_c }}</div>
            </div>
            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/>
            </svg>
        </label>
    </li>

    <li v-else-if="question.respuesta_correcta === 'c' && question.respuesta_usuario != 'c'" class="mb-2">
        <label for="option_c" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-yellow-200 border border-gray-200 rounded-lg">                           
            <div class="block">
                <div class="w-full">{{ question.content.respuesta_c }}</div>
            </div>
            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/>
            </svg>
        </label>
    </li>

    <li v-else-if="question.respuesta_correcta != 'c' && question.respuesta_usuario === 'c'" class="mb-2">
        <label for="option_c" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-red-200 border border-gray-200 rounded-lg">                           
            <div class="block">
                <div class="w-full">{{ question.content.respuesta_c }}</div>
            </div>
            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
            </svg>
        </label>
    </li>

    <li v-else class="mb-2">
        <label for="option_c" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg">                           
            <div class="block">
                <div class="w-full">{{ question.content.respuesta_c }}</div>
            </div>
        </label>
    </li>

    <li v-if="question.respuesta_correcta === 'd' && question.respuesta_usuario === 'd'" class="mb-2">
        <label for="option_d" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-green-200 border border-gray-200 rounded-lg">                           
            <div class="block">
                <div class="w-full">{{ question.content.respuesta_d }}</div>
            </div>
            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/>
            </svg>
        </label>
    </li>

    <li v-else-if="question.respuesta_correcta === 'd' && question.respuesta_usuario != 'd'" class="mb-2">
        <label for="option_d" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-yellow-200 border border-gray-200 rounded-lg">                           
            <div class="block">
                <div class="w-full">{{ question.content.respuesta_d }}</div>
            </div>
            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/>
            </svg>
        </label>
    </li>

    <li v-else-if="question.respuesta_correcta != 'd' && question.respuesta_usuario === 'd'" class="mb-2">
        <label for="option_d" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-red-200 border border-gray-200 rounded-lg">                           
            <div class="block">
                <div class="w-full">{{ question.content.respuesta_d }}</div>
            </div>
            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
            </svg>
        </label>
    </li>

    <li v-else class="mb-2">
        <label for="option_d" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg">                           
            <div class="block">
                <div class="w-full">{{
                    question.content.respuesta_d
                }}</div>
            </div>
        </label>
    </li>  
    
</ul>

        </div>
    </div>
</div>

    </AuthenticatedLayout>
</template>