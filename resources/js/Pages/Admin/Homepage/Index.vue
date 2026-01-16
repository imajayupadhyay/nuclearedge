<template>
    <Head>
        <title>Homepage Settings - Admin Portal</title>
    </Head>

    <AdminLayout :user="$page.props.auth.user">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
                <a href="/admin/dashboard" class="hover:text-slate-700">Dashboard</a>
                <span>/</span>
                <span class="text-slate-900">Homepage Settings</span>
            </div>
            <h1 class="text-2xl font-bold text-slate-900">Homepage Settings</h1>
            <p class="text-slate-600 mt-1">Manage all sections of your homepage</p>
        </div>

        <!-- Success Message -->
        <div v-if="$page.props.flash.success" class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center">
            <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="text-green-800">{{ $page.props.flash.success }}</span>
        </div>

        <form @submit.prevent="saveSettings">
            <!-- ==================== HERO SECTION ==================== -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center">
                        <span class="text-white font-bold">1</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Hero Section</h2>
                        <p class="text-sm text-slate-500">The main banner at the top of your homepage</p>
                    </div>
                </div>

                <!-- Background Video Section -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-4">
                    <h3 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                        Background Video
                    </h3>

                    <!-- Current Video Preview -->
                    <div v-if="form.hero_video_url" class="mb-4">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Current Video</label>
                        <div class="relative rounded-lg overflow-hidden bg-slate-900 max-w-2xl">
                            <video
                                :src="form.hero_video_url"
                                class="w-full h-48 object-cover"
                                autoplay
                                muted
                                loop
                                playsinline
                            ></video>
                            <div class="absolute inset-0 bg-gradient-to-b from-black/30 to-black/50"></div>
                        </div>
                        <p class="text-xs text-slate-500 mt-2">{{ form.hero_video_url }}</p>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Video URL -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Video URL</label>
                            <input
                                v-model="form.hero_video_url"
                                type="text"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="/videos/hero-background.mp4"
                            />
                            <p class="text-xs text-slate-500 mt-1">Enter a URL or upload a new video file</p>
                        </div>

                        <!-- Video File Upload -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Upload New Video</label>
                            <input
                                type="file"
                                @change="handleVideoUpload"
                                accept="video/mp4,video/webm,video/quicktime"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent file:mr-4 file:py-1 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                            />
                            <p class="text-xs text-slate-500 mt-1">Max 100MB. Formats: MP4, WebM, MOV</p>
                        </div>
                    </div>
                </div>

                <!-- Headlines Section -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-4">
                    <h3 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>
                        Headlines & Subheadline
                    </h3>

                    <!-- Preview Card -->
                    <div class="mb-6 p-6 bg-slate-900 rounded-lg">
                        <div class="text-center">
                            <h3 class="text-2xl md:text-3xl font-bold text-white mb-2">
                                {{ form.hero_headline_line1 || 'Innovation at the' }}
                            </h3>
                            <h3 class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 bg-clip-text text-transparent">
                                {{ form.hero_headline_line2 || 'Nuclear Edge' }}
                            </h3>
                            <p class="text-white/80 mt-3">{{ form.hero_subheadline || 'Powerful Ideas, Nuclear Results' }}</p>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Headline Line 1</label>
                            <input
                                v-model="form.hero_headline_line1"
                                type="text"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Innovation at the"
                            />
                            <p class="text-xs text-slate-500 mt-1">Default: "Innovation at the"</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Headline Line 2 (Gradient Text)</label>
                            <input
                                v-model="form.hero_headline_line2"
                                type="text"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Nuclear Edge"
                            />
                            <p class="text-xs text-slate-500 mt-1">Default: "Nuclear Edge"</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Subheadline</label>
                        <input
                            v-model="form.hero_subheadline"
                            type="text"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Powerful Ideas, Nuclear Results"
                        />
                        <p class="text-xs text-slate-500 mt-1">Default: "Powerful Ideas, Nuclear Results"</p>
                    </div>
                </div>

                <!-- CTA Buttons Section -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <h3 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/>
                        </svg>
                        Call-to-Action Buttons
                    </h3>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Primary Button -->
                        <div class="p-4 bg-gradient-to-br from-orange-50 to-red-50 border border-orange-200 rounded-lg">
                            <h4 class="font-medium text-slate-900 mb-3 flex items-center gap-2">
                                <span class="w-3 h-3 bg-gradient-to-r from-orange-500 to-red-500 rounded-full"></span>
                                Primary Button
                            </h4>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Button Text</label>
                                    <input
                                        v-model="form.hero_primary_button_text"
                                        type="text"
                                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                        placeholder="Discover Our Story"
                                    />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Button Link</label>
                                    <input
                                        v-model="form.hero_primary_button_link"
                                        type="text"
                                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                        placeholder="/about"
                                    />
                                </div>
                            </div>
                        </div>

                        <!-- Secondary Button -->
                        <div class="p-4 bg-slate-50 border border-slate-200 rounded-lg">
                            <h4 class="font-medium text-slate-900 mb-3 flex items-center gap-2">
                                <span class="w-3 h-3 bg-slate-400 rounded-full border-2 border-slate-500"></span>
                                Secondary Button
                            </h4>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Button Text</label>
                                    <input
                                        v-model="form.hero_secondary_button_text"
                                        type="text"
                                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="Explore Services"
                                    />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Button Link</label>
                                    <input
                                        v-model="form.hero_secondary_button_link"
                                        type="text"
                                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="#services"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== BLOG CAROUSEL SECTION ==================== -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                        <span class="text-white font-bold">2</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Blog Carousel Section</h2>
                        <p class="text-sm text-slate-500">Latest insights carousel with dynamic blog posts</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <h3 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>
                        Section Header
                    </h3>

                    <!-- Preview Card -->
                    <div class="mb-6 p-6 bg-white border border-slate-200 rounded-lg">
                        <div class="text-center">
                            <h3 class="text-2xl md:text-3xl font-bold text-slate-900 mb-2">
                                {{ form.blog_carousel_heading_line1 || 'Latest Insights &' }}
                                <span class="bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent">
                                    {{ form.blog_carousel_heading_line2 || 'Perspectives' }}
                                </span>
                            </h3>
                            <p class="text-slate-600">{{ form.blog_carousel_paragraph || 'Stay updated with our latest expert insights and industry perspectives' }}</p>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Heading Line 1</label>
                            <input
                                v-model="form.blog_carousel_heading_line1"
                                type="text"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Latest Insights &"
                            />
                            <p class="text-xs text-slate-500 mt-1">Default: "Latest Insights &"</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Heading Line 2 (Gradient Text)</label>
                            <input
                                v-model="form.blog_carousel_heading_line2"
                                type="text"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Perspectives"
                            />
                            <p class="text-xs text-slate-500 mt-1">Default: "Perspectives"</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Description Paragraph</label>
                        <textarea
                            v-model="form.blog_carousel_paragraph"
                            rows="2"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Stay updated with our latest expert insights and industry perspectives"
                        ></textarea>
                        <p class="text-xs text-slate-500 mt-1">Default: "Stay updated with our latest expert insights and industry perspectives"</p>
                    </div>

                    <!-- Info Note -->
                    <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                        <p class="text-sm text-blue-800 flex items-start gap-2">
                            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span><strong>Note:</strong> Blog posts are automatically pulled from your published blogs. Manage them in the Blog Posts section.</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Default Values Info -->
            <div class="mb-6 p-4 bg-amber-50 border border-amber-200 rounded-lg">
                <p class="text-sm text-amber-800 flex items-start gap-2">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span><strong>Tip:</strong> Leave fields empty to use the default values. Only fill in fields you want to customize.</span>
                </p>
            </div>

            <!-- Save Button -->
            <div class="flex justify-end gap-3">
                <a
                    href="/"
                    target="_blank"
                    class="px-6 py-3 bg-slate-100 text-slate-700 font-semibold rounded-lg hover:bg-slate-200 transition-all flex items-center gap-2"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    Preview Site
                </a>
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 disabled:opacity-50"
                >
                    <span v-if="!form.processing">Save All Settings</span>
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
import { reactive } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import AdminLayout from '../../../Components/Admin/AdminLayout.vue';

