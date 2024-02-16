<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link, useForm, usePage, useRemember  } from '@inertiajs/inertia-vue3';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import VueMultiselect from 'vue-multiselect';
    import FlashMessage from "@/Components/FlashMessage.vue";
    import { computed, onMounted, onUnmounted, ref } from 'vue';
    import { Inertia } from '@inertiajs/inertia';

    const props = defineProps({
        quizId: Number,
        questions: Array,
        types: Array,
    });

    const solutions = Inertia.restore('solutions') ?? {};

    const addChoice = (questionId, choiceId) => {

        solutions[questionId] = choiceId;
        Inertia.remember(solutions, 'solutions');
    };

    const submitForm = useForm({
        quiz_id: props.quizId,
        solutions: solutions
    });

    const submit = () => {

        submitForm.post(route('quizzes.submit'));
    };

</script>

<template>
    <Head title="Start Quiz" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Questions</h2>
            </div>
        </template>
        <div class="py-12">
            <FlashMessage />
        </div>
        <div class="py-12" v-for="question in questions.data" :key="question.id">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-white rounded-md shadow overflow-x-auto p-9 h-200">
                        <div class="text-xl">
                            {{ question.word }}
                        </div>
                        <div>
                            <div v-for="type in types" :key="type.id" class="mt-4">
                                <input @click="addChoice(question.id, type.id)" type="radio" :checked="solutions[question.id] === type.id" :name="question.id">
                                {{type.type}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-between max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between">
                <div class="mr-2" v-if="questions.current_page > 1">
                    <Link preserve-state class="text-lg text-indigo-400 underline"  :href="questions.prev_page_url">
                        previous
                    </Link>
                </div>
                &nbsp;&nbsp;&nbsp;
                <div v-if="questions.next_page_url">
                    <Link preserve-state class="text-lg text-indigo-400 underline" :href="questions.next_page_url">
                        next
                    </Link>
                </div>
            </div>
            <div v-if="!questions.next_page_url">
                <form @submit.prevent="submit">
                    <PrimaryButton class="max-w-3xl ms-4" :class="{ 'opacity-25': submitForm.processing }" :disabled="submitForm.processing">
                        submit
                    </PrimaryButton>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>

