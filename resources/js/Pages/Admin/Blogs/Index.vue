<template>
    <Head>
        <title>Blog Management - Admin Portal</title>
    </Head>

    <AdminLayout :user="$page.props.auth.user">
        <!-- Header -->
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Blog Management</h1>
                <p class="text-slate-600 mt-1">Create and manage blog posts with rich content</p>
            </div>
            <a
                :href="route('admin.blogs.create')"
                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200"
            >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Create New Post
            </a>
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

        <!-- Search & Filters -->
        <div class="mb-6 bg-white rounded-xl shadow-sm border border-slate-200 p-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="md:col-span-2 relative">
                    <svg class="w-5 h-5 text-slate-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input
                        v-model="searchForm.search"
                        @input="search"
                        type="text"
                        placeholder="Search posts by title or excerpt..."
                        class="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    />
                </div>
                <div>
                    <select
                        v-model="searchForm.status"
                        @change="search"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                        <option value="">All Status</option>
                        <option value="published">Published</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
                <div>
                    <select
                        v-model="searchForm.category"
                        @change="search"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                        <option value="">All Categories</option>
                        <option v-for="category in categories" :key="category.id" :value="category.id">
                            {{ category.name }}
                        </option>
                    </select>
                </div>
            </div>
            <button
                v-if="searchForm.search || searchForm.status || searchForm.category"
                @click="clearFilters"
                class="mt-3 px-4 py-2 text-slate-600 hover:text-slate-900 border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors"
            >
                Clear Filters
            </button>
        </div>

        <!-- Blogs Table -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Post</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Categories</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Author</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-slate-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        <tr v-if="blogs.data.length === 0">
                            <td colspan="6" class="px-6 py-8 text-center text-slate-500">
                                <svg class="w-12 h-12 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="text-lg font-medium">No blog posts found</p>
                                <p class="text-sm mt-1">Try adjusting your filters or create a new blog post</p>
                            </td>
                        </tr>
                        <tr v-for="blog in blogs.data" :key="blog.id" class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div v-if="blog.featured_image" class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0">
                                        <img :src="`/storage/${blog.featured_image}`" :alt="blog.title" class="w-full h-full object-cover">
                                    </div>
                                    <div v-else class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-slate-900">{{ blog.title }}</div>
                                        <div v-if="blog.excerpt" class="text-xs text-slate-500 mt-0.5">{{ truncateText(blog.excerpt, 60) }}</div>
                                        <div class="flex items-center mt-1 space-x-2">
                                            <span v-if="blog.is_featured" class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                                Featured
                                            </span>
                                            <span class="text-xs text-slate-500">{{ blog.read_time }} min read</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-wrap gap-1">
                                    <span
                                        v-for="category in blog.categories"
                                        :key="category.id"
                                        class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800"
                                    >
                                        {{ category.name }}
                                    </span>
                                    <span v-if="blog.categories.length === 0" class="text-xs text-slate-400 italic">No categories</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-slate-600">{{ blog.user.name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    :class="[
                                        'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium',
                                        blog.status === 'published' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'
                                    ]"
                                >
                                    {{ blog.status.charAt(0).toUpperCase() + blog.status.slice(1) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                {{ formatDate(blog.created_at) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                <a
                                    :href="getBlogPreviewUrl(blog)"
                                    target="_blank"
                                    class="inline-flex items-center px-3 py-1.5 bg-purple-50 text-purple-700 rounded-lg hover:bg-purple-100 transition-colors"
                                    :title="blog.status === 'draft' ? 'Preview Draft' : 'View Blog'"
                                >
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    {{ blog.status === 'draft' ? 'Preview' : 'View' }}
                                </a>
                                <a
                                    :href="route('admin.blogs.edit', blog.id)"
                                    class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors"
                                >
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>
                                <button
                                    @click="deleteBlog(blog)"
                                    class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition-colors"
                                >
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div v-if="blogs.data.length > 0" class="px-6 py-4 bg-slate-50 border-t border-slate-200">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-slate-600">
                        Showing {{ blogs.from }} to {{ blogs.to }} of {{ blogs.total }} posts
                    </div>
                    <div class="flex space-x-2">
                        <a
                            v-for="link in blogs.links"
                            :key="link.label"
                            :href="link.url"
                            v-html="link.label"
                            :class="[
                                'px-3 py-2 text-sm rounded-lg transition-colors',
                                link.active
                                    ? 'bg-blue-500 text-white'
                                    : link.url
                                    ? 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-300'
                                    : 'bg-slate-100 text-slate-400 cursor-not-allowed'
                            ]"
                        ></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <Transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="opacity-0"
            enter-to-class="opacity-100"
            leave-active-class="transition ease-in duration-150"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div v-if="showDeleteModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
                <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6">
                    <div class="flex items-center justify-center w-12 h-12 bg-red-100 rounded-full mx-auto mb-4">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-900 text-center mb-2">Delete Blog Post</h3>
                    <p class="text-slate-600 text-center mb-6">
                        Are you sure you want to delete <strong>{{ blogToDelete?.title }}</strong>? This action cannot be undone.
                    </p>
                    <div class="flex space-x-3">
                        <button
                            @click="showDeleteModal = false"
                            class="flex-1 px-4 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition-colors font-medium"
                        >
                            Cancel
                        </button>
                        <button
                            @click="confirmDelete"
                            class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium"
                        >
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </Transition>
    </AdminLayout>
</template>

<script setup>
import { ref, reactive } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import AdminLayout from '../../../Components/Admin/AdminLayout.vue';

const props = defineProps({
    blogs: Object,
    categories: Array,
    filters: Object,
});

const searchForm = reactive({
    search: props.filters.search || '',
    status: props.filters.status || '',
    category: props.filters.category || '',
});

const showDeleteModal = ref(false);
const blogToDelete = ref(null);

const route = (name, id = null) => {
    const routes = {
        'admin.blogs.create': '/admin/blogs/create',
        'admin.blogs.edit': `/admin/blogs/${id}/edit`,
    };
    return routes[name] || '#';
};

const search = () => {
    router.get('/admin/blogs', {
        search: searchForm.search,
        status: searchForm.status,
        category: searchForm.category,
    }, {
        preserveState: true,
        replace: true,
    });
};

const clearFilters = () => {
    searchForm.search = '';
    searchForm.status = '';
    searchForm.category = '';
    search();
};

const truncateText = (text, length) => {
    if (!text) return '';
    return text.length > length ? text.substring(0, length) + '...' : text;
};

const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
    });
};

const getBlogPreviewUrl = (blog) => {
    const categorySlug = blog.categories.length > 0 ? blog.categories[0].slug : 'uncategorized';
    const baseUrl = `/${categorySlug}/${blog.slug}`;
    // Add preview parameter for draft blogs
    return blog.status === 'draft' ? `${baseUrl}?preview=true` : baseUrl;
};

const deleteBlog = (blog) => {
    blogToDelete.value = blog;
    showDeleteModal.value = true;
};

const confirmDelete = () => {
    router.delete(`/admin/blogs/${blogToDelete.value.id}`, {
        onSuccess: () => {
            showDeleteModal.value = false;
            blogToDelete.value = null;
        },
    });
};
</script>
