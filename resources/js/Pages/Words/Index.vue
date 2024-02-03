<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link  } from '@inertiajs/vue3';
    import Table from "@/Components/Table.vue";
    import TableRow from "@/Components/TableRow.vue";
    import TableDataCell from "@/Components/TableDataCell.vue";
    import TableHeaderCell from "@/Components/TableHeaderCell.vue";
    import Pagination from "@/Components/Pagination.vue";
    import DangerButton from "@/Components/DangerButton.vue";
    import PrimaryButton from "@/Components/PrimaryButton.vue";
    import FlashMessage from "@/Components/FlashMessage.vue";

    defineProps({
        words: Array
    });
</script>

<template>
    <Head title="Words" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Words</h2>
                <Link :href="route('words.create')">
                    <button class="text-indigo-400">Add new Word</button>
                </Link>
            </div>
        </template>

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
                                <TableRow v-for="word in words.data" :key="word.id">
                                    <TableDataCell>{{ word.word }}</TableDataCell>
                                    <TableDataCell>{{ word.ar_translation }}</TableDataCell>
                                    <TableDataCell>{{ word.en_translation }}</TableDataCell>
                                    <TableDataCell>{{ word.type }}</TableDataCell>
                                    <TableDataCell>{{ word.language_level }}</TableDataCell>
                                    <TableDataCell>{{ word.user }}</TableDataCell>
                                    <TableDataCell class="flex justify-between">
                                        <Link :href="route('words.create')">
                                            <button class="text-sm text-red-400">report issue</button>
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
