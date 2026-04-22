<template>
    <div class="layout-topbar">
        <div class="topbar-start">
            <button
                class="topbar-menubutton p-link"
                type="button"
                @click="$emit('toggle-menu')"
            >
                <i class="pi pi-bars" />
            </button>
            <div class="topbar-breadcrumb">
                <div class="layout-breadcrumb relative flex h-12 items-center">
                    <nav>
                        <ol class="relative z-20">
                            <li class="font-bold">
                                <span
                                    v-for="(crumb, idx) in props.breadcrumbs"
                                    :key="`${idx}-${crumb.label}`"
                                >
                                    {{ idx > 0 ? ' / ' : '' }}
                                    {{ crumb.label }}
                                </span>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="layout-end" />
    </div>
</template>

<script setup lang="ts">
import type { BreadcrumbItem } from '@/types';

interface RPiLayoutTopbarProps {
    breadcrumbs?: BreadcrumbItem[];
}

const props = withDefaults(defineProps<RPiLayoutTopbarProps>(), {
    breadcrumbs: () => [],
});

defineEmits<{
    'toggle-menu': [];
}>();
</script>

<style scoped></style>
