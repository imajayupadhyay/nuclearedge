<template>
    <section class="py-20 bg-white overflow-hidden">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-slate-900 mb-4">
                    Latest News &
                    <span class="bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent">
                        Insights
                    </span>
                </h2>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                    Stay updated with our latest articles, insights, and industry news
                </p>
            </div>

            <!-- Carousel Container -->
            <div class="relative">
                <!-- Cards Wrapper -->
                <div class="overflow-hidden" ref="carouselContainer">
                    <div
                        class="flex transition-transform duration-500 ease-out gap-6"
                        :style="{ transform: `translateX(-${currentIndex * (100 / visibleCards)}%)` }"
                    >
                        <!-- Blog Card -->
                        <div
                            v-for="(post, index) in blogPosts"
                            :key="index"
                            :class="[
                                'flex-shrink-0 rounded-2xl overflow-hidden group cursor-pointer transform transition-all duration-300 hover:scale-105 hover:shadow-2xl',
                                cardWidthClass
                            ]"
                            @click="readMore(post)"
                        >
                            <!-- Card Content -->
                            <div :class="['h-full p-8 relative', post.gradient]">
                                <!-- Decorative Pattern Overlay -->
                                <div class="absolute inset-0 opacity-10">
                                    <svg class="w-full h-full" viewBox="0 0 400 400" xmlns="http://www.w3.org/2000/svg">
                                        <defs>
                                            <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                                                <circle cx="20" cy="20" r="1" fill="white"/>
                                            </pattern>
                                        </defs>
                                        <rect width="400" height="400" fill="url(#grid)"/>
                                    </svg>
                                </div>

                                <!-- Content -->
                                <div class="relative z-10 flex flex-col h-full min-h-[320px]">
                                    <!-- Date and Category -->
                                    <div class="flex items-center gap-2 mb-4">
                                        <span class="text-white/90 text-sm font-medium">
                                            {{ post.date }}
                                        </span>
                                        <span class="text-white/70">•</span>
                                        <span class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-xs font-semibold text-white">
                                            {{ post.category }}
                                        </span>
                                    </div>

                                    <!-- Title -->
                                    <h3 class="text-2xl md:text-3xl font-bold text-white mb-6 leading-tight flex-grow">
                                        {{ post.title }}
                                    </h3>

                                    <!-- Author (if exists) -->
                                    <div v-if="post.author" class="flex items-center gap-3 mb-6">
                                        <div class="w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white font-semibold text-lg">
                                            {{ post.author.initials }}
                                        </div>
                                        <div>
                                            <p class="text-white font-medium text-sm">{{ post.author.name }}</p>
                                            <p class="text-white/70 text-xs">{{ post.author.role }}</p>
                                        </div>
                                    </div>

                                    <!-- Read More Button -->
                                    <button class="inline-flex items-center gap-2 px-6 py-3 bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-full text-white font-semibold transition-all duration-300 group-hover:gap-4 w-fit">
                                        <span>Read more</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Controls -->
                <div class="flex items-center justify-center gap-4 mt-12">
                    <!-- Previous Button -->
                    <button
                        @click="prevSlide"
                        :disabled="currentIndex === 0"
                        :class="[
                            'w-14 h-14 rounded-full border-2 flex items-center justify-center transition-all duration-300',
                            currentIndex === 0
                                ? 'border-slate-300 text-slate-300 cursor-not-allowed'
                                : 'border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white hover:shadow-lg hover:shadow-orange-500/30'
                        ]"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>

                    <!-- Next Button -->
                    <button
                        @click="nextSlide"
                        :disabled="currentIndex >= maxIndex"
                        :class="[
                            'w-14 h-14 rounded-full flex items-center justify-center transition-all duration-300',
                            currentIndex >= maxIndex
                                ? 'bg-slate-300 text-white cursor-not-allowed'
                                : 'bg-gradient-to-r from-orange-500 to-red-500 text-white hover:shadow-lg hover:shadow-orange-500/40 hover:scale-110'
                        ]"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>

                    <!-- View All Button -->
                    <button class="px-8 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold rounded-full hover:shadow-lg hover:shadow-orange-500/40 transition-all duration-300 hover:scale-105 ml-4">
                        View all
                    </button>
                </div>

                <!-- Progress Indicator -->
                <div class="flex justify-center gap-2 mt-6">
                    <div
                        v-for="i in totalDots"
                        :key="i"
                        :class="[
                            'h-2 rounded-full transition-all duration-300',
                            i - 1 === currentIndex
                                ? 'w-8 bg-gradient-to-r from-orange-500 to-red-500'
                                : 'w-2 bg-slate-300'
                        ]"
                    ></div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';

