<script>
    const props = defineProps({
        user: Object
    })
</script>

<template>
    <div class="stats stats-vertical shadow bg-slate-200 dark:bg-slate-800">
        <div class="stat">
           <div class="stat-title">DNI</div>
           <div class="stat-value">{{ user.dni }}</div>
        </div>
        <div class="stat">
            <div class="stat-title">Phone</div>
            <div class="stat-value">{{ user.phone}}</div>
        </div>
        <div class="stat">
            <div class="stat-title">Puesto</div>
            <div class="stat-value">{{ user.role.role_name }}</div>
        </div>
        <div class="stat">
            <div class="stat-title">Email</div>
            <div class="stat-value">{{ user. }}</div>
        </div>
    </div>
</template>