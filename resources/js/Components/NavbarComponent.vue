<script setup>
import { House, Search, ArrowDown } from 'lucide-vue-next';
import { ref, useTemplateRef, watch } from 'vue';
import { useFocus } from '@vueuse/core';
import { Input } from '@/Components/ui/input/index.js';
import { Link, router } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import {
    Popover,
    PopoverContent,
    PopoverAnchor,
} from '@/Components/ui/popover/index.js';
import { usePage } from '@inertiajs/vue3';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuTrigger,
    DropdownMenuItem,
} from '@/Components/ui/dropdown-menu/index.js';

const page = usePage();

const searchInput = useTemplateRef('searchInput');
const { focused: searchInputFocused } = useFocus(searchInput);
const popoverOpen = ref(false);

const redirect = (direction) => {
    if (direction === 'dashboard') {
        router.visit(route('dashboard'));
    }
    if (direction === 'profile') {
        router.visit(route('profile.edit'));
    }
    if (direction === 'logout') {
        router.post(route('logout'));
    }
};

const focusOnSearch = () => {
    searchInputFocused.value = true;
};

watch(searchInputFocused, (focused) => {
    popoverOpen.value = focused;
});
</script>

<template>
    <div class="mt-1 mx-1 rounded bg-ui-surface px-4 text-ui-text sm:px-6 lg:px-4">
        <div class="flex h-16 flex-row items-center justify-between">
            <div>
                <Link :href="route('dashboard')">
                    <ApplicationLogo class="h-9 fill-current text-ui-text" />
                </Link>
            </div>

            <div class="flex flex-row items-center gap-4">
                <div
                    class="cursor-pointer rounded-full bg-ui-accent-secondary p-2 duration-300 hover:bg-ui-accent-secondary/40"
                >
                    <House @click="redirect('dashboard')" />
                </div>

                <Popover :open="popoverOpen">
                    <PopoverAnchor as-child>
                        <div
                            class="flex flex-row items-center gap-3 rounded-lg border border-transparent bg-black px-2 duration-300 focus-within:border-white"
                        >
                            <Search
                                class="cursor-pointer"
                                @click="focusOnSearch"
                            />
                            <Input
                                class="min-w-72 border-none focus:outline-none focus:ring-0 focus:ring-offset-0 focus-visible:ring-0 focus-visible:ring-offset-0"
                                ref="searchInput"
                                placeholder="Mit szeretnél lejátszani?"
                            />
                        </div>
                    </PopoverAnchor>
                    <PopoverContent
                        class="!w-[--reka-popper-anchor-width] border-none bg-ui-accent-secondary text-ui-text"
                    >
                        <div class="grid gap-4">
                            <div class="space-y-2">
                                <h4 class="font-medium leading-none">
                                    Utosló keresések
                                </h4>
                                <p class="text-sm text-muted-foreground">
                                    Itt lesz megvalósítva a keresés
                                </p>
                            </div>
                        </div>
                    </PopoverContent>
                </Popover>
            </div>
            <div>
                <DropdownMenu>
                    <DropdownMenuTrigger>
                        <div
                            class="flex flex-row items-center gap-1 hover:text-ui-muted"
                        >
                            {{ page.props.auth.user.name }}

                            <ArrowDown class="size-4" />
                        </div>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent
                        class="border-black bg-ui-surface p-3 text-ui-text"
                    >
                        <DropdownMenuItem @click="redirect('profile')">
                            Profile</DropdownMenuItem
                        >
                        <DropdownMenuItem @click="redirect('logout')"
                            >Logout</DropdownMenuItem
                        >
                    </DropdownMenuContent>
                </DropdownMenu>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
