<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { defineProps } from 'vue';
import { watch } from 'vue';

const props = defineProps({
    exams: Array
});

const exams = ref(props.exams);

function formatDateTime(date) {
    return new Date(date).toLocaleString();
}

const currentPage = ref(1);
const examsPerPage = 5;

function paginateExams(exams) {
    const startIndex = (currentPage.value - 1) * examsPerPage;
    const endIndex = startIndex + examsPerPage;
    return exams.slice(startIndex, endIndex);
}

const simple_search = ref('');

watch(simple_search, (value) => {
    if (value === '') {
        exams.value = props.exams;
    } else {
        exams.value = props.exams.filter((exam) => {
            return exam.name.toLowerCase().includes(value.toLowerCase());
        });
    }
});



</script>
<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Mis examenes</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 mb-4 flex justify-end mt-4">
                <input v-model="simple_search" type="text" class="w-full md:w-2/6 border border-gray-300 rounded-md p-2" placeholder="Buscar examen">
            </div>
            <div class="max-w-7xl mx-auto px-6 lg:px-8 mb-4" v-for="exam in paginateExams(exams)" :key="exam.id">
                <a :href="'/exam-solutions/'+exam.id">
                    <div class="bg-white overflow-hidden block md:flex justify-between shadow-sm rounded-lg px-4 ">
                        <div class="p-6 text-gray-900">{{ exam.name }}</div>
                        <div class="p-6 text-gray-900">{{ exam.correct_questions }} / {{ exam.total_questions }}</div>
                        <div class="p-6 text-gray-900">{{ formatDateTime(exam.created_at) }}</div>
                        <div class="p-6 text-gray-900">
                            <span v-if="exam.correct_questions / exam.total_questions >= 0.75" class="bg-green-200 text-black px-2 rounded-md">Aprobado</span>
                            <span class="bg-red-200 text-black px-2 rounded-md" v-else>Suspendido</span>
                        </div>
                    </div>
                </a> 
            </div>

            <div class="max-w-7xl mx-auto px-6 lg:px-8 mb-4 flex justify-between mt-4">
                <span class="text-sm font-normal text-gray-500 ">
                Mostrando
                <span class="font-semibold text-gray-900 ">{{ (currentPage - 1) * examsPerPage + 1 }}-{{ Math.min(currentPage * examsPerPage, exams.length) }}</span>
                de
                <span class="font-semibold text-gray-900 ">{{ exams.length }}</span>
            </span>
            <ul class="inline-flex items-stretch -space-x-px">
                <li>
                <button @click="currentPage--" :disabled="currentPage === 1" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                    <span class="sr-only">Previous</span>
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>
                </li>
                <li v-for="page in Math.ceil(exams.length / examsPerPage)" :key="page">
                <button @click="currentPage = page" :class="{ 'text-black bg-blue-200': currentPage === page }" class="flex items center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white border border-gray-300 ">
                    {{ page }}
                </button>
                </li>
                <li>
                <button @click="currentPage++" :disabled="currentPage * examsPerPage >= exams.length" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                    <span class="sr-only">Next</span>
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>
                </li>
            </ul>
            </div>
        </div>

    </AuthenticatedLayout>
</template>