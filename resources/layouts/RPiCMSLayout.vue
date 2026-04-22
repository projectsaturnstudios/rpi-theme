<template>
    <div
        id="rpi-theme-layout"
        class="layout-wrapper layout-slim"
        :class="{ 'layout-mobile-active': mobileMenuOpen }"
    >
        <RPiLayoutSidebar />

        <div class="layout-mask" @click="closeMobileMenu" />

        <div class="layout-content-wrapper">
            <RPiLayoutTopbar
                :breadcrumbs="props.breadcrumbs"
                @toggle-menu="toggleMobileMenu"
            />
            <div class="layout-content">
                <slot name="content" />
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, watch } from 'vue';
import type { BreadcrumbItem } from '@/types';
import RPiLayoutTopbar from '../components/ui/RPiLayoutTopbar.vue';
import RPiLayoutSidebar from '../components/ui/RPiLayoutSidebar.vue';

interface RPiCMSLayoutProps {
    breadcrumbs?: BreadcrumbItem[];
}

const props = withDefaults(defineProps<RPiCMSLayoutProps>(), {
    breadcrumbs: () => [],
});

const mobileMenuOpen = ref(false);

function toggleMobileMenu() {
    mobileMenuOpen.value = !mobileMenuOpen.value;
}

function closeMobileMenu() {
    mobileMenuOpen.value = false;
}

watch(mobileMenuOpen, (open) => {
    if (open) {
        document.body.classList.add('blocked-scroll');
    } else {
        document.body.classList.remove('blocked-scroll');
    }
});
</script>

<style scoped></style>
