<template>
    <div class="min-h-screen bg-white">
        <!-- Header - Transparent on hero, black glass effect on scroll -->
        <Header :isTransparent="isHeaderTransparent" logoUrl="/images/nuclear-edge-logo.webp" />

        <!-- Hero Section -->
        <Hero :videoUrl="videoUrl" />

        <!-- Blog Carousel Section -->
        <BlogCarousel />

        <!-- Success Stories Section -->
        <SuccessStories />

        <!-- Future sections will go here -->
        <!-- <About /> -->
        <!-- <Services /> -->
        <!-- <Contact /> -->

        <!-- Footer -->
        <Footer />
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import Header from '../../Components/Header.vue';
import Footer from '../../Components/Footer.vue';
import Hero from './Hero.vue';
import BlogCarousel from './BlogCarousel.vue';
import SuccessStories from './SuccessStories.vue';

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
