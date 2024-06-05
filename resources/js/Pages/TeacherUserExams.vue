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

console.log(props.exams);

const exams = ref(props.exams);

function formatDateTime(date) {
    return new Date(date).toLocaleString();
}

const search_name = ref('');
const search_date = ref('');
const search_result = ref('');


watch(search_name, (value) => {
    exams.value = props.exams.filter((exam) => exam.name.toLowerCase().includes(value.toLowerCase()));
});

watch(search_date, (value) => {
    exams.value = props.exams.filter((exam) => exam.created_at.toLowerCase().includes(value.toLowerCase()));
});

watch(search_result, (value) => {
    if (value === 'aprobado') {
        exams.value = props.exams.filter((exam) => exam.correct_questions / exam.total_questions >= 0.75);
    } else if (value === 'suspendido') {
        exams.value = props.exams.filter((exam) => exam.correct_questions / exam.total_questions < 0.75);
    }
});




</script>
<template>

    

        <LateralMenu>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white  p-4">
        
        <label for="table-search" class="sr-only">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input v-model="search" type="text" id="table-search-users" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 " placeholder="Search for users">
        </div>
            <input type="date" v-model="search_date" placeholder="Buscar examen..."
                class="ml-4 w-1/4 p-2 mb-4 border border-gray-200 rounded-lg" />
            <select v-model="search_result" class="ml-4 w-1/4 p-2 mb-4 border border-gray-200 rounded-lg">
                <option value="">Buscar por resultado</option>
                <option value="aprobado">Aprobado</option>
                <option value="suspendido">Suspendido</option>
            </select>
    </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
        <thead class="text-xs text-white uppercase bg-gray-800 ">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Errores
                </th>
                <th scope="col" class="px-6 py-3">
                    Corrección
                </th>
                <th scope="col" class="px-6 py-3">
                    Ver exámen
                </th>
                
            </tr>
        </thead>
        <tbody>
            <tr v-if="exams.length === 0" class="bg-white border-b hover:bg-gray-50 ">
                <td class="px-6 py-4" colspan="4">
                    No se encontraron usuarios
                </td>
            </tr>
            <tr v-for="exam in exams" :key="exam.id" class="bg-white border-b hover:bg-gray-50 ">
                <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap ">
                    {{ exam.name }}
                </th>
                <td class="px-6 py-4">
                    {{ exam.total_questions - exam.correct_questions }} errores
                </td>
                <td class="px-6 py-4">
                    <span v-if = "exam.correct_questions / exam.total_questions >= 0.75" class="bg-green-200 text-black px-2 rounded-md p-4">Aprobado</span>
                        <span class="bg-red-200 text-black px-2 rounded-md px-3 py-1" v-else>Suspendido</span>
                </td>
                <td class="px-6 py-4">
                         <a :href="'/exam-solutions/' + exam.id" class="bg-blue-500 py-2 px-4 text-white rounded-lg">Ver examen</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>


        </LateralMenu>

    
</template>