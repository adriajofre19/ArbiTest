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
        console.log(form.respuesta_correcta);
        console.log(form.respuesta_usuario);
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
                <div class="p-4">
                    <input class="mr-4" type="radio" v-model="question.respuesta_usuario" value="a"
                        :name="'respuesta_' + question.id + '_' + question.index" /> {{ question.respuesta_a }}
                </div>
                <div class="p-4">
                    <input class="mr-4" type="radio" v-model="question.respuesta_usuario" value="b"
                        :name="'respuesta_' + question.id + '_' + question.index" /> {{ question.respuesta_b }}
                </div>
                <div class="p-4">
                    <input class="mr-4" type="radio" v-model="question.respuesta_usuario" value="c"
                        :name="'respuesta_' + question.id + '_' + question.index" /> {{ question.respuesta_c }}
                </div>
                <div class="p-4">
                    <input class="mr-4" type="radio" v-model="question.respuesta_usuario" value="d"
                        :name="'respuesta_' + question.id + '_' + question.index" /> {{ question.respuesta_d }}
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



