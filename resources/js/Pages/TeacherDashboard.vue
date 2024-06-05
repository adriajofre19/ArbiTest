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

    <AuthenticatedLayout>

        <LateralMenu>

            <input type="text" v-model="search" placeholder="Buscar usuario..."
                class="w-full p-2 mb-4 border border-gray-200 rounded-lg" />

            <div v-if="users.length === 0" class="text-center">No se encontraron usuarios</div>

            <a :href="'/teacher-user-exams/' + user.id" v-for="user in users" :key="user.id"
                class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex items-center">
                <div class="p-4">
                    <img :src="user.avatar" :alt="user.name" class="w-20 h-20  rounded-full" />
                </div>
                <div>
                    <div class="p-4">
                        <h2 class="text-xl font-semibold">{{ user.name }}</h2>
                        <p class="text-gray-500">{{ user.email }}</p>
                        <p class="text-gray-500">{{ user.total_exams }} Exámenes</p>
                    </div>
                </div>
            </a>

        </LateralMenu>

    </AuthenticatedLayout>
</template>