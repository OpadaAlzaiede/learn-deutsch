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

</script>

<template>
    <Head title="Words" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Users</h2>
            </div>
        </template>

        <div class="py-12">
            <FlashMessage />
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-white rounded-md shadow overflow-x-auto">
                        Users page
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
