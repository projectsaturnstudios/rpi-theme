<template>
    <div class="layout-sidebar">
        <div class="sidebar-header">
            <a href="/" class="app-logo">
                <div class="app-logo-normal">
                    <img src="/pi-logo.png" alt="Pironman 5" />
                </div>
                <div class="app-logo-small">
                    <img src="/pi-logo.png" alt="Pironman 5" />
                </div>
            </a>
        </div>

        <div class="layout-menu-container">
            <ul class="layout-menu" role="menu">
                <li class="layout-root-menuitem" role="none">
                    <a
                        href="/"
                        class="layout-root-menuitem-link"
                        role="menuitem"
                        v-tooltip.right="{ value: 'Home', showDelay: 150 }"
                    >
                        <i class="layout-menuitem-icon pi pi-home" />
                        <span class="layout-menuitem-text">Home</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup lang="ts">
import Tooltip from 'primevue/tooltip';

const vTooltip = Tooltip;
</script>

<style scoped></style>
