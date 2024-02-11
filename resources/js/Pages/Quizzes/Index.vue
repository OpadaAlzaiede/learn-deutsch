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
                    <button class="text-indigo-400 text-lg underline">Start new quiz</button>
                </Link>
            </div>
        </template>

        <div v-for="quiz in quizzes.data" :key="quiz.id">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="rounded-md shadow overflow-x-auto" :class="(quiz.score > (quiz.number_of_words  / 2) ) ? 'bg-green-100' : 'bg-red-100'">
                            <div class="mx-auto rounded overflow-hidden shadow-lg flex justify-between">
                                <div class="px-6 py-4">
                                    <div class="font-bold text-xl mb-2">{{quiz.language_level}}</div>
                                    <p class="text-gray-700 text-base">
                                        {{ quiz.date }}
                                    </p>
                                </div>
                                <div class="px-6 py-4 mt-2">
                                    score: {{ quiz.score }} / {{ quiz.number_of_words }}
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
    </AuthenticatedLayout>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
