<script setup>

</script>

<template>
    <div class="relative overflow-x-auto">
        <table class="w-full text-lg text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-lg text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <slot name="header"></slot>
            </thead>
            <tbody>
                <slot />
            </tbody>
        </table>
    </div>
</template>
