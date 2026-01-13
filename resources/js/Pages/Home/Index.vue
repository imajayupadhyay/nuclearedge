<template>
    <div class="min-h-screen bg-white">
        <Head>
            <title>Nuclear Edge - Business Transformation & Technology Consulting | Bangalore</title>
            <meta name="description" content="Nuclear Edge offers powerful business transformation and technology consulting services. With 35+ years of excellence, we help businesses achieve their goals through innovative solutions and strategic planning." />
            <meta name="keywords" content="business consulting, digital transformation, technology solutions, business strategy, Nuclear Edge, Bangalore consulting, IT consulting India, business transformation services" />
            <meta name="author" content="Nuclear Edge" />
            <meta name="robots" content="index, follow" />
            <link rel="canonical" href="https://nuclearedge.com" />

            <!-- Open Graph / Facebook -->
            <meta property="og:type" content="website" />
            <meta property="og:url" content="https://nuclearedge.com" />
            <meta property="og:title" content="Nuclear Edge - Business Transformation & Technology Consulting" />
            <meta property="og:description" content="Nuclear Edge offers powerful business transformation and technology consulting services. With 35+ years of excellence, we help businesses achieve their goals." />
            <meta property="og:image" content="https://nuclearedge.com/images/nuclear-edge-og-image.jpg" />
            <meta property="og:site_name" content="Nuclear Edge" />
            <meta property="og:locale" content="en_US" />

            <!-- Twitter -->
            <meta name="twitter:card" content="summary_large_image" />
            <meta name="twitter:url" content="https://nuclearedge.com" />
            <meta name="twitter:title" content="Nuclear Edge - Business Transformation & Technology Consulting" />
            <meta name="twitter:description" content="Nuclear Edge offers powerful business transformation and technology consulting services. With 35+ years of excellence." />
            <meta name="twitter:image" content="https://nuclearedge.com/images/nuclear-edge-og-image.jpg" />

            <!-- Additional SEO -->
            <meta name="theme-color" content="#F97316" />
            <meta name="geo.region" content="IN-KA" />
            <meta name="geo.placename" content="Bangalore" />
            <meta name="geo.position" content="12.9716;77.5946" />
        </Head>

        <!-- Header - Transparent on hero, black glass effect on scroll -->
        <Header :isTransparent="isHeaderTransparent" logoUrl="/images/nuclear-edge-logo.webp" />

        <!-- Hero Section -->
        <Hero :videoUrl="videoUrl" />

        <!-- Blog Carousel Section -->
        <BlogCarousel />

        <!-- Tabs Section -->
        <TabsSection />

        <!-- Featured Articles Section -->
        <FeaturedArticles />

        <!-- Footer -->
        <Footer />
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import Header from '../../Components/Header.vue';
import Footer from '../../Components/Footer.vue';
import Hero from './Hero.vue';
import BlogCarousel from './BlogCarousel.vue';
import TabsSection from './TabsSection.vue';
import FeaturedArticles from './FeaturedArticles.vue';

defineProps({
    videoUrl: {
        type: String,
        default: '/videos/hero-background.mp4'
    }
});

const isHeaderTransparent = ref(true);

// Handle scroll to toggle header transparency
const handleScroll = () => {
    // Change header immediately when user starts scrolling
    const scrollPosition = window.scrollY;

    isHeaderTransparent.value = scrollPosition < 50;
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
    handleScroll(); // Check initial position
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>
