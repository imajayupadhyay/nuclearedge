<template>
    <section class="py-24 bg-white">
        <div class="container mx-auto px-4">
            <!-- Tabs Navigation -->
            <div class="flex justify-center mb-12">
                <div class="inline-flex flex-wrap justify-center gap-8 border-b-2 border-slate-200">
                    <button
                        v-for="(tab, index) in tabs"
                        :key="index"
                        @click="activeTab = index"
                        :class="[
                            'relative pb-4 px-2 text-lg font-semibold transition-all duration-300',
                            activeTab === index
                                ? 'text-slate-900'
                                : 'text-slate-500 hover:text-slate-700'
                        ]"
                    >
                        {{ tab.name }}
                        <!-- Active Tab Indicator -->
                        <span
                            :class="[
                                'absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-orange-500 to-red-500 transition-all duration-300',
                                activeTab === index ? 'opacity-100 scale-x-100' : 'opacity-0 scale-x-0'
                            ]"
                        ></span>
                    </button>
                </div>
            </div>

            <!-- Tab Content -->
            <div class="max-w-7xl mx-auto">
                <transition name="fade" mode="out-in">
                    <div :key="activeTab" class="rounded-3xl overflow-hidden shadow-2xl">
                        <!-- Large Card with Image and Overlay -->
                        <div class="relative h-[500px] md:h-[600px] overflow-hidden group">
                            <!-- Background Image -->
                            <img
                                :src="tabs[activeTab].image"
                                :alt="tabs[activeTab].name"
                                class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                            />

                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-transparent"></div>

                            <!-- Content Overlay -->
                            <div class="absolute inset-0 flex items-center">
                                <div class="container mx-auto px-8 md:px-16">
                                    <div class="max-w-2xl">
                                        <!-- Label -->
                                        <p class="text-orange-500 font-bold text-sm uppercase tracking-wider mb-4">
                                            {{ tabs[activeTab].label }}
                                        </p>

                                        <!-- Title -->
                                        <h3 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                                            {{ tabs[activeTab].title }}
                                        </h3>

                                        <!-- Description -->
                                        <p class="text-xl text-white/90 mb-8 leading-relaxed">
                                            {{ tabs[activeTab].description }}
                                        </p>

                                        <!-- CTA Button -->
                                        <Link
                                            :href="tabs[activeTab].link"
                                            class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold rounded-full shadow-lg shadow-orange-500/30 hover:shadow-xl hover:shadow-orange-500/50 transition-all duration-300 hover:scale-105"
                                        >
                                            <span>{{ tabs[activeTab].buttonText }}</span>
                                            <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                            </svg>
                                        </Link>
                                    </div>
                                </div>
                            </div>

                            <!-- Decorative Pattern Overlay (subtle) -->
                            <div class="absolute inset-0 opacity-5 pointer-events-none">
                                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <pattern id="tab-grid" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                                            <circle cx="2" cy="2" r="1.5" fill="white"/>
                                        </pattern>
                                    </defs>
                                    <rect width="100%" height="100%" fill="url(#tab-grid)"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const activeTab = ref(0);

const tabs = ref([
    {
        name: 'Our Solutions',
        label: 'COMPREHENSIVE SERVICES',
        title: 'End-to-end business transformation',
        description: 'We deliver comprehensive solutions that transform businesses from strategy to execution, leveraging cutting-edge technology and proven methodologies.',
        image: 'https://images.unsplash.com/photo-1553877522-43269d4ea984?w=1600&q=80',
        link: '/about',
        buttonText: 'Explore Our Services'
    },
    {
        name: 'Our Approach',
        label: 'STRATEGIC METHODOLOGY',
        title: 'Innovation meets execution',
        description: 'Our proven approach combines strategic thinking with hands-on implementation, ensuring your business transformation delivers measurable results.',
        image: 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=1600&q=80',
        link: '/about',
        buttonText: 'Learn Our Process'
    },
    {
        name: 'Industry Expertise',
        label: 'DOMAIN KNOWLEDGE',
        title: 'Deep expertise across industries',
        description: 'With 35+ years of experience, we bring deep industry knowledge in FMCG, EdTech, Manufacturing, and Corporate Services to drive your success.',
        image: 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1600&q=80',
        link: '/about',
        buttonText: 'See Our Impact'
    },
    {
        name: 'Technology & Innovation',
        label: 'CUTTING-EDGE SOLUTIONS',
        title: 'Powered by advanced technology',
        description: 'We harness the latest in AI, cloud computing, and digital platforms to create solutions that give you a competitive advantage.',
        image: 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=1600&q=80',
        link: '/about',
        buttonText: 'Discover Technologies'
    }
]);
</script>

<style scoped>
/* Fade transition for tab content */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
