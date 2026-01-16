<template>
    <div class="min-h-screen bg-white">
        <Head>
            <title>Blog - Nuclear Edge | Insights on Technology & Business Transformation</title>
            <meta name="description" content="Explore Nuclear Edge's latest insights on technology, business transformation, and industry trends. Expert articles on AI, digital transformation, scalable applications, and more." />
            <meta name="keywords" content="technology blog, business transformation articles, digital transformation insights, AI in business, Nuclear Edge blog, tech trends 2026, innovation articles, business strategy blog" />
            <meta name="author" content="Nuclear Edge" />
            <meta name="robots" content="index, follow" />
            <link rel="canonical" href="https://nuclearedge.com/blog" />

            <!-- Open Graph / Facebook -->
            <meta property="og:type" content="website" />
            <meta property="og:url" content="https://nuclearedge.com/blog" />
            <meta property="og:title" content="Blog - Nuclear Edge | Technology & Business Insights" />
            <meta property="og:description" content="Explore Nuclear Edge's latest insights on technology, business transformation, and industry trends. Expert articles on AI, digital transformation, and more." />
            <meta property="og:image" content="https://nuclearedge.com/images/blog-og-image.jpg" />
            <meta property="og:site_name" content="Nuclear Edge" />

            <!-- Twitter -->
            <meta name="twitter:card" content="summary_large_image" />
            <meta name="twitter:url" content="https://nuclearedge.com/blog" />
            <meta name="twitter:title" content="Blog - Nuclear Edge | Technology & Business Insights" />
            <meta name="twitter:description" content="Expert articles on AI, digital transformation, business strategy, and technology trends." />
            <meta name="twitter:image" content="https://nuclearedge.com/images/blog-og-image.jpg" />

            <!-- Additional SEO -->
            <meta name="theme-color" content="#F97316" />
        </Head>

        <!-- Header -->
        <Header :isTransparent="false" logoUrl="/images/nuclear-edge-logo.webp" />

        <!-- Hero Section -->
        <section class="pt-32 pb-20 bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-5">
                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="blog-grid" x="0" y="0" width="50" height="50" patternUnits="userSpaceOnUse">
                            <circle cx="2" cy="2" r="1.5" fill="#F97316"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#blog-grid)"/>
                </svg>
            </div>

            <div class="container mx-auto px-4 relative z-10">
                <div class="max-w-4xl mx-auto text-center">
                    <p class="text-orange-500 font-semibold text-sm uppercase tracking-wider mb-4">
                        {{ heroLabel }}
                    </p>
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6">
                        {{ heroHeadlineLine1 }}
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500 mt-2">
                            {{ heroHeadlineLine2 }}
                        </span>
                    </h1>
                    <p class="text-xl text-slate-300 leading-relaxed">
                        {{ heroParagraph }}
                    </p>
                </div>
            </div>
        </section>

        <!-- Floating Toggle Button -->
        <button
            @click="toggleFilters"
            class="fixed top-24 right-6 z-50 bg-gradient-to-r from-orange-500 to-red-500 text-white p-4 rounded-full shadow-2xl hover:shadow-orange-500/50 transition-all duration-300 hover:scale-110 group"
            :class="{ 'rotate-180': showFilters }"
        >
            <svg class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
            </svg>
            <span class="absolute -bottom-10 right-0 bg-slate-900 text-white text-xs px-3 py-1.5 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                {{ showFilters ? 'Hide Filters' : 'Show Filters' }}
            </span>
        </button>

        <!-- Filter Section with Shutter Animation -->
        <Transition
            enter-active-class="transition-all duration-500 ease-out"
            enter-from-class="opacity-0 -translate-y-full"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transition-all duration-500 ease-in"
            leave-from-class="opacity-100 translate-y-0"
            leave-to-class="opacity-0 -translate-y-full"
        >
            <section
                v-show="showFilters"
                class="py-8 border-b border-slate-200 sticky top-20 bg-white/95 backdrop-blur-xl z-40 shadow-lg"
            >
                <div class="container mx-auto px-4">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                        <!-- Categories Dropdown -->
                        <div class="relative w-full md:w-auto">
                            <select
                                v-model="selectedCategory"
                                class="w-full md:w-64 px-6 py-3 pl-12 pr-10 bg-slate-100 border border-slate-200 rounded-full text-slate-700 font-semibold text-sm outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition-all duration-300 appearance-none cursor-pointer"
                            >
                                <option
                                    v-for="category in allCategories"
                                    :key="category.slug"
                                    :value="category.name"
                                >
                                    {{ category.name }}
                                </option>
                            </select>
                            <svg class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            <svg class="w-4 h-4 text-slate-500 absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>

                        <!-- Search -->
                        <div class="relative w-full md:w-auto">
                            <input
                                v-model="searchQuery"
                                type="text"
                                placeholder="Search articles..."
                                class="w-full md:w-80 px-6 py-3 pl-12 bg-slate-100 border border-slate-200 rounded-full text-slate-700 placeholder:text-slate-500 outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition-all duration-300"
                            />
                            <svg class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>

                        <!-- Active Filters Indicator -->
                        <div v-if="(searchQuery || selectedCategory !== 'All')" class="flex items-center gap-2 text-sm">
                            <span class="px-4 py-2 bg-orange-100 text-orange-600 rounded-full font-semibold flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Filters Active
                            </span>
                            <button
                                @click="clearFilters"
                                class="px-4 py-2 bg-slate-100 text-slate-600 rounded-full font-semibold hover:bg-slate-200 transition-colors duration-300"
                            >
                                Clear All
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </Transition>

        <!-- Blog Grid -->
        <section class="py-20 relative overflow-hidden">
            <!-- Background SVG -->
            <div class="absolute inset-0 pointer-events-none opacity-[0.02]">
                <div class="absolute top-20 right-10 w-64 h-64">
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="100" cy="100" r="80" stroke="#F97316" stroke-width="1" fill="none"/>
                        <circle cx="100" cy="100" r="60" stroke="#EF4444" stroke-width="1" fill="none"/>
                    </svg>
                </div>
            </div>

            <div class="container mx-auto px-4 relative z-10">
                <!-- Results Count -->
                <div class="mb-8">
                    <p class="text-slate-600">
                        <span class="font-bold text-slate-900">{{ blogs.total || filteredBlogs.length }}</span> articles found
                    </p>
                </div>

                <!-- Blog Grid -->
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <Link
                        v-for="blog in filteredBlogs"
                        :key="blog.id"
                        :href="`/${blog.categorySlug}/${blog.slug}`"
                        class="group cursor-pointer block"
                    >
                        <!-- Image -->
                        <div class="relative overflow-hidden rounded-3xl mb-6 aspect-[16/10]">
                            <img
                                :src="blog.image"
                                :alt="blog.title"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>

                            <!-- Category Badge -->
                            <div class="absolute top-4 left-4">
                                <span class="px-4 py-2 bg-white/90 backdrop-blur-sm rounded-full text-xs font-bold text-slate-900">
                                    {{ blog.category }}
                                </span>
                            </div>

                            <!-- Reading Time -->
                            <div class="absolute bottom-4 right-4 flex items-center gap-2 text-white text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ blog.readTime }}
                            </div>
                        </div>

                        <!-- Content -->
                        <div>
                            <!-- Date & Author -->
                            <div class="flex items-center gap-4 mb-4 text-sm text-slate-500">
                                <span>{{ blog.date }}</span>
                                <span>•</span>
                                <span>{{ blog.author }}</span>
                            </div>

                            <!-- Title -->
                            <h3 class="text-2xl font-bold text-slate-900 mb-3 group-hover:text-orange-500 transition-colors duration-300 leading-tight">
                                {{ blog.title }}
                            </h3>

                            <!-- Excerpt -->
                            <p class="text-slate-600 leading-relaxed mb-6">
                                {{ blog.excerpt }}
                            </p>

                            <!-- Read More -->
                            <button class="inline-flex items-center gap-2 text-orange-500 font-semibold group-hover:gap-4 transition-all duration-300">
                                Read Article
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </button>
                        </div>
                    </Link>
                </div>

                <!-- Empty State -->
                <div v-if="filteredBlogs.length === 0" class="text-center py-20">
                    <svg class="w-24 h-24 mx-auto text-slate-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h3 class="text-2xl font-bold text-slate-900 mb-2">No articles found</h3>
                    <p class="text-slate-600">Try adjusting your filters or search query</p>
                </div>

                <!-- Pagination -->
                <div v-if="blogs.last_page > 1" class="flex justify-center items-center gap-2 mt-16">
                    <template v-for="(link, index) in blogs.links" :key="index">
                        <Link
                            v-if="link.url"
                            :href="link.url"
                            v-html="link.label"
                            :class="[
                                'px-4 py-2 rounded-lg font-semibold text-sm transition-all duration-300',
                                link.active
                                    ? 'bg-gradient-to-r from-orange-500 to-red-500 text-white shadow-lg'
                                    : 'bg-slate-100 text-slate-700 hover:bg-slate-200'
                            ]"
                            preserve-scroll
                        />
                        <span
                            v-else
                            v-html="link.label"
                            class="px-4 py-2 rounded-lg font-semibold text-sm bg-slate-50 text-slate-400 cursor-not-allowed"
                        />
                    </template>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <Footer />
    </div>
