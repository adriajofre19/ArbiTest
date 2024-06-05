<script setup>
import { ref } from 'vue';
import { defineProps } from 'vue';
import { initFlowbite } from 'flowbite';
import { onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { watch } from 'vue';
import LateralMenu from '@/Components/LateralMenu.vue';

onMounted(() => {
    initFlowbite();
});

const props = defineProps(['exams']);

const exams = ref(props.exams);

function formatDateTime(date) {
    return new Date(date).toLocaleString();
}

const search_name = ref('');
const search_date = ref('');
const search_note = ref('');

watch(search_name, (value) => {
    exams.value = props.exams.filter((exam) => exam.name.toLowerCase().includes(value.toLowerCase()));
});

watch(search_date, (value) => {
    exams.value = props.exams.filter((exam) => exam.created_at.toLowerCase().includes(value.toLowerCase()));
});




</script>
<template>

    <AuthenticatedLayout>

        <LateralMenu>

            <div class="flex ">
                <input type="text" v-model="search_name" placeholder="Buscar examen..."
                    class="w-1/4 p-2 mb-4 border border-gray-200 rounded-lg" />

                <input type="date" v-model="search_date" placeholder="Buscar examen..."
                    class="ml-4 w-1/4 p-2 mb-4 border border-gray-200 rounded-lg" />
            </div>

            <div v-if="exams.length === 0" class="text-center">No se encontraron exámenes</div>

            <div v-for="exam in exams" :key="exam.id"
                class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex items-center justify-between">
                <a :href="'/exam-solutions/' + exam.id" class="p-4">{{ exam.name }}</a>
                <h1 class="p-4">{{ formatDateTime(exam.created_at) }}</h1>
                <h1 class="p-4">{{ exam.correct_questions }} / {{ exam.total_questions }}</h1>
                <span v-if="exam.correct_questions === exam.total_questions"
                    class=" bg-green-500 text-white rounded-md px-2 mr-4">Aprobado</span>
                <span v-else class=" bg-red-500 text-white rounded-md px-2 mr-4">Suspendido</span>


            </div>



        </LateralMenu>

    </AuthenticatedLayout>
</template>