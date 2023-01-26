<script setup>
    import { ref } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3'

    const props = defineProps({
        users: Array,
        filters: Object
    })

    const highlight = (text, reg) => {
        if(reg == null) return text
        return text.replace(new RegExp(reg, "gi"), match => {
            return '<span class="text-red-600">' + match + '</span>'
        })
    }

    const imgURL = ref('https://imgv3.fotor.com/images/blog-cover-image/10-profile-picture-ideas-to-make-you-stand-out.jpg')
</script>

<template>
    <div class="overflow-x-auto w-full">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Job</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user of users" class="hover">
                    <td>
                        <div class="flex items-center space-x-3">
                            <div class="avatar">
                                <div class="mask mask-squircle w-12 h-12">
                                    <img :src="imgURL"
                                        alt="Avatar Tailwind CSS Component" />
                                </div>
                            </div>
                            <div>
                                <div class="font-bold" v-html="highlight(user.name, filters.search)"></div>
                                <div class="text-sm opacity-50" v-html="highlight(user.email, filters.search)"></div>
                            </div>
                        </div>
                    </td>
                    <td>
                        {{ user.role.role_name }}
                    </td>
                    <td>
                        <div class="indicator ">
                        <span class="indicator-item indicator-middle indicator-start badge h-2" :class="{'badge-info': user.active, 'badge-error': !user.active}"></span>
                        <div class="ml-6">{{ user.active ? 'Active' : 'Leave' }}</div>
                        </div>
                    </td>
                    <th>
                        <Link as="button" class="btn btn-ghost btn-xs">details</Link>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
</template>