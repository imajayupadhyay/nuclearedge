<template>
    <Head><title>PsychLab Session #{{ response.id }} - Admin Portal</title></Head>

    <AdminLayout :user="$page.props.auth.user">
        <!-- Header -->
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-3">
                <a href="/admin/talkheals-psychlab"
                    class="flex items-center gap-1.5 text-sm text-slate-500 hover:text-slate-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    All Sessions
                </a>
                <span class="text-slate-300">/</span>
                <h1 class="text-xl font-bold text-slate-900">Session #{{ response.id }}</h1>
            </div>
            <div class="flex items-center gap-3">
                <span :class="['inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium',
                    response.is_reviewed ? 'bg-purple-100 text-purple-800' : 'bg-orange-100 text-orange-800']">
                    <span :class="['w-1.5 h-1.5 rounded-full mr-2', response.is_reviewed ? 'bg-purple-600' : 'bg-orange-500']"></span>
                    {{ response.is_reviewed ? 'Reviewed' : 'Unreviewed' }}
                </span>
                <button v-if="response.is_reviewed" @click="markUnreviewed"
                    class="px-3 py-1.5 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition-colors text-sm font-medium">
                    Mark Unreviewed
                </button>
                <button v-else @click="markReviewed"
                    class="px-3 py-1.5 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors text-sm font-medium">
                    Mark Reviewed
                </button>
                <button @click="showDeleteModal = true"
                    class="px-3 py-1.5 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition-colors text-sm font-medium">
                    Delete
                </button>
            </div>
        </div>

        <!-- Flash -->
        <div v-if="$page.props.flash.success" class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center">
            <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="text-green-800">{{ $page.props.flash.success }}</span>
        </div>

        <!-- Meta card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 mb-6 flex flex-wrap gap-6">
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Submitted</p>
                <p class="text-sm font-medium text-slate-900">{{ formatDate(response.created_at) }}</p>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Games Completed</p>
                <p class="text-sm font-medium text-slate-900">
                    <span class="text-purple-600 font-bold">{{ response.completed_games.length }}</span> / 7
                </p>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Form</p>
                <p class="text-sm font-medium text-slate-900">TalkHeals PsychLab</p>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Client</p>
                <p class="text-sm font-medium text-slate-900">Namrata · TalkHeals Psychotherapy</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Trait Profile (left/main) -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 bg-gradient-to-r from-purple-50 to-pink-50">
                        <h2 class="font-semibold text-slate-900 flex items-center gap-2">
                            <span>🧠</span> Psychological Trait Profile
                        </h2>
                        <p class="text-xs text-slate-500 mt-0.5">Computed from all completed games</p>
                    </div>
                    <div class="p-6 space-y-5">
                        <div v-for="trait in TRAIT_LIST" :key="trait.key" class="flex items-center gap-4">
                            <span class="text-xl w-8 flex-shrink-0 text-center">{{ trait.icon }}</span>
                            <div class="w-28 flex-shrink-0">
                                <p class="text-sm font-semibold text-slate-700">{{ trait.label }}</p>
                                <p class="text-xs text-slate-400">{{ trait.desc }}</p>
                            </div>
                            <div class="flex-1">
                                <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden">
                                    <div class="h-3 rounded-full transition-all duration-700"
                                        :style="{ background: `linear-gradient(90deg,${trait.color}88,${trait.color})`, width: response.scores[trait.key] + '%' }">
                                    </div>
                                </div>
                            </div>
                            <div class="w-14 text-right flex-shrink-0">
                                <span class="text-lg font-bold" :style="{ color: trait.color }">
                                    {{ Math.round(response.scores[trait.key]) }}
                                </span>
                                <span class="text-xs text-slate-400">/100</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top 3 dominant traits highlight -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100">
                        <h2 class="font-semibold text-slate-900">⭐ Dominant Traits</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Top 3 scoring psychological dimensions</p>
                    </div>
                    <div class="p-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div v-for="(trait, i) in topTraits" :key="trait.key"
                            class="rounded-xl p-4 text-center border-2"
                            :style="{ borderColor: trait.color + '40', background: trait.color + '08' }">
                            <div class="text-3xl mb-2">{{ trait.icon }}</div>
                            <div class="text-xs font-bold uppercase tracking-wider mb-1" :style="{ color: trait.color }">
                                #{{ i + 1 }} {{ trait.label }}
                            </div>
                            <div class="text-2xl font-bold text-slate-900">{{ Math.round(trait.score) }}</div>
                            <div class="text-xs text-slate-400 mt-1">{{ trait.desc }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Games sidebar -->
            <div class="space-y-4">
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100">
                        <h2 class="font-semibold text-slate-900">🎮 Game Completion</h2>
                    </div>
                    <div class="p-4 space-y-2">
                        <div v-for="g in GAMES" :key="g.id"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg"
                            :style="{ background: response.completed_games.includes(g.id) ? g.color + '10' : '#F8FAFC' }">
                            <span class="text-lg">{{ g.icon }}</span>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-slate-700">{{ g.title }}</p>
                                <p class="text-xs text-slate-400">{{ g.subtitle }}</p>
                            </div>
                            <span v-if="response.completed_games.includes(g.id)"
                                class="w-5 h-5 rounded-full flex items-center justify-center text-white text-xs font-bold"
                                :style="{ background: g.color }">✓</span>
                            <span v-else class="w-5 h-5 rounded-full bg-slate-200 flex items-center justify-center text-slate-400 text-xs">–</span>
                        </div>
                    </div>
                </div>

                <!-- Score summary table -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100">
                        <h2 class="font-semibold text-slate-900">📊 Score Summary</h2>
                    </div>
                    <div class="divide-y divide-slate-50">
                        <div v-for="trait in TRAIT_LIST" :key="trait.key"
                            class="flex items-center justify-between px-5 py-2.5">
                            <div class="flex items-center gap-2">
                                <span class="text-base">{{ trait.icon }}</span>
                                <span class="text-sm text-slate-600">{{ trait.label }}</span>
                            </div>
                            <span class="text-sm font-bold" :style="{ color: trait.color }">
                                {{ Math.round(response.scores[trait.key]) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom nav -->
        <div class="mt-8 flex justify-between">
            <a href="/admin/talkheals-psychlab"
                class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors text-sm font-medium shadow-sm">
                ← Back to All Sessions
            </a>
            <button @click="showDeleteModal = true"
                class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 text-red-700 border border-red-200 rounded-lg hover:bg-red-100 transition-colors text-sm font-medium">
                Delete This Session
            </button>
        </div>

        <!-- Delete Modal -->
        <Transition enter-active-class="transition ease-out duration-200" enter-from-class="opacity-0" enter-to-class="opacity-100"
                    leave-active-class="transition ease-in duration-150" leave-from-class="opacity-100" leave-to-class="opacity-0">
            <div v-if="showDeleteModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
                <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6">
                    <div class="flex items-center justify-center w-12 h-12 bg-red-100 rounded-full mx-auto mb-4">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-900 text-center mb-2">Delete Session</h3>
                    <p class="text-slate-600 text-center mb-6">This will permanently delete this PsychLab session and all its data.</p>
                    <div class="flex space-x-3">
                        <button @click="showDeleteModal = false"
                            class="flex-1 px-4 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition-colors font-medium">Cancel</button>
                        <button @click="confirmDelete"
                            class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">Delete</button>
                    </div>
                </div>
            </div>
        </Transition>
    </AdminLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import AdminLayout from '../../../Components/Admin/AdminLayout.vue';

const props = defineProps({
    response: Object,
});

const showDeleteModal = ref(false);

const TRAIT_LIST = [
    { key: 'openness',   label: 'Openness',      icon: '🌀', desc: 'Curiosity & ambiguity',       color: '#8A5CF6' },
    { key: 'risk',       label: 'Risk Appetite',  icon: '⚡', desc: 'Boldness under uncertainty',  color: '#F59E0B' },
    { key: 'empathy',    label: 'Empathy',         icon: '🫀', desc: 'Emotional attunement',        color: '#EC4899' },
    { key: 'control',    label: 'Locus',           icon: '🧭', desc: 'Internal locus of control',   color: '#10B981' },
    { key: 'optimism',   label: 'Optimism',        icon: '☀️', desc: 'Orientation to possibility',  color: '#F97316' },
    { key: 'intuition',  label: 'Intuition',       icon: '💡', desc: 'Gut over logic',              color: '#06B6D4' },
    { key: 'resilience', label: 'Resilience',      icon: '🌿', desc: 'Bounce-back & grit',          color: '#84CC16' },
];

const GAMES = [
    { id: 'word',    title: 'Word Flash',     subtitle: 'First instinct only',         icon: '⚡', color: '#8A5CF6' },
    { id: 'inkblot', title: 'Shape Stories',  subtitle: 'What do you see?',            icon: '🔮', color: '#EC4899' },
    { id: 'dilemma', title: 'Split Seconds',  subtitle: '6 seconds to decide',         icon: '⚖️', color: '#F59E0B' },
    { id: 'memory',  title: 'Memory Imprint', subtitle: 'What stays with you?',        icon: '🧠', color: '#10B981' },
    { id: 'story',   title: 'Story Compass',  subtitle: 'You choose the ending',       icon: '📖', color: '#F97316' },
    { id: 'desert',  title: 'Desert Island',  subtitle: 'Forced choices reveal truth', icon: '🏝️', color: '#06B6D4' },
    { id: 'mirror',  title: 'Emotion Mirror', subtitle: 'Rate your inner weather',     icon: '🪞', color: '#84CC16' },
];

const topTraits = computed(() =>
    TRAIT_LIST
        .map(t => ({ ...t, score: props.response.scores[t.key] }))
        .sort((a, b) => b.score - a.score)
        .slice(0, 3)
);

const formatDate = (d) => new Date(d).toLocaleDateString('en-US', {
    year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit',
});

const markReviewed   = () => router.post(`/admin/talkheals-psychlab/${props.response.id}/mark-reviewed`);
const markUnreviewed = () => router.post(`/admin/talkheals-psychlab/${props.response.id}/mark-unreviewed`);

const confirmDelete = () => {
    router.delete(`/admin/talkheals-psychlab/${props.response.id}`, {
        onSuccess: () => { showDeleteModal.value = false; },
    });
};
</script>
