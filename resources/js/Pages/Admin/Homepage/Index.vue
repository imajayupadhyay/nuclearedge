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

            <!-- ==================== TABS SECTION ==================== -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center">
                        <span class="text-white font-bold">3</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Tabs Section</h2>
                        <p class="text-sm text-slate-500">Showcase your services, approach, and expertise with interactive tabs</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-slate-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                            </svg>
                            Manage Tabs
                        </h3>
                        <button
                            type="button"
                            @click="addTab"
                            class="px-4 py-2 bg-emerald-500 text-white text-sm font-semibold rounded-lg hover:bg-emerald-600 transition-colors flex items-center gap-2"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Add Tab
                        </button>
                    </div>

                    <!-- Tabs List -->
                    <div class="space-y-4">
                        <div
                            v-for="(tab, index) in form.tabs_data"
                            :key="index"
                            class="border border-slate-200 rounded-xl overflow-hidden"
                        >
                            <!-- Tab Header (Collapsible) -->
                            <div
                                @click="toggleTabExpand(index)"
                                class="flex items-center justify-between p-4 bg-slate-50 cursor-pointer hover:bg-slate-100 transition-colors"
                            >
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white font-semibold text-sm">
                                        {{ index + 1 }}
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-slate-900">{{ tab.name || 'Untitled Tab' }}</h4>
                                        <p class="text-xs text-slate-500">{{ tab.label || 'No label set' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button
                                        type="button"
                                        @click.stop="removeTab(index)"
                                        class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors"
                                        title="Remove tab"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                    <svg
                                        :class="['w-5 h-5 text-slate-400 transition-transform', expandedTabs.includes(index) ? 'rotate-180' : '']"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>

                            <!-- Tab Content (Expandable) -->
                            <div v-show="expandedTabs.includes(index)" class="p-4 border-t border-slate-200">
                                <div class="grid md:grid-cols-2 gap-4">
                                    <!-- Tab Name -->
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Tab Name *</label>
                                        <input
                                            v-model="tab.name"
                                            type="text"
                                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                                            placeholder="Our Solutions"
                                        />
                                    </div>

                                    <!-- Label -->
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Label (Uppercase)</label>
                                        <input
                                            v-model="tab.label"
                                            type="text"
                                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                                            placeholder="COMPREHENSIVE SERVICES"
                                        />
                                    </div>

                                    <!-- Title -->
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Title</label>
                                        <input
                                            v-model="tab.title"
                                            type="text"
                                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                                            placeholder="End-to-end business transformation"
                                        />
                                    </div>

                                    <!-- Description -->
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Description</label>
                                        <textarea
                                            v-model="tab.description"
                                            rows="3"
                                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                                            placeholder="We deliver comprehensive solutions that transform businesses..."
                                        ></textarea>
                                    </div>

                                    <!-- Background Image -->
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Background Image</label>

                                        <!-- Image Preview -->
                                        <div v-if="tab.image || tabImagePreviews[index]" class="mb-3">
                                            <img
                                                :src="tabImagePreviews[index] || tab.image"
                                                alt="Preview"
                                                class="w-full h-40 object-cover rounded-lg border border-slate-200"
                                            />
                                        </div>

                                        <div class="grid md:grid-cols-2 gap-3">
                                            <!-- Upload Image -->
                                            <div>
                                                <label class="block text-xs font-medium text-slate-600 mb-1">Upload Image</label>
                                                <input
                                                    type="file"
                                                    @change="(e) => handleTabImageUpload(e, index)"
                                                    accept="image/jpeg,image/png,image/webp"
                                                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-sm file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100"
                                                />
                                                <p class="text-xs text-slate-400 mt-1">Max 5MB. JPG, PNG, WebP</p>
                                            </div>

                                            <!-- Or URL -->
                                            <div>
                                                <label class="block text-xs font-medium text-slate-600 mb-1">Or Enter URL</label>
                                                <input
                                                    v-model="tab.image"
                                                    type="text"
                                                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-sm"
                                                    placeholder="https://images.unsplash.com/..."
                                                    @input="clearTabImageFile(index)"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Button Text -->
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Button Text</label>
                                        <input
                                            v-model="tab.buttonText"
                                            type="text"
                                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                                            placeholder="Explore Our Services"
                                        />
                                    </div>

                                    <!-- Button Link -->
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Button Link</label>
                                        <input
                                            v-model="tab.link"
                                            type="text"
                                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                                            placeholder="/about"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Empty State -->
                        <div v-if="form.tabs_data.length === 0" class="text-center py-12 border-2 border-dashed border-slate-200 rounded-xl">
                            <svg class="w-12 h-12 mx-auto text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                            </svg>
                            <p class="text-slate-500 mb-2">No tabs added yet</p>
                            <p class="text-sm text-slate-400">Click "Add Tab" to create your first tab, or leave empty to use defaults</p>
                        </div>
                    </div>

                    <!-- Info Note -->
                    <div class="mt-4 p-3 bg-emerald-50 border border-emerald-200 rounded-lg">
                        <p class="text-sm text-emerald-800 flex items-start gap-2">
                            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span><strong>Tip:</strong> Leave this section empty to use the default tabs. Add tabs only if you want to customize the content.</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- ==================== FEATURED ARTICLES SECTION ==================== -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-violet-500 to-purple-600 flex items-center justify-center">
                        <span class="text-white font-bold">4</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Featured Articles Section</h2>
                        <p class="text-sm text-slate-500">Display handpicked expert insights and perspectives</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <h3 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        Section Header
                    </h3>

                    <!-- Preview Card -->
                    <div class="mb-6 p-6 bg-gradient-to-br from-slate-50 to-white border border-slate-200 rounded-lg">
                        <div class="text-center">
                            <p class="text-orange-500 font-semibold text-sm uppercase tracking-wider mb-2">
                                {{ form.featured_articles_label || 'Expert Knowledge' }}
                            </p>
                            <h3 class="text-2xl md:text-3xl font-bold text-slate-900 mb-2">
                                {{ form.featured_articles_heading_line1 || 'Featured' }}
                                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500">
                                    {{ form.featured_articles_heading_line2 || 'Perspectives' }}
                                </span>
                            </h3>
                            <p class="text-slate-600">{{ form.featured_articles_paragraph || 'Explore our handpicked selection of expert insights and industry perspectives' }}</p>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Label -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Label (Uppercase)</label>
                            <input
                                v-model="form.featured_articles_label"
                                type="text"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                placeholder="Expert Knowledge"
                            />
                            <p class="text-xs text-slate-500 mt-1">Default: "Expert Knowledge"</p>
                        </div>

                        <!-- Heading Line 1 -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Heading Line 1</label>
                            <input
                                v-model="form.featured_articles_heading_line1"
                                type="text"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                placeholder="Featured"
                            />
                            <p class="text-xs text-slate-500 mt-1">Default: "Featured"</p>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6 mt-4">
                        <!-- Heading Line 2 (Gradient) -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Heading Line 2 (Gradient Text)</label>
                            <input
                                v-model="form.featured_articles_heading_line2"
                                type="text"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                placeholder="Perspectives"
                            />
                            <p class="text-xs text-slate-500 mt-1">Default: "Perspectives"</p>
                        </div>

                        <!-- Paragraph -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Description Paragraph</label>
                            <input
                                v-model="form.featured_articles_paragraph"
                                type="text"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                placeholder="Explore our handpicked selection of expert insights..."
                            />
                            <p class="text-xs text-slate-500 mt-1">Default: "Explore our handpicked selection of expert insights and industry perspectives"</p>
                        </div>
                    </div>

                    <!-- Info Note -->
                    <div class="mt-4 p-3 bg-violet-50 border border-violet-200 rounded-lg">
                        <p class="text-sm text-violet-800 flex items-start gap-2">
                            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span><strong>Note:</strong> Articles are automatically pulled from your featured/published blogs. Manage them in the Blog Posts section.</span>
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
import { reactive, ref } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import AdminLayout from '../../../Components/Admin/AdminLayout.vue';

const props = defineProps({
    settings: Object,
});

// Track expanded tabs
const expandedTabs = ref([]);

// Track tab image files and previews
const tabImageFiles = reactive({});
const tabImagePreviews = reactive({});

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
    // Tabs Section
    tabs_data: props.settings?.tabs_data || [],
    // Featured Articles Section
    featured_articles_label: props.settings?.featured_articles_label || '',
    featured_articles_heading_line1: props.settings?.featured_articles_heading_line1 || '',
    featured_articles_heading_line2: props.settings?.featured_articles_heading_line2 || '',
    featured_articles_paragraph: props.settings?.featured_articles_paragraph || '',
    processing: false,
});

