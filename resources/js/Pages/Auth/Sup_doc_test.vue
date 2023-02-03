<template>
    <div>
        <v-container>
            <h1 class="text-center">Formulario</h1>
            <div class="flex flex-col">
                <input v-for="(campo, index) in campos" :key="index" :type="campo.type" :placeholder="campo.placeholder"
                    :class="campo.class" />
            </div>
        </v-container>
    </div>
</template>

<script>
export default {
    data() {
        return {
            campos: [
                {
                    type: 'text',
                    placeholder: 'Type here',
                    class: 'input input-bordered input-primary w-full max-w-xs',
                },
                {
                    type: 'date',
                    placeholder: 'Type here',
                    class: 'input input-bordered input-primary w-full max-w-xs',
                },
                {
                    type: 'text',
                    placeholder: 'Type here',
                    class: 'input input-bordered input-primary w-full max-w-xs',
                },
            ]
        }
    }
}
</script>

<style>

</style>