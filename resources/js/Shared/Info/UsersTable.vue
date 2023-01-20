<script setup>
    import { ref } from 'vue'

    const users = [
        {
            "name": "John",
            "email": "john@example.com",
            "job": "Technician",
            "status": "Active"
        },
        {
            "name": "Jack",
            "email": "jack@example.com",
            "job": "Teacher",
            "status": "Active"
        },
        {
            "name": "Trudy",
            "email": "trudy@gmail.com",
            "job": "Administrative",
            "status": "Leave"
        }
    ]

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
                <tr v-for="user of users">
                    <td>
                        <div class="flex items-center space-x-3">
                            <div class="avatar">
                                <div class="mask mask-squircle w-12 h-12">
                                    <img :src="imgURL"
                                        alt="Avatar Tailwind CSS Component" />
                                </div>
                            </div>
                            <div>
                                <div class="font-bold">{{ user.name }}</div>
                                <div class="text-sm opacity-50">{{ user.email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        {{ user.job }}
                    </td>
                    <td>
                        <div class="indicator ">
                        <span class="indicator-item indicator-middle indicator-start badge" :class="{'badge-success': user.status === 'Active', 'badge-error': user.status === 'Leave'}"></span>
                        <div class="ml-6">{{ user.status }}</div>
                        </div>
                    </td>
                    <th>
                        <button class="btn btn-ghost btn-xs">details</button>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
</template>