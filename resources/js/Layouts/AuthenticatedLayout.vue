<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="h-screen overflow-hidden bg-ui-bg">
        <div class="flex h-full flex-col">
            <nav>
                <!-- Primary Navigation Menu -->
                <div class="bg-ui-surface px-4 sm:px-6 lg:px-4 m-1 text-ui-text rounded">
                    <div
                        class="flex h-16 flex-row items-center justify-between"
                    >
                        <div>
                            <Link :href="route('dashboard')">
                                <ApplicationLogo
                                    class="h-9 fill-current text-ui-text"
                                />
                            </Link>
                        </div>

                        <div>Közép</div>
                        <div>jobb</div>
                    </div>
                </div>
            </nav>

            <!--            Sidebar-->
            <div class="flex min-h-0 flex-1 overflow-hidden">
                <!-- SIDEBAR (mindig látszik, saját scroll ha kell) -->
                <aside
                    class="m-1 hidden w-16 shrink-0 overflow-y-auto rounded bg-ui-surface text-ui-text lg:flex"
                >
                    <div class="flex flex-col space-y-6 p-3 pt-5">
                        <div>Ikon 1</div>
                        <div>Ikon 2</div>
                        <div>Ikon 3</div>
                    </div>
                </aside>

                <!-- MAIN: csak ez görgethető -->
                <main class="m-1 min-h-0 flex-1 overflow-y-auto">
                    <slot />
                </main>
            </div>

            <div
                class="flex h-20 w-full flex-row items-center justify-between px-4 bg-ui-surface text-ui-text mx-1 rounded"
            >
                <div>bal</div>
                <div>Közép</div>
                <div>jobb</div>
            </div>
        </div>
    </div>
</template>
