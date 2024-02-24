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

    const props = defineProps({
        users: Array,
        filters: Object
    });

    let searchText = ref(props.filters.keyword);

    watch(searchText, value => {
        Inertia.get(route('users.index'), { keyword: value }, {
            preserveState: true,
            replace: true
        });
    });

</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Users</h2>
            </div>
        </template>

        <div class="flex justify-between max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5">
            <div>
                <input class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                       v-model="searchText" placeholder="search user..."/>
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
                                    <TableHeaderCell>ID</TableHeaderCell>
                                    <TableHeaderCell>NAME</TableHeaderCell>
                                    <TableHeaderCell>EMAIL</TableHeaderCell>
                                    <TableHeaderCell>REGISTERED AT</TableHeaderCell>
                                    <TableHeaderCell>ACTION</TableHeaderCell>
                                </TableRow>
                            </template>
                            <template #default>
                                <TableRow v-for="user in users.data" :key="user.id">
                                    <TableDataCell>{{ user.id }}</TableDataCell>
                                    <TableDataCell>{{ user.name }}</TableDataCell>
                                    <TableDataCell>{{ user.email }}</TableDataCell>
                                    <TableDataCell>{{ user.registered_at }}</TableDataCell>
                                    <TableDataCell class="">
                                        <Link method="put" as="button" :href="route('users.change-state', user.id)">
                                            <button class="text-sm underline" :class="user.is_blocked ? 'text-indigo-400' : 'text-red-400'">
                                                {{user.is_blocked ? 'unblock' : 'block'}}
                                            </button>
                                        </Link>
                                        <Link class="ml-4" :href="route('words.issue.create', user.id)">
                                            <button class="text-sm text-indigo-400 underline">manage</button>
                                        </Link>
                                    </TableDataCell>
                                </TableRow>
                            </template>
                        </Table>
                    </div>
                    <pagination class="mt-6" :links="users.links" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
