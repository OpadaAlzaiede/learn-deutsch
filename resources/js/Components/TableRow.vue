<template>
    <tr class="border-b" :class="colorClass">
        <slot />
    </tr>
</template>

<script setup>
    defineProps({
        colorClass: {
            type: String
        }
    });
</script>
