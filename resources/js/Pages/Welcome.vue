<template>
    <div class="min-h-screen bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-2xl p-12 max-w-2xl mx-4">
            <h1 class="text-5xl font-bold text-gray-800 mb-4">
                Welcome to Laravel + Vue + Inertia
            </h1>
            <p class="text-xl text-gray-600 mb-8">
                Your monolith project with Tailwind CSS is ready!
            </p>
            <div class="space-y-4">
                <div class="flex items-center space-x-3">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-gray-700">Laravel {{ laravelVersion }}</span>
                </div>
                <div class="flex items-center space-x-3">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-gray-700">Vue.js 3</span>
                </div>
                <div class="flex items-center space-x-3">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-gray-700">Inertia.js</span>
                </div>
                <div class="flex items-center space-x-3">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-gray-700">Tailwind CSS 4</span>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-200">
                <p class="text-sm text-gray-500">
                    Edit <code class="bg-gray-100 px-2 py-1 rounded">resources/js/Pages/Welcome.vue</code> to get started
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    laravelVersion: String,
});
</script>
