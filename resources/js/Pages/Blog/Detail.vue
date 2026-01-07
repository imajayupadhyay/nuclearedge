<template>
    <div class="min-h-screen bg-white">
        <Head>
            <title>{{ blog.title }} - Nuclear Edge Blog</title>
            <meta name="description" :content="blog.excerpt" />
            <meta name="keywords" :content="`${blog.category}, ${blog.title}, Nuclear Edge, business insights, technology trends`" />
            <meta name="author" :content="blog.author" />
        </Head>

        <!-- Header -->
        <Header :isTransparent="false" logoUrl="/images/nuclear-edge-logo.webp" />

        <!-- Hero Section with Featured Image -->
        <section class="pt-32 pb-16 relative overflow-hidden min-h-[600px] md:min-h-[700px]">
            <!-- Featured Image Background -->
            <div class="absolute inset-0">
                <img
                    :src="blog.image"
                    :alt="blog.title"
                    class="w-full h-full object-cover"
                />
                <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/70 to-black/40"></div>
            </div>

            <!-- Content Container -->
            <div class="container mx-auto px-4 relative z-10">
                <div class="max-w-4xl mx-auto pt-12 md:pt-20">
                    <!-- Category Badge -->
                    <div class="mb-6">
                        <span class="px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white font-bold rounded-full text-sm uppercase tracking-wider shadow-lg shadow-orange-500/30">
                            {{ blog.category }}
                        </span>
                    </div>

                    <!-- Title -->
                    <h1 class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold text-white mb-6 leading-tight" style="text-shadow: 0 4px 20px rgba(0,0,0,0.8), 0 2px 8px rgba(0,0,0,0.9);">
                        {{ blog.title }}
                    </h1>

                    <!-- Meta Information -->
                    <div class="flex flex-wrap items-center gap-4 md:gap-6 text-white" style="text-shadow: 0 2px 10px rgba(0,0,0,0.8);">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span class="font-medium">{{ blog.author }}</span>
                        </div>
                        <span class="text-white/80">•</span>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>{{ blog.date }}</span>
                        </div>
                        <span class="text-white/80">•</span>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ blog.readTime }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Article Content -->
        <article class="py-16 relative">
            <!-- Background Pattern -->
            <div class="absolute inset-0 pointer-events-none opacity-[0.02]">
                <div class="absolute top-40 right-20 w-64 h-64">
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="100" cy="100" r="80" stroke="#F97316" stroke-width="1" fill="none"/>
                        <circle cx="100" cy="100" r="60" stroke="#EF4444" stroke-width="1" fill="none"/>
                    </svg>
                </div>
            </div>

            <div class="container mx-auto px-4 relative z-10">
                <div class="max-w-4xl mx-auto">
                    <!-- Article Body -->
                    <div class="prose prose-lg max-w-none">
                        <!-- Excerpt/Introduction -->
                        <div class="text-2xl font-light text-slate-700 leading-relaxed mb-12 pb-8 border-b-2 border-slate-200">
                            {{ blog.excerpt }}
                        </div>

                        <!-- Main Content -->
                        <div class="space-y-8 text-slate-600 leading-relaxed">
                            <p>
                                In today's rapidly evolving digital landscape, businesses are constantly seeking innovative solutions to stay ahead of the competition. This comprehensive exploration delves into the transformative impact of modern technology and how organizations can leverage these advancements to achieve unprecedented growth.
                            </p>

                            <h2 class="text-3xl font-bold text-slate-900 mt-12 mb-6">
                                Understanding the <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500">Fundamentals</span>
                            </h2>

                            <p>
                                The foundation of any successful digital transformation lies in understanding the core principles that drive innovation. Organizations must first assess their current technological infrastructure and identify areas where strategic improvements can yield the greatest returns. This process involves careful analysis of existing workflows, pain points, and opportunities for optimization.
                            </p>

                            <p>
                                Moreover, the integration of cutting-edge technologies requires a holistic approach that considers not only the technical aspects but also the human element. Employee training, change management, and organizational culture play crucial roles in ensuring the successful adoption of new systems and processes.
                            </p>

                            <!-- Quote Block -->
                            <blockquote class="border-l-4 border-orange-500 pl-6 py-4 my-12 bg-slate-50 rounded-r-2xl">
                                <p class="text-2xl font-light text-slate-800 italic leading-relaxed mb-3">
                                    "Innovation distinguishes between a leader and a follower. The key is not just to adopt new technologies, but to integrate them in ways that fundamentally transform how we deliver value to our customers."
                                </p>
                                <footer class="text-slate-600 font-semibold">— Industry Expert</footer>
                            </blockquote>

                            <h2 class="text-3xl font-bold text-slate-900 mt-12 mb-6">
                                Key <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500">Strategies</span> for Success
                            </h2>

                            <p>
                                Implementing effective strategies requires a multi-faceted approach that addresses both immediate needs and long-term objectives. Organizations that excel in this area typically follow several proven methodologies:
                            </p>

                            <!-- Numbered List with Custom Styling -->
                            <div class="space-y-6 my-10">
                                <div class="flex gap-6 items-start">
                                    <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-orange-500/30">
                                        1
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-slate-900 mb-2">Strategic Planning and Assessment</h3>
                                        <p class="text-slate-600">Begin with a comprehensive evaluation of current capabilities and future requirements to create a roadmap for transformation.</p>
                                    </div>
                                </div>

                                <div class="flex gap-6 items-start">
                                    <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-orange-500/30">
                                        2
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-slate-900 mb-2">Technology Selection and Integration</h3>
                                        <p class="text-slate-600">Choose technologies that align with your business objectives and integrate seamlessly with existing systems.</p>
                                    </div>
                                </div>

                                <div class="flex gap-6 items-start">
                                    <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-orange-500/30">
                                        3
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-slate-900 mb-2">Continuous Monitoring and Optimization</h3>
                                        <p class="text-slate-600">Implement feedback loops and analytics to continuously refine and improve your solutions.</p>
                                    </div>
                                </div>
                            </div>

                            <h2 class="text-3xl font-bold text-slate-900 mt-12 mb-6">
                                Real-World <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500">Applications</span>
                            </h2>

                            <p>
                                The practical application of these principles has resulted in remarkable success stories across various industries. Companies that embrace innovation and invest in modern solutions consistently outperform their competitors in terms of efficiency, customer satisfaction, and overall market position.
                            </p>

                            <p>
                                From streamlined operations to enhanced customer experiences, the benefits of strategic technology adoption are far-reaching. Organizations report significant improvements in productivity, cost reduction, and the ability to scale their operations effectively.
                            </p>

                            <!-- Highlight Box -->
                            <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-3xl p-8 my-12 border border-orange-100">
                                <h3 class="text-2xl font-bold text-slate-900 mb-4 flex items-center gap-3">
                                    <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                    Key Takeaway
                                </h3>
                                <p class="text-lg text-slate-700 leading-relaxed">
                                    Success in the digital age requires more than just adopting new technologies—it demands a fundamental shift in how organizations think about innovation, customer value, and competitive advantage. The companies that thrive are those that view technology not as a cost center, but as a strategic enabler of business transformation.
                                </p>
                            </div>

                            <h2 class="text-3xl font-bold text-slate-900 mt-12 mb-6">
                                Looking <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500">Forward</span>
                            </h2>

                            <p>
                                As we move into an increasingly digital future, the pace of technological change shows no signs of slowing. Organizations must remain agile, adaptable, and committed to continuous learning and improvement. By embracing innovation and maintaining a forward-thinking mindset, businesses can position themselves for long-term success in an ever-evolving marketplace.
                            </p>

                            <p>
                                The journey toward digital excellence is ongoing, and those who invest in the right strategies, technologies, and people will be best positioned to thrive in the years to come.
                            </p>
                        </div>
                    </div>

                    <!-- Author Bio -->
                    <div class="mt-16 pt-12 border-t-2 border-slate-200">
                        <div class="flex gap-6 items-start bg-slate-50 rounded-3xl p-8">
                            <div class="flex-shrink-0">
                                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center text-white text-2xl font-bold shadow-lg shadow-orange-500/30">
                                    {{ blog.author.charAt(0) }}
                                </div>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-slate-900 mb-2">{{ blog.author }}</h3>
                                <p class="text-slate-600 leading-relaxed">
                                    A seasoned expert in business transformation and technology innovation, bringing years of experience helping organizations achieve their digital goals. Passionate about sharing insights and best practices with the broader business community.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Share Section -->
                    <div class="mt-12">
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-6 bg-gradient-to-br from-slate-50 to-orange-50/30 rounded-3xl p-8 border border-slate-100">
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 mb-2">Share this article</h3>
                                <p class="text-slate-600">Help others discover this content</p>
                            </div>
                            <div class="flex gap-3">
                                <button class="w-12 h-12 rounded-xl bg-white border-2 border-slate-200 flex items-center justify-center text-slate-600 hover:border-orange-500 hover:text-orange-500 transition-all duration-300 shadow-sm hover:shadow-lg hover:shadow-orange-500/20">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                </button>
                                <button class="w-12 h-12 rounded-xl bg-white border-2 border-slate-200 flex items-center justify-center text-slate-600 hover:border-orange-500 hover:text-orange-500 transition-all duration-300 shadow-sm hover:shadow-lg hover:shadow-orange-500/20">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                    </svg>
                                </button>
                                <button class="w-12 h-12 rounded-xl bg-white border-2 border-slate-200 flex items-center justify-center text-slate-600 hover:border-orange-500 hover:text-orange-500 transition-all duration-300 shadow-sm hover:shadow-lg hover:shadow-orange-500/20">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>

        <!-- Related Articles -->
        <section class="py-20 bg-slate-50 relative overflow-hidden">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <div class="text-center mb-12">
                        <h2 class="text-4xl font-bold text-slate-900 mb-4">
                            Related <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500">Articles</span>
                        </h2>
                        <p class="text-slate-600 text-lg">Continue exploring insights and innovation</p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-8">
                        <article
                            v-for="related in relatedArticles"
                            :key="related.id"
                            class="group cursor-pointer"
                        >
                            <!-- Image -->
                            <div class="relative overflow-hidden rounded-3xl mb-6 aspect-[16/10]">
                                <img
                                    :src="related.image"
                                    :alt="related.title"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                />
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>

                                <!-- Category Badge -->
                                <div class="absolute top-4 left-4">
                                    <span class="px-4 py-2 bg-white/90 backdrop-blur-sm rounded-full text-xs font-bold text-slate-900">
                                        {{ related.category }}
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-orange-500 transition-colors duration-300 leading-tight">
                                    {{ related.title }}
                                </h3>

                                <p class="text-slate-600 leading-relaxed mb-4">
                                    {{ related.excerpt }}
                                </p>

                                <div class="flex items-center gap-4 text-sm text-slate-500">
                                    <span>{{ related.date }}</span>
                                    <span>•</span>
                                    <span>{{ related.readTime }}</span>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 relative overflow-hidden">
            <div class="absolute inset-0 opacity-5">
                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="cta-grid" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                            <circle cx="2" cy="2" r="1" fill="#F97316"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#cta-grid)"/>
                </svg>
            </div>

            <div class="container mx-auto px-4 relative z-10">
                <div class="max-w-3xl mx-auto text-center">
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                        Ready to Transform Your
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500 mt-2">
                            Business?
                        </span>
                    </h2>
                    <p class="text-xl text-slate-300 mb-10 leading-relaxed">
                        Let's discuss how Nuclear Edge can help you achieve your goals
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <Link
                            href="/contact"
                            class="group relative px-8 py-4 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold rounded-full overflow-hidden transition-all duration-300 hover:shadow-lg hover:shadow-orange-500/50 hover:scale-105"
                        >
                            <span class="relative z-10 flex items-center justify-center gap-2">
                                Get Started Today
                                <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-red-600 to-orange-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </Link>
                        <Link
                            href="/blog"
                            class="px-8 py-4 border-2 border-white/20 text-white font-semibold rounded-full backdrop-blur-sm hover:bg-white/10 hover:border-orange-400 transition-all duration-300"
                        >
                            Explore More Articles
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <Footer />
    </div>
