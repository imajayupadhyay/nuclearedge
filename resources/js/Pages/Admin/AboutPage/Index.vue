<template>
    <Head>
        <title>About Page Settings - Admin Portal</title>
    </Head>

    <AdminLayout :user="$page.props.auth.user">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
                <a href="/admin/dashboard" class="hover:text-slate-700">Dashboard</a>
                <span>/</span>
                <span class="text-slate-900">About Page Settings</span>
            </div>
            <h1 class="text-2xl font-bold text-slate-900">About Page Settings</h1>
            <p class="text-slate-600 mt-1">Manage all sections of your about page</p>
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
                        <p class="text-sm text-slate-500">The main banner at the top of the about page</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <!-- Preview -->
                    <div class="mb-6 p-6 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-xl">
                        <div class="text-center">
                            <p class="text-orange-500 font-semibold text-sm uppercase tracking-wider mb-2">{{ form.hero_label || 'Who We Are' }}</p>
                            <h3 class="text-2xl font-bold text-white mb-2">{{ form.hero_headline_line1 || 'About' }}</h3>
                            <h3 class="text-2xl font-bold bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent">{{ form.hero_headline_line2 || 'Nuclear Edge' }}</h3>
                            <p class="text-slate-300 mt-3">{{ form.hero_paragraph || 'Powerful, efficient, and always pushing the limits of innovation' }}</p>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Label</label>
                            <input v-model="form.hero_label" type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Who We Are" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Headline Line 1</label>
                            <input v-model="form.hero_headline_line1" type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="About" />
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 gap-6 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Headline Line 2 (Gradient)</label>
                            <input v-model="form.hero_headline_line2" type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Nuclear Edge" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Paragraph</label>
                            <input v-model="form.hero_paragraph" type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Powerful, efficient..." />
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== INTRO SECTION ==================== -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                        <span class="text-white font-bold">2</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Intro Section</h2>
                        <p class="text-sm text-slate-500">Main introduction with statistics</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Heading Line 1</label>
                            <input v-model="form.intro_heading_line1" type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="At Nuclear Edge, we embody the spirit of" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Heading Line 2 (Gradient)</label>
                            <input v-model="form.intro_heading_line2" type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="nuclear energy" />
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Paragraph</label>
                        <textarea v-model="form.intro_paragraph" rows="3" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Powerful, efficient, and always pushing the limits of innovation..."></textarea>
                    </div>

                    <!-- Stats -->
                    <div class="mt-6 pt-6 border-t border-slate-200">
                        <h4 class="font-semibold text-slate-900 mb-4">Statistics</h4>
                        <div class="grid md:grid-cols-3 gap-6">
                            <div class="p-4 bg-slate-50 rounded-lg">
                                <label class="block text-sm font-medium text-slate-700 mb-2">Stat 1 Value</label>
                                <input v-model="form.intro_stat1_value" type="text" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="1989" />
                                <label class="block text-sm font-medium text-slate-700 mb-2 mt-3">Stat 1 Label</label>
                                <input v-model="form.intro_stat1_label" type="text" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="Founded in Ambala" />
                            </div>
                            <div class="p-4 bg-slate-50 rounded-lg">
                                <label class="block text-sm font-medium text-slate-700 mb-2">Stat 2 Value</label>
                                <input v-model="form.intro_stat2_value" type="text" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="35+" />
                                <label class="block text-sm font-medium text-slate-700 mb-2 mt-3">Stat 2 Label</label>
                                <input v-model="form.intro_stat2_label" type="text" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="Years of Excellence" />
                            </div>
                            <div class="p-4 bg-slate-50 rounded-lg">
                                <label class="block text-sm font-medium text-slate-700 mb-2">Stat 3 Value</label>
                                <input v-model="form.intro_stat3_value" type="text" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="100+" />
                                <label class="block text-sm font-medium text-slate-700 mb-2 mt-3">Stat 3 Label</label>
                                <input v-model="form.intro_stat3_label" type="text" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="Businesses Transformed" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== JOURNEY SECTION ==================== -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center">
                        <span class="text-white font-bold">3</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Journey Section</h2>
                        <p class="text-sm text-slate-500">Your company's history and timeline</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <div class="grid md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Label Badge</label>
                            <input v-model="form.journey_label" type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="Our Journey" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Start Year</label>
                            <input v-model="form.journey_start_year" type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="1989" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">End Year</label>
                            <input v-model="form.journey_end_year" type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="2026" />
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 gap-6 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Heading Line 1</label>
                            <input v-model="form.journey_heading_line1" type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="A Legacy Built on" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Heading Line 2 (Gradient)</label>
                            <input v-model="form.journey_heading_line2" type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="Trust & Innovation" />
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 gap-6 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Paragraph 1</label>
                            <textarea v-model="form.journey_paragraph1" rows="3" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="Our journey began in 1989..."></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Paragraph 2</label>
                            <textarea v-model="form.journey_paragraph2" rows="3" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="With decades of experience..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== EXCELLENCE SECTION ==================== -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-violet-500 to-purple-600 flex items-center justify-center">
                        <span class="text-white font-bold">4</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Excellence Section</h2>
                        <p class="text-sm text-slate-500">Your company's values and features</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <div class="grid md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Label Badge</label>
                            <input v-model="form.excellence_label" type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500" placeholder="Our Excellence" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Heading Line 1</label>
                            <input v-model="form.excellence_heading_line1" type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500" placeholder="Grounded in Culture," />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Heading Line 2 (Gradient)</label>
                            <input v-model="form.excellence_heading_line2" type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500" placeholder="Driven by Results" />
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 gap-6 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Paragraph 1</label>
                            <textarea v-model="form.excellence_paragraph1" rows="3" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500" placeholder="We pride ourselves..."></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Paragraph 2</label>
                            <textarea v-model="form.excellence_paragraph2" rows="3" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500" placeholder="Over the years..."></textarea>
                        </div>
                    </div>

                    <!-- Features -->
                    <div class="mt-6 pt-6 border-t border-slate-200">
                        <h4 class="font-semibold text-slate-900 mb-4">Features</h4>
                        <div class="grid md:grid-cols-3 gap-6">
                            <div class="p-4 bg-slate-50 rounded-lg">
                                <label class="block text-sm font-medium text-slate-700 mb-2">Feature 1 Title</label>
                                <input v-model="form.excellence_feature1_title" type="text" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="Personal Touch" />
                                <label class="block text-sm font-medium text-slate-700 mb-2 mt-3">Feature 1 Description</label>
                                <input v-model="form.excellence_feature1_desc" type="text" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="Every project gets our undivided attention" />
                            </div>
                            <div class="p-4 bg-slate-50 rounded-lg">
                                <label class="block text-sm font-medium text-slate-700 mb-2">Feature 2 Title</label>
                                <input v-model="form.excellence_feature2_title" type="text" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="Sustainable Approach" />
                                <label class="block text-sm font-medium text-slate-700 mb-2 mt-3">Feature 2 Description</label>
                                <input v-model="form.excellence_feature2_desc" type="text" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="Building solutions that last" />
                            </div>
                            <div class="p-4 bg-slate-50 rounded-lg">
                                <label class="block text-sm font-medium text-slate-700 mb-2">Feature 3 Title</label>
                                <input v-model="form.excellence_feature3_title" type="text" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="Attention to Detail" />
                                <label class="block text-sm font-medium text-slate-700 mb-2 mt-3">Feature 3 Description</label>
                                <input v-model="form.excellence_feature3_desc" type="text" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="From atoms to the big picture" />
                            </div>
                        </div>
                    </div>

                    <!-- Badge -->
                    <div class="mt-6 pt-6 border-t border-slate-200">
                        <h4 class="font-semibold text-slate-900 mb-4">Floating Badge</h4>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Badge Value</label>
                                <input v-model="form.excellence_badge_value" type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500" placeholder="100+" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Badge Label</label>
                                <input v-model="form.excellence_badge_label" type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500" placeholder="Happy Clients" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== VISION/CTA SECTION ==================== -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-pink-500 to-rose-600 flex items-center justify-center">
                        <span class="text-white font-bold">5</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Vision / CTA Section</h2>
                        <p class="text-sm text-slate-500">Bottom call-to-action section</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <!-- Preview -->
                    <div class="mb-6 p-6 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-xl">
                        <div class="text-center">
                            <span class="px-3 py-1 bg-orange-500/20 text-orange-400 rounded-full text-xs font-semibold">{{ form.vision_label || 'Our Vision' }}</span>
                            <h3 class="text-2xl font-bold text-white mt-4">{{ form.vision_heading_line1 || 'Passionate About Your' }}</h3>
                            <h3 class="text-2xl font-bold bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent">{{ form.vision_heading_line2 || 'Success' }}</h3>
                            <p class="text-slate-300 mt-3 text-sm">{{ form.vision_paragraph || "And while we're serious about helping your business grow, we're also a fun bunch to work with!" }}</p>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Label Badge</label>
                            <input v-model="form.vision_label" type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500" placeholder="Our Vision" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Heading Line 1</label>
                            <input v-model="form.vision_heading_line1" type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500" placeholder="Passionate About Your" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Heading Line 2 (Gradient)</label>
                            <input v-model="form.vision_heading_line2" type="text" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500" placeholder="Success" />
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Paragraph</label>
                        <textarea v-model="form.vision_paragraph" rows="3" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500" placeholder="And while we're serious about helping your business grow..."></textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="mt-6 pt-6 border-t border-slate-200">
                        <h4 class="font-semibold text-slate-900 mb-4">CTA Buttons</h4>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="p-4 bg-slate-50 rounded-lg">
                                <h5 class="font-medium text-slate-800 mb-3">Primary Button</h5>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Button Text</label>
                                <input v-model="form.vision_primary_button_text" type="text" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="Join the Nuclear Edge Family" />
                                <label class="block text-sm font-medium text-slate-700 mb-2 mt-3">Button Link</label>
                                <input v-model="form.vision_primary_button_link" type="text" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="/contact" />
                            </div>
                            <div class="p-4 bg-slate-50 rounded-lg">
                                <h5 class="font-medium text-slate-800 mb-3">Secondary Button</h5>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Button Text</label>
                                <input v-model="form.vision_secondary_button_text" type="text" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="Read Our Stories" />
                                <label class="block text-sm font-medium text-slate-700 mb-2 mt-3">Button Link</label>
                                <input v-model="form.vision_secondary_button_link" type="text" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="/blog" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <div class="flex justify-end gap-3">
                <a href="/about" target="_blank" class="px-6 py-3 bg-slate-100 text-slate-700 font-semibold rounded-lg hover:bg-slate-200 transition-all flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    Preview Page
                </a>
                <button type="submit" :disabled="form.processing" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 disabled:opacity-50">
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

