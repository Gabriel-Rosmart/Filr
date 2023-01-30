<template>
    <div class="tabs">
        <a class="tab tab-bordered tab-active">Tab 1</a>
        <a class="tab tab-bordered">Tab 2</a>
        <a class="tab tab-bordered">Tab 3</a>
    </div>
    <div class="my-7">
        <form>
            <div class="grid grid-cols-2 ">
                <div class="mx-7">
                    <div class="mb-4">
                        <label class="block mb-1" for="email">Name and Surname</label>
                        <input type="text" placeholder="Type here"
                            class="input input-bordered input-primary w-full max-w-xs" />
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1" for="email">DNI</label>
                        <input type="text" placeholder="Type here"
                            class="input input-bordered input-primary w-full max-w-xs" />
                    </div>
                </div>
                <div class="mx-7">
                    <div class="mb-4">
                        <label class="block mb-1" for="email">Email</label>
                        <input type="email" placeholder="Type here"
                            class="input input-bordered input-primary w-full max-w-xs" />
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1" for="email">Telephone</label>
                        <input type="number" placeholder="Type here"
                            class="input input-bordered input-primary w-full max-w-xs" />
                    </div>
                </div>
                <div class="form-control mx-7 mt-4">
                    <label class="cursor-pointer label">
                        <span class="label-text">Its Admin?</span>
                        <input type="checkbox" class="checkbox checkbox-secondary" />
                    </label>
                </div>
            </div>
        </form>
    </div>
</template>

<script>

</script>