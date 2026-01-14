<template>
    <div class="min-h-screen bg-white">
        <Head>
            <title>{{ blog.title }} - Nuclear Edge Blog</title>
            <meta name="description" :content="blog.excerpt" />
            <meta name="keywords" :content="`${blog.category}, ${blog.title}, Nuclear Edge, business insights, technology trends, ${blog.category.toLowerCase()} articles, business transformation`" />
            <meta name="author" :content="blog.author" />
            <meta name="robots" content="index, follow" />
            <meta name="article:published_time" :content="blog.date" />
            <meta name="article:author" :content="blog.author" />
            <meta name="article:section" :content="blog.category" />
            <link rel="canonical" :href="canonicalUrl" />

            <!-- Open Graph / Facebook -->
            <meta property="og:type" content="article" />
            <meta property="og:url" :content="canonicalUrl" />
            <meta property="og:title" :content="blog.title" />
            <meta property="og:description" :content="blog.excerpt" />
            <meta property="og:image" :content="blog.image" />
            <meta property="og:site_name" content="Nuclear Edge" />
            <meta property="article:published_time" :content="blog.date" />
            <meta property="article:author" :content="blog.author" />
            <meta property="article:section" :content="blog.category" />

            <!-- Twitter -->
            <meta name="twitter:card" content="summary_large_image" />
            <meta name="twitter:url" :content="canonicalUrl" />
            <meta name="twitter:title" :content="blog.title" />
            <meta name="twitter:description" :content="blog.excerpt" />
            <meta name="twitter:image" :content="blog.image" />
            <meta name="twitter:creator" :content="`@${blog.author.replace(' ', '')}`" />
            <meta name="twitter:label1" content="Written by" />
            <meta name="twitter:data1" :content="blog.author" />
            <meta name="twitter:label2" content="Reading time" />
            <meta name="twitter:data2" :content="blog.readTime" />

            <!-- Additional SEO -->
            <meta name="theme-color" content="#F97316" />
        </Head>

        <!-- Header -->
        <Header :isTransparent="false" logoUrl="/images/nuclear-edge-logo.webp" />

        <!-- Preview Banner -->
        <div v-if="isPreview" class="fixed top-0 left-0 right-0 z-50 bg-gradient-to-r from-yellow-500 to-orange-500 text-white py-3 px-4 shadow-lg">
            <div class="container mx-auto flex items-center justify-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                <span class="font-semibold">Preview Mode</span>
                <span class="hidden sm:inline">- This blog post is a draft and is not publicly visible</span>
            </div>
        </div>

        <!-- Hero Section with Featured Image -->
        <section :class="['pb-16 relative overflow-hidden min-h-[600px] md:min-h-[700px]', isPreview ? 'pt-44' : 'pt-32']">
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
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 max-w-7xl mx-auto">
                    <!-- Main Content Area -->
                    <div class="lg:col-span-8">
                        <!-- Article Body -->
                        <div class="prose prose-lg max-w-none">
                            <!-- Excerpt/Introduction -->
                            <div class="text-2xl font-light text-slate-700 leading-relaxed mb-12 pb-8 border-b-2 border-slate-200">
                                {{ blog.excerpt }}
                            </div>

                            <!-- Main Content from Database -->
                            <div
                                ref="contentRef"
                                class="blog-content space-y-6 text-slate-600 leading-relaxed"
                                v-html="blog.content"
                            ></div>
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
                                        {{ blog.authorBio || 'Content creator at Nuclear Edge' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar with Table of Contents -->
                    <aside class="lg:col-span-4 hidden lg:block">
                        <div class="sticky top-24 space-y-6">
                            <!-- Table of Contents Card -->
                            <div class="bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
                                <div class="bg-gradient-to-r from-orange-500 to-red-500 px-6 py-4">
                                    <h3 class="text-white font-bold text-lg flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                                        </svg>
                                        Table of Contents
                                    </h3>
                                </div>
                                <div class="p-4 max-h-[60vh] overflow-y-auto custom-scrollbar">
                                    <nav v-if="headings.length > 0" class="space-y-1">
                                        <a
                                            v-for="(heading, index) in headings"
                                            :key="index"
                                            :href="`#${heading.id}`"
                                            @click.prevent="scrollToHeading(heading.id)"
                                            :class="[
                                                'block py-2 px-3 rounded-lg text-sm transition-all duration-200',
                                                heading.level === 'h2' ? 'font-semibold' : 'pl-6 text-sm',
                                                activeHeading === heading.id
                                                    ? 'bg-gradient-to-r from-orange-500 to-red-500 text-white shadow-md'
                                                    : 'text-slate-700 hover:bg-slate-100'
                                            ]"
                                        >
                                            {{ heading.text }}
                                        </a>
                                    </nav>
                                    <p v-else class="text-slate-500 text-sm text-center py-8">
                                        No headings found
                                    </p>
                                </div>
                            </div>

                            <!-- Share Card -->
                            <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6">
                                <h3 class="font-bold text-slate-900 mb-4 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                                    </svg>
                                    Share Article
                                </h3>
                                <div class="flex gap-3">
                                    <a
                                        :href="`https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(canonicalUrl)}`"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="flex-1 flex items-center justify-center gap-2 px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                                    >
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                        </svg>
                                    </a>
                                    <a
                                        :href="`https://twitter.com/intent/tweet?url=${encodeURIComponent(canonicalUrl)}&text=${encodeURIComponent(blog.title)}`"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="flex-1 flex items-center justify-center gap-2 px-4 py-3 bg-slate-900 text-white rounded-lg hover:bg-slate-800 transition-colors"
                                    >
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                        </svg>
                                    </a>
                                    <a
                                        :href="`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(canonicalUrl)}`"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="flex-1 flex items-center justify-center gap-2 px-4 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors"
                                    >
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <!-- Stats Card -->
                            <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-2xl border border-orange-100 p-6">
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        <span class="text-slate-600 text-sm">Reading Time</span>
                                        <span class="font-bold text-orange-600">{{ blog.readTime }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-slate-600 text-sm">Published</span>
                                        <span class="font-bold text-slate-900">{{ blog.date }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-slate-600 text-sm">Category</span>
                                        <span class="px-3 py-1 bg-white rounded-full text-sm font-semibold text-orange-600 border border-orange-200">
                                            {{ blog.category }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
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
                        <Link
                            v-for="related in relatedArticles"
                            :key="related.id"
                            :href="`/${related.categorySlug}/${related.slug}`"
                            class="group cursor-pointer block"
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
                        </Link>
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
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { Link, Head } from '@inertiajs/vue3';
import Header from '../../Components/Header.vue';
import Footer from '../../Components/Footer.vue';

const props = defineProps({
    blog: {
        type: Object,
        required: true
    },
    relatedArticles: {
        type: Array,
        default: () => []
    },
    isPreview: {
        type: Boolean,
        default: false
    }
});

const contentRef = ref(null);
const headings = ref([]);
const activeHeading = ref('');

// Generate canonical URL based on blog category and slug
const canonicalUrl = computed(() => {
    const categorySlug = props.blog.categorySlug || props.blog.category.toLowerCase().replace(/[^a-z0-9]+/g, '-');
    return `https://nuclearedge.com/${categorySlug}/${props.blog.slug}`;
});

// Extract headings from blog content
const extractHeadings = () => {
    if (!contentRef.value) return;

    const content = contentRef.value;
    const h2Elements = content.querySelectorAll('h2');
    const h3Elements = content.querySelectorAll('h3');

    const allHeadings = [];

    // Process H2 elements
    h2Elements.forEach((heading, index) => {
        const id = `heading-h2-${index}`;
        heading.id = id;
        allHeadings.push({
            id,
            text: heading.textContent,
            level: 'h2',
            element: heading
        });
    });

    // Process H3 elements
    h3Elements.forEach((heading, index) => {
        const id = `heading-h3-${index}`;
        heading.id = id;
        allHeadings.push({
            id,
            text: heading.textContent,
            level: 'h3',
            element: heading
        });
    });

    // Sort by document position
    allHeadings.sort((a, b) => {
        return a.element.compareDocumentPosition(b.element) & Node.DOCUMENT_POSITION_FOLLOWING ? -1 : 1;
    });

    headings.value = allHeadings;

    // Set first heading as active initially
    if (allHeadings.length > 0) {
        activeHeading.value = allHeadings[0].id;
    }
};

// Handle scroll for active heading detection
const handleScroll = () => {
    if (headings.value.length === 0) return;

    const scrollPosition = window.scrollY + 150;

    for (let i = headings.value.length - 1; i >= 0; i--) {
        const heading = headings.value[i];
        const element = document.getElementById(heading.id);

        if (element && element.offsetTop <= scrollPosition) {
            activeHeading.value = heading.id;
            break;
        }
    }
};

// Smooth scroll to heading
const scrollToHeading = (id) => {
    const element = document.getElementById(id);
    if (element) {
        const offsetTop = element.offsetTop - 100;
        window.scrollTo({
            top: offsetTop,
            behavior: 'smooth'
        });
    }
};

onMounted(() => {
    // Wait for content to be rendered
    setTimeout(() => {
        extractHeadings();
        window.addEventListener('scroll', handleScroll);
        handleScroll(); // Initial check
    }, 100);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>

<style scoped>
/* Blog Content Styling for WordPress HTML */
:deep(.blog-content) {
    color: #475569;
    font-size: 1.125rem;
    line-height: 1.75;
}

:deep(.blog-content h1),
:deep(.blog-content h2),
:deep(.blog-content h3),
:deep(.blog-content h4),
:deep(.blog-content h5),
:deep(.blog-content h6) {
    color: #0f172a;
    font-weight: 700;
    margin-top: 2.5rem;
    margin-bottom: 1.5rem;
    line-height: 1.3;
}

:deep(.blog-content h1) {
    font-size: 2.25rem;
}

:deep(.blog-content h2) {
    font-size: 2rem;
    background: linear-gradient(to right, #f97316, #ef4444);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

:deep(.blog-content h3) {
    font-size: 1.75rem;
}

:deep(.blog-content h4) {
    font-size: 1.5rem;
}

:deep(.blog-content p) {
    margin-bottom: 1.5rem;
}

:deep(.blog-content a) {
    color: #f97316;
    text-decoration: underline;
    transition: color 0.2s;
}

:deep(.blog-content a:hover) {
    color: #ef4444;
}

:deep(.blog-content ul),
:deep(.blog-content ol) {
    margin: 1.5rem 0;
    padding-left: 2rem;
}

:deep(.blog-content li) {
    margin-bottom: 0.75rem;
}

:deep(.blog-content ul li) {
    list-style-type: disc;
}

:deep(.blog-content ol li) {
    list-style-type: decimal;
}

:deep(.blog-content blockquote) {
    border-left: 4px solid #f97316;
    padding-left: 1.5rem;
    padding-top: 1rem;
    padding-bottom: 1rem;
    margin: 2rem 0;
    background: #f8fafc;
    border-radius: 0 1rem 1rem 0;
    font-style: italic;
    color: #334155;
}

:deep(.blog-content img) {
    width: 100%;
    height: auto;
    border-radius: 1rem;
    margin: 2rem 0;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
}

:deep(.blog-content figure) {
    margin: 2rem 0;
}

:deep(.blog-content figcaption) {
    text-align: center;
    color: #64748b;
    font-size: 0.875rem;
    margin-top: 0.5rem;
    font-style: italic;
}

:deep(.blog-content code) {
    background: #f1f5f9;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-family: 'Courier New', monospace;
    font-size: 0.875em;
    color: #ef4444;
}

:deep(.blog-content pre) {
    background: #1e293b;
    color: #e2e8f0;
    padding: 1.5rem;
    border-radius: 0.75rem;
    overflow-x: auto;
    margin: 2rem 0;
}

:deep(.blog-content pre code) {
    background: transparent;
    padding: 0;
    color: #e2e8f0;
}

:deep(.blog-content table) {
    width: 100%;
    border-collapse: collapse;
    margin: 2rem 0;
}

:deep(.blog-content table th),
:deep(.blog-content table td) {
    border: 1px solid #e2e8f0;
    padding: 0.75rem 1rem;
    text-align: left;
}

:deep(.blog-content table th) {
    background: #f8fafc;
    font-weight: 600;
    color: #0f172a;
}

:deep(.blog-content table tr:nth-child(even)) {
    background: #f8fafc;
}

:deep(.blog-content hr) {
    border: none;
    border-top: 2px solid #e2e8f0;
    margin: 3rem 0;
}

:deep(.blog-content strong),
:deep(.blog-content b) {
    font-weight: 700;
    color: #0f172a;
}

:deep(.blog-content em),
:deep(.blog-content i) {
    font-style: italic;
}
</style>
