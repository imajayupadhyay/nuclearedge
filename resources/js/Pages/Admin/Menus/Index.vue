<template>
    <Head>
        <title>Menu Management - Admin Portal</title>
    </Head>

    <AdminLayout :user="$page.props.auth.user">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
                <a href="/admin/dashboard" class="hover:text-slate-700">Dashboard</a>
                <span>/</span>
                <span class="text-slate-900">Menu & Social Links</span>
            </div>
            <h1 class="text-2xl font-bold text-slate-900">Menu & Social Links</h1>
            <p class="text-slate-600 mt-1">Manage navigation menu and social media links</p>
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

        <!-- ==================== SOCIAL LINKS SECTION ==================== -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-pink-500 to-rose-600 flex items-center justify-center">
                        <span class="text-white font-bold">1</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Social Media Links</h2>
                        <p class="text-sm text-slate-500">Manage social media links shown in the header navigation</p>
                    </div>
                </div>
                <button
                    @click="openAddSocialModal"
                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-pink-500 to-rose-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Social Link
                </button>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <!-- Social Links List -->
                <div v-if="localSocialLinks.length > 0" class="divide-y divide-slate-200">
                    <div
                        v-for="(link, index) in localSocialLinks"
                        :key="link.id"
                        class="flex items-center justify-between p-4 hover:bg-slate-50 transition-colors"
                    >
                        <div class="flex items-center gap-4">
                            <!-- Icon Preview -->
                            <div class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-slate-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path :d="link.icon"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-slate-900">{{ link.name }}</h4>
                                <p class="text-sm text-slate-500 truncate max-w-xs">{{ link.url }}</p>
                            </div>
                            <span
                                :class="[
                                    'px-2 py-1 text-xs font-medium rounded-full',
                                    link.is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'
                                ]"
                            >
                                {{ link.is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        <div class="flex items-center gap-2">
                            <!-- Move Up/Down -->
                            <button
                                @click="moveSocialLink(index, -1)"
                                :disabled="index === 0"
                                class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition-all disabled:opacity-30 disabled:cursor-not-allowed"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
                                </svg>
                            </button>
                            <button
                                @click="moveSocialLink(index, 1)"
                                :disabled="index === localSocialLinks.length - 1"
                                class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition-all disabled:opacity-30 disabled:cursor-not-allowed"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <!-- Edit -->
                            <button
                                @click="editSocialLink(link)"
                                class="p-2 text-blue-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </button>
                            <!-- Delete -->
                            <button
                                @click="confirmDeleteSocialLink(link)"
                                class="p-2 text-red-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Empty State -->
                <div v-else class="text-center py-12 text-slate-500">
                    <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                    </svg>
                    <p class="text-lg font-medium">No social links yet</p>
                    <p class="mt-1">Click "Add Social Link" to add your first social media link</p>
                </div>
            </div>
        </div>

        <!-- ==================== MENU SECTION ==================== -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                        <span class="text-white font-bold">2</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Navigation Menu</h2>
                        <p class="text-sm text-slate-500">Drag and drop to reorder. Drag onto an item to create dropdown.</p>
                    </div>
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

        <!-- Social Link Modal -->
        <div v-if="showSocialModal" class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" @click="closeSocialModal"></div>

                <div class="relative bg-white rounded-2xl shadow-2xl max-w-lg w-full mx-auto z-10">
                    <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
                        <h3 class="text-xl font-bold text-slate-900">{{ editingSocialLink ? 'Edit Social Link' : 'Add Social Link' }}</h3>
                        <button @click="closeSocialModal" class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <form @submit.prevent="saveSocialLink" class="p-6">
                        <!-- Name -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Platform Name *</label>
                            <input
                                v-model="socialForm.name"
                                type="text"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500"
                                placeholder="e.g., LinkedIn"
                                required
                            />
                        </div>

                        <!-- URL -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Profile URL *</label>
                            <input
                                v-model="socialForm.url"
                                type="url"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500"
                                placeholder="https://linkedin.com/company/yourcompany"
                                required
                            />
                        </div>

                        <!-- Icon Selection -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Icon *</label>
                            <div class="grid grid-cols-5 gap-2">
                                <button
                                    v-for="(iconPath, iconName) in defaultIcons"
                                    :key="iconName"
                                    type="button"
                                    @click="socialForm.icon = iconPath"
                                    :class="[
                                        'p-3 rounded-lg border-2 transition-all flex items-center justify-center',
                                        socialForm.icon === iconPath
                                            ? 'border-pink-500 bg-pink-50'
                                            : 'border-slate-200 hover:border-slate-300'
                                    ]"
                                >
                                    <svg class="w-6 h-6" :class="socialForm.icon === iconPath ? 'text-pink-600' : 'text-slate-600'" fill="currentColor" viewBox="0 0 24 24">
                                        <path :d="iconPath"/>
                                    </svg>
                                </button>
                            </div>
                            <p class="text-xs text-slate-500 mt-2">Select a platform icon above</p>
                        </div>

                        <!-- Custom Icon (optional) -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Or Custom SVG Path</label>
                            <textarea
                                v-model="socialForm.icon"
                                rows="2"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 text-sm font-mono"
                                placeholder="Paste SVG path here..."
                            ></textarea>
                        </div>

                        <!-- Active Status -->
                        <div class="mb-6">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input
                                    v-model="socialForm.is_active"
                                    type="checkbox"
                                    class="w-5 h-5 text-pink-500 border-slate-300 rounded focus:ring-pink-500"
                                />
                                <span class="text-sm font-medium text-slate-700">Active (visible on the website)</span>
                            </label>
                        </div>

                        <!-- Actions -->
                        <div class="flex justify-end gap-3">
                            <button
                                type="button"
                                @click="closeSocialModal"
                                class="px-6 py-2 bg-slate-100 text-slate-700 font-semibold rounded-lg hover:bg-slate-200 transition-all"
                            >
                                Cancel
                            </button>
                            <button
                                type="submit"
                                :disabled="socialForm.processing"
                                class="px-6 py-2 bg-gradient-to-r from-pink-500 to-rose-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all disabled:opacity-50"
                            >
                                {{ editingSocialLink ? 'Update' : 'Add' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Social Link Modal -->
        <div v-if="deletingSocialLink" class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" @click="deletingSocialLink = null"></div>

                <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full mx-auto z-10 p-6">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Delete Social Link</h3>
                        <p class="text-slate-600 mb-6">Are you sure you want to delete "{{ deletingSocialLink?.name }}"?</p>
                        <div class="flex justify-center gap-3">
                            <button @click="deletingSocialLink = null" class="px-6 py-2 bg-slate-100 text-slate-700 font-semibold rounded-lg hover:bg-slate-200 transition-all">
                                Cancel
                            </button>
                            <button @click="deleteSocialLink" class="px-6 py-2 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 transition-all">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref, reactive, computed, watch } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import draggable from 'vuedraggable';
import AdminLayout from '../../../Components/Admin/AdminLayout.vue';
import MenuItemRow from '../../../Components/Admin/Menu/MenuItemRow.vue';
import MenuItemModal from '../../../Components/Admin/Menu/MenuItemModal.vue';
import DeleteModal from '../../../Components/Admin/Menu/DeleteModal.vue';
import axios from 'axios';

const props = defineProps({
    menuItems: Array,
    socialLinks: Array,
    defaultIcons: Object,
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

// ==================== SOCIAL LINKS ====================
const localSocialLinks = ref([...props.socialLinks || []]);
const showSocialModal = ref(false);
const editingSocialLink = ref(null);
const deletingSocialLink = ref(null);

const defaultSocialForm = {
    name: '',
    url: '',
    icon: '',
    is_active: true,
    processing: false,
};

const socialForm = reactive({ ...defaultSocialForm });

// Watch for prop changes
watch(() => props.socialLinks, (newVal) => {
    localSocialLinks.value = [...newVal || []];
}, { deep: true });

const openAddSocialModal = () => {
    editingSocialLink.value = null;
    Object.assign(socialForm, defaultSocialForm);
    showSocialModal.value = true;
};

const editSocialLink = (link) => {
    editingSocialLink.value = link;
    Object.assign(socialForm, {
        name: link.name || '',
        url: link.url || '',
        icon: link.icon || '',
        is_active: link.is_active ?? true,
        processing: false,
    });
    showSocialModal.value = true;
};

const closeSocialModal = () => {
    showSocialModal.value = false;
    editingSocialLink.value = null;
};

const saveSocialLink = () => {
    socialForm.processing = true;
    const data = {
        name: socialForm.name,
        url: socialForm.url,
        icon: socialForm.icon,
        is_active: socialForm.is_active,
    };

    if (editingSocialLink.value) {
        router.put(`/admin/social-links/${editingSocialLink.value.id}`, data, {
            onSuccess: () => closeSocialModal(),
            onFinish: () => { socialForm.processing = false; },
        });
    } else {
        router.post('/admin/social-links', data, {
            onSuccess: () => closeSocialModal(),
            onFinish: () => { socialForm.processing = false; },
        });
    }
};

const confirmDeleteSocialLink = (link) => {
    deletingSocialLink.value = link;
};

const deleteSocialLink = () => {
    router.delete(`/admin/social-links/${deletingSocialLink.value.id}`, {
        onSuccess: () => {
            deletingSocialLink.value = null;
        },
    });
};

const moveSocialLink = (index, direction) => {
    const newIndex = index + direction;
    if (newIndex < 0 || newIndex >= localSocialLinks.value.length) return;

    const temp = localSocialLinks.value[index];
    localSocialLinks.value[index] = localSocialLinks.value[newIndex];
    localSocialLinks.value[newIndex] = temp;

    // Update order in backend
    const reorderedLinks = localSocialLinks.value.map((link, idx) => ({
        id: link.id,
        order: idx,
    }));

    router.post('/admin/social-links/reorder', { links: reorderedLinks }, {
        preserveScroll: true,
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
