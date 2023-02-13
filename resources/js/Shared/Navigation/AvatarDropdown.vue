<script setup>

  /** Icons imports */
  import { LogOutIcon,  UserIcon } from '../Icons/Icons';

  /** Component imports */
  import { Link } from '@inertiajs/inertia-vue3'

  /** Config import */
  import appconfig from '@/appconfig'

  /** Function imports */
  import { useI18n } from 'vue-i18n'

  import { onBeforeMount, ref } from 'vue';

  const { t } = useI18n()

  
  const pic  = ref('')

  onBeforeMount(() => {
      axios.get('/avatar').then((response) => pic.value = response.data)
  })
</script>

<template>
    <div class="dropdown dropdown-end mx-4">
      <label tabindex="0" class="btn btn-ghost btn-circle avatar">
        <div class="w-10 rounded-full">
          <img :src="appconfig.STORAGE_URL + pic" />
        </div>
      </label>
      <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
        <li>
          <Link>
            <UserIcon/>
            {{ t('admin.navbar.avatar.profile') }}
          </Link>
        </li>
        <li>
            <Link as="button" href="/logout" method="post">
                <LogOutIcon/>
                {{ t('admin.navbar.avatar.logout') }}
            </Link>
        </li>
      </ul>
    </div>
</template>