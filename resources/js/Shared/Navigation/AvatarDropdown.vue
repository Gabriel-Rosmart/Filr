<script setup>

    /** Icons imports */
    import { LogOutIcon,  UserIcon } from '../Icons/Icons';

    /** Component imports */
    import { Link } from '@inertiajs/inertia-vue3'

    /** Config import */
    import appconfig from '@/appconfig'
</script>

<template>
    <div class="dropdown dropdown-end mx-4">
      <label tabindex="0" class="btn btn-ghost btn-circle avatar">
        <div class="w-10 rounded-full">
          <img :src="appconfig.STORAGE_URL + '0fe194e2c89b5188129fbbcff5781d60001129fc684039ab57ca8364913339ae.jpg'" />
        </div>
      </label>
      <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
        <li>
          <Link>
            <UserIcon/>
            Editar Perfil
          </Link>
        </li>
        <li>
            <Link as="button" href="/logout" method="post">
                <LogOutIcon/>
                Cerrar Sesión
            </Link>
        </li>
      </ul>
    </div>
</template>