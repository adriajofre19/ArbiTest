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
        
        
        

    <div class='flex items-center justify-center min-h-screen from-teal-100 via-teal-300 to-teal-500 bg-gradient-to-br '>
    <div class='w-full max-w-7xl md:px-10 py-8 mx-auto bg-white rounded-lg shadow-xl md:mt-8'>

    <div class="border-b flex justify-between pb-2 mb-4">
            <p>{{ exam.name }}</p>
            <p>{{ exam.correct_questions }} / {{ exam.total_questions }}</p>
            <span v-if = "exam.correct_questions / exam.total_questions >= 0.75" class="bg-green-200 px-2 rounded-md">Aprobado</span>
            <span class="bg-red-200 px-2 rounded-md" v-else>Suspendido</span>
    </div>
        
    <div v-for="question in exam.questions" :key="question.id" class="m-4">
            <div class="bg-gray-800 text-white p-4 rounded-md">{{ question.index }}. {{ question.content.pregunta }}</div>
            
            <div v-if="question.respuesta_correcta === 'a' && question.respuesta_usuario === 'a'" class="p-4"><span class="bg-green-300 py-1 px-2 rounded-md">{{question.content.respuesta_a }}</span> </div>
            <div v-else-if="question.respuesta_correcta === 'a' && question.respuesta_usuario != 'a'" class="p-4"><span class="bg-yellow-300 py-1 px-2 rounded-md">{{question.content.respuesta_a }}</span></div>
            <div v-else-if="question.respuesta_correcta != 'a' && question.respuesta_usuario === 'a'" class="p-4"><span class="bg-red-300 py-1 px-2 rounded-md">{{question.content.respuesta_a }}</span></div>
            <div v-else class="bg-white p-4"><span class="bg-white py-1 px-2 rounded-md">{{question.content.respuesta_a }}</span></div>

            <div v-if="question.respuesta_correcta === 'b' && question.respuesta_usuario === 'b'" class="p-4"><span class="bg-green-300 py-1 px-2 rounded-md">{{question.content.respuesta_b }}</span></div>
            <div v-else-if="question.respuesta_correcta === 'b' && question.respuesta_usuario != 'b'" class="p-4"><span class="bg-yellow-300 py-1 px-2 rounded-md">{{question.content.respuesta_b }}</span></div>
            <div v-else-if="question.respuesta_correcta != 'b' && question.respuesta_usuario === 'b'" class="p-4"><span class="bg-red-300 py-1 px-2 rounded-md">{{question.content.respuesta_b }}</span></div>
            <div v-else class="bg-white p-4"><span class="bg-white py-1 px-2 rounded-md">{{question.content.respuesta_b }}</span></div>

            <div v-if="question.respuesta_correcta === 'c' && question.respuesta_usuario === 'c'" class="p-4"><span class="bg-green-300 py-1 px-2 rounded-md">{{question.content.respuesta_c }}</span></div>
            <div v-else-if="question.respuesta_correcta === 'c' && question.respuesta_usuario != 'c'" class="p-4"><span class="bg-yellow-300 py-1 px-2 rounded-md">{{question.content.respuesta_c }}</span></div>
            <div v-else-if="question.respuesta_correcta != 'c' && question.respuesta_usuario === 'c'" class="p-4"><span class="bg-red-300 py-1 px-2 rounded-md">{{question.content.respuesta_c }}</span></div>
            <div v-else class="bg-white p-4"><span class="bg-white py-1 px-2 rounded-md">{{question.content.respuesta_c }}</span></div>

            <div v-if="question.respuesta_correcta === 'd' && question.respuesta_usuario === 'd'" class="p-4"><span class="bg-green-300 py-1 px-2 rounded-md">{{question.content.respuesta_d }}</span></div>
            <div v-else-if="question.respuesta_correcta === 'd' && question.respuesta_usuario != 'd'" class="p-4"><span class="bg-yellow-300 py-1 px-2 rounded-md">{{question.content.respuesta_d }}</span></div>
            <div v-else-if="question.respuesta_correcta != 'd' && question.respuesta_usuario === 'd'" class="p-4"><span class="bg-red-300 py-1 px-2 rounded-md">{{question.content.respuesta_d }}</span></div>
            <div v-else class="bg-white p-4"><span class="bg-white py-1 px-2 rounded-md">{{question.content.respuesta_d }}</span></div>

        </div>
    </div>
</div>

    </AuthenticatedLayout>
</template>