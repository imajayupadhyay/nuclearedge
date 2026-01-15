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
            <div class="bg-white rounded-xl shadow-2xl max-w-lg w-full p-6">
                <h3 class="text-lg font-semibold text-slate-900 mb-6">
                    {{ item ? 'Edit Menu Item' : 'Add Menu Item' }}
                </h3>

                <form @submit.prevent="submit">
                    <!-- Title -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Title <span class="text-red-500">*</span>
                        </label>
                        <input
                            v-model="form.title"
                            type="text"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="e.g., About Us"
                            required
                        />
                    </div>

                    <!-- URL -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            URL <span class="text-red-500">*</span>
                        </label>
                        <input
                            v-model="form.url"
                            type="text"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent font-mono text-sm"
                            placeholder="/about or https://external.com"
                            required
                        />
                        <p class="text-xs text-slate-500 mt-1">Use relative paths (e.g., /about) for internal links or full URLs for external links</p>
                    </div>

                    <!-- Icon (optional) -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Icon SVG Path (optional)
                        </label>
                        <textarea
                            v-model="form.icon"
                            rows="2"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent font-mono text-xs"
                            placeholder="M3 12l2-2m0 0l7-7 7 7M5 10v10..."
                        ></textarea>
                        <p class="text-xs text-slate-500 mt-1">SVG path data (d attribute value) for mobile menu icons</p>
                    </div>

                    <!-- Options Row -->
                    <div class="flex items-center gap-6 mb-6">
                        <!-- Open in New Tab -->
                        <label class="flex items-center cursor-pointer">
                            <input
                                v-model="form.open_in_new_tab"
                                type="checkbox"
                                class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500"
                            />
                            <span class="ml-2 text-sm text-slate-700">Open in new tab</span>
                        </label>

                        <!-- Status -->
                        <label class="flex items-center cursor-pointer">
                            <input
                                v-model="form.status"
                                type="checkbox"
                                class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500"
                            />
                            <span class="ml-2 text-sm text-slate-700">Active</span>
                        </label>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end gap-3">
                        <button
                            type="button"
                            @click="$emit('close')"
                            class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            class="px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg hover:shadow-lg transition-all"
                        >
                            {{ item ? 'Update' : 'Add' }} Item
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </Transition>
</template>

<script setup>
import { reactive, watch } from 'vue';

const props = defineProps({
    item: Object,
});

const emit = defineEmits(['close', 'save']);

const form = reactive({
    title: '',
    url: '',
    icon: '',
    open_in_new_tab: false,
    status: true,
});

// Populate form if editing
watch(() => props.item, (newItem) => {
    if (newItem) {
        form.title = newItem.title || '';
        form.url = newItem.url || '';
        form.icon = newItem.icon || '';
        form.open_in_new_tab = newItem.open_in_new_tab || false;
        form.status = newItem.status !== undefined ? newItem.status : true;
    } else {
        form.title = '';
        form.url = '';
        form.icon = '';
        form.open_in_new_tab = false;
        form.status = true;
    }
}, { immediate: true });

const submit = () => {
    emit('save', { ...form });
};
</script>
