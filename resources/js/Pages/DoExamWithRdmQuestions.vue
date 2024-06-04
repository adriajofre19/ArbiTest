<script setup>
import { ref } from 'vue'
import axios from 'axios'
import { onMounted } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { defineProps } from 'vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps(['questions'])

const questions = props.questions


const form = useForm({
    name: 'Examen de 25 preguntas',
    number_of_questions: 25,
    number_of_correct_answers: 0,
    preguntas: [],
})

const submit = () => {
    form.post('/store-exam', form)
};

onMounted(() => {

    questions.forEach((question, index) => {
        question.index = index + 1;
        form.preguntas.push(question);
        form.respuesta_usuario = question.respuesta_usuario;
        form.respuesta_correcta = question.correcta;
    });
})

</script>

<template>
    <AuthenticatedLayout>
<div class='flex items-center justify-center min-h-screen from-teal-100 via-teal-300 to-teal-500 bg-gradient-to-br '>
    <div class='w-full max-w-7xl md:px-10 py-8 mx-auto bg-white rounded-lg shadow-xl md:mt-8'>

        <div class="border-b flex justify-between pb-2 mb-4">
            <p>Examen de 25 preguntas</p>
        </div>

        <form @submit.prevent="submit">
            <div v-for="question in questions" :key="question.id" class="mb-4">
                <div class="bg-gray-800 text-white p-4 rounded-md">{{ question.index }}. {{ question.pregunta }}</div>
                               
   
        <div class="flex items-center ps-4 border-b border-gray-800">
            <input :id="'bordered-radio-a'+question.id" type="radio" value="a" v-model="question.respuesta_usuario" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
            <label :for="'bordered-radio-a'+question.id" class="w-full py-4 ms-2 font-medium text-gray-900 ml-4">{{ question.respuesta_a }}</label>
        </div>

        <div class="flex items-center ps-4 border-b border-gray-800">
            <input :id="'bordered-radio-b'+question.id" type="radio" value="b" v-model="question.respuesta_usuario" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
            <label :for="'bordered-radio-b'+question.id" class="w-full py-4 ms-2 font-medium text-gray-900 ml-4">{{ question.respuesta_b }}</label>
        </div>

        <div class="flex items-center ps-4 border-b border-gray-800">
            <input :id="'bordered-radio-c'+question.id" type="radio" value="c" v-model="question.respuesta_usuario" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
            <label :for="'bordered-radio-c'+question.id" class="w-full py-4 ms-2 font-medium text-gray-900 ml-4">{{ question.respuesta_c }}</label>
        </div>

        <div class="flex items-center ps-4 border-b border-gray-800">
            <input :id="'bordered-radio-d'+question.id" type="radio" value="d" v-model="question.respuesta_usuario" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
            <label :for="'bordered-radio-d'+question.id" class="w-full py-4 ms-2 font-medium text-gray-900 ml-4">{{ question.respuesta_d }}</label>
        </div>



            </div>
            
        <div class="flex flex-row justify-end">
            <button class="bg-gray-800 text-white p-4 rounded-md" type="submit">Enviar</button>
        </div>
</form>
</div>
</div>
    </AuthenticatedLayout>
</template>



