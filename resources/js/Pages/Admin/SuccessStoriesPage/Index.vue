<template>
    <Head>
        <title>Success Stories Page Settings - Admin Portal</title>
    </Head>

    <AdminLayout :user="$page.props.auth.user">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
                <a href="/admin/dashboard" class="hover:text-slate-700">Dashboard</a>
                <span>/</span>
                <span class="text-slate-900">Success Stories Page</span>
            </div>
            <h1 class="text-2xl font-bold text-slate-900">Success Stories Page Settings</h1>
            <p class="text-slate-600 mt-1">Manage hero section, success stories, and CTA section</p>
        </div>

        <!-- Success Message -->
        <div v-if="$page.props.flash.success" class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center">
            <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="text-green-800">{{ $page.props.flash.success }}</span>
        </div>

        <!-- ==================== HERO SECTION ==================== -->
        <form @submit.prevent="saveSettings">
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center">
                        <span class="text-white font-bold">1</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Hero Section</h2>
                        <p class="text-sm text-slate-500">The main banner at the top of the success stories page</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <!-- Preview -->
                    <div class="mb-6 p-6 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-xl">
                        <div class="text-center">
                            <p class="text-orange-500 font-semibold text-sm uppercase tracking-wider mb-2">{{ form.hero_label || 'Success Stories' }}</p>
                            <h3 class="text-2xl font-bold text-white mb-2">{{ form.hero_headline_line1 || 'How We Made It' }}</h3>
                            <h3 class="text-2xl font-bold bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent">{{ form.hero_headline_line2 || 'Happen' }}</h3>
                            <p class="text-slate-300 mt-3">{{ form.hero_paragraph || 'Real businesses, real transformations, real results.' }}</p>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Label</label>
                            <input v-model="form.hero_label" type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Success Stories" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Headline Line 1</label>
                            <input v-model="form.hero_headline_line1" type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="How We Made It" />
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 gap-6 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Headline Line 2 (Gradient)</label>
                            <input v-model="form.hero_headline_line2" type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Happen" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Paragraph</label>
                            <input v-model="form.hero_paragraph" type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Real businesses, real transformations..." />
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== CTA SECTION ==================== -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-pink-500 to-rose-600 flex items-center justify-center">
                        <span class="text-white font-bold">3</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">CTA Section</h2>
                        <p class="text-sm text-slate-500">Bottom call-to-action section</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <!-- Preview -->
                    <div class="mb-6 p-6 bg-gradient-to-br from-orange-500 via-red-500 to-orange-600 rounded-xl">
                        <div class="text-center">
                            <h3 class="text-2xl font-bold text-white">{{ form.cta_heading_line1 || 'Ready to Write Your Own' }}</h3>
                            <h3 class="text-2xl font-bold text-white">{{ form.cta_heading_line2 || 'Success Story?' }}</h3>
                            <p class="text-white/90 mt-3 text-sm">{{ form.cta_paragraph || 'Join the companies that have transformed their business with Nuclear Edge.' }}</p>
                            <div class="flex justify-center gap-3 mt-4">
                                <span class="px-4 py-2 bg-white text-orange-500 rounded-full text-sm font-semibold">{{ form.cta_primary_button_text || 'Get Started Today' }}</span>
                                <span class="px-4 py-2 bg-white/10 text-white rounded-full text-sm font-semibold border border-white/30">{{ form.cta_secondary_button_text || 'Learn About Us' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Heading Line 1</label>
                            <input v-model="form.cta_heading_line1" type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500" placeholder="Ready to Write Your Own" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Heading Line 2</label>
                            <input v-model="form.cta_heading_line2" type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500" placeholder="Success Story?" />
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Paragraph</label>
                        <textarea v-model="form.cta_paragraph" rows="2" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500" placeholder="Join the companies that have transformed their business..."></textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="mt-6 pt-6 border-t border-slate-200">
                        <h4 class="font-semibold text-slate-900 mb-4">CTA Buttons</h4>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="p-4 bg-slate-50 rounded-lg">
                                <h5 class="font-medium text-slate-800 mb-3">Primary Button</h5>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Button Text</label>
                                <input v-model="form.cta_primary_button_text" type="text" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="Get Started Today" />
                                <label class="block text-sm font-medium text-slate-700 mb-2 mt-3">Button Link</label>
                                <input v-model="form.cta_primary_button_link" type="text" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="/contact" />
                            </div>
                            <div class="p-4 bg-slate-50 rounded-lg">
                                <h5 class="font-medium text-slate-800 mb-3">Secondary Button</h5>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Button Text</label>
                                <input v-model="form.cta_secondary_button_text" type="text" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="Learn About Us" />
                                <label class="block text-sm font-medium text-slate-700 mb-2 mt-3">Button Link</label>
                                <input v-model="form.cta_secondary_button_link" type="text" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="/about" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Save Settings Button -->
            <div class="flex justify-end gap-3 mb-8">
                <a href="/success-stories" target="_blank" class="px-6 py-3 bg-slate-100 text-slate-700 font-semibold rounded-lg hover:bg-slate-200 transition-all flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    Preview Page
                </a>
                <button type="submit" :disabled="form.processing" class="px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 disabled:opacity-50">
                    <span v-if="!form.processing">Save Hero & CTA Settings</span>
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

        <!-- ==================== SUCCESS STORIES SECTION ==================== -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                        <span class="text-white font-bold">2</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Success Stories</h2>
                        <p class="text-sm text-slate-500">Manage individual success stories</p>
                    </div>
                </div>
                <button @click="openAddModal" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Story
                </button>
            </div>

            <!-- Stories List -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div v-if="localStories.length === 0" class="p-12 text-center">
                    <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    <p class="text-slate-500 mb-4">No success stories added yet</p>
                    <button @click="openAddModal" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-all">
                        Add Your First Story
                    </button>
                </div>

                <div v-else class="divide-y divide-slate-200">
                    <div v-for="(story, index) in localStories" :key="story.id" class="p-6 hover:bg-slate-50 transition-colors">
                        <div class="flex items-start gap-6">
                            <!-- Image -->
                            <div class="w-32 h-24 bg-slate-100 rounded-lg overflow-hidden flex-shrink-0">
                                <img v-if="story.image" :src="story.image" :alt="story.company" class="w-full h-full object-cover" />
                                <div v-else class="w-full h-full flex items-center justify-center text-slate-400">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="text-lg font-bold text-slate-900">{{ story.company }}</h3>
                                    <span class="px-2 py-1 bg-slate-100 text-slate-600 text-xs font-medium rounded-full">{{ story.industry }}</span>
                                    <span v-if="!story.is_active" class="px-2 py-1 bg-red-100 text-red-600 text-xs font-medium rounded-full">Inactive</span>
                                </div>
                                <p class="text-slate-600 text-sm mb-3">{{ story.tagline }}</p>
                                <div class="flex items-center gap-4 text-sm text-slate-500">
                                    <span v-if="story.stat1_value" class="flex items-center gap-1">
                                        <span class="font-semibold text-orange-500">{{ story.stat1_value }}</span>
                                        {{ story.stat1_label }}
                                    </span>
                                    <span v-if="story.stat2_value" class="flex items-center gap-1">
                                        <span class="font-semibold text-orange-500">{{ story.stat2_value }}</span>
                                        {{ story.stat2_label }}
                                    </span>
                                    <span v-if="story.stat3_value" class="flex items-center gap-1">
                                        <span class="font-semibold text-orange-500">{{ story.stat3_value }}</span>
                                        {{ story.stat3_label }}
                                    </span>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <button @click="moveStory(index, -1)" :disabled="index === 0" class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition-all disabled:opacity-30 disabled:cursor-not-allowed">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
                                    </svg>
                                </button>
                                <button @click="moveStory(index, 1)" :disabled="index === localStories.length - 1" class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition-all disabled:opacity-30 disabled:cursor-not-allowed">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <button @click="openEditModal(story)" class="p-2 text-blue-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                <button @click="confirmDelete(story)" class="p-2 text-red-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add/Edit Story Modal -->
        <div v-if="showModal" class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" @click="closeModal"></div>

                <div class="relative bg-white rounded-2xl shadow-2xl max-w-4xl w-full mx-auto z-10 max-h-[90vh] overflow-y-auto">
                    <div class="sticky top-0 bg-white px-6 py-4 border-b border-slate-200 flex items-center justify-between z-10">
                        <h3 class="text-xl font-bold text-slate-900">{{ editingStory ? 'Edit Story' : 'Add New Story' }}</h3>
                        <button @click="closeModal" class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <form @submit.prevent="saveStory" class="p-6">
                        <!-- Basic Info -->
                        <div class="mb-6">
                            <h4 class="font-semibold text-slate-900 mb-4">Basic Information</h4>
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Company Name *</label>
                                    <input v-model="storyForm.company" type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="e.g., Rajah Foods" required />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Industry *</label>
                                    <input v-model="storyForm.industry" type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="e.g., FMCG" required />
                                </div>
                            </div>
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-slate-700 mb-2">Tagline *</label>
                                <input v-model="storyForm.tagline" type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="e.g., Transforming a Local FMCG Brand into a Market Leader" required />
                            </div>

                            <!-- Image Upload -->
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-slate-700 mb-2">Story Image</label>
                                <div class="grid md:grid-cols-2 gap-4">
                                    <!-- Image Preview -->
                                    <div class="relative">
                                        <div class="aspect-[4/3] bg-slate-100 rounded-lg overflow-hidden border-2 border-dashed border-slate-300">
                                            <img
                                                v-if="imagePreview || storyForm.image"
                                                :src="imagePreview || storyForm.image"
                                                alt="Preview"
                                                class="w-full h-full object-cover"
                                            />
                                            <div v-else class="w-full h-full flex flex-col items-center justify-center text-slate-400">
                                                <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                <span class="text-sm">No image selected</span>
                                            </div>
                                        </div>
                                        <button
                                            v-if="imagePreview || storyForm.image"
                                            type="button"
                                            @click="clearImage"
                                            class="absolute top-2 right-2 p-1.5 bg-red-500 text-white rounded-full hover:bg-red-600 transition-all"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Upload Options -->
                                    <div class="space-y-4">
                                        <!-- File Upload -->
                                        <div>
                                            <label class="block text-sm font-medium text-slate-600 mb-2">Upload Image</label>
                                            <div class="relative">
                                                <input
                                                    type="file"
                                                    ref="imageInput"
                                                    @change="handleImageUpload"
                                                    accept="image/jpeg,image/png,image/webp"
                                                    class="hidden"
                                                />
                                                <button
                                                    type="button"
                                                    @click="$refs.imageInput.click()"
                                                    class="w-full px-4 py-3 border-2 border-dashed border-slate-300 rounded-lg text-slate-600 hover:border-blue-500 hover:text-blue-500 transition-all flex items-center justify-center gap-2"
                                                >
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                                    </svg>
                                                    Choose File
                                                </button>
                                            </div>
                                            <p class="text-xs text-slate-500 mt-1">JPG, PNG or WebP. Max 5MB.</p>
                                        </div>

                                        <!-- Or use URL -->
                                        <div>
                                            <label class="block text-sm font-medium text-slate-600 mb-2">Or enter Image URL</label>
                                            <input
                                                v-model="storyForm.image"
                                                type="text"
                                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                                placeholder="/images/story-image.png"
                                                @input="imagePreview = null; selectedFile = null"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Stats -->
                        <div class="mb-6 pt-6 border-t border-slate-200">
                            <h4 class="font-semibold text-slate-900 mb-4">Statistics (Optional)</h4>
                            <div class="grid md:grid-cols-3 gap-4">
                                <div class="p-4 bg-slate-50 rounded-lg">
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Stat 1 Value</label>
                                    <input v-model="storyForm.stat1_value" type="text" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="300%" />
                                    <label class="block text-sm font-medium text-slate-700 mb-2 mt-3">Stat 1 Label</label>
                                    <input v-model="storyForm.stat1_label" type="text" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="Sales Increase" />
                                </div>
                                <div class="p-4 bg-slate-50 rounded-lg">
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Stat 2 Value</label>
                                    <input v-model="storyForm.stat2_value" type="text" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="6 Mo" />
                                    <label class="block text-sm font-medium text-slate-700 mb-2 mt-3">Stat 2 Label</label>
                                    <input v-model="storyForm.stat2_label" type="text" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="Timeline" />
                                </div>
                                <div class="p-4 bg-slate-50 rounded-lg">
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Stat 3 Value</label>
                                    <input v-model="storyForm.stat3_value" type="text" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="3 States" />
                                    <label class="block text-sm font-medium text-slate-700 mb-2 mt-3">Stat 3 Label</label>
                                    <input v-model="storyForm.stat3_label" type="text" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="Expansion" />
                                </div>
                            </div>
                        </div>

                        <!-- Story Content -->
                        <div class="mb-6 pt-6 border-t border-slate-200">
                            <h4 class="font-semibold text-slate-900 mb-4">Story Content</h4>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">The Challenge *</label>
                                    <textarea v-model="storyForm.challenge" rows="4" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Describe the challenge the client faced..." required></textarea>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">The Solution *</label>
                                    <textarea v-model="storyForm.solution" rows="4" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Describe how you solved the challenge..." required></textarea>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">The Outcome *</label>
                                    <textarea v-model="storyForm.outcome" rows="4" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Describe the results achieved..." required></textarea>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Key Takeaway *</label>
                                    <textarea v-model="storyForm.takeaway" rows="2" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="A motivational quote or key insight..." required></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-6 pt-6 border-t border-slate-200">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input v-model="storyForm.is_active" type="checkbox" class="w-5 h-5 text-blue-500 border-slate-300 rounded focus:ring-blue-500" />
                                <span class="text-sm font-medium text-slate-700">Active (visible on the website)</span>
                            </label>
                        </div>

                        <!-- Actions -->
                        <div class="flex justify-end gap-3 pt-6 border-t border-slate-200">
                            <button type="button" @click="closeModal" class="px-6 py-3 bg-slate-100 text-slate-700 font-semibold rounded-lg hover:bg-slate-200 transition-all">
                                Cancel
                            </button>
                            <button type="submit" :disabled="storyForm.processing" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all disabled:opacity-50">
                                <span v-if="!storyForm.processing">{{ editingStory ? 'Update Story' : 'Add Story' }}</span>
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
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div v-if="showDeleteModal" class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" @click="showDeleteModal = false"></div>

                <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full mx-auto z-10 p-6">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Delete Story</h3>
                        <p class="text-slate-600 mb-6">Are you sure you want to delete "{{ storyToDelete?.company }}"? This action cannot be undone.</p>
                        <div class="flex justify-center gap-3">
                            <button @click="showDeleteModal = false" class="px-6 py-3 bg-slate-100 text-slate-700 font-semibold rounded-lg hover:bg-slate-200 transition-all">
                                Cancel
                            </button>
                            <button @click="deleteStory" class="px-6 py-3 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 transition-all">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { reactive, ref } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import AdminLayout from '../../../Components/Admin/AdminLayout.vue';

const props = defineProps({
    settings: Object,
    stories: Array,
});

// Settings Form
const form = reactive({
    // Hero Section
    hero_label: props.settings?.hero_label || '',
    hero_headline_line1: props.settings?.hero_headline_line1 || '',
    hero_headline_line2: props.settings?.hero_headline_line2 || '',
    hero_paragraph: props.settings?.hero_paragraph || '',
    // CTA Section
    cta_heading_line1: props.settings?.cta_heading_line1 || '',
    cta_heading_line2: props.settings?.cta_heading_line2 || '',
    cta_paragraph: props.settings?.cta_paragraph || '',
    cta_primary_button_text: props.settings?.cta_primary_button_text || '',
    cta_primary_button_link: props.settings?.cta_primary_button_link || '',
    cta_secondary_button_text: props.settings?.cta_secondary_button_text || '',
    cta_secondary_button_link: props.settings?.cta_secondary_button_link || '',
    processing: false,
});

const saveSettings = () => {
    form.processing = true;
    const { processing, ...data } = form;
    router.post('/admin/success-stories-page', data, {
        onFinish: () => {
            form.processing = false;
        },
    });
};

// Stories Management
const localStories = ref([...props.stories]);
const showModal = ref(false);
const showDeleteModal = ref(false);
const editingStory = ref(null);
const storyToDelete = ref(null);

// Image upload
const imagePreview = ref(null);
const selectedFile = ref(null);
const imageInput = ref(null);

const defaultStoryForm = {
    company: '',
    industry: '',
    tagline: '',
    image: '',
    stat1_value: '',
    stat1_label: '',
    stat2_value: '',
    stat2_label: '',
    stat3_value: '',
    stat3_label: '',
    challenge: '',
    solution: '',
    outcome: '',
    takeaway: '',
    is_active: true,
    processing: false,
};

const storyForm = reactive({ ...defaultStoryForm });

const handleImageUpload = (event) => {
    const file = event.target.files[0];
    if (file) {
        // Validate file size (5MB)
        if (file.size > 5 * 1024 * 1024) {
            alert('File size must be less than 5MB');
            return;
        }
        selectedFile.value = file;
        storyForm.image = ''; // Clear URL input when file is selected
        // Create preview
        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreview.value = e.target.result;
        };
        reader.readAsDataURL(file);
    }
};

const clearImage = () => {
    imagePreview.value = null;
    selectedFile.value = null;
    storyForm.image = '';
    if (imageInput.value) {
        imageInput.value.value = '';
    }
};

const openAddModal = () => {
    editingStory.value = null;
    Object.assign(storyForm, defaultStoryForm);
    imagePreview.value = null;
    selectedFile.value = null;
    showModal.value = true;
};

const openEditModal = (story) => {
    editingStory.value = story;
    Object.assign(storyForm, {
        company: story.company || '',
        industry: story.industry || '',
        tagline: story.tagline || '',
        image: story.image || '',
        stat1_value: story.stat1_value || '',
        stat1_label: story.stat1_label || '',
        stat2_value: story.stat2_value || '',
        stat2_label: story.stat2_label || '',
        stat3_value: story.stat3_value || '',
        stat3_label: story.stat3_label || '',
        challenge: story.challenge || '',
        solution: story.solution || '',
        outcome: story.outcome || '',
        takeaway: story.takeaway || '',
        is_active: story.is_active ?? true,
        processing: false,
    });
    imagePreview.value = null;
    selectedFile.value = null;
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
    editingStory.value = null;
    imagePreview.value = null;
    selectedFile.value = null;
};

const saveStory = () => {
    storyForm.processing = true;

    // Create FormData for file upload
    const formData = new FormData();
    formData.append('company', storyForm.company);
    formData.append('industry', storyForm.industry);
    formData.append('tagline', storyForm.tagline);
    formData.append('image', storyForm.image || '');
    formData.append('stat1_value', storyForm.stat1_value || '');
    formData.append('stat1_label', storyForm.stat1_label || '');
    formData.append('stat2_value', storyForm.stat2_value || '');
    formData.append('stat2_label', storyForm.stat2_label || '');
    formData.append('stat3_value', storyForm.stat3_value || '');
    formData.append('stat3_label', storyForm.stat3_label || '');
    formData.append('challenge', storyForm.challenge);
    formData.append('solution', storyForm.solution);
    formData.append('outcome', storyForm.outcome);
    formData.append('takeaway', storyForm.takeaway);
    formData.append('is_active', storyForm.is_active ? '1' : '0');

    // Add file if selected
    if (selectedFile.value) {
        formData.append('image_file', selectedFile.value);
    }

    if (editingStory.value) {
        // For PUT with file upload, use POST with _method
        formData.append('_method', 'PUT');
        router.post(`/admin/success-stories-page/stories/${editingStory.value.id}`, formData, {
            onSuccess: () => {
                closeModal();
            },
            onFinish: () => {
                storyForm.processing = false;
            },
        });
    } else {
        router.post('/admin/success-stories-page/stories', formData, {
            onSuccess: () => {
                closeModal();
            },
            onFinish: () => {
                storyForm.processing = false;
            },
        });
    }
};

const confirmDelete = (story) => {
    storyToDelete.value = story;
    showDeleteModal.value = true;
};

const deleteStory = () => {
    router.delete(`/admin/success-stories-page/stories/${storyToDelete.value.id}`, {
        onSuccess: () => {
            showDeleteModal.value = false;
            storyToDelete.value = null;
        },
    });
};

const moveStory = (index, direction) => {
    const newIndex = index + direction;
    if (newIndex < 0 || newIndex >= localStories.value.length) return;

    const temp = localStories.value[index];
    localStories.value[index] = localStories.value[newIndex];
    localStories.value[newIndex] = temp;

    // Update order in backend
    const reorderedStories = localStories.value.map((story, idx) => ({
        id: story.id,
        order: idx,
    }));

    router.post('/admin/success-stories-page/stories/reorder', { stories: reorderedStories }, {
        preserveScroll: true,
    });
};
</script>
