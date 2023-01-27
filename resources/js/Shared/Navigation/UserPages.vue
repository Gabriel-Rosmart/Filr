<script setup>
import { ref } from 'vue';
import HomeIcon from '../Icons/HomeIcon.vue';
import statsIcon from '../Icons/statsIcon.vue';
import infoIcon from '../Icons/infoIcon.vue';
import { Link } from '@inertiajs/inertia-vue3';

var props = defineProps({
    activePage: String
})
const isActiveDash = ref(false);
const isActiveWarns = ref(false);
const isActiveStats = ref(false);

switch (props.activePage) {
    case 'Dashboard':
        isActiveDash.value = true;
        isActiveWarns.value = false;
        isActiveStats.value = false;
        break;
    case 'Warns':
        isActiveDash.value = false;
        isActiveWarns.value = true;
        isActiveStats.value = false;
        break;
    case 'Stats':
        isActiveDash.value = false;
        isActiveWarns.value = false;
        isActiveStats.value = true;
        break;
}

</script>



<template>
    <div class="flex justify-center content-center">
        <div class="tabs">
            <Link href='/user'>
            <a class="tab tab-bordered" :class="{ 'tab-active': isActiveDash }">
                <HomeIcon class="w-20" />
            </a>
            </Link>

            <Link href='/user/warnings'>
            <a class="tab tab-bordered" :class="{ 'tab-active': isActiveWarns }">
                <infoIcon class="w-20" />
            </a>

            </Link>

            <a class="tab tab-bordered" :class="{ 'tab-active': isActiveStats }">
                <statsIcon class="w-20" />
            </a>
        </div>
    </div>
    <!-- <div class="btn-group">

        <button class="btn " :class="{ 'btn-active': isActiveDash }">
            <HomeIcon class="h-5 w-96" fill="none" />
        </button>

        <button class="btn" :class="{ 'btn-active': isActiveWarns }">
            <infoIcon class="h-5 w-96" fill="none" />
        </button>

        <button class="btn" :class="{ 'btn-active': isActiveStats }">
            <statsIcon class="h-5 w-96" fill="none" />
        </button>

    </div> -->
</template>