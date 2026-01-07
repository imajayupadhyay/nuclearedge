<template>
    <div class="min-h-screen bg-white">
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
                        Insights & Innovation
                    </p>
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6">
                        Nuclear Edge
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500 mt-2">
                            Blog
                        </span>
                    </h1>
                    <p class="text-xl text-slate-300 leading-relaxed">
                        Explore our latest insights on technology, business transformation, and industry trends
                    </p>
                </div>
            </div>
        </section>

        <!-- Filter Section -->
        <section class="py-12 border-b border-slate-200 sticky top-20 bg-white/80 backdrop-blur-lg z-40">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                    <!-- Categories Filter -->
                    <div class="flex flex-wrap items-center gap-3">
                        <button
                            v-for="category in categories"
                            :key="category.slug"
                            @click="selectedCategory = category.slug"
                            :class="[
                                'px-6 py-3 rounded-full font-semibold text-sm transition-all duration-300',
                                selectedCategory === category.slug
                                    ? 'bg-gradient-to-r from-orange-500 to-red-500 text-white shadow-lg shadow-orange-500/30'
                                    : 'bg-slate-100 text-slate-700 hover:bg-slate-200'
                            ]"
                        >
                            {{ category.name }}
                        </button>
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
                </div>
            </div>
        </section>

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
                        <span class="font-bold text-slate-900">{{ filteredBlogs.length }}</span> articles found
                    </p>
                </div>

                <!-- Blog Grid -->
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <Link
                        v-for="blog in filteredBlogs"
                        :key="blog.id"
                        :href="`/${blog.category.toLowerCase()}/${blog.slug}`"
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

                <!-- Load More -->
                <div v-if="filteredBlogs.length > 0 && filteredBlogs.length >= 9" class="text-center mt-16">
                    <button class="px-10 py-4 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold rounded-full hover:shadow-lg hover:shadow-orange-500/40 transition-all duration-300 hover:scale-105">
                        Load More Articles
                    </button>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <Footer />
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import Header from '../../Components/Header.vue';
import Footer from '../../Components/Footer.vue';

const searchQuery = ref('');
const selectedCategory = ref('all');

const categories = ref([
    { name: 'All', slug: 'all' },
    { name: 'Technology', slug: 'technology' },
    { name: 'Business', slug: 'business' },
    { name: 'Innovation', slug: 'innovation' },
    { name: 'Industry Insights', slug: 'insights' },
]);