</template>

<script setup>
import { computed } from 'vue';
import { Link, Head } from '@inertiajs/vue3';
import Header from '../../Components/Header.vue';
import Footer from '../../Components/Footer.vue';

const props = defineProps({
    blog: {
        type: Object,
        required: true
    }
});

// For demo purposes, showing 3 related articles
const relatedArticles = computed(() => {
    // In a real app, this would fetch related articles based on category or tags
    return [
        {
            id: 2,
            title: 'Digital Transformation: A Complete Guide',
            excerpt: 'Learn how legacy businesses can successfully navigate digital transformation.',
            category: 'Business',
            date: 'Jan 3, 2026',
            readTime: '12 min read',
            image: 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=800&q=80'
        },
        {
            id: 3,
            title: 'Building Scalable Web Applications',
            excerpt: 'Discover the latest architectural patterns and tools for 2026.',
            category: 'Technology',
            date: 'Dec 28, 2025',
            readTime: '10 min read',
            image: 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800&q=80'
        },
        {
            id: 4,
            title: 'The Rise of EdTech',
            excerpt: 'How technology is revolutionizing education and learning experiences.',
            category: 'Innovation',
            date: 'Dec 25, 2025',
            readTime: '9 min read',
            image: 'https://images.unsplash.com/photo-1501504905252-473c47e087f8?w=800&q=80'
        }
    ];
});
</script>
