<template>
    <Head>
        <title>Contact Page Settings - Admin Portal</title>
    </Head>

    <AdminLayout :user="$page.props.auth.user">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
                <a href="/admin/dashboard" class="hover:text-slate-700">Dashboard</a>
                <span>/</span>
                <span class="text-slate-900">Contact Page Settings</span>
            </div>
            <h1 class="text-2xl font-bold text-slate-900">Contact Page Settings</h1>
            <p class="text-slate-600 mt-1">Manage all sections of your contact page</p>
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
                        <p class="text-sm text-slate-500">The main banner at the top of the contact page</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <!-- Preview Card -->
                    <div class="mb-6 p-6 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-xl">
                        <div class="text-center">
                            <p class="text-orange-500 font-semibold text-sm uppercase tracking-wider mb-2">
                                {{ form.hero_label || 'Get in Touch' }}
                            </p>
                            <h3 class="text-2xl md:text-3xl font-bold text-white mb-2">
                                {{ form.hero_headline_line1 || 'Contact' }}
                            </h3>
                            <h3 class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent">
                                {{ form.hero_headline_line2 || 'Nuclear Edge' }}
                            </h3>
                            <p class="text-slate-300 mt-3">{{ form.hero_paragraph || "Let's discuss how we can help transform your business" }}</p>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Label (Uppercase)</label>
                            <input
                                v-model="form.hero_label"
                                type="text"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                placeholder="Get in Touch"
                            />
                            <p class="text-xs text-slate-500 mt-1">Default: "Get in Touch"</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Headline Line 1</label>
                            <input
                                v-model="form.hero_headline_line1"
                                type="text"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                placeholder="Contact"
                            />
                            <p class="text-xs text-slate-500 mt-1">Default: "Contact"</p>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Headline Line 2 (Gradient)</label>
                            <input
                                v-model="form.hero_headline_line2"
                                type="text"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                placeholder="Nuclear Edge"
                            />
                            <p class="text-xs text-slate-500 mt-1">Default: "Nuclear Edge"</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Paragraph</label>
                            <input
                                v-model="form.hero_paragraph"
                                type="text"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                placeholder="Let's discuss how we can help transform your business"
                            />
                            <p class="text-xs text-slate-500 mt-1">Default: "Let's discuss how we can help transform your business"</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== CONTACT INFO SECTION ==================== -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                        <span class="text-white font-bold">2</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Contact Information</h2>
                        <p class="text-sm text-slate-500">Email, phone, and address details</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Email Address</label>
                            <input
                                v-model="form.contact_email"
                                type="email"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="connect.nuclearedge@gmail.com"
                            />
                            <p class="text-xs text-slate-500 mt-1">Default: "connect.nuclearedge@gmail.com"</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Phone Number</label>
                            <input
                                v-model="form.contact_phone"
                                type="text"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="+91 9315946467"
                            />
                            <p class="text-xs text-slate-500 mt-1">Default: "+91 9315946467"</p>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Address Line 1</label>
                            <input
                                v-model="form.contact_address_line1"
                                type="text"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="1195 Salarpuriya IndiraNagar"
                            />
                            <p class="text-xs text-slate-500 mt-1">Default: "1195 Salarpuriya IndiraNagar"</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Address Line 2</label>
                            <input
                                v-model="form.contact_address_line2"
                                type="text"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Bangalore 560038"
                            />
                            <p class="text-xs text-slate-500 mt-1">Default: "Bangalore 560038"</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== FORM SECTION ==================== -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center">
                        <span class="text-white font-bold">3</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Form Section</h2>
                        <p class="text-sm text-slate-500">Contact form heading and description</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <!-- Preview Card -->
                    <div class="mb-6 p-6 bg-slate-50 border border-slate-200 rounded-xl">
                        <h3 class="text-2xl font-bold text-slate-900 mb-2">
                            {{ form.form_heading_line1 || 'Drop Us a' }}
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500">
                                {{ form.form_heading_line2 || 'Line' }}
                            </span>
                        </h3>
                        <p class="text-slate-600">{{ form.form_description || 'Your email address will not be published. Required fields are marked *' }}</p>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Heading Line 1</label>
                            <input
                                v-model="form.form_heading_line1"
                                type="text"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                                placeholder="Drop Us a"
                            />
                            <p class="text-xs text-slate-500 mt-1">Default: "Drop Us a"</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Heading Line 2 (Gradient)</label>
                            <input
                                v-model="form.form_heading_line2"
                                type="text"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                                placeholder="Line"
                            />
                            <p class="text-xs text-slate-500 mt-1">Default: "Line"</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Description</label>
                        <input
                            v-model="form.form_description"
                            type="text"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                            placeholder="Your email address will not be published. Required fields are marked *"
                        />
                        <p class="text-xs text-slate-500 mt-1">Default: "Your email address will not be published. Required fields are marked *"</p>
                    </div>
                </div>
            </div>

            <!-- ==================== MAP SECTION ==================== -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-violet-500 to-purple-600 flex items-center justify-center">
                        <span class="text-white font-bold">4</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Map Section</h2>
                        <p class="text-sm text-slate-500">Google Maps embed and location details</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <!-- Preview Card -->
                    <div class="mb-6 p-6 bg-slate-50 border border-slate-200 rounded-xl">
                        <h3 class="text-xl font-bold text-slate-900 mb-2">
                            {{ form.map_heading_line1 || 'Find Us on' }}
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500">
                                {{ form.map_heading_line2 || 'Map' }}
                            </span>
                        </h3>
                        <p class="text-slate-600">{{ form.map_description || 'Visit our office in Bangalore' }}</p>
                        <div class="mt-4 p-3 bg-white rounded-lg border border-slate-200 inline-flex items-center gap-2">
                            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-slate-900 text-sm">{{ form.map_overlay_title || 'Nuclear Edge' }}</p>
                                <p class="text-xs text-slate-500">{{ form.map_overlay_subtitle || 'Bangalore, Karnataka' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Heading Line 1</label>
                            <input
                                v-model="form.map_heading_line1"
                                type="text"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                placeholder="Find Us on"
                            />
                            <p class="text-xs text-slate-500 mt-1">Default: "Find Us on"</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Heading Line 2 (Gradient)</label>
                            <input
                                v-model="form.map_heading_line2"
                                type="text"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                placeholder="Map"
                            />
                            <p class="text-xs text-slate-500 mt-1">Default: "Map"</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Description</label>
                        <input
                            v-model="form.map_description"
                            type="text"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                            placeholder="Visit our office in Bangalore"
                        />
                        <p class="text-xs text-slate-500 mt-1">Default: "Visit our office in Bangalore"</p>
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Google Maps Embed URL</label>
                        <textarea
                            v-model="form.map_embed_url"
                            rows="2"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent text-sm"
                            placeholder="https://www.google.com/maps/embed?pb=..."
                        ></textarea>
                        <p class="text-xs text-slate-500 mt-1">Paste the full Google Maps embed URL here</p>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Overlay Title</label>
                            <input
                                v-model="form.map_overlay_title"
                                type="text"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                placeholder="Nuclear Edge"
                            />
                            <p class="text-xs text-slate-500 mt-1">Default: "Nuclear Edge"</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Overlay Subtitle</label>
                            <input
                                v-model="form.map_overlay_subtitle"
                                type="text"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                placeholder="Bangalore, Karnataka"
                            />
                            <p class="text-xs text-slate-500 mt-1">Default: "Bangalore, Karnataka"</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== CTA SECTION ==================== -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-pink-500 to-rose-600 flex items-center justify-center">
                        <span class="text-white font-bold">5</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Call-to-Action Section</h2>
                        <p class="text-sm text-slate-500">Bottom CTA banner content</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <!-- Preview Card -->
                    <div class="mb-6 p-6 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-xl">
                        <div class="text-center">
                            <h3 class="text-2xl font-bold text-white mb-2">
                                {{ form.cta_heading_line1 || 'Ready to Start Your' }}
                            </h3>
                            <h3 class="text-2xl font-bold bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent">
                                {{ form.cta_heading_line2 || 'Journey?' }}
                            </h3>
                            <p class="text-slate-300 mt-3">{{ form.cta_paragraph || 'Join hundreds of businesses that have transformed with Nuclear Edge' }}</p>
                            <div class="mt-4">
                                <span class="inline-block px-6 py-2 border border-white/20 text-white/80 rounded-full text-sm">
                                    {{ form.cta_button_text || 'Learn More About Us' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Heading Line 1</label>
                            <input
                                v-model="form.cta_heading_line1"
                                type="text"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                                placeholder="Ready to Start Your"
                            />
                            <p class="text-xs text-slate-500 mt-1">Default: "Ready to Start Your"</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Heading Line 2 (Gradient)</label>
                            <input
                                v-model="form.cta_heading_line2"
                                type="text"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                                placeholder="Journey?"
                            />
                            <p class="text-xs text-slate-500 mt-1">Default: "Journey?"</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Paragraph</label>
                        <textarea
                            v-model="form.cta_paragraph"
                            rows="2"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                            placeholder="Join hundreds of businesses that have transformed with Nuclear Edge"
                        ></textarea>
                        <p class="text-xs text-slate-500 mt-1">Default: "Join hundreds of businesses that have transformed with Nuclear Edge"</p>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Button Text</label>
                            <input
                                v-model="form.cta_button_text"
                                type="text"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                                placeholder="Learn More About Us"
                            />
                            <p class="text-xs text-slate-500 mt-1">Default: "Learn More About Us"</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Button Link</label>
                            <input
                                v-model="form.cta_button_link"
                                type="text"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                                placeholder="/about"
                            />
                            <p class="text-xs text-slate-500 mt-1">Default: "/about"</p>
                        </div>
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
                    href="/contact"
                    target="_blank"
                    class="px-6 py-3 bg-slate-100 text-slate-700 font-semibold rounded-lg hover:bg-slate-200 transition-all flex items-center gap-2"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    Preview Page
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
    hero_label: props.settings?.hero_label || '',
    hero_headline_line1: props.settings?.hero_headline_line1 || '',
    hero_headline_line2: props.settings?.hero_headline_line2 || '',
    hero_paragraph: props.settings?.hero_paragraph || '',
    // Contact Info Section
    contact_email: props.settings?.contact_email || '',
    contact_phone: props.settings?.contact_phone || '',
    contact_address_line1: props.settings?.contact_address_line1 || '',
    contact_address_line2: props.settings?.contact_address_line2 || '',
    // Form Section
    form_heading_line1: props.settings?.form_heading_line1 || '',
    form_heading_line2: props.settings?.form_heading_line2 || '',
    form_description: props.settings?.form_description || '',
    // Map Section
    map_heading_line1: props.settings?.map_heading_line1 || '',
    map_heading_line2: props.settings?.map_heading_line2 || '',
    map_description: props.settings?.map_description || '',
    map_embed_url: props.settings?.map_embed_url || '',
    map_overlay_title: props.settings?.map_overlay_title || '',
    map_overlay_subtitle: props.settings?.map_overlay_subtitle || '',
    // CTA Section
    cta_heading_line1: props.settings?.cta_heading_line1 || '',
    cta_heading_line2: props.settings?.cta_heading_line2 || '',
    cta_paragraph: props.settings?.cta_paragraph || '',
    cta_button_text: props.settings?.cta_button_text || '',
    cta_button_link: props.settings?.cta_button_link || '',
    processing: false,
});

const saveSettings = () => {
    form.processing = true;

    const data = {
        // Hero Section
        hero_label: form.hero_label || '',
        hero_headline_line1: form.hero_headline_line1 || '',
        hero_headline_line2: form.hero_headline_line2 || '',
        hero_paragraph: form.hero_paragraph || '',
        // Contact Info Section
        contact_email: form.contact_email || '',
        contact_phone: form.contact_phone || '',
        contact_address_line1: form.contact_address_line1 || '',
        contact_address_line2: form.contact_address_line2 || '',
        // Form Section
        form_heading_line1: form.form_heading_line1 || '',
        form_heading_line2: form.form_heading_line2 || '',
        form_description: form.form_description || '',
        // Map Section
        map_heading_line1: form.map_heading_line1 || '',
        map_heading_line2: form.map_heading_line2 || '',
        map_description: form.map_description || '',
        map_embed_url: form.map_embed_url || '',
        map_overlay_title: form.map_overlay_title || '',
        map_overlay_subtitle: form.map_overlay_subtitle || '',
        // CTA Section
        cta_heading_line1: form.cta_heading_line1 || '',
        cta_heading_line2: form.cta_heading_line2 || '',
        cta_paragraph: form.cta_paragraph || '',
        cta_button_text: form.cta_button_text || '',
        cta_button_link: form.cta_button_link || '',
    };

    router.post('/admin/contact-page', data, {
        onFinish: () => {
            form.processing = false;
        },
    });
};
</script>
