<template>
    <Head><title>TalkHeals PsychLab Responses - Admin Portal</title></Head>

    <AdminLayout :user="$page.props.auth.user">
        <!-- Header -->
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">TalkHeals PsychLab</h1>
                <p class="text-slate-600 mt-1">Psychological profiling game results from Namrata</p>
            </div>
            <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-purple-50 text-purple-700 border border-purple-200 rounded-lg text-sm font-medium">
                🔬 Confidential
            </span>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-600 mb-1">Total Sessions</p>
                        <p class="text-2xl font-bold text-slate-900">{{ stats.total }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-600 mb-1">Unreviewed</p>
                        <p class="text-2xl font-bold text-orange-600">{{ stats.unreviewed }}</p>
                    </div>
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-600 mb-1">Reviewed</p>
                        <p class="text-2xl font-bold text-purple-600">{{ stats.reviewed }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        <div v-if="$page.props.flash.success" class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center">
            <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="text-green-800">{{ $page.props.flash.success }}</span>
        </div>

        <!-- Filters -->
        <div class="mb-6 bg-white rounded-xl shadow-sm border border-slate-200 p-4">
            <div class="flex gap-2">
                <button @click="setFilter('')"
                    :class="['px-4 py-2 rounded-lg font-medium transition-colors text-sm',
                        !filters.filter ? 'bg-purple-600 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200']">
                    All ({{ stats.total }})
                </button>
                <button @click="setFilter('unreviewed')"
                    :class="['px-4 py-2 rounded-lg font-medium transition-colors text-sm',
                        filters.filter === 'unreviewed' ? 'bg-orange-500 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200']">
                    Unreviewed ({{ stats.unreviewed }})
                </button>
                <button @click="setFilter('reviewed')"
                    :class="['px-4 py-2 rounded-lg font-medium transition-colors text-sm',
                        filters.filter === 'reviewed' ? 'bg-purple-600 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200']">
                    Reviewed ({{ stats.reviewed }})
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">#</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Submitted</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Games Completed</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Top Traits</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-slate-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        <tr v-if="responses.data.length === 0">
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="text-6xl mb-4">🔬</div>
                                <p class="text-lg font-medium text-slate-500">No sessions yet</p>
                                <p class="text-sm text-slate-400 mt-1">PsychLab results will appear here once submitted</p>
                            </td>
                        </tr>
                        <tr v-for="r in responses.data" :key="r.id"
                            class="hover:bg-slate-50 transition-colors"
                            :class="{ 'bg-orange-50/40': !r.is_reviewed }">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="w-9 h-9 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center">
                                    <span class="text-white text-xs font-bold">#{{ r.id }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-slate-900">{{ formatDate(r.created_at) }}</div>
                                <div class="text-xs text-slate-500">{{ timeAgo(r.created_at) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <div class="flex gap-1">
                                        <span v-for="g in GAMES" :key="g.id"
                                            class="w-6 h-6 rounded-full flex items-center justify-center text-xs"
                                            :style="{
                                                background: r.completed_games.includes(g.id) ? g.color + '22' : '#F1F5F9',
                                                color: r.completed_games.includes(g.id) ? g.color : '#CBD5E1'
                                            }"
                                            :title="g.title">
                                            {{ g.icon }}
                                        </span>
                                    </div>
                                    <span class="text-sm text-slate-600 font-medium">{{ r.completed_games.length }}/7</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-1.5 flex-wrap">
                                    <span v-for="trait in getTopTraits(r.scores)" :key="trait.key"
                                        class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium"
                                        :style="{ background: trait.color + '18', color: trait.color }">
                                        {{ trait.icon }} {{ trait.label }}
                                        <span class="font-bold">{{ Math.round(trait.score) }}</span>
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span :class="['inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium',
                                    r.is_reviewed ? 'bg-purple-100 text-purple-800' : 'bg-orange-100 text-orange-800']">
                                    <span :class="['w-1.5 h-1.5 rounded-full mr-1.5',
                                        r.is_reviewed ? 'bg-purple-600' : 'bg-orange-500']"></span>
                                    {{ r.is_reviewed ? 'Reviewed' : 'Unreviewed' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm space-x-2">
                                <a :href="`/admin/talkheals-psychlab/${r.id}`"
                                    class="inline-flex items-center px-3 py-1.5 bg-purple-50 text-purple-700 rounded-lg hover:bg-purple-100 transition-colors">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    View
                                </a>
                                <button @click="deleteResponse(r)"
                                    class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition-colors">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div v-if="responses.data.length > 0" class="px-6 py-4 bg-slate-50 border-t border-slate-200">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-slate-600">
                        Showing {{ responses.from }} to {{ responses.to }} of {{ responses.total }} sessions
                    </div>
                    <div class="flex space-x-2">
                        <a v-for="link in responses.links" :key="link.label"
                            :href="link.url"
                            v-html="link.label"
                            :class="['px-3 py-2 text-sm rounded-lg transition-colors',
                                link.active ? 'bg-purple-600 text-white'
                                    : link.url ? 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-300'
                                    : 'bg-slate-100 text-slate-400 cursor-not-allowed']">
                        </a>
                    </div>
                </div>
            </div>
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
                    <p class="text-slate-600 text-center mb-6">Are you sure you want to delete this PsychLab session? This cannot be undone.</p>
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
import { ref } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import AdminLayout from '../../../Components/Admin/AdminLayout.vue';

const props = defineProps({
    responses: Object,
    filters:   Object,
    stats:     Object,
});

const showDeleteModal  = ref(false);
const responseToDelete = ref(null);

const TRAITS = {
    openness:   { label: 'Openness',   icon: '🌀', color: '#8A5CF6' },
    risk:       { label: 'Risk',        icon: '⚡', color: '#F59E0B' },
    empathy:    { label: 'Empathy',     icon: '🫀', color: '#EC4899' },
    control:    { label: 'Locus',       icon: '🧭', color: '#10B981' },
    optimism:   { label: 'Optimism',    icon: '☀️', color: '#F97316' },
    intuition:  { label: 'Intuition',   icon: '💡', color: '#06B6D4' },
    resilience: { label: 'Resilience',  icon: '🌿', color: '#84CC16' },
};

const GAMES = [
    { id: 'word',    title: 'Word Flash',     icon: '⚡', color: '#8A5CF6' },
    { id: 'inkblot', title: 'Shape Stories',  icon: '🔮', color: '#EC4899' },
    { id: 'dilemma', title: 'Split Seconds',  icon: '⚖️', color: '#F59E0B' },
    { id: 'memory',  title: 'Memory Imprint', icon: '🧠', color: '#10B981' },
    { id: 'story',   title: 'Story Compass',  icon: '📖', color: '#F97316' },
    { id: 'desert',  title: 'Desert Island',  icon: '🏝️', color: '#06B6D4' },
    { id: 'mirror',  title: 'Emotion Mirror', icon: '🪞', color: '#84CC16' },
];

const getTopTraits = (scores) =>
    Object.entries(scores)
        .map(([key, score]) => ({ key, score, ...TRAITS[key] }))
        .sort((a, b) => b.score - a.score)
        .slice(0, 3);

const setFilter = (filter) => {
    router.get('/admin/talkheals-psychlab', { filter: filter || undefined }, { preserveState: true, replace: true });
};

const formatDate = (d) => new Date(d).toLocaleDateString('en-US', {
    year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit',
});

const timeAgo = (d) => {
    const diff  = Date.now() - new Date(d).getTime();
    const mins  = Math.floor(diff / 60000);
    const hours = Math.floor(diff / 3600000);
    const days  = Math.floor(diff / 86400000);
    if (mins < 60)  return `${mins}m ago`;
    if (hours < 24) return `${hours}h ago`;
    return `${days}d ago`;
};

const deleteResponse = (r) => { responseToDelete.value = r; showDeleteModal.value = true; };
const confirmDelete  = () => {
    router.delete(`/admin/talkheals-psychlab/${responseToDelete.value.id}`, {
        onSuccess: () => { showDeleteModal.value = false; responseToDelete.value = null; },
    });
};
</script>