const currentIndex = ref(0);
const carouselContainer = ref(null);
const windowWidth = ref(typeof window !== 'undefined' ? window.innerWidth : 1024);

// Dummy blog posts data
const blogPosts = ref([
    {
        date: '5 Jan 2026',
        category: 'Industry Insights',
        title: 'The Future of Nuclear Energy: Innovations Shaping Tomorrow',
        gradient: 'bg-gradient-to-br from-orange-500 via-red-500 to-pink-600',
        author: {
            name: 'Rajesh Goel',
            role: 'Chief Technology Officer',
            initials: 'RG'
        }
    },
    {
        date: '3 Jan 2026',
        category: 'Press Release',
        title: 'Nuclear Edge Expands Operations to Three New Markets',
        gradient: 'bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700',
    },
    {
        date: '28 Dec 2025',
        category: 'Business Strategy',
        title: 'How Digital Transformation is Revolutionizing Traditional Industries',
        gradient: 'bg-gradient-to-br from-violet-600 via-purple-600 to-fuchsia-700',
        author: {
            name: 'Priya Sharma',
            role: 'Head of Strategy',
            initials: 'PS'
        }
    },
    {
        date: '20 Dec 2025',
        category: 'Technology',
        title: 'AI and Machine Learning: The Nuclear Approach to Innovation',
        gradient: 'bg-gradient-to-br from-emerald-500 via-teal-600 to-cyan-700',
    },
    {
        date: '15 Dec 2025',
        category: 'Insights',
        title: 'Sustainable Growth: Our Commitment to Environmental Excellence',
        gradient: 'bg-gradient-to-br from-amber-500 via-orange-600 to-red-700',
        author: {
            name: 'Amit Kumar',
            role: 'Sustainability Lead',
            initials: 'AK'
        }
    },
]);

// Responsive cards visibility
const visibleCards = computed(() => {
    if (windowWidth.value >= 1024) return 3; // Desktop: 3 cards
    if (windowWidth.value >= 768) return 2;  // Tablet: 2 cards
    return 1; // Mobile: 1 card
});

const cardWidthClass = computed(() => {
    if (windowWidth.value >= 1024) return 'w-1/3';
    if (windowWidth.value >= 768) return 'w-1/2';
    return 'w-full';
});

const maxIndex = computed(() => {
    return Math.max(0, blogPosts.value.length - visibleCards.value);
});

const totalDots = computed(() => {
    return maxIndex.value + 1;
});

const nextSlide = () => {
    if (currentIndex.value < maxIndex.value) {
        currentIndex.value++;
    }
};

const prevSlide = () => {
    if (currentIndex.value > 0) {
        currentIndex.value--;
    }
};

const readMore = (post) => {
    console.log('Read more:', post.title);
    // Navigate to blog post
};

// Handle window resize
const handleResize = () => {
    windowWidth.value = window.innerWidth;
    // Reset to first slide if current index is out of bounds
    if (currentIndex.value > maxIndex.value) {
        currentIndex.value = maxIndex.value;
    }
};

onMounted(() => {
    window.addEventListener('resize', handleResize);
});

onUnmounted(() => {
    window.removeEventListener('resize', handleResize);
});
</script>
