<template>
    <footer class="relative bg-slate-950 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 pointer-events-none opacity-5">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="footer-grid" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
                        <circle cx="3" cy="3" r="2" fill="#F97316"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#footer-grid)"/>
            </svg>
        </div>

        <!-- Decorative Gradient Orbs -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-gradient-to-br from-orange-500/10 to-red-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-gradient-to-br from-orange-500/10 to-red-500/10 rounded-full blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <!-- Main Footer Content -->
            <div class="py-20">
                <!-- Top Section: Newsletter & Info -->
                <div class="grid lg:grid-cols-2 gap-16 mb-20">
                    <!-- Left: Newsletter -->
                    <div>
                        <div class="mb-8">
                            <!-- Logo -->
                            <img
                                :src="footerData.logo_url || '/images/nuclear-edge-logo.webp'"
                                alt="Nuclear Edge"
                                class="h-16 mb-6"
                            />
                            <h3 class="text-3xl md:text-4xl font-bold text-white mb-4">
                                {{ footerData.heading_line1 || 'From Problems to Progress:' }}
                                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500 mt-2">
                                    {{ footerData.heading_line2 || 'Your Partner in Growth' }}
                                </span>
                            </h3>
                            <p class="text-slate-400 text-lg leading-relaxed">
                                {{ footerData.description || 'Join our newsletter to stay updated with the latest insights, innovations, and success stories.' }}
                            </p>
                        </div>

                        <!-- Newsletter Form -->
                        <div class="relative">
                            <div class="flex items-center gap-3">
                                <div class="flex-1 relative group">
                                    <input
                                        v-model="form.email"
                                        type="email"
                                        placeholder="Enter your email"
                                        :class="[
                                            'w-full px-6 py-4 bg-white/5 border rounded-2xl text-white placeholder:text-slate-500 outline-none transition-all duration-300 focus:bg-white/10 backdrop-blur-sm',
                                            form.errors.email ? 'border-red-500 focus:border-red-500' : 'border-white/10 focus:border-orange-500/50'
                                        ]"
                                    />
                                    <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-orange-500/20 to-red-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 -z-10 blur-xl"></div>
                                </div>
                                <button
                                    @click="subscribeNewsletter"
                                    :disabled="form.processing"
                                    class="group relative px-8 py-4 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-lg hover:shadow-orange-500/50 hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed"
                                >
                                    <span class="relative z-10 flex items-center gap-2">
                                        <span v-if="!form.processing">Subscribe</span>
                                        <span v-else>Subscribing...</span>
                                        <svg v-if="!form.processing" class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                        </svg>
                                    </span>
                                    <div class="absolute inset-0 bg-gradient-to-r from-red-600 to-orange-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </button>
                            </div>
                            <p v-if="subscribeMessage" :class="[
                                'mt-3 text-sm',
                                form.errors.email ? 'text-red-400' : 'text-green-400'
                            ]">{{ subscribeMessage }}</p>
                        </div>
                    </div>

                    <!-- Right: Quick Links & Contact -->
                    <div class="grid md:grid-cols-2 gap-12">
                        <!-- Quick Links -->
                        <div>
                            <h4 class="text-white font-bold text-lg mb-6 flex items-center gap-2">
                                <span class="w-1 h-6 bg-gradient-to-b from-orange-500 to-red-500 rounded"></span>
                                Quick Links
                            </h4>
                            <ul class="space-y-4">
                                <li v-for="link in quickLinks" :key="link.name">
                                    <a
                                        :href="link.url"
                                        class="text-slate-400 hover:text-orange-500 transition-colors duration-300 flex items-center gap-2 group"
                                    >
                                        <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                        {{ link.name }}
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- Contact Info -->
                        <div>
                            <h4 class="text-white font-bold text-lg mb-6 flex items-center gap-2">
                                <span class="w-1 h-6 bg-gradient-to-b from-orange-500 to-red-500 rounded"></span>
                                Contact Us
                            </h4>
                            <ul class="space-y-6">
                                <li v-if="footerData.address" class="flex items-start gap-4 group">
                                    <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center flex-shrink-0 group-hover:bg-orange-500/20 transition-colors duration-300">
                                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-slate-400 leading-relaxed whitespace-pre-line">{{ footerData.address }}</p>
                                    </div>
                                </li>
                                <li v-if="footerData.phone" class="flex items-start gap-4 group">
                                    <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center flex-shrink-0 group-hover:bg-orange-500/20 transition-colors duration-300">
                                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <a :href="'tel:' + footerData.phone.replace(/\s/g, '')" class="text-slate-400 hover:text-orange-500 transition-colors duration-300">
                                            {{ footerData.phone }}
                                        </a>
                                    </div>
                                </li>
                                <li v-if="footerData.email" class="flex items-start gap-4 group">
                                    <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center flex-shrink-0 group-hover:bg-orange-500/20 transition-colors duration-300">
                                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <a :href="'mailto:' + footerData.email" class="text-slate-400 hover:text-orange-500 transition-colors duration-300">
                                            {{ footerData.email }}
                                        </a>
                                    </div>
                                </li>
                            </ul>

                            <!-- Social Links -->
                            <div class="mt-8">
                                <div class="flex items-center gap-3">
                                    <!-- LinkedIn -->
                                    <a
                                        v-if="getSocialUrl('linkedin')"
                                        :href="getSocialUrl('linkedin')"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        aria-label="LinkedIn"
                                        class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center text-slate-400 hover:bg-gradient-to-r hover:from-orange-500 hover:to-red-500 hover:text-white transition-all duration-300 hover:scale-110"
                                    >
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                        </svg>
                                    </a>
                                    <!-- Twitter/X -->
                                    <a
                                        v-if="getSocialUrl('twitter')"
                                        :href="getSocialUrl('twitter')"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        aria-label="Twitter"
                                        class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center text-slate-400 hover:bg-gradient-to-r hover:from-orange-500 hover:to-red-500 hover:text-white transition-all duration-300 hover:scale-110"
                                    >
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                        </svg>
                                    </a>
                                    <!-- Facebook -->
                                    <a
                                        v-if="getSocialUrl('facebook')"
                                        :href="getSocialUrl('facebook')"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        aria-label="Facebook"
                                        class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center text-slate-400 hover:bg-gradient-to-r hover:from-orange-500 hover:to-red-500 hover:text-white transition-all duration-300 hover:scale-110"
                                    >
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                        </svg>
                                    </a>
                                    <!-- Instagram -->
                                    <a
                                        v-if="getSocialUrl('instagram')"
                                        :href="getSocialUrl('instagram')"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        aria-label="Instagram"
                                        class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center text-slate-400 hover:bg-gradient-to-r hover:from-orange-500 hover:to-red-500 hover:text-white transition-all duration-300 hover:scale-110"
                                    >
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Divider with Glass Effect -->
                <div class="relative mb-8">
                    <div class="h-px bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
                </div>

                <!-- Bottom Section: Copyright -->
                <div class="text-center">
                    <p class="text-slate-500 text-sm">
                        Copyright © {{ currentYear }}
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500 font-semibold">
                            {{ footerData.copyright_text || 'NuclearEdge' }}
                        </span>
                        . All Rights Reserved.
                    </p>
                    <p class="text-slate-600 text-xs mt-2">
                        {{ footerData.copyright_tagline || 'Built with nuclear precision and innovative excellence' }}
                    </p>
                </div>
            </div>
        </div>
    </footer>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';

