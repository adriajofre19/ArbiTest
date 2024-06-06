<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    

        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
    

<div class="bg-gray-300">
        <div class="flex justify-center h-screen">
            <div class="hidden bg-cover lg:block lg:w-2/4" style="background-image: url(https://images.unsplash.com/photo-1616763355603-9755a640a287?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80)">
                <div class="flex items-center h-full px-20 bg-gray-900 bg-opacity-40">
                    <div>
                        <img src="/img/logo_page.png" alt="logo" class="w-20 h-20 mb-4"/>
                        <h2 class="text-4xl font-bold text-white">ArbiTest</h2>
                        
                        <p class="max-w-xl mt-3 text-gray-300">¡Sigue adelante y no te rindas! Cada partido es una oportunidad para crecer y mejorar. Confía en tus habilidades, mantén la concentración y demuestra tu pasión por el arbitraje. Con esfuerzo y dedicación, lograrás alcanzar tu ascenso. ¡Tú puedes hacerlo!</p>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center w-full max-w-lg sm:px-6 mx-auto lg:w-2/4 bg-white sm:bg-gray-300" >
                <div class="flex-1 border p-8 bg-white sm:shadow-lg sm:border-gray-300 border-0 shadow-0">
                    <div class="text-center">
                        <img src="/img/logo_page.png" alt="logo" class="w-16 h-16 mx-auto mb-4"/>
                        <h2 class="text-4xl font-bold text-center text-gray-700">ArbiTest</h2>
                        
                    </div>

                    <div class="mt-8">
                        <form @submit.prevent="submit">
                            <div>
                                <label for="email" class="block mb-2 text-sm text-gray-600 ">Email</label>
                                <input type="email" v-model="form.email" name="email" id="email" placeholder="email@gmail.com" class="block w-full px-4 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md  focus:border-blue-400  focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                                <InputError class="mt-2" :message="form.errors.email" />
                                    
                            </div>
                                

                            <div class="mt-6">
                                <div class="flex justify-between mb-2">
                                    <label for="password" class="text-sm text-gray-600 ">Contrasenya</label>
                                </div>

                                <input type="password" name="password" id="password" v-model="form.password" placeholder="Contrasenya" class="block w-full px-4 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md  focus:border-blue-400  focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                                <InputError class="mt-2" :message="form.errors.password" />
                            </div>

                            <div class="mt-6">
                                <button
                                    class="w-full px-4 py-3 tracking-wide text-white transition-colors duration-200 transform bg-black rounded-md focus:outline-none focus:ring focus:ring-opacity-50">
                                    Iniciar sessió
                                </button>
                            </div>

                                <div class="flex md:justify-between justify-center items-center mt-10">
                    <div style="height: 1px;" class="bg-gray-300 md:block hidden w-6/12"></div>
                    <p class="md:mx-2 text-sm font-light text-gray-400"> Or </p> 
                    <div style="height: 1px;" class="bg-gray-300 md:block hidden w-6/12"></div> 
                </div>

                            <div class="mt-6">
                                <a href="/login-google"
                    class="w-full px-4 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md  focus:border-blue-400  focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40 flex space-x-2 items-center justify-center">
                    <img src="/img/logo.png" class="w-6 h-6" alt=""> <span>Login with Google</span>
                </a>
                            </div>

                            

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

</template>