</template>

<script setup>
import { ref, computed, watch, onMounted, onUnmounted } from 'vue';
import { Link, Head, router } from '@inertiajs/vue3';
import Header from '../../Components/Header.vue';
import Footer from '../../Components/Footer.vue';

const props = defineProps({
    blogs: Object,
    categories: Array,
    filters: Object,
    pageData: Object,
});

// Computed properties for hero section with fallback defaults
const heroLabel = computed(() => props.pageData?.hero?.label || 'Insights & Innovation');
const heroHeadlineLine1 = computed(() => props.pageData?.hero?.headline_line1 || 'Nuclear Edge');
const heroHeadlineLine2 = computed(() => props.pageData?.hero?.headline_line2 || 'Blog');
const heroParagraph = computed(() => props.pageData?.hero?.paragraph || 'Explore our latest insights on technology, business transformation, and industry trends');

const searchQuery = ref(props.filters.search || '');
const selectedCategory = ref(props.filters.category || 'All');
const showFilters = ref(true);
const lastScrollY = ref(0);

// Prepend "All" to categories
const allCategories = computed(() => [
    { name: 'All', slug: 'all' },
    ...props.categories
]);

// Watch for filter changes and update URL
watch([searchQuery, selectedCategory], ([newSearch, newCategory]) => {
    const params = {};
    if (newSearch) params.search = newSearch;
    if (newCategory && newCategory !== 'All') params.category = newCategory;

    router.get('/blog', params, {
        preserveState: true,
        preserveScroll: true,
        replace: true,
    });
}, { debounce: 300 });

const filteredBlogs = computed(() => props.blogs.data);

// Toggle filters visibility
const toggleFilters = () => {
    showFilters.value = !showFilters.value;
};

// Clear all filters
const clearFilters = () => {
    searchQuery.value = '';
    selectedCategory.value = 'All';
};

// Handle scroll to auto-hide/show filters
const handleScroll = () => {
    const currentScrollY = window.scrollY;

    // Don't hide if at the top of the page
    if (currentScrollY < 100) {
        showFilters.value = true;
        lastScrollY.value = currentScrollY;
        return;
    }

    // Scrolling down - hide filters
    if (currentScrollY > lastScrollY.value && currentScrollY > 200) {
        showFilters.value = false;
    }
    // Scrolling up - show filters
    else if (currentScrollY < lastScrollY.value - 10) {
        showFilters.value = true;
    }

    lastScrollY.value = currentScrollY;
};

// Set up scroll listener
onMounted(() => {
    window.addEventListener('scroll', handleScroll, { passive: true });
});

// Clean up scroll listener
onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>