const page = usePage();
const subscribeMessage = ref('');

const form = useForm({
    email: '',
});

// Get footer data from shared props
const footerData = computed(() => page.props.footer || {});

// Get quick links - use dynamic data or fallback to defaults
const quickLinks = computed(() => {
    if (footerData.value.quick_links && footerData.value.quick_links.length > 0) {
        return footerData.value.quick_links;
    }
    // Fallback default links
    return [
        { name: 'Home', url: '/' },
        { name: 'About Us', url: '/about' },
        { name: 'Blog', url: '/blog' },
        { name: 'Success Stories', url: '/success-stories' },
        { name: 'Contact', url: '/contact' },
    ];
});

// Get social URL by platform
const getSocialUrl = (platform) => {
    if (!footerData.value.social_links) return null;
    const social = footerData.value.social_links.find(s => s.platform === platform);
    return social?.url || null;
};

// Current year for copyright
const currentYear = new Date().getFullYear();

const subscribeNewsletter = () => {
    if (form.email) {
        form.post('/newsletter/subscribe', {
            preserveScroll: true,
            onSuccess: () => {
                subscribeMessage.value = 'Thank you for subscribing!';
                form.reset();
                setTimeout(() => {
                    subscribeMessage.value = '';
                }, 5000);
            },
            onError: () => {
                if (form.errors.email) {
                    subscribeMessage.value = form.errors.email;
                    setTimeout(() => {
                        subscribeMessage.value = '';
                        form.clearErrors();
                    }, 5000);
                }
            },
        });
    }
};
</script>

<style scoped>
/* Social icon components using inline SVG */
</style>
