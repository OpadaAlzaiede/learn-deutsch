<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { ref, watch } from "vue";
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import { Inertia } from "@inertiajs/inertia";
    import Table from "@/Components/Table.vue";
    import TableRow from "@/Components/TableRow.vue";
    import TableDataCell from "@/Components/TableDataCell.vue";
    import TableHeaderCell from "@/Components/TableHeaderCell.vue";
    import Pagination from "@/Components/Pagination.vue";
    import DangerButton from "@/Components/DangerButton.vue";
    import PrimaryButton from "@/Components/PrimaryButton.vue";
    import FlashMessage from "@/Components/FlashMessage.vue";
    import { useTypes } from "@/Compasables/types.js";
    import VueMultiselect from 'vue-multiselect';

    defineProps({
        words: Array,
        language_levels: Array,
        types: Array
    });

    let languageLevelFilter = ref([]);
    let typeFilter = ref([]);

    const { getRowColor } = useTypes();

    watch(languageLevelFilter, value => {
        Inertia.get(route('words.index'), { language_levels: value, types: typeFilter.value }, {
            preserveState: true
        });
    });

    watch(typeFilter, value => {
        Inertia.get(route('words.index'), { types: value, language_levels: languageLevelFilter.value }, {
            preserveState: true
        });
    });

</script>

<template>
    <Head title="Words" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Words</h2>
                <Link :href="route('words.create')">
                    <button class="text-indigo-400 text-lg underline">Add new Word</button>
                </Link>
            </div>
        </template>

        <div class="flex justify-end max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-4">
                <VueMultiselect
                    v-model="languageLevelFilter"
                    :options="language_levels"
                    :multiple="true"
                    :close-on-select="true"
                    placeholder="Filter levels"
                    label="level"
                    track-by="level"
                />
            </div>
            <div class="mt-4">
                <VueMultiselect
                    v-model="typeFilter"
                    :options="types"
                    :multiple="true"
                    :close-on-select="true"
                    placeholder="Filter types"
                    label="type"
                    track-by="type"
                />
            </div>
        </div>

        <div class="py-12">
            <FlashMessage />
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-white rounded-md shadow overflow-x-auto">
                        <Table>
                            <template #header>
                                <TableRow>
                                    <TableHeaderCell>WORD</TableHeaderCell>
                                    <TableHeaderCell>ARABIC TRANSLATION</TableHeaderCell>
                                    <TableHeaderCell>ENGLISH TRANSLATION</TableHeaderCell>
                                    <TableHeaderCell>TYPE</TableHeaderCell>
                                    <TableHeaderCell>LEVEL</TableHeaderCell>
                                    <TableHeaderCell>ADDED BY</TableHeaderCell>
                                    <TableHeaderCell>ACTION</TableHeaderCell>
                                </TableRow>
                            </template>
                            <template #default>
                                <TableRow :class="getRowColor(word.type)" v-for="word in words.data" :key="word.id">
                                    <TableDataCell>{{ word.word }}</TableDataCell>
                                    <TableDataCell>{{ word.ar_translation }}</TableDataCell>
                                    <TableDataCell>{{ word.en_translation }}</TableDataCell>
                                    <TableDataCell>{{ word.type }}</TableDataCell>
                                    <TableDataCell>{{ word.language_level }}</TableDataCell>
                                    <TableDataCell class="text-sm">{{ word.user }}</TableDataCell>
                                    <TableDataCell class="flex justify-between">
                                        <Link :href="route('words.create')">
                                            <button class="text-sm text-red-400 underline">report issue</button>
                                        </Link>
                                    </TableDataCell>
                                </TableRow>
                            </template>
                        </Table>
                    </div>
                    <pagination class="mt-6" :links="words.links" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