// Tab management functions
const addTab = () => {
    const newIndex = form.tabs_data.length;
    form.tabs_data.push({
        name: '',
        label: '',
        title: '',
        description: '',
        image: '',
        link: '',
        buttonText: ''
    });
    // Auto-expand the new tab
    expandedTabs.value.push(newIndex);
};

const removeTab = (index) => {
    form.tabs_data.splice(index, 1);
    // Remove from expanded tabs if present
    const expandedIndex = expandedTabs.value.indexOf(index);
    if (expandedIndex > -1) {
        expandedTabs.value.splice(expandedIndex, 1);
    }
    // Adjust expanded indices for tabs after the removed one
    expandedTabs.value = expandedTabs.value.map(i => i > index ? i - 1 : i);

    // Clean up image file and preview for removed tab
    if (tabImageFiles[index]) {
        delete tabImageFiles[index];
    }
    if (tabImagePreviews[index]) {
        URL.revokeObjectURL(tabImagePreviews[index]);
        delete tabImagePreviews[index];
    }
    // Adjust indices for image files/previews after the removed one
    const newImageFiles = {};
    const newImagePreviews = {};
    Object.keys(tabImageFiles).forEach(key => {
        const numKey = parseInt(key);
        if (numKey > index) {
            newImageFiles[numKey - 1] = tabImageFiles[key];
        } else if (numKey < index) {
            newImageFiles[numKey] = tabImageFiles[key];
        }
    });
    Object.keys(tabImagePreviews).forEach(key => {
        const numKey = parseInt(key);
        if (numKey > index) {
            newImagePreviews[numKey - 1] = tabImagePreviews[key];
        } else if (numKey < index) {
            newImagePreviews[numKey] = tabImagePreviews[key];
        }
    });
    Object.keys(tabImageFiles).forEach(key => delete tabImageFiles[key]);
    Object.keys(tabImagePreviews).forEach(key => delete tabImagePreviews[key]);
    Object.assign(tabImageFiles, newImageFiles);
    Object.assign(tabImagePreviews, newImagePreviews);
};

