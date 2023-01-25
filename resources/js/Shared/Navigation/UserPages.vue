<script setup>
import { ref } from 'vue';
import HomeIcon from '../Icons/HomeIcon.vue';
import statsIcon from '../Icons/statsIcon.vue';
import infoIcon from '../Icons/infoIcon.vue';

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
    <div class="btn-group">

        <button class="btn " :class="{ 'btn-active': isActiveDash }">
            <HomeIcon class="h-5 w-96" fill="none" />
        </button>

        <button class="btn" :class="{ 'btn-active': isActiveWarns }">
            <infoIcon class="h-5 w-96" fill="none" />
        </button>

        <button class="btn" :class="{ 'btn-active': isActiveStats }">
            <statsIcon class="h-5 w-96" fill="none" />
        </button>

    </div>
</template>