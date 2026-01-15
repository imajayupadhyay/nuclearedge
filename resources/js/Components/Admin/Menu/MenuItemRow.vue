<template>
    <div
        :class="[
            'rounded-lg border transition-all',
            depth === 0 ? 'bg-white border-slate-200' : 'bg-slate-50 border-slate-200',
        ]"
    >
        <!-- Item Row -->
        <div class="flex items-center p-4">
            <!-- Drag Handle -->
            <div class="drag-handle cursor-move mr-3 text-slate-400 hover:text-slate-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/>
                </svg>
            </div>

            <!-- Expand/Collapse (if has children or is root level) -->
            <button
                v-if="depth === 0"
                @click="isExpanded = !isExpanded"
                class="mr-3 text-slate-500 hover:text-slate-700"
            >
                <svg
                    :class="['w-5 h-5 transition-transform', isExpanded ? 'rotate-90' : '']"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
            <div v-else class="w-8"></div>

            <!-- Item Info -->
            <div class="flex-1 min-w-0">
                <div class="font-medium text-slate-900 truncate">{{ item.title }}</div>
                <div class="text-sm text-slate-500 flex items-center gap-2 flex-wrap">
                    <span class="font-mono text-xs truncate max-w-[200px]">{{ item.url }}</span>
                    <span v-if="item.open_in_new_tab" class="text-xs bg-blue-100 text-blue-700 px-1.5 py-0.5 rounded flex-shrink-0">New Tab</span>
                </div>
            </div>

            <!-- Status Badge -->
            <span
                :class="[
                    'px-2.5 py-0.5 rounded-full text-xs font-medium mr-4 flex-shrink-0',
                    item.status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
                ]"
            >
                {{ item.status ? 'Active' : 'Inactive' }}
            </span>

            <!-- Children Count Badge -->
            <span
                v-if="depth === 0 && item.children && item.children.length > 0"
                class="px-2 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 mr-4 flex-shrink-0"
            >
                {{ item.children.length }} sub-item{{ item.children.length > 1 ? 's' : '' }}
            </span>

            <!-- Actions -->
            <div class="flex items-center gap-2 flex-shrink-0">
                <button
                    @click="$emit('edit', item)"
                    class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                    title="Edit"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </button>
                <button
                    @click="$emit('delete', item)"
                    class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                    title="Delete"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Children (Nested draggable) - Only for root items -->
        <transition name="expand">
            <div v-if="depth === 0 && isExpanded" class="pl-8 pr-4 pb-4">
                <draggable
                    :model-value="item.children || []"
                    @update:model-value="updateChildren"
                    :group="{ name: 'menu', pull: true, put: true }"
                    item-key="id"
                    handle=".drag-handle"
                    ghost-class="ghost"
                    class="space-y-2 min-h-[40px] bg-slate-100/50 rounded-lg p-2"
                >
                    <template #item="{ element }">
                        <MenuItemRow
                            :item="element"
                            :depth="1"
                            @edit="$emit('edit', $event)"
                            @delete="$emit('delete', $event)"
                        />
                    </template>
                </draggable>
                <p v-if="!item.children || item.children.length === 0" class="text-sm text-slate-400 text-center py-2">
                    Drag items here to create dropdown
                </p>
            </div>
        </transition>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import draggable from 'vuedraggable';

const props = defineProps({
    item: Object,
    depth: {
        type: Number,
        default: 0,
    },
});

const emit = defineEmits(['edit', 'delete', 'update-children']);

const isExpanded = ref(true);

const updateChildren = (newChildren) => {
    emit('update-children', {
        parentId: props.item.id,
        children: newChildren,
    });
};
</script>

<style scoped>
.ghost {
    opacity: 0.5;
    background: #f1f5f9;
    border: 2px dashed #3b82f6;
    border-radius: 0.5rem;
}

.expand-enter-active,
.expand-leave-active {
    transition: all 0.3s ease;
    overflow: hidden;
}

.expand-enter-from,
.expand-leave-to {
    max-height: 0;
    opacity: 0;
    padding-top: 0;
    padding-bottom: 0;
}
</style>