const blogs = ref([
    {
        id: 1,
        title: 'The Future of AI in Business: Transforming Operations and Decision-Making',
        slug: 'the-future-of-ai-in-business',
        excerpt: 'Explore how artificial intelligence is revolutionizing business operations, from automation to predictive analytics, and what it means for the future.',
        category: 'Technology',
        date: 'Jan 5, 2026',
        author: 'Rajesh Goel',
        readTime: '8 min read',
        image: 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=800&q=80'
    },
    {
        id: 2,
        title: 'Digital Transformation: A Complete Guide for Traditional Industries',
        slug: 'digital-transformation',
        excerpt: 'Learn how legacy businesses can successfully navigate digital transformation, overcome challenges, and emerge stronger in the digital age.',
        category: 'Business',
        date: 'Jan 3, 2026',
        author: 'Priya Sharma',
        readTime: '12 min read',
        image: 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=800&q=80'
    },
    {
        id: 3,
        title: 'Building Scalable Web Applications: Best Practices for 2026',
        slug: 'building-scalable-web-applications',
        excerpt: 'Discover the latest architectural patterns, tools, and methodologies for building web applications that scale effortlessly.',
        category: 'Technology',
        date: 'Dec 28, 2025',
        author: 'Amit Kumar',
        readTime: '10 min read',
        image: 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800&q=80'
    },
    {
        id: 4,
        title: 'The Rise of EdTech: How Technology is Revolutionizing Education',
        slug: 'the-rise-of-edtech',
        excerpt: 'An in-depth look at how educational technology is transforming learning experiences and making quality education accessible to all.',
        category: 'Innovation',
        date: 'Dec 25, 2025',
        author: 'Dr. Meera Singh',
        readTime: '9 min read',
        image: 'https://images.unsplash.com/photo-1501504905252-473c47e087f8?w=800&q=80'
    },
    {
        id: 5,
        title: 'Sustainable Business Practices: The New Competitive Advantage',
        slug: 'sustainable-business-practices',
        excerpt: 'Why sustainability is no longer optional for businesses and how implementing green practices can drive growth and profitability.',
        category: 'Business',
        date: 'Dec 20, 2025',
        author: 'Vikram Reddy',
        readTime: '7 min read',
        image: 'https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?w=800&q=80'
    },
    {
        id: 6,
        title: 'Cloud Computing vs Edge Computing: Choosing the Right Architecture',
        slug: 'cloud-computing-vs-edge-computing',
        excerpt: 'A comprehensive comparison of cloud and edge computing paradigms to help you make informed infrastructure decisions.',
        category: 'Technology',
        date: 'Dec 18, 2025',
        author: 'Sanjay Patel',
        readTime: '11 min read',
        image: 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?w=800&q=80'
    },
    {
        id: 7,
        title: 'Customer Experience in the Digital Age: Strategies That Work',
        slug: 'customer-experience-in-the-digital-age',
        excerpt: 'Learn proven strategies for delivering exceptional customer experiences across digital channels and building lasting relationships.',
        category: 'Business',
        date: 'Dec 15, 2025',
        author: 'Neha Kapoor',
        readTime: '8 min read',
        image: 'https://images.unsplash.com/photo-1556761175-4b46a572b786?w=800&q=80'
    },
    {
        id: 8,
        title: 'Cybersecurity Essentials: Protecting Your Business in 2026',
        slug: 'cybersecurity-essentials',
        excerpt: 'Essential cybersecurity practices every business needs to implement to protect against evolving threats and data breaches.',
        category: 'Technology',
        date: 'Dec 12, 2025',
        author: 'Arjun Malhotra',
        readTime: '10 min read',
        image: 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=800&q=80'
    },
    {
        id: 9,
        title: 'The Power of Data Analytics: Turning Information into Insights',
        slug: 'the-power-of-data-analytics',
        excerpt: 'How businesses are leveraging data analytics to make smarter decisions, optimize operations, and gain competitive advantages.',
        category: 'Insights',
        date: 'Dec 10, 2025',
        author: 'Kavita Desai',
        readTime: '9 min read',
        image: 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&q=80'
    },
    {
        id: 10,
        title: 'Agile Methodology: Beyond Software Development',
        slug: 'agile-methodology-beyond-software-development',
        excerpt: 'Discover how agile principles are being applied across various business functions to improve efficiency and adaptability.',
        category: 'Innovation',
        date: 'Dec 8, 2025',
        author: 'Rohit Verma',
        readTime: '7 min read',
        image: 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&q=80'
    },
    {
        id: 11,
        title: 'E-commerce Trends: What\'s Shaping Online Retail in 2026',
        slug: 'e-commerce-trends',
        excerpt: 'Stay ahead of the curve with insights into the latest e-commerce trends, from social commerce to AR shopping experiences.',
        category: 'Business',
        date: 'Dec 5, 2025',
        author: 'Anjali Gupta',
        readTime: '8 min read',
        image: 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&q=80'
    },
    {
        id: 12,
        title: 'IoT in Manufacturing: The Industrial Revolution 4.0',
        slug: 'iot-in-manufacturing',
        excerpt: 'How the Internet of Things is transforming manufacturing processes, enabling predictive maintenance, and optimizing supply chains.',
        category: 'Insights',
        date: 'Dec 1, 2025',
        author: 'Suresh Kumar',
        readTime: '11 min read',
        image: 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=800&q=80'
    },
]);

const filteredBlogs = computed(() => {
    let filtered = blogs.value;

    // Filter by category
    if (selectedCategory.value !== 'all') {
        filtered = filtered.filter(blog =>
            blog.category.toLowerCase() === selectedCategory.value.toLowerCase()
        );
    }

    // Filter by search query
    if (searchQuery.value) {
        const query = searchQuery.value.toLowerCase();
        filtered = filtered.filter(blog =>
            blog.title.toLowerCase().includes(query) ||
            blog.excerpt.toLowerCase().includes(query) ||
            blog.category.toLowerCase().includes(query)
        );
    }

    return filtered;
});
</script>
