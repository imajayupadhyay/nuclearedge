<template>
    <Head>
        <title>Create Category - Admin Portal</title>
    </Head>

    <AdminLayout :user="$page.props.auth.user">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center space-x-4 mb-4">
                <a
                    href="/admin/categories"
                    class="p-2 hover:bg-slate-100 rounded-lg transition-colors"
                >
                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">Create New Category</h1>
                    <p class="text-slate-600 mt-1">Add a new blog category with hierarchical support</p>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="max-w-4xl">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <form @submit.prevent="submit">
                    <!-- Basic Information Section -->
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-slate-900 mb-4">Basic Information</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-slate-700 mb-2">
                                    Category Name <span class="text-red-500">*</span>
                                </label>
                                <input
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    :class="form.errors.name ? 'border-red-500' : 'border-slate-300'"
                                    placeholder="e.g., Travel, Cafes, Hotels"
                                />
                                <p v-if="form.errors.name" class="mt-1 text-sm text-red-600">{{ form.errors.name }}</p>
                            </div>

                            <!-- Slug -->
                            <div>
                                <label for="slug" class="block text-sm font-medium text-slate-700 mb-2">
                                    Slug (URL-friendly)
                                </label>
                                <input
                                    id="slug"
                                    v-model="form.slug"
                                    type="text"
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 font-mono text-sm"
                                    :class="form.errors.slug ? 'border-red-500' : 'border-slate-300'"
                                    placeholder="Leave empty to auto-generate"
                                />
                                <p v-if="form.errors.slug" class="mt-1 text-sm text-red-600">{{ form.errors.slug }}</p>
                                <p class="mt-1 text-xs text-slate-500">Auto-generated from name if left empty</p>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mt-6">
                            <label for="description" class="block text-sm font-medium text-slate-700 mb-2">
                                Description
                            </label>
                            <textarea
                                id="description"
                                v-model="form.description"
                                rows="4"
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="form.errors.description ? 'border-red-500' : 'border-slate-300'"
                                placeholder="Brief description of the category"
                            ></textarea>
                            <p v-if="form.errors.description" class="mt-1 text-sm text-red-600">{{ form.errors.description }}</p>
                        </div>
                    </div>

                    <!-- Hierarchy & Settings Section -->
                    <div class="mb-6 pt-6 border-t border-slate-200">
                        <h2 class="text-lg font-semibold text-slate-900 mb-4">Hierarchy & Settings</h2>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Parent Category -->
                            <div>
                                <label for="parent_id" class="block text-sm font-medium text-slate-700 mb-2">
                                    Parent Category
                                </label>
                                <select
                                    id="parent_id"
                                    v-model="form.parent_id"
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    :class="form.errors.parent_id ? 'border-red-500' : 'border-slate-300'"
                                >
                                    <option :value="null">None (Root Category)</option>
                                    <template v-for="parent in parentCategories" :key="parent.id">
                                        <option :value="parent.id">{{ parent.name }}</option>
                                        <option
                                            v-for="child in parent.children"
                                            :key="child.id"
                                            :value="child.id"
                                        >
                                            &nbsp;&nbsp;&nbsp;&nbsp;↳ {{ child.name }}
                                        </option>
                                    </template>
                                </select>
                                <p v-if="form.errors.parent_id" class="mt-1 text-sm text-red-600">{{ form.errors.parent_id }}</p>
                            </div>

                            <!-- Order -->
                            <div>
                                <label for="order" class="block text-sm font-medium text-slate-700 mb-2">
                                    Display Order
                                </label>
                                <input
                                    id="order"
                                    v-model="form.order"
                                    type="number"
                                    min="0"
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    :class="form.errors.order ? 'border-red-500' : 'border-slate-300'"
                                    placeholder="0"
                                />
                                <p v-if="form.errors.order" class="mt-1 text-sm text-red-600">{{ form.errors.order }}</p>
                                <p class="mt-1 text-xs text-slate-500">Lower numbers appear first</p>
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-slate-700 mb-2">
                                    Status <span class="text-red-500">*</span>
                                </label>
                                <select
                                    id="status"
                                    v-model="form.status"
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    :class="form.errors.status ? 'border-red-500' : 'border-slate-300'"
                                >
                                    <option :value="true">Active</option>
                                    <option :value="false">Inactive</option>
                                </select>
                                <p v-if="form.errors.status" class="mt-1 text-sm text-red-600">{{ form.errors.status }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- SEO Section -->
                    <div class="mb-6 pt-6 border-t border-slate-200">
                        <h2 class="text-lg font-semibold text-slate-900 mb-4">SEO Settings</h2>

                        <!-- Meta Title -->
                        <div class="mb-6">
                            <label for="meta_title" class="block text-sm font-medium text-slate-700 mb-2">
                                Meta Title
                            </label>
                            <input
                                id="meta_title"
                                v-model="form.meta_title"
                                type="text"
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="form.errors.meta_title ? 'border-red-500' : 'border-slate-300'"
                                placeholder="SEO title for search engines"
                            />
                            <p v-if="form.errors.meta_title" class="mt-1 text-sm text-red-600">{{ form.errors.meta_title }}</p>
                        </div>

                        <!-- Meta Description -->
                        <div>
                            <label for="meta_description" class="block text-sm font-medium text-slate-700 mb-2">
                                Meta Description
                            </label>
                            <textarea
                                id="meta_description"
                                v-model="form.meta_description"
                                rows="3"
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="form.errors.meta_description ? 'border-red-500' : 'border-slate-300'"
                                placeholder="SEO description for search engines"
                            ></textarea>
                            <p v-if="form.errors.meta_description" class="mt-1 text-sm text-red-600">{{ form.errors.meta_description }}</p>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-slate-200">
                        <a
                            href="/admin/categories"
                            class="px-6 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors font-medium"
                        >
                            Cancel
                        </a>
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 font-medium disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <span v-if="!form.processing">Create Category</span>
                            <span v-else class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Creating...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '../../../Components/Admin/AdminLayout.vue';

const props = defineProps({
    parentCategories: Array,
});

const form = useForm({
    name: '',
    slug: '',
    description: '',
    parent_id: null,
    order: 0,
    status: true,
    meta_title: '',
    meta_description: '',
});

const submit = () => {
    form.post('/admin/categories', {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>
