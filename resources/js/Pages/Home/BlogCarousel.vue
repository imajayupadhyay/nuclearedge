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
                        <!-- Blog Card with Glass Effect -->
                        <Link
                            v-for="post in blogPosts"
                            :key="post.id"
                            :href="`/${post.category.toLowerCase()}/${post.slug}`"
                            :class="[
                                'flex-shrink-0 rounded-3xl overflow-hidden group cursor-pointer transform transition-all duration-300 hover:scale-105 hover:shadow-2xl',
                                cardWidthClass
                            ]"
                        >
                            <!-- Card Content with Glass Effect -->
                            <div class="h-full relative">
                                <!-- Background Image -->
                                <img
                                    :src="post.image"
                                    :alt="post.title"
                                    class="absolute inset-0 w-full h-full object-cover"
                                />
                                <!-- Glass Overlay -->
                                <div :class="['absolute inset-0 backdrop-blur-sm', post.gradient, 'opacity-90']"></div>

                                <!-- Content Container -->
                                <div class="h-full p-8 relative z-10">
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
                                    <!-- Date and Category with Glass Effect -->
                                    <div class="flex items-center gap-2 mb-4">
                                        <span class="text-white/90 text-sm font-medium">
                                            {{ post.date }}
                                        </span>
                                        <span class="text-white/70">•</span>
                                        <span class="px-3 py-1 bg-white/30 backdrop-blur-md rounded-full text-xs font-semibold text-white border border-white/40">
                                            {{ post.category }}
                                        </span>
                                    </div>

                                    <!-- Title -->
                                    <h3 class="text-2xl md:text-3xl font-bold text-white mb-4 leading-tight flex-grow line-clamp-3">
                                        {{ post.title }}
                                    </h3>

                                    <!-- Excerpt with Glass Effect -->
                                    <p class="text-white/80 mb-6 text-sm leading-relaxed line-clamp-2">
                                        {{ post.excerpt }}
                                    </p>

                                    <!-- Author with Glass Effect -->
                                    <div class="flex items-center gap-3 mb-6">
                                        <div class="w-12 h-12 rounded-full bg-white/30 backdrop-blur-md flex items-center justify-center text-white font-semibold text-lg border border-white/40">
                                            {{ post.author.charAt(0) }}
                                        </div>
                                        <div>
                                            <p class="text-white font-medium text-sm">{{ post.author }}</p>
                                            <p class="text-white/70 text-xs">{{ post.readTime }}</p>
                                        </div>
                                    </div>

                                    <!-- Read More Button with Enhanced Glass Effect -->
                                    <div class="inline-flex items-center gap-2 px-6 py-3 bg-white/30 hover:bg-white/40 backdrop-blur-md rounded-full text-white font-semibold transition-all duration-300 group-hover:gap-4 w-fit border border-white/40">
                                        <span>Read more</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </Link>
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
                    <Link
                        href="/blog"
                        class="px-8 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold rounded-full hover:shadow-lg hover:shadow-orange-500/40 transition-all duration-300 hover:scale-105 ml-4"
                    >
                        View all
                    </Link>
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
import { Link } from '@inertiajs/vue3';

const currentIndex = ref(0);
const carouselContainer = ref(null);
const windowWidth = ref(typeof window !== 'undefined' ? window.innerWidth : 1024);

// Real blog posts data from our blog
const blogPosts = ref([
    {
        id: 1,
        title: 'The Future of AI in Business: Transforming Operations and Decision-Making',
        slug: 'the-future-of-ai-in-business',
        excerpt: 'Explore how artificial intelligence is revolutionizing business operations',
        category: 'Technology',
        date: 'Jan 5, 2026',
        author: 'Rajesh Goel',
        readTime: '8 min read',
        image: 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=800&q=80',
        gradient: 'bg-gradient-to-br from-orange-500 via-red-500 to-pink-600'
    },
    {
        id: 2,
        title: 'Digital Transformation: A Complete Guide for Traditional Industries',
        slug: 'digital-transformation',
        excerpt: 'Learn how legacy businesses can successfully navigate digital transformation',
        category: 'Business',
        date: 'Jan 3, 2026',
        author: 'Priya Sharma',
        readTime: '12 min read',
        image: 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=800&q=80',
        gradient: 'bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700'
    },
    {
        id: 3,
        title: 'Building Scalable Web Applications: Best Practices for 2026',
        slug: 'building-scalable-web-applications',
        excerpt: 'Discover the latest architectural patterns, tools, and methodologies',
        category: 'Technology',
        date: 'Dec 28, 2025',
        author: 'Amit Kumar',
        readTime: '10 min read',
        image: 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800&q=80',
        gradient: 'bg-gradient-to-br from-violet-600 via-purple-600 to-fuchsia-700'
    },
    {
        id: 4,
        title: 'The Rise of EdTech: How Technology is Revolutionizing Education',
        slug: 'the-rise-of-edtech',
        excerpt: 'An in-depth look at how educational technology is transforming learning',
        category: 'Innovation',
        date: 'Dec 25, 2025',
        author: 'Dr. Meera Singh',
        readTime: '9 min read',
        image: 'https://images.unsplash.com/photo-1501504905252-473c47e087f8?w=800&q=80',
        gradient: 'bg-gradient-to-br from-emerald-500 via-teal-600 to-cyan-700'
    },
    {
        id: 5,
        title: 'Sustainable Business Practices: The New Competitive Advantage',
        slug: 'sustainable-business-practices',
        excerpt: 'Why sustainability is no longer optional for businesses',
        category: 'Business',
        date: 'Dec 20, 2025',
        author: 'Vikram Reddy',
        readTime: '7 min read',
        image: 'https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?w=800&q=80',
        gradient: 'bg-gradient-to-br from-amber-500 via-orange-600 to-red-700'
    }
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

<style scoped>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
