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

        <!-- Mobile Navigation Menu (Modern Slide-in) -->
        <!-- Backdrop Overlay -->
        <transition name="fade">
            <div
                v-if="isMenuOpen"
                @click="closeMenu"
                class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[100]"
            ></div>
        </transition>

        <!-- Slide-in Menu -->
        <transition name="slide-menu">
            <div
                v-if="isMenuOpen"
                class="fixed top-0 left-0 bottom-0 w-80 bg-slate-950/95 backdrop-blur-xl z-[101] overflow-y-auto shadow-2xl"
            >
                <!-- Menu Header -->
                <div class="p-6 border-b border-white/10">
                    <div class="flex items-center justify-between">
                        <img
                            src="/images/nuclear-edge-logo.webp"
                            alt="Nuclear Edge"
                            class="h-10"
                        />
                        <button
                            @click="closeMenu"
                            class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center text-white hover:bg-white/10 transition-colors"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Navigation Links -->
                <nav class="p-6">
                    <ul class="space-y-2">
                        <li>
                            <a
                                href="/"
                                class="group flex items-center gap-4 px-4 py-4 text-lg font-semibold text-white hover:bg-gradient-to-r hover:from-orange-500 hover:to-red-500 rounded-xl transition-all duration-300"
                                @click="closeMenu"
                            >
                                <svg class="w-5 h-5 text-orange-500 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                <span>Home</span>
                            </a>
                        </li>
                        <li>
                            <a
                                href="/about"
                                class="group flex items-center gap-4 px-4 py-4 text-lg font-semibold text-white hover:bg-gradient-to-r hover:from-orange-500 hover:to-red-500 rounded-xl transition-all duration-300"
                                @click="closeMenu"
                            >
                                <svg class="w-5 h-5 text-orange-500 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>About</span>
                            </a>
                        </li>
                        <li>
                            <a
                                href="#services"
                                class="group flex items-center gap-4 px-4 py-4 text-lg font-semibold text-white hover:bg-gradient-to-r hover:from-orange-500 hover:to-red-500 rounded-xl transition-all duration-300"
                                @click="closeMenu"
                            >
                                <svg class="w-5 h-5 text-orange-500 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span>Services</span>
                            </a>
                        </li>
                        <li>
                            <a
                                href="/blog"
                                class="group flex items-center gap-4 px-4 py-4 text-lg font-semibold text-white hover:bg-gradient-to-r hover:from-orange-500 hover:to-red-500 rounded-xl transition-all duration-300"
                                @click="closeMenu"
                            >
                                <svg class="w-5 h-5 text-orange-500 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                                <span>Blog</span>
                            </a>
                        </li>
                        <li>
                            <a
                                href="#contact"
                                class="group flex items-center gap-4 px-4 py-4 text-lg font-semibold text-white hover:bg-gradient-to-r hover:from-orange-500 hover:to-red-500 rounded-xl transition-all duration-300"
                                @click="closeMenu"
                            >
                                <svg class="w-5 h-5 text-orange-500 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span>Contact</span>
                            </a>
                        </li>
                    </ul>
                </nav>

                <!-- Menu Footer -->
                <div class="absolute bottom-0 left-0 right-0 p-6 border-t border-white/10 bg-slate-950/50">
                    <div class="flex items-center gap-3">
                        <!-- Social Links -->
                        <a href="#" class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center text-slate-400 hover:bg-gradient-to-r hover:from-orange-500 hover:to-red-500 hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center text-slate-400 hover:bg-gradient-to-r hover:from-orange-500 hover:to-red-500 hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center text-slate-400 hover:bg-gradient-to-r hover:from-orange-500 hover:to-red-500 hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    </div>
                </div>
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
    console.log('Menu toggled:', isMenuOpen.value);
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

/* Fade animation for backdrop */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

/* Slide menu animation (left to right) */
.slide-menu-enter-active,
.slide-menu-leave-active {
    transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.slide-menu-enter-from {
    transform: translateX(-100%);
}

.slide-menu-leave-to {
    transform: translateX(-100%);
}
</style>
