<script setup>
import NavbarComponent from '@/Components/NavbarComponent.vue';
import BottomPlayerComponent from '@/Components/BottomPlayerComponent.vue';
</script>

<template>
    <div class="h-screen overflow-hidden bg-ui-bg">
        <div class="flex h-full flex-col">
            <nav>
                <!-- Primary Navigation Menu -->
                <NavbarComponent />
            </nav>

            <!--            Sidebar-->
            <div class="flex min-h-0 flex-1 overflow-hidden">
                <!-- SIDEBAR (mindig látszik, saját scroll ha kell) -->
                <aside
                    class="m-1 hidden  shrink-0 overflow-y-auto rounded bg-ui-surface text-ui-text lg:flex"
                >
                    <div class="flex flex-col space-y-6 p-4 pt-5">
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

            <div>
                <!--  Player Component-->
                <BottomPlayerComponent/>
            </div>
        </div>
    </div>
</template>