const toggleTabExpand = (index) => {
    const expandedIndex = expandedTabs.value.indexOf(index);
    if (expandedIndex > -1) {
        expandedTabs.value.splice(expandedIndex, 1);
    } else {
        expandedTabs.value.push(index);
    }
};

// Handle tab image upload
const handleTabImageUpload = (event, index) => {
    const file = event.target.files[0];
    if (file) {
        tabImageFiles[index] = file;
        tabImagePreviews[index] = URL.createObjectURL(file);
        // Clear the URL field since we're using uploaded file
        form.tabs_data[index].image = '';
    }
};

// Clear tab image file when URL is entered
const clearTabImageFile = (index) => {
    if (tabImageFiles[index]) {
        delete tabImageFiles[index];
    }
    if (tabImagePreviews[index]) {
        URL.revokeObjectURL(tabImagePreviews[index]);
        delete tabImagePreviews[index];
    }
};

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

    // Prepare data object
    const data = {
        // Hero Section
        hero_video_url: form.hero_video_url || '',
        hero_headline_line1: form.hero_headline_line1 || '',
        hero_headline_line2: form.hero_headline_line2 || '',
        hero_subheadline: form.hero_subheadline || '',
        hero_primary_button_text: form.hero_primary_button_text || '',
        hero_primary_button_link: form.hero_primary_button_link || '',
        hero_secondary_button_text: form.hero_secondary_button_text || '',
        hero_secondary_button_link: form.hero_secondary_button_link || '',
        // Blog Carousel Section
        blog_carousel_heading_line1: form.blog_carousel_heading_line1 || '',
        blog_carousel_heading_line2: form.blog_carousel_heading_line2 || '',
        blog_carousel_paragraph: form.blog_carousel_paragraph || '',
        // Tabs Section
        tabs_data: form.tabs_data,
        // Featured Articles Section
        featured_articles_label: form.featured_articles_label || '',
        featured_articles_heading_line1: form.featured_articles_heading_line1 || '',
        featured_articles_heading_line2: form.featured_articles_heading_line2 || '',
        featured_articles_paragraph: form.featured_articles_paragraph || '',
    };

    // Use FormData for file upload
    const formData = new FormData();
    Object.keys(data).forEach(key => {
        if (key === 'tabs_data') {
            // Append each tab as array items for Laravel validation
            data.tabs_data.forEach((tab, index) => {
                Object.keys(tab).forEach(tabKey => {
                    formData.append(`tabs_data[${index}][${tabKey}]`, tab[tabKey] || '');
                });
            });
        } else {
            formData.append(key, data[key]);
        }
    });

    if (form.hero_video_file) {
        formData.append('hero_video_file', form.hero_video_file);
    }

    // Append tab image files
    Object.keys(tabImageFiles).forEach(index => {
        if (tabImageFiles[index]) {
            formData.append(`tab_images[${index}]`, tabImageFiles[index]);
        }
    });

    router.post('/admin/homepage', formData, {
        forceFormData: true,
        onFinish: () => {
            form.processing = false;
            form.hero_video_file = null;
            // Clear tab image files and previews
            Object.keys(tabImageFiles).forEach(key => delete tabImageFiles[key]);
            Object.keys(tabImagePreviews).forEach(key => {
                URL.revokeObjectURL(tabImagePreviews[key]);
                delete tabImagePreviews[key];
            });
        },
    });
};
</script>