const props = defineProps({
    settings: Object,
});

// Initialize form with settings or empty (to use defaults)
const form = reactive({
    // Hero Section
    hero_video_url: props.settings?.hero_video_url || '',
    hero_video_file: null,
    hero_headline_line1: props.settings?.hero_headline_line1 || '',
    hero_headline_line2: props.settings?.hero_headline_line2 || '',
    hero_subheadline: props.settings?.hero_subheadline || '',
    hero_primary_button_text: props.settings?.hero_primary_button_text || '',
    hero_primary_button_link: props.settings?.hero_primary_button_link || '',
    hero_secondary_button_text: props.settings?.hero_secondary_button_text || '',
    hero_secondary_button_link: props.settings?.hero_secondary_button_link || '',
    // Blog Carousel Section
    blog_carousel_heading_line1: props.settings?.blog_carousel_heading_line1 || '',
    blog_carousel_heading_line2: props.settings?.blog_carousel_heading_line2 || '',
    blog_carousel_paragraph: props.settings?.blog_carousel_paragraph || '',
    processing: false,
});

const handleVideoUpload = (event) => {
    const file = event.target.files[0];
    if (file) {
        form.hero_video_file = file;
        // Create preview URL
        form.hero_video_url = URL.createObjectURL(file);
    }
};

const saveSettings = () => {
    form.processing = true;

    // Use FormData for file upload
    const formData = new FormData();
    // Hero Section
    formData.append('hero_video_url', form.hero_video_url || '');
    formData.append('hero_headline_line1', form.hero_headline_line1 || '');
    formData.append('hero_headline_line2', form.hero_headline_line2 || '');
    formData.append('hero_subheadline', form.hero_subheadline || '');
    formData.append('hero_primary_button_text', form.hero_primary_button_text || '');
    formData.append('hero_primary_button_link', form.hero_primary_button_link || '');
    formData.append('hero_secondary_button_text', form.hero_secondary_button_text || '');
    formData.append('hero_secondary_button_link', form.hero_secondary_button_link || '');
    // Blog Carousel Section
    formData.append('blog_carousel_heading_line1', form.blog_carousel_heading_line1 || '');
    formData.append('blog_carousel_heading_line2', form.blog_carousel_heading_line2 || '');
    formData.append('blog_carousel_paragraph', form.blog_carousel_paragraph || '');

    if (form.hero_video_file) {
        formData.append('hero_video_file', form.hero_video_file);
    }

    router.post('/admin/homepage', formData, {
        forceFormData: true,
        onFinish: () => {
            form.processing = false;
            form.hero_video_file = null;
        },
    });
};
</script>
