<template>
    <div class="tabs">
        <a class="tab tab-bordered">Tab 1</a>
        <a class="tab tab-bordered tab-active">Tab 2</a>
        <a class="tab tab-bordered">Tab 3</a>
    </div>
    <div class="my-7">
        <form>
            <div class="flex">
                <div class="grid grid-cols-2">
                    <div class="mb-4 mx-7">
                        <label class="block mb-1" for="email">Date in</label>
                        <input type="date" placeholder="Type here"
                            class="input input-bordered input-primary w-full max-w-xs" />
                    </div>
                    <div class="mb-4 mx-7">
                        <label class="block mb-1" for="email">Date out</label>
                        <input type="date" placeholder="Type here"
                            class="input input-bordered input-primary w-full max-w-xs" />
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>

</script>