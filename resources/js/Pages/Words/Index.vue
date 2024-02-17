<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { ref, watch } from "vue";
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import { Inertia } from "@inertiajs/inertia";
    import Table from "@/Components/Table.vue";
    import TableRow from "@/Components/TableRow.vue";
    import SearchInput from "@/Components/SearchInput.vue";
    import TableDataCell from "@/Components/TableDataCell.vue";
    import TableHeaderCell from "@/Components/TableHeaderCell.vue";
    import Pagination from "@/Components/Pagination.vue";
    import DangerButton from "@/Components/DangerButton.vue";
    import PrimaryButton from "@/Components/PrimaryButton.vue";
    import FlashMessage from "@/Components/FlashMessage.vue";
    import { useTypes } from "@/Compasables/types.js";
    import VueMultiselect from 'vue-multiselect';

    let props = defineProps({
        words: Array,
        language_levels: Array,
        types: Array,
        filters: Object
    });

    console.log(props.filters);

    let languageLevelFilter = ref(props.filters.language_levels);
    let typeFilter = ref(props.filters.types);
    let searchText = ref(props.filters.keyword);
    let showArabicTranslation = ref(true);
    let showEnglishTranslation = ref(true);
    let showAddedBy = ref(true);

    const { getRowColor } = useTypes();

    watch(languageLevelFilter, value => {
        Inertia.get(route('words.index'), { language_levels: value, types: typeFilter.value, keyword: searchText.value }, {
            preserveState: true,
            replace: true
        });
    });

    watch(typeFilter, value => {
        Inertia.get(route('words.index'), { types: value, language_levels: languageLevelFilter.value, keyword: searchText.value }, {
            preserveState: true,
            replace: true
        });
    });

    watch(searchText, value => {
        Inertia.get(route('words.index'), { types: typeFilter.value, language_levels: languageLevelFilter.value, keyword: value }, {
            preserveState: true,
            replace: true
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
                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        create
                    </button>
                </Link>
            </div>
        </template>

        <div class="flex justify-between max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5">
            <div class="drop-down-filters flex">
                <div>
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
                <div class="ml-4">
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
                <div class="ml-4">
                    <input class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                           v-model="searchText" placeholder="search word..."/>
                </div>
            </div>
            <div class="checkbox-filter flex flex-col justify-between ">
                <div>
                    <input type="checkbox" id="arabicTranslation" v-model="showArabicTranslation">
                    <label for="arabicTranslation" class="ml-1">show arabic translation</label>
                </div>
                <div>
                    <input type="checkbox" id="englishTranslation" v-model="showEnglishTranslation">
                    <label for="englishTranslation" class="ml-1">show english translation</label>
                </div>
                <div>
                    <input type="checkbox" id="addedBy" v-model="showAddedBy">
                    <label for="addedBy" class="ml-1">show added by</label>
                </div>
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
                                    <TableHeaderCell v-if="showArabicTranslation"> ARABIC TRANSLATION</TableHeaderCell>
                                    <TableHeaderCell v-if="showEnglishTranslation">ENGLISH TRANSLATION</TableHeaderCell>
                                    <TableHeaderCell>TYPE</TableHeaderCell>
                                    <TableHeaderCell>LEVEL</TableHeaderCell>
                                    <TableHeaderCell v-if="showAddedBy">ADDED BY</TableHeaderCell>
                                    <TableHeaderCell>ACTION</TableHeaderCell>
                                </TableRow>
                            </template>
                            <template #default>
                                <TableRow :class="getRowColor(word.type)" v-for="word in words.data" :key="word.id">
                                    <TableDataCell>{{ word.word }}</TableDataCell>
                                    <TableDataCell v-if="showArabicTranslation">{{ word.ar_translation }}</TableDataCell>
                                    <TableDataCell v-if="showEnglishTranslation">{{ word.en_translation }}</TableDataCell>
                                    <TableDataCell>{{ word.type }}</TableDataCell>
                                    <TableDataCell>{{ word.language_level }}</TableDataCell>
                                    <TableDataCell v-if="showAddedBy" class="text-sm">{{ word.user }}</TableDataCell>
                                    <TableDataCell class="flex justify-between">
                                        <Link :href="route('words.issue.create', word.id)">
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
