<template>
    <div class="min-h-screen bg-white">
        <Head>
            <title>Nuclear Edge - Business Transformation & Technology Consulting</title>
            <meta name="description" content="Nuclear Edge offers powerful business transformation and technology consulting services. With 35+ years of excellence, we help businesses achieve their goals through innovative solutions and strategic planning." />
            <meta name="keywords" content="business consulting, digital transformation, technology solutions, business strategy, Nuclear Edge, Bangalore consulting" />
        </Head>

        <!-- Header - Transparent on hero, black glass effect on scroll -->
        <Header :isTransparent="isHeaderTransparent" logoUrl="/images/nuclear-edge-logo.webp" />

        <!-- Hero Section -->
        <Hero :videoUrl="videoUrl" />

        <!-- Blog Carousel Section -->
        <BlogCarousel />

        <!-- Success Stories Section -->
        <SuccessStories />

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
import SuccessStories from './SuccessStories.vue';
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
