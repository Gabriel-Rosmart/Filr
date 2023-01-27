<template>
    <div>
        <ul class="steps">
            <li class="step step-primary"></li>
            <li class="step step-primary"></li>
            <li class="step step-primary"></li>
        </ul>
    </div>
    <div class="my-4">
        <form>
            <div class="flex">
                <div class="p-5">
                    <div>
                        <div class="mb-4">
                            <label class="block mb-1" for="email">Name and Surname</label>
                            <input type="text" placeholder="Type here"
                                class="input input-bordered input-primary w-full max-w-xs" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: 'Profile',
}
</script>