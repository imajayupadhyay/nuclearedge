<template>
    <aside
        :class="[
            'fixed left-0 top-0 h-full w-64 bg-slate-900 border-r border-slate-800 transition-transform duration-300 z-40',
            { '-translate-x-full lg:translate-x-0': !isOpen }
        ]"
    >
        <!-- Logo Section -->
        <div class="h-16 flex items-center justify-between px-6 border-b border-slate-800">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-white font-bold text-lg">Nuclear Edge</h1>
                    <p class="text-slate-400 text-xs">Admin Panel</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="px-4 py-6 overflow-y-auto h-[calc(100vh-4rem)]">
            <!-- Overview Section -->
            <div class="mb-6">
                <div class="flex items-center px-3 mb-3">
                    <svg class="w-4 h-4 text-slate-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Overview</p>
                </div>
                <a
                    :href="route('admin.dashboard')"
                    :class="[
                        'flex items-center px-3 py-2.5 rounded-lg transition-all duration-200',
                        isActive('admin.dashboard')
                            ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg'
                            : 'text-slate-300 hover:bg-slate-800 hover:text-white'
                    ]"
                >
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </a>
            </div>

            <!-- Content Management Section -->
            <div class="mb-6">
                <div class="flex items-center px-3 mb-3">
                    <svg class="w-4 h-4 text-slate-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Content</p>
                </div>
                <div class="space-y-1">
                    <a
                        href="/admin/blogs"
                        :class="[
                            'flex items-center px-3 py-2.5 rounded-lg transition-all duration-200',
                            page.url.startsWith('/admin/blogs')
                                ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg'
                                : 'text-slate-300 hover:bg-slate-800 hover:text-white'
                        ]"
                    >
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span class="font-medium">Blog Posts</span>
                    </a>

                    <a
                        href="/admin/categories"
                        :class="[
                            'flex items-center px-3 py-2.5 rounded-lg transition-all duration-200',
                            page.url.startsWith('/admin/categories')
                                ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg'
                                : 'text-slate-300 hover:bg-slate-800 hover:text-white'
                        ]"
                    >
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        <span class="font-medium">Categories</span>
                    </a>

                    <a
                        href="/admin/menus"
                        :class="[
                            'flex items-center px-3 py-2.5 rounded-lg transition-all duration-200',
                            page.url.startsWith('/admin/menus')
                                ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg'
                                : 'text-slate-300 hover:bg-slate-800 hover:text-white'
                        ]"
                    >
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <span class="font-medium">Menu Builder</span>
                    </a>

                    <a
                        href="/admin/footer"
                        :class="[
                            'flex items-center px-3 py-2.5 rounded-lg transition-all duration-200',
                            page.url.startsWith('/admin/footer')
                                ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg'
                                : 'text-slate-300 hover:bg-slate-800 hover:text-white'
                        ]"
                    >
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        <span class="font-medium">Footer Settings</span>
                    </a>
                </div>
            </div>

            <!-- Homepage Management Section -->
            <div class="mb-6">
                <div class="flex items-center px-3 mb-3">
                    <svg class="w-4 h-4 text-slate-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Homepage</p>
                </div>
                <div class="space-y-1">
                    <a
                        href="/admin/homepage"
                        :class="[
                            'flex items-center px-3 py-2.5 rounded-lg transition-all duration-200',
                            page.url.startsWith('/admin/homepage')
                                ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg'
                                : 'text-slate-300 hover:bg-slate-800 hover:text-white'
                        ]"
                    >
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                        </svg>
                        <span class="font-medium">Page Sections</span>
                    </a>
                </div>
            </div>

            <!-- User Management Section -->
            <div class="mb-6">
                <div class="flex items-center px-3 mb-3">
                    <svg class="w-4 h-4 text-slate-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Users</p>
                </div>
                <a
                    href="/admin/users"
                    :class="[
                        'flex items-center px-3 py-2.5 rounded-lg transition-all duration-200',
                        page.url.startsWith('/admin/users')
                            ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg'
                            : 'text-slate-300 hover:bg-slate-800 hover:text-white'
                    ]"
                >
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <span class="font-medium">All Users</span>
                </a>
            </div>

            <!-- Communications Section -->
            <div class="mb-6">
                <div class="flex items-center px-3 mb-3">
                    <svg class="w-4 h-4 text-slate-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                    </svg>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Communications</p>
                </div>
                <div class="space-y-1">
                    <a
                        href="/admin/contacts"
                        :class="[
                            'flex items-center px-3 py-2.5 rounded-lg transition-all duration-200',
                            page.url.startsWith('/admin/contacts')
                                ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg'
                                : 'text-slate-300 hover:bg-slate-800 hover:text-white'
                        ]"
                    >
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span class="font-medium">Contact Messages</span>
                    </a>

                    <a
                        href="/admin/newsletters"
                        :class="[
                            'flex items-center px-3 py-2.5 rounded-lg transition-all duration-200',
                            page.url.startsWith('/admin/newsletters')
                                ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg'
                                : 'text-slate-300 hover:bg-slate-800 hover:text-white'
                        ]"
                    >
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"/>
                        </svg>
                        <span class="font-medium">Newsletter</span>
                    </a>
                </div>
            </div>

            <!-- Quick Links Section -->
            <div class="mt-auto pt-6 border-t border-slate-800">
                <div class="flex items-center px-3 mb-3">
                    <svg class="w-4 h-4 text-slate-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Quick Links</p>
                </div>
                <a
                    href="/"
                    target="_blank"
                    class="flex items-center px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition-all duration-200 group"
                >
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    <span class="font-medium">View Website</span>
                    <svg class="w-3 h-3 ml-auto opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </nav>
    </aside>

    <!-- Mobile Overlay -->
    <Transition
        enter-active-class="transition-opacity duration-300"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition-opacity duration-300"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div
            v-show="isOpen"
            @click="closeSidebar"
            class="fixed inset-0 bg-black/50 z-30 lg:hidden"
        ></div>
    </Transition>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const isOpen = ref(false);

const isActive = (routeName) => {
    return page.url === `/admin/${routeName.replace('admin.', '')}`;
};

const route = (name) => {
    const routes = {
        'admin.dashboard': '/admin/dashboard',
    };
    return routes[name] || '#';
};

const toggleSidebar = () => {
    isOpen.value = !isOpen.value;
};

const closeSidebar = () => {
    isOpen.value = false;
};

onMounted(() => {
    window.addEventListener('toggle-sidebar', toggleSidebar);
});

onUnmounted(() => {
    window.removeEventListener('toggle-sidebar', toggleSidebar);
});
</script>
