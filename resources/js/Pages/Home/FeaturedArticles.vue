<template>
    <section class="py-20 bg-gradient-to-br from-slate-50 via-white to-slate-50 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 pointer-events-none opacity-[0.02]">
            <div class="absolute top-20 left-10 w-48 h-48">
                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="100" cy="100" r="80" stroke="#F97316" stroke-width="1" fill="none"/>
                    <circle cx="100" cy="100" r="60" stroke="#EF4444" stroke-width="1" fill="none"/>
                </svg>
            </div>
            <div class="absolute bottom-20 right-10 w-64 h-64">
                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <rect x="50" y="50" width="100" height="100" stroke="#F97316" stroke-width="1" fill="none" transform="rotate(45 100 100)"/>
                </svg>
            </div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <p class="text-orange-500 font-semibold text-sm uppercase tracking-wider mb-4">
                    From Our Blog
                </p>
                <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-6">
                    Featured
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500">
                        Articles
                    </span>
                </h2>
                <p class="text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed">
                    Explore our handpicked selection of trending articles and expert insights
                </p>
            </div>

            <!-- Blog Grid with Glass Effect -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
                <Link
                    v-for="blog in latestBlogs"
                    :key="blog.id"
                    :href="`/${blog.category.toLowerCase()}/${blog.slug}`"
                    class="group cursor-pointer"
                >
                    <!-- Glass Card Container -->
                    <div class="h-full bg-white/60 backdrop-blur-lg border border-white/20 rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl hover:shadow-orange-500/10 transition-all duration-500 hover:scale-[1.02] hover:bg-white/80">
                        <!-- Image -->
                        <div class="relative overflow-hidden aspect-[16/10]">
                            <img
                                :src="blog.image"
                                :alt="blog.title"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>

                            <!-- Category Badge with Glass Effect -->
                            <div class="absolute top-4 left-4">
                                <span class="px-4 py-2 bg-white/90 backdrop-blur-md rounded-full text-xs font-bold text-slate-900 border border-white/40 shadow-lg">
                                    {{ blog.category }}
                                </span>
                            </div>

                            <!-- Reading Time with Glass Effect -->
                            <div class="absolute bottom-4 right-4 flex items-center gap-2 px-3 py-2 bg-black/40 backdrop-blur-md rounded-full text-white text-sm border border-white/20">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ blog.readTime }}
                            </div>
                        </div>

                        <!-- Content with Glass Effect -->
                        <div class="p-6">
                            <!-- Date & Author -->
                            <div class="flex items-center gap-4 mb-4 text-sm text-slate-500">
                                <span>{{ blog.date }}</span>
                                <span>•</span>
                                <span>{{ blog.author }}</span>
                            </div>

                            <!-- Title -->
                            <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-orange-500 transition-colors duration-300 leading-tight line-clamp-2">
                                {{ blog.title }}
                            </h3>

                            <!-- Excerpt -->
                            <p class="text-slate-600 leading-relaxed mb-6 line-clamp-3">
                                {{ blog.excerpt }}
                            </p>

                            <!-- Read More Button with Glass Effect -->
                            <div class="flex items-center gap-2 text-orange-500 font-semibold group-hover:gap-4 transition-all duration-300">
                                <span>Read Article</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </Link>
            </div>

            <!-- View All Button -->
            <div class="text-center mt-16">
                <Link
                    href="/blog"
                    class="group inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold rounded-full shadow-lg shadow-orange-500/30 hover:shadow-xl hover:shadow-orange-500/50 transition-all duration-300 hover:scale-105"
                >
                    <span>View All Articles</span>
                    <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </Link>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

// Latest 6 blog posts (same data from Blog/Index.vue)
const latestBlogs = ref([
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
    }
]);
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
