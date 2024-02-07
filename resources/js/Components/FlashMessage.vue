<template>
    <div v-if="$page.props.flash.message" :class="$page.props.flash.success ? 'bg-green-100 border-green-200 text-green-700' : 'bg-red-100 border-red-200 text-red-700'" class="border px-4 py-3 mb-5 rounded relative max-w-5xl mx-auto sm:px-6 lg:px-8" role="alert">
            <span class="block sm:inline">{{ $page.props.flash.message }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
      </span>
    </div>
</template>

