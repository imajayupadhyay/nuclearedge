<template>
    <header
        :class="[
            'fixed top-0 left-0 right-0 z-50 transition-all duration-500',
            isTransparent ? 'bg-transparent' : 'bg-slate-900/80 backdrop-blur-lg shadow-lg border-b border-white/10'
        ]"
    >
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-20">
                <!-- Left: Hamburger Menu -->
                <div class="flex-shrink-0">
                    <button
                        @click="toggleMenu"
                        :class="[
                            'p-2 rounded-lg transition-all duration-300',
                            isTransparent ? 'text-white hover:bg-white/10' : 'text-white hover:bg-white/20'
                        ]"
                        aria-label="Toggle menu"
                    >
                        <svg
                            class="w-7 h-7"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                v-if="!isMenuOpen"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path
                                v-else
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>

                <!-- Center: Logo -->
                <div class="absolute left-1/2 transform -translate-x-1/2">
                    <a href="/" class="block">
                        <img
                            :src="logoUrl"
                            alt="Nuclear Edge"
                            class="h-12 w-auto transition-all duration-200 hover:scale-105"
                        />
                    </a>
                </div>

                <!-- Right: Search Bar -->
                <div class="flex-shrink-0">
                    <div class="relative">
                        <!-- Desktop Search Bar -->
                        <div class="hidden md:block">
                            <div
                                :class="[
                                    'flex items-center rounded-full px-4 py-2 backdrop-blur-md transition-all duration-300',
                                    isTransparent
                                        ? 'bg-white/20 border border-white/30'
                                        : 'bg-white/10 border border-white/20'
                                ]"
                            >
                                <input
                                    type="text"
                                    v-model="searchQuery"
                                    placeholder="Search..."
                                    :class="[
                                        'bg-transparent outline-none w-48 transition-all duration-200 focus:w-64 placeholder:text-sm text-white placeholder:text-white/70'
                                    ]"
                                    @focus="isSearchFocused = true"
                                    @blur="isSearchFocused = false"
                                />
                                <button
                                    :class="[
                                        'ml-2 transition-colors duration-200',
                                        'text-white hover:text-orange-400'
                                    ]"
                                    aria-label="Search"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Mobile Search Icon -->
                        <button
                            @click="toggleSearch"
                            :class="[
                                'md:hidden p-2 rounded-lg transition-all duration-300',
                                isTransparent ? 'text-white hover:bg-white/10' : 'text-white hover:bg-white/20'
                            ]"
                            aria-label="Search"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Search Bar (Expandable) -->
            <transition name="slide-down">
                <div v-if="isSearchOpen" class="md:hidden pb-4">
                    <div
                        :class="[
                            'flex items-center rounded-full px-4 py-2 backdrop-blur-md transition-all duration-300',
                            isTransparent
                                ? 'bg-white/20 border border-white/30'
                                : 'bg-white/10 border border-white/20'
                        ]"
                    >
                        <input
                            type="text"
                            v-model="searchQuery"
                            placeholder="Search..."
                            :class="[
                                'bg-transparent outline-none w-full placeholder:text-sm text-white placeholder:text-white/70'
                            ]"
                        />
                        <button
                            :class="[
                                'ml-2 text-white'
                            ]"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </transition>
        </div>

        <!-- Mobile Navigation Menu (Slide-in) -->
        <transition name="slide">
            <div
                v-if="isMenuOpen"
                class="fixed inset-0 top-20 bg-white z-40 md:hidden overflow-y-auto"
            >
                <nav class="container mx-auto px-4 py-8">
                    <ul class="space-y-6">
                        <li>
                            <a
                                href="#home"
                                class="text-2xl font-semibold text-slate-700 hover:text-orange-500 transition-colors block"
                                @click="closeMenu"
                            >
                                Home
                            </a>
                        </li>
                        <li>
                            <a
                                href="#about"
                                class="text-2xl font-semibold text-slate-700 hover:text-orange-500 transition-colors block"
                                @click="closeMenu"
                            >
                                About
                            </a>
                        </li>
                        <li>
                            <a
                                href="#services"
                                class="text-2xl font-semibold text-slate-700 hover:text-orange-500 transition-colors block"
                                @click="closeMenu"
                            >
                                Services
                            </a>
                        </li>
                        <li>
                            <a
                                href="#blog"
                                class="text-2xl font-semibold text-slate-700 hover:text-orange-500 transition-colors block"
                                @click="closeMenu"
                            >
                                Blog
                            </a>
                        </li>
                        <li>
                            <a
                                href="#contact"
                                class="text-2xl font-semibold text-slate-700 hover:text-orange-500 transition-colors block"
                                @click="closeMenu"
                            >
                                Contact
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </transition>
    </header>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    isTransparent: {
        type: Boolean,
        default: true
    },
    logoUrl: {
        type: String,
        default: '/images/nuclear-edge-logo.webp'
    }
});

const isMenuOpen = ref(false);
const isSearchOpen = ref(false);
const searchQuery = ref('');
const isSearchFocused = ref(false);

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;
    if (isMenuOpen.value) {
        isSearchOpen.value = false;
    }
};

const toggleSearch = () => {
    isSearchOpen.value = !isSearchOpen.value;
};

const closeMenu = () => {
    isMenuOpen.value = false;
};
</script>

<style scoped>
/* Slide down animation for mobile search */
.slide-down-enter-active,
.slide-down-leave-active {
    transition: all 0.3s ease;
}

.slide-down-enter-from {
    opacity: 0;
    transform: translateY(-10px);
}

.slide-down-leave-to {
    opacity: 0;
    transform: translateY(-10px);
}

/* Slide animation for mobile menu */
.slide-enter-active,
.slide-leave-active {
    transition: transform 0.3s ease;
}

.slide-enter-from {
    transform: translateX(-100%);
}

.slide-leave-to {
    transform: translateX(-100%);
}
</style>