const form = reactive({
    // Hero Section
    hero_label: props.settings?.hero_label || '',
    hero_headline_line1: props.settings?.hero_headline_line1 || '',
    hero_headline_line2: props.settings?.hero_headline_line2 || '',
    hero_paragraph: props.settings?.hero_paragraph || '',
    // Intro Section
    intro_heading_line1: props.settings?.intro_heading_line1 || '',
    intro_heading_line2: props.settings?.intro_heading_line2 || '',
    intro_paragraph: props.settings?.intro_paragraph || '',
    intro_stat1_value: props.settings?.intro_stat1_value || '',
    intro_stat1_label: props.settings?.intro_stat1_label || '',
    intro_stat2_value: props.settings?.intro_stat2_value || '',
    intro_stat2_label: props.settings?.intro_stat2_label || '',
    intro_stat3_value: props.settings?.intro_stat3_value || '',
    intro_stat3_label: props.settings?.intro_stat3_label || '',
    // Journey Section
    journey_label: props.settings?.journey_label || '',
    journey_heading_line1: props.settings?.journey_heading_line1 || '',
    journey_heading_line2: props.settings?.journey_heading_line2 || '',
    journey_start_year: props.settings?.journey_start_year || '',
    journey_end_year: props.settings?.journey_end_year || '',
    journey_paragraph1: props.settings?.journey_paragraph1 || '',
    journey_paragraph2: props.settings?.journey_paragraph2 || '',
    // Excellence Section
    excellence_label: props.settings?.excellence_label || '',
    excellence_heading_line1: props.settings?.excellence_heading_line1 || '',
    excellence_heading_line2: props.settings?.excellence_heading_line2 || '',
    excellence_paragraph1: props.settings?.excellence_paragraph1 || '',
    excellence_paragraph2: props.settings?.excellence_paragraph2 || '',
    excellence_feature1_title: props.settings?.excellence_feature1_title || '',
    excellence_feature1_desc: props.settings?.excellence_feature1_desc || '',
    excellence_feature2_title: props.settings?.excellence_feature2_title || '',
    excellence_feature2_desc: props.settings?.excellence_feature2_desc || '',
    excellence_feature3_title: props.settings?.excellence_feature3_title || '',
    excellence_feature3_desc: props.settings?.excellence_feature3_desc || '',
    excellence_badge_value: props.settings?.excellence_badge_value || '',
    excellence_badge_label: props.settings?.excellence_badge_label || '',
    // Vision Section
    vision_label: props.settings?.vision_label || '',
    vision_heading_line1: props.settings?.vision_heading_line1 || '',
    vision_heading_line2: props.settings?.vision_heading_line2 || '',
    vision_paragraph: props.settings?.vision_paragraph || '',
    vision_primary_button_text: props.settings?.vision_primary_button_text || '',
    vision_primary_button_link: props.settings?.vision_primary_button_link || '',
    vision_secondary_button_text: props.settings?.vision_secondary_button_text || '',
    vision_secondary_button_link: props.settings?.vision_secondary_button_link || '',
    processing: false,
});

const saveSettings = () => {
    form.processing = true;
    const { processing, ...data } = form;
    router.post('/admin/about-page', data, {
        onFinish: () => {
            form.processing = false;
        },
    });
};
</script>
