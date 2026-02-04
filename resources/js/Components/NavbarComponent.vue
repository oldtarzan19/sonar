<script setup>
import { House, Search } from 'lucide-vue-next';
import { ref, useTemplateRef, watch } from 'vue';
import { useFocus } from '@vueuse/core';
import { Input } from '@/Components/ui/input/index.js';
import { Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import {
    Popover,
    PopoverContent,
    PopoverAnchor,
} from '@/Components/ui/popover/index.js';
import { usePage } from '@inertiajs/vue3';

const page = usePage();

const searchInput = useTemplateRef('searchInput');
const { focused: searchInputFocused } = useFocus(searchInput);
const popoverOpen = ref(false);

const focusOnSearch = () => {
    searchInputFocused.value = true;
};

watch(searchInputFocused, (focused) => {
    popoverOpen.value = focused;
});

</script>

<template>
    <div class="m-1 rounded bg-ui-surface px-4 text-ui-text sm:px-6 lg:px-4">
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
                    <House />
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
                {{ page.props.auth.user.name }}
            </div>
        </div>
    </div>
</template>

<style scoped></style>
