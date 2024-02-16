<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link  } from '@inertiajs/inertia-vue3';
    import PrimaryButton from '@/Components/PrimaryButton.vue';

    const props = defineProps({
        totalQuestions: Number,
        correctAnswers: Number
    });

</script>

<template>
    <Head title="Result" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Result</h2>
                <Link :href="route('quizzes.create')">
                    <button class="text-indigo-400 text-lg underline">
                        try new quiz
                    </button>
                </Link>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="rounded-md shadow overflow-x-auto p-9 h-200" :class="(correctAnswers > (totalQuestions  / 2) ) ? 'bg-green-100' : 'bg-red-100'">
                        <div class="text-center text-xl">
                            Your Result is: {{ correctAnswers }} / {{ totalQuestions }}
                        </div>
                        <div class="text-center text-xl mt-5">
                            <Link :href="route('quizzes.index')">
                                <button class="text-indigo-400 text-lg underline">view my quizzes</button>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

