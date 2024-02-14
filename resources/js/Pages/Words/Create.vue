<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link, useForm  } from '@inertiajs/inertia-vue3';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import VueMultiselect from 'vue-multiselect';


    const props = defineProps({
        language_levels: Array,
        types: Array
    });

    const createForm = useForm({
        word: '',
        type_id: null,
        language_level_id: null
    });

    const submit = () => {
        createForm.language_level_id = createForm.language_level_id.id;
        createForm.type_id = createForm.type_id.id;

        createForm.post(route('words.store'));
    };

</script>

<template>
    <Head title="Create word" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create new word</h2>
                <Link :href="route('words.index')">
                    <button class="text-indigo-400 text-lg underline">Back</button>
                </Link>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-white rounded-md shadow overflow-x-auto p-9">
                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="word" value="word" />

                                <TextInput
                                    id="word"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="createForm.word"
                                    required
                                    autofocus
                                    autocomplete="word"
                                />

                                <InputError class="mt-2" :message="createForm.errors.word" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="language_levels" value="level" />
                                <VueMultiselect
                                    v-model="createForm.language_level_id"
                                    :options="language_levels"
                                    :multiple="false"
                                    :close-on-select="true"
                                    placeholder="Pick one"
                                    label="level"
                                    track-by="id"
                                />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="types" value="type" />
                                <VueMultiselect
                                    v-model="createForm.type_id"
                                    :options="types"
                                    :multiple="false"
                                    :close-on-select="true"
                                    placeholder="Pick one"
                                    label="type"
                                    track-by="id"
                                />
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

<style src="vue-multiselect/dist/vue-multiselect.css"></style>

