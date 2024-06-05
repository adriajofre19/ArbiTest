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
    const preguntasContestadas = ComprovarPreguntasContestadas();
    if (preguntasContestadas < 25) {
        alert('Debes contestar todas las preguntas');
        return;
    } else {
        form.post('/store-exam', form)
    }

};

onMounted(() => {

    questions.forEach((question, index) => {
        question.index = index + 1;
        form.preguntas.push(question);
        form.respuesta_usuario = question.respuesta_usuario;
        form.respuesta_correcta = question.correcta;
    });
})

function ComprovarPreguntasContestadas() {
    let preguntasContestadas = 0;
    form.preguntas.forEach((pregunta) => {
        if (pregunta.respuesta_usuario) {
            preguntasContestadas++;
        }
    });
    return preguntasContestadas;
}

</script>

<template>
    <AuthenticatedLayout>
        <div class='flex items-center justify-center  '>
            <div class='w-full max-w-7xl md:px-10 py-8 mx-auto bg-white md:rounded-lg shadow-xl md:mt-8'>

                <div class="border-b flex justify-between pb-2 mb-4 px-4 mx-4">
                    <p>Examen de 25 preguntas</p>
                </div>

                <form @submit.prevent="submit">
                    <div v-for="question in questions" :key="question.id" class="mb-4 px-4 md:px-0">
                        <div class="bg-gray-800 text-white p-5 rounded-md">
                            <h1>{{ question.index }}. {{ question.pregunta }}</h1>
                        </div>

                        <ul class="grid w-full mt-2">
                            <li class="mb-2">
                                <input type="radio" :id="'option_a' + question.id" v-model="question.respuesta_usuario"
                                    value="a" class="hidden peer" required />
                                <label :for="'option_a' + question.id"
                                    class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100">
                                    <div class="block">
                                        <div class="w-full">{{ question.respuesta_a }}</div>
                                    </div>
                                </label>
                            </li>
                            <li class="mb-2">
                                <input type="radio" :id="'option_b' + question.id" v-model="question.respuesta_usuario"
                                    value="b" class="hidden peer" required>
                                <label :for="'option_b' + question.id"
                                    class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100">
                                    <div class="block">
                                        <div class="w-full">{{ question.respuesta_b }}</div>
                                    </div>
                                </label>
                            </li>
                            <li class="mb-2">
                                <input type="radio" :id="'option_c' + question.id" v-model="question.respuesta_usuario"
                                    value="c" class="hidden peer" required />
                                <label :for="'option_c' + question.id"
                                    class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100">
                                    <div class="block">
                                        <div class="w-full">{{ question.respuesta_c }}</div>
                                    </div>
                                </label>
                            </li>
                            <li class="mb-2">
                                <input type="radio" :id="'option_d' + question.id" v-model="question.respuesta_usuario"
                                    value="d" class="hidden peer" required>
                                <label :for="'option_d' + question.id"
                                    class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100">
                                    <div class="block">
                                        <div class="w-full">{{ question.respuesta_d }}</div>
                                    </div>
                                </label>
                            </li>
                        </ul>






                    </div>

                    <div class="flex flex-row justify-end px-4">
                        <button class="bg-gray-800 text-white px-6 py-4 rounded-md" type="submit">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
