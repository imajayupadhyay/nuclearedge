<template>
    <Head>
        <title>Footer Settings - Admin Portal</title>
    </Head>

    <AdminLayout :user="$page.props.auth.user">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-900">Footer Settings</h1>
            <p class="text-slate-600 mt-1">Manage your website footer content</p>
        </div>

        <!-- Success Message -->
        <div v-if="$page.props.flash.success" class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center">
            <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="text-green-800">{{ $page.props.flash.success }}</span>
        </div>

        <form @submit.prevent="saveSettings">
            <!-- Branding Section -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                    </svg>
                    Branding & Newsletter Section
                </h2>

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Logo URL -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Logo URL</label>
                        <input
                            v-model="form.logo_url"
                            type="text"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="/images/logo.webp"
                        />
                    </div>

                    <!-- Preview -->
                    <div v-if="form.logo_url" class="flex items-center">
                        <img :src="form.logo_url" alt="Logo Preview" class="h-12 bg-slate-900 p-2 rounded-lg" />
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6 mt-4">
                    <!-- Heading Line 1 -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Heading Line 1</label>
                        <input
                            v-model="form.heading_line1"
                            type="text"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="From Problems to Progress:"
                        />
                    </div>

                    <!-- Heading Line 2 (Gradient) -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Heading Line 2 (Gradient Text)</label>
                        <input
                            v-model="form.heading_line2"
                            type="text"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Your Partner in Growth"
                        />
                    </div>
                </div>

                <!-- Description -->
                <div class="mt-4">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Newsletter Description</label>
                    <textarea
                        v-model="form.description"
                        rows="2"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Join our newsletter to stay updated..."
                    ></textarea>
                </div>
            </div>

            <!-- Quick Links Section -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-slate-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                        </svg>
                        Quick Links
                    </h2>
                    <button
                        type="button"
                        @click="addQuickLink"
                        class="px-3 py-1.5 bg-blue-500 text-white text-sm font-medium rounded-lg hover:bg-blue-600 transition-colors"
                    >
                        + Add Link
                    </button>
                </div>

                <div class="space-y-3">
                    <div
                        v-for="(link, index) in form.quick_links"
                        :key="index"
                        class="flex items-center gap-3"
                    >
                        <input
                            v-model="link.name"
                            type="text"
                            class="flex-1 px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Link Name"
                        />
                        <input
                            v-model="link.url"
                            type="text"
                            class="flex-1 px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="/about or https://..."
                        />
                        <button
                            type="button"
                            @click="removeQuickLink(index)"
                            class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                    <p v-if="form.quick_links.length === 0" class="text-slate-500 text-sm py-4 text-center">
                        No quick links added. Click "Add Link" to create one.
                    </p>
                </div>
            </div>

            <!-- Contact Section -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    Contact Information
                </h2>

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Address -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Address</label>
                        <textarea
                            v-model="form.address"
                            rows="2"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="1195 Salarpuriya IndiraNagar, Bangalore 560038"
                        ></textarea>
                    </div>

                    <div class="space-y-4">
                        <!-- Phone -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Phone Number</label>
                            <input
                                v-model="form.phone"
                                type="text"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="+91 9315946467"
                            />
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Email Address</label>
                            <input
                                v-model="form.email"
                                type="email"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="contact@example.com"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Links Section -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                    </svg>
                    Social Media Links
                </h2>

                <div class="grid md:grid-cols-2 gap-4">
                    <div v-for="social in form.social_links" :key="social.platform">
                        <label class="block text-sm font-medium text-slate-700 mb-2 capitalize">{{ social.platform }}</label>
                        <div class="flex items-center gap-2">
                            <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <component :is="getSocialIcon(social.platform)" class="w-5 h-5 text-slate-600" />
                            </div>
                            <input
                                v-model="social.url"
                                type="url"
                                class="flex-1 px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                :placeholder="`https://${social.platform}.com/...`"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Copyright Section -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Copyright Information
                </h2>

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Copyright Text -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Copyright Text</label>
                        <input
                            v-model="form.copyright_text"
                            type="text"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="NuclearEdge"
                        />
                        <p class="text-xs text-slate-500 mt-1">The year is automatically added. e.g., "Copyright © 2026 NuclearEdge"</p>
                    </div>

                    <!-- Tagline -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Tagline</label>
                        <input
                            v-model="form.copyright_tagline"
                            type="text"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Built with nuclear precision and innovative excellence"
                        />
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <div class="flex justify-end">
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 disabled:opacity-50"
                >
                    <span v-if="!form.processing">Save Footer Settings</span>
                    <span v-else class="flex items-center gap-2">
                        <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Saving...
                    </span>
                </button>
            </div>
        </form>
    </AdminLayout>
</template>

<script setup>
import { reactive, h } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import AdminLayout from '../../../Components/Admin/AdminLayout.vue';

const props = defineProps({
    settings: Object,
});

// Initialize form with settings or defaults
const form = reactive({
    logo_url: props.settings?.logo_url || '/images/nuclear-edge-logo.webp',
    heading_line1: props.settings?.heading_line1 || 'From Problems to Progress:',
    heading_line2: props.settings?.heading_line2 || 'Your Partner in Growth',
    description: props.settings?.description || 'Join our newsletter to stay updated with the latest insights, innovations, and success stories.',
    address: props.settings?.address || '',
    phone: props.settings?.phone || '',
    email: props.settings?.email || '',
    copyright_text: props.settings?.copyright_text || 'NuclearEdge',
    copyright_tagline: props.settings?.copyright_tagline || 'Built with nuclear precision and innovative excellence',
    quick_links: props.settings?.quick_links || [],
    social_links: props.settings?.social_links?.length > 0 ? props.settings.social_links : [
        { platform: 'linkedin', url: '' },
        { platform: 'twitter', url: '' },
        { platform: 'facebook', url: '' },
        { platform: 'instagram', url: '' },
    ],
    processing: false,
});

const addQuickLink = () => {
    form.quick_links.push({ name: '', url: '' });
};

const removeQuickLink = (index) => {
    form.quick_links.splice(index, 1);
};

const getSocialIcon = (platform) => {
    const icons = {
        linkedin: () => h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
            h('path', { d: 'M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z' })
        ]),
        twitter: () => h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
            h('path', { d: 'M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z' })
        ]),
        facebook: () => h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
            h('path', { d: 'M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z' })
        ]),
        instagram: () => h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
            h('path', { d: 'M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z' })
        ]),
    };
    return icons[platform] || icons.linkedin;
};

const saveSettings = () => {
    form.processing = true;
    router.put('/admin/footer', {
        logo_url: form.logo_url,
        heading_line1: form.heading_line1,
        heading_line2: form.heading_line2,
        description: form.description,
        address: form.address,
        phone: form.phone,
        email: form.email,
        copyright_text: form.copyright_text,
        copyright_tagline: form.copyright_tagline,
        quick_links: form.quick_links,
        social_links: form.social_links,
    }, {
        onFinish: () => {
            form.processing = false;
        },
    });
};
</script>
