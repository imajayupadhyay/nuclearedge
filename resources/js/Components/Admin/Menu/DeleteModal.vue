<template>
    <Transition
        enter-active-class="transition ease-out duration-200"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition ease-in duration-150"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6">
                <div class="flex items-center justify-center w-12 h-12 bg-red-100 rounded-full mx-auto mb-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-900 text-center mb-2">Delete Menu Item</h3>
                <p class="text-slate-600 text-center mb-2">
                    Are you sure you want to delete <strong>{{ item.title }}</strong>?
                </p>
                <p v-if="item.children && item.children.length > 0" class="text-red-600 text-sm text-center mb-6 bg-red-50 p-2 rounded-lg">
                    Warning: This will also delete {{ item.children.length }} sub-item{{ item.children.length > 1 ? 's' : '' }}.
                </p>
                <p v-else class="text-slate-500 text-sm text-center mb-6">
                    This action cannot be undone.
                </p>
                <div class="flex space-x-3">
                    <button
                        @click="$emit('close')"
                        class="flex-1 px-4 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition-colors font-medium"
                    >
                        Cancel
                    </button>
                    <button
                        @click="$emit('confirm')"
                        class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium"
                    >
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </Transition>
</template>

<script setup>
defineProps({
    item: Object,
});

defineEmits(['close', 'confirm']);
</script>
