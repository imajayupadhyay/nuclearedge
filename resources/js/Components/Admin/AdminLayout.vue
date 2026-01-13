<template>
    <div class="min-h-screen bg-slate-50">
        <AdminTopbar :user="user" />

        <div class="flex">
            <AdminSidebar />

            <main class="flex-1 ml-64 mt-16 p-8">
                <slot />
            </main>
        </div>
    </div>
</template>

<script setup>
import AdminTopbar from './AdminTopbar.vue';
import AdminSidebar from './AdminSidebar.vue';

defineProps({
    user: {
        type: Object,
        required: true
    }
});
</script>
