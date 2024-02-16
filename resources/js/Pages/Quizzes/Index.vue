<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { ref, watch } from "vue";
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import { Inertia } from "@inertiajs/inertia";
    import Pagination from "@/Components/Pagination.vue";
    import DangerButton from "@/Components/DangerButton.vue";
    import PrimaryButton from "@/Components/PrimaryButton.vue";
    import FlashMessage from "@/Components/FlashMessage.vue";
    import { useTypes } from "@/Compasables/types.js";
    import VueMultiselect from 'vue-multiselect';


    defineProps({
        quizzes: Array
    });

</script>

<template>
    <Head title="Quizzes" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Quizzes</h2>
                <Link :href="route('quizzes.create')">
                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        new quiz
                    </button>
                </Link>
            </div>
        </template>
        <div class="py-12">
            <FlashMessage />
        </div>
        <div v-if="quizzes.data.length > 0">
            <div v-for="quiz in quizzes.data" :key="quiz.id">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="rounded-md shadow overflow-x-auto" :class="(quiz.score > (quiz.number_of_words  / 2) ) ? 'bg-green-100' : 'bg-red-100'">
                                <div class="mx-auto rounded overflow-hidden shadow-lg flex justify-between">
                                    <div class="px-6 py-4">
                                        <div class="font-bold text-xl mb-2">{{quiz.language_level}}</div>
                                        <p class="text-gray-700 text-base mt-4">
                                            {{ quiz.date }}
                                        </p>
                                    </div>
                                    <div class="px-6 py-4 flex flex-col">
                                        <div class="score text-xl">
                                            score: {{ quiz.score }} / {{ quiz.number_of_words }}
                                        </div>
                                        <div class="action text-center mt-4">
                                            <Link :href="route('quizzes.destroy', quiz.id)" method="delete" as="button">
                                                <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    delete
                                                </button>
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <pagination class="mt-6" :links="quizzes.links" />
                </div>
            </div>
        </div>
        <div v-else>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="py-6 px-6 bg-white rounded-md shadow overflow-x-auto text-center text-xl">
                            <h1>No quizzes yet!</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
