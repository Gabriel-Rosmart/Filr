<template>
    <div class="object-center">
        <ul class="steps">
            <li class="step step-primary"></li>
            <li class="step step-primary"></li>
            <li class="step"></li>
        </ul>
    </div>
    <div class="my-4">
        <form>
            <div class="flex">
                <div class="p-5">
                    <div class="mb-4">
                        <label class="block mb-1" for="email">Date in</label>
                        <input type="text" placeholder="Type here"
                            class="input input-bordered input-primary w-full max-w-xs" />
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1" for="email">Date out</label>
                        <input type="text" placeholder="Type here"
                            class="input input-bordered input-primary w-full max-w-xs" />
                    </div>
                    <div class="form-control">
                        <label class="cursor-pointer label">
                            <span class="label-text">Admin</span>
                            <input type="checkbox" class="checkbox checkbox-secondary" />
                        </label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: 'About',
}
</script>