<template>
    <Head>
        <title>Menu Management - Admin Portal</title>
    </Head>

    <AdminLayout :user="$page.props.auth.user">
        <!-- Header -->
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Menu Management</h1>
                <p class="text-slate-600 mt-1">Drag and drop to reorder. Drag onto an item to create dropdown.</p>
            </div>
            <button
                @click="showAddModal = true"
                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200"
            >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Menu Item
            </button>
        </div>

        <!-- Success Message -->
        <div v-if="$page.props.flash.success" class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center">
            <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="text-green-800">{{ $page.props.flash.success }}</span>
        </div>

        <!-- Error Message -->
        <div v-if="$page.props.flash.error" class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg flex items-center">
            <svg class="w-5 h-5 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="text-red-800">{{ $page.props.flash.error }}</span>
        </div>

        <!-- Menu Tree Container -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <draggable
                v-model="localMenuItems"
                :group="{ name: 'menu', pull: true, put: true }"
                item-key="id"
                handle=".drag-handle"
                ghost-class="ghost"
                @change="handleDragChange"
                class="space-y-2 min-h-[100px]"
            >
                <template #item="{ element }">
                    <MenuItemRow
                        :item="element"
                        :depth="0"
                        @edit="editItem"
                        @delete="deleteItem"
                        @update-children="updateChildren"
                    />
                </template>
            </draggable>

            <div v-if="localMenuItems.length === 0" class="text-center py-12 text-slate-500">
                <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <p class="text-lg font-medium">No menu items yet</p>
                <p class="mt-1">Click "Add Menu Item" to get started</p>
            </div>
        </div>

        <!-- Save Button (appears after changes) -->
        <Transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="opacity-0 translate-y-4"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transition ease-in duration-150"
            leave-from-class="opacity-100 translate-y-0"
            leave-to-class="opacity-0 translate-y-4"
        >
            <div v-if="hasChanges" class="fixed bottom-6 right-6 z-50">
                <button
                    @click="saveOrder"
                    :disabled="isSaving"
                    class="px-6 py-3 bg-green-500 text-white font-semibold rounded-xl shadow-lg hover:bg-green-600 transition-colors flex items-center"
                >
                    <svg v-if="!isSaving" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <svg v-else class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                    {{ isSaving ? 'Saving...' : 'Save Order' }}
                </button>
            </div>
        </Transition>

        <!-- Add/Edit Modal -->
        <MenuItemModal
            v-if="showAddModal || editingItem"
            :item="editingItem"
            @close="closeModal"
            @save="saveItem"
        />

        <!-- Delete Confirmation Modal -->
        <DeleteModal
            v-if="deletingItem"
            :item="deletingItem"
            @close="deletingItem = null"
            @confirm="confirmDelete"
        />
    </AdminLayout>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import draggable from 'vuedraggable';
import AdminLayout from '../../../Components/Admin/AdminLayout.vue';
import MenuItemRow from '../../../Components/Admin/Menu/MenuItemRow.vue';
import MenuItemModal from '../../../Components/Admin/Menu/MenuItemModal.vue';
import DeleteModal from '../../../Components/Admin/Menu/DeleteModal.vue';
import axios from 'axios';

const props = defineProps({
    menuItems: Array,
});

// Local state for drag-and-drop
const localMenuItems = ref(JSON.parse(JSON.stringify(props.menuItems || [])));
const originalOrder = ref(JSON.stringify(props.menuItems || []));
const hasChanges = computed(() => JSON.stringify(localMenuItems.value) !== originalOrder.value);

// Modal state
const showAddModal = ref(false);
const editingItem = ref(null);
const deletingItem = ref(null);
const isSaving = ref(false);

// Watch for prop changes (after Inertia reload)
watch(() => props.menuItems, (newVal) => {
    localMenuItems.value = JSON.parse(JSON.stringify(newVal || []));
    originalOrder.value = JSON.stringify(newVal || []);
}, { deep: true });

// Flatten tree for API submission
const flattenTree = (items, parentId = null) => {
    let result = [];
    items.forEach((item, index) => {
        result.push({
            id: item.id,
            parent_id: parentId,
            order: index,
        });
        if (item.children && item.children.length > 0) {
            result = result.concat(flattenTree(item.children, item.id));
        }
    });
    return result;
};

// Handle drag changes
const handleDragChange = () => {
    // Changes are tracked reactively through v-model
};

// Update children order (called from child component)
const updateChildren = ({ parentId, children }) => {
    const parent = findItem(localMenuItems.value, parentId);
    if (parent) {
        parent.children = children;
    }
};

// Find item recursively
const findItem = (items, id) => {
    for (const item of items) {
        if (item.id === id) return item;
        if (item.children) {
            const found = findItem(item.children, id);
            if (found) return found;
        }
    }
    return null;
};

// Save reordered structure
const saveOrder = async () => {
    isSaving.value = true;
    try {
        const flatItems = flattenTree(localMenuItems.value);
        await axios.post('/admin/menus/reorder', { items: flatItems });
        originalOrder.value = JSON.stringify(localMenuItems.value);
        router.reload({ only: ['menuItems'] });
    } catch (error) {
        alert('Failed to save order. Please try again.');
    } finally {
        isSaving.value = false;
    }
};

// Modal handlers
const editItem = (item) => {
    editingItem.value = { ...item };
};

const deleteItem = (item) => {
    deletingItem.value = item;
};

const closeModal = () => {
    showAddModal.value = false;
    editingItem.value = null;
};

const saveItem = (formData) => {
    if (editingItem.value) {
        router.put(`/admin/menus/${editingItem.value.id}`, formData, {
            onSuccess: () => closeModal(),
        });
    } else {
        router.post('/admin/menus', formData, {
            onSuccess: () => closeModal(),
        });
    }
};

const confirmDelete = () => {
    router.delete(`/admin/menus/${deletingItem.value.id}`, {
        onSuccess: () => {
            deletingItem.value = null;
        },
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
</style>
