<template>
    <Head>
        <title>Create Blog Post - Admin Portal</title>
    </Head>

    <AdminLayout :user="$page.props.auth.user">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center space-x-4 mb-4">
                <a
                    href="/admin/blogs"
                    class="p-2 hover:bg-slate-100 rounded-lg transition-colors"
                >
                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">Create New Blog Post</h1>
                    <p class="text-slate-600 mt-1">Write and publish your blog content</p>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <form @submit.prevent="submit" class="space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content Column -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Basic Information -->
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                        <h2 class="text-lg font-semibold text-slate-900 mb-4">Basic Information</h2>

                        <!-- Title -->
                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-slate-700 mb-2">
                                Title <span class="text-red-500">*</span>
                            </label>
                            <input
                                id="title"
                                v-model="form.title"
                                type="text"
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="form.errors.title ? 'border-red-500' : 'border-slate-300'"
                                placeholder="Enter blog title"
                            />
                            <p v-if="form.errors.title" class="mt-1 text-sm text-red-600">{{ form.errors.title }}</p>
                        </div>

                        <!-- Slug -->
                        <div class="mb-6">
                            <label for="slug" class="block text-sm font-medium text-slate-700 mb-2">
                                Slug (URL)
                            </label>
                            <input
                                id="slug"
                                v-model="form.slug"
                                type="text"
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 font-mono text-sm"
                                :class="form.errors.slug ? 'border-red-500' : 'border-slate-300'"
                                placeholder="auto-generated-from-title"
                            />
                            <p v-if="form.errors.slug" class="mt-1 text-sm text-red-600">{{ form.errors.slug }}</p>
                            <p class="mt-1 text-xs text-slate-500">Leave empty to auto-generate from title</p>
                        </div>

                        <!-- Excerpt -->
                        <div>
                            <label for="excerpt" class="block text-sm font-medium text-slate-700 mb-2">
                                Excerpt
                            </label>
                            <textarea
                                id="excerpt"
                                v-model="form.excerpt"
                                rows="3"
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="form.errors.excerpt ? 'border-red-500' : 'border-slate-300'"
                                placeholder="Brief description of the blog post"
                            ></textarea>
                            <p v-if="form.errors.excerpt" class="mt-1 text-sm text-red-600">{{ form.errors.excerpt }}</p>
                        </div>
                    </div>

                    <!-- Content Editor -->
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                        <h2 class="text-lg font-semibold text-slate-900 mb-4">Content <span class="text-red-500">*</span></h2>
                        <QuillEditor
                            v-model:content="form.content"
                            content-type="html"
                            theme="snow"
                            :toolbar="editorToolbar"
                            class="min-h-[400px]"
                        />
                        <p v-if="form.errors.content" class="mt-2 text-sm text-red-600">{{ form.errors.content }}</p>
                    </div>

                    <!-- SEO Settings -->
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
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
                        <div class="mb-6">
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

                        <!-- Meta Keywords -->
                        <div>
                            <label for="meta_keywords" class="block text-sm font-medium text-slate-700 mb-2">
                                Meta Keywords
                            </label>
                            <input
                                id="meta_keywords"
                                v-model="form.meta_keywords"
                                type="text"
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="form.errors.meta_keywords ? 'border-red-500' : 'border-slate-300'"
                                placeholder="keyword1, keyword2, keyword3"
                            />
                            <p v-if="form.errors.meta_keywords" class="mt-1 text-sm text-red-600">{{ form.errors.meta_keywords }}</p>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Column -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Publish Settings -->
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                        <h2 class="text-lg font-semibold text-slate-900 mb-4">Publish</h2>

                        <!-- Status -->
                        <div class="mb-6">
                            <label for="status" class="block text-sm font-medium text-slate-700 mb-2">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select
                                id="status"
                                v-model="form.status"
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="form.errors.status ? 'border-red-500' : 'border-slate-300'"
                            >
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                            </select>
                            <p v-if="form.errors.status" class="mt-1 text-sm text-red-600">{{ form.errors.status }}</p>
                        </div>

                        <!-- Published At -->
                        <div class="mb-6">
                            <label for="published_at" class="block text-sm font-medium text-slate-700 mb-2">
                                Publish Date
                            </label>
                            <input
                                id="published_at"
                                v-model="form.published_at"
                                type="datetime-local"
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="form.errors.published_at ? 'border-red-500' : 'border-slate-300'"
                            />
                            <p v-if="form.errors.published_at" class="mt-1 text-sm text-red-600">{{ form.errors.published_at }}</p>
                            <p class="mt-1 text-xs text-slate-500">Leave empty for immediate publish</p>
                        </div>

                        <!-- Is Featured -->
                        <div>
                            <label class="flex items-center">
                                <input
                                    v-model="form.is_featured"
                                    type="checkbox"
                                    class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500"
                                />
                                <span class="ml-2 text-sm text-slate-700">Featured Post</span>
                            </label>
                            <p class="mt-1 text-xs text-slate-500">Display on homepage</p>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                        <h2 class="text-lg font-semibold text-slate-900 mb-4">Featured Image</h2>

                        <div v-if="imagePreview" class="mb-4">
                            <img :src="imagePreview" alt="Preview" class="w-full h-48 object-cover rounded-lg">
                            <button
                                type="button"
                                @click="removeImage"
                                class="mt-2 w-full px-3 py-2 text-sm text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition-colors"
                            >
                                Remove Image
                            </button>
                        </div>

                        <div v-else>
                            <label class="block">
                                <div class="border-2 border-dashed border-slate-300 rounded-lg p-6 text-center hover:border-blue-500 transition-colors cursor-pointer">
                                    <svg class="w-12 h-12 mx-auto mb-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="text-sm text-slate-600 mb-1">Click to upload image</p>
                                    <p class="text-xs text-slate-500">PNG, JPG, WEBP up to 2MB</p>
                                </div>
                                <input
                                    type="file"
                                    @change="handleImageUpload"
                                    accept="image/jpeg,image/png,image/jpg,image/webp"
                                    class="hidden"
                                />
                            </label>
                        </div>
                        <p v-if="form.errors.featured_image" class="mt-2 text-sm text-red-600">{{ form.errors.featured_image }}</p>
                    </div>

                    <!-- Categories -->
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                        <h2 class="text-lg font-semibold text-slate-900 mb-4">Categories</h2>
                        <div class="space-y-2 max-h-64 overflow-y-auto">
                            <label v-for="category in categories" :key="category.id" class="flex items-center">
                                <input
                                    v-model="form.categories"
                                    type="checkbox"
                                    :value="category.id"
                                    class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500"
                                />
                                <span class="ml-2 text-sm text-slate-700">{{ category.name }}</span>
                            </label>
                        </div>
                        <p v-if="form.errors.categories" class="mt-2 text-sm text-red-600">{{ form.errors.categories }}</p>
                    </div>

                    <!-- Reading Time -->
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                        <h2 class="text-lg font-semibold text-slate-900 mb-4">Reading Time</h2>
                        <div class="flex items-center space-x-2">
                            <input
                                id="read_time"
                                v-model="form.read_time"
                                type="number"
                                min="1"
                                class="w-20 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="form.errors.read_time ? 'border-red-500' : 'border-slate-300'"
                                placeholder="5"
                            />
                            <span class="text-sm text-slate-700">minutes</span>
                        </div>
                        <p v-if="form.errors.read_time" class="mt-1 text-sm text-red-600">{{ form.errors.read_time }}</p>
                        <p class="mt-1 text-xs text-slate-500">Auto-calculated if left empty</p>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end space-x-4 bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <a
                    href="/admin/blogs"
                    class="px-6 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors font-medium"
                >
                    Cancel
                </a>
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 font-medium disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    <span v-if="!form.processing">Create Post</span>
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
    </AdminLayout>
</template>

<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '../../../Components/Admin/AdminLayout.vue';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';

const props = defineProps({
    categories: Array,
});

const form = useForm({
    title: '',
    slug: '',
    excerpt: '',
    content: '',
    featured_image: null,
    read_time: null,
    status: 'draft',
    is_featured: false,
    categories: [],
    published_at: '',
    meta_title: '',
    meta_description: '',
    meta_keywords: '',
});

const imagePreview = ref(null);

const editorToolbar = [
    [{ header: [1, 2, 3, 4, 5, 6, false] }],
    ['bold', 'italic', 'underline', 'strike'],
    [{ list: 'ordered' }, { list: 'bullet' }],
    [{ align: [] }],
    ['link', 'image', 'code-block'],
    [{ color: [] }, { background: [] }],
    ['clean'],
];

const handleImageUpload = (event) => {
    const file = event.target.files[0];
    if (file) {
        form.featured_image = file;
        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreview.value = e.target.result;
        };
        reader.readAsDataURL(file);
    }
};

const removeImage = () => {
    form.featured_image = null;
    imagePreview.value = null;
};

const submit = () => {
    form.post('/admin/blogs', {
        onSuccess: () => {
            form.reset();
            imagePreview.value = null;
        },
    });
};
</script>
