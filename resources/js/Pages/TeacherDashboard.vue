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

const props = defineProps(['users']);

console.log(props.users);

const users = ref(props.users);

function formatDateTime(date) {
    return new Date(date).toLocaleString();
}

const search = ref('');

watch(search, (value) => {
    users.value = props.users.filter((user) => user.name.toLowerCase().includes(value.toLowerCase()));
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
    </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
        <thead class="text-xs text-white uppercase bg-gray-800 ">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Exámenes
                </th>
                <th scope="col" class="px-6 py-3">
                    Media de errores
                </th>
                <th scope="col" class="px-6 py-3">
                    Ver exámenes
                </th>
                
            </tr>
        </thead>
        <tbody>
            <tr v-if="users.length === 0" class="bg-white border-b hover:bg-gray-50 ">
                <td class="px-6 py-4" colspan="3">
                    No se encontraron usuarios
                </td>
            </tr>
            <tr v-for="user in users" :key="user.id" class="bg-white border-b hover:bg-gray-50 ">
                <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap ">
                    <img class="w-10 h-10 rounded-full" :src="user.avatar" alt="Jese image">
                    <div class="ps-3">
                        <div class="text-base font-semibold">{{user.name}}</div>
                        <div class="font-normal text-gray-500">{{ user.email }}</div>
                    </div>  
                </th>
                <td class="px-6 py-4">
                    {{ user.total_exams }} exámenes
                </td>
                <td class="px-6 py-4">
                    {{ (user.total_questions - user.correct_questions) / user.total_exams }} errores / examen
                </td>
                <td class="px-6 py-4">
                         <a :href="'/teacher-user-exams/' + user.id" class="bg-blue-500 py-2 px-4 text-white rounded-lg">Ver los exámenes</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>

 
        </LateralMenu>

</template>