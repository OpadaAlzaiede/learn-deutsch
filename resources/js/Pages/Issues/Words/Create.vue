<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link, useForm  } from '@inertiajs/inertia-vue3';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import TextAreaInput from '@/Components/TextAreaInput.vue';
    import VueMultiselect from 'vue-multiselect';

    const props = defineProps({
        word: Object
    });

    const createForm = useForm({
        issue_title: '',
        suggested_solution: '',
    });

    const submit = () => {
        createForm.post(route('words.issue.store', props.word.id));
    };

</script>

<template>
    <Head title="Create issue" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create issue</h2>
                <Link :href="route('words.index')">
                    <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        cancel
                    </button>
                </Link>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-white rounded-md shadow overflow-x-auto p-9">
                        <div class="text-center text-xl underline">
                            <h1>Word Details</h1>
                        </div>
                        <div class="mt-4">
                            <InputLabel for="word" value="word" />

                            <TextInput
                                id="word"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="word.word"
                                required
                                readonly
                                autocomplete="word"
                            />
                        </div>
                        <div class="mt-4">
                            <InputLabel for="ar_translation" value="arabic translation" />

                            <TextInput
                                id="ar_translation"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="word.ar_translation"
                                required
                                readonly
                                autocomplete="ar_translation"
                            />
                        </div>
                        <div class="mt-4">
                            <InputLabel for="en_translation" value="english translation" />

                            <TextInput
                                id="en_translation"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="word.en_translation"
                                required
                                readonly
                                autocomplete="en_translation"
                            />
                        </div>
                        <div class="mt-4">
                            <InputLabel for="language_level" value="language_level" />

                            <TextInput
                                id="language_level"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="word.language_level"
                                required
                                readonly
                                autocomplete="language_level"
                            />
                        </div>
                        <div class="mt-4">
                            <InputLabel for="type" value="type" />

                            <TextInput
                                id="type"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="word.type"
                                required
                                readonly
                                autocomplete="type"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-white rounded-md shadow overflow-x-auto p-9">
                        <div class="text-center text-xl underline">
                            <h1>Create Issue</h1>
                        </div>
                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="issue_title" value="issue title" />

                                <TextInput
                                    id="issue_title"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="createForm.issue_title"
                                    required
                                    autofocus
                                    autocomplete="issue_title"
                                />

                                <InputError class="mt-2" :message="createForm.errors.issue_title" />
                            </div>
                            <div class="mt-5">
                                <InputLabel for="suggested_solution" value="suggested updated" />

                                <TextAreaInput
                                    id="issue_title"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="createForm.suggested_solution"
                                    required
                                    autocomplete="suggested_solution"
                                />

                                <InputError class="mt-2" :message="createForm.errors.suggested_solution" />
                            </div>



                            <div class="mt-4 max-w-6xl flex lg:justify-center">
                                <PrimaryButton class="max-w-3xl ms-4" :class="{ 'opacity-25': createForm.processing }" :disabled="createForm.processing">
                                    create
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style src="../../../../../node_modules/vue-multiselect/dist/vue-multiselect.css"></style>

