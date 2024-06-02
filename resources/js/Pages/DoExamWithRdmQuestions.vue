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
        <form @submit.prevent="submit">
            <div v-for="question in questions" :key="question.id" class="exam">
                <h1>{{ question.index }}. {{ question.pregunta }}</h1>
                <div>
                    <input type="radio" v-model="question.respuesta_usuario" value="a"
                        :name="'respuesta_' + question.id + '_' + question.index" /> {{ question.respuesta_a }}
                </div>
                <div>
                    <input type="radio" v-model="question.respuesta_usuario" value="b"
                        :name="'respuesta_' + question.id + '_' + question.index" /> {{ question.respuesta_b }}
                </div>
                <div>
                    <input type="radio" v-model="question.respuesta_usuario" value="c"
                        :name="'respuesta_' + question.id + '_' + question.index" /> {{ question.respuesta_c }}
                </div>
                <div>
                    <input type="radio" v-model="question.respuesta_usuario" value="d"
                        :name="'respuesta_' + question.id + '_' + question.index" /> {{ question.respuesta_d }}
                </div>


            </div>
            <button type="submit">Enviar</button>
        </form>
    </AuthenticatedLayout>
</template>

<style scoped>
.exam {
    margin: 20px;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.exam h1 {
    font-size: 20px;
    font-weight: bold;
}

.exam div {
    margin: 10px 0;
}

.exam input {
    margin-right: 10px;
}

.exam input[type="radio"] {
    margin-right: 5px;
}
</style>