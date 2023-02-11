<script setup>

    /** Component imports */
    import Steps from '@/Shared/Navigation/Steps.vue'
    import FormTextInput from '@/Shared/Forms/FormTextInput.vue'
    import FormLabel from '@/Shared/Forms/FormLabel.vue'
    import { useForm } from '@inertiajs/inertia-vue3'

    /** Function imports */
    import { ref } from 'vue'

    let currentStep = ref(0)

    const form = useForm({
        email: '',
    });

    const submit = () => {
        /*
        form.post(route('login'), {
            onFinish: () => form.reset('password'),
        });
        */
    };

</script>

<template>
    <div class="flex justify-center mt-24">
        <form @submit.prevent="">
            <div class="w-full flex justify-center">
                <Steps :index="currentStep" class="w-full"/>
            </div>
            <!-- Step 1 of form -->
            <div class="flex flex-col mt-2 p-4">
                <div class="flex" v-show="currentStep == 0">
                    <div class="flex flex-col p-8">
                        <FormLabel value="Name" />
                        <FormTextInput type="text" class="mt-1 block w-full mb-6" required/>

                        <FormLabel value="DNI" />
                        <FormTextInput type="text" class="mt-1 block w-full" required/>
                    </div>
                    <div class="flex flex-col p-8">
                        <FormLabel value="Email" />
                        <FormTextInput type="email" class="mt-1 block w-full mb-6" required/>

                        <FormLabel value="Telephone" />
                        <FormTextInput type="telephone" class="mt-1 block w-full" required/>
                    </div>
                </div>
                <!-- Step 2 of form -->
                <div class="flex mt-2 p-4" v-show="currentStep == 1">
                    <input type="date" class="input input-bordered dark:input-primary w-full max-w-xs focus:border-none focus:ring-0">
                    <input type="date" class="input input-bordered dark:input-primary w-full max-w-xs focus:border-none focus:ring-0">
                </div>
                <!-- Step 3 of form -->
                <div class="overflow-x-auto" v-show="currentStep == 2">
                    <table class="table w-full">
                        <!-- head -->
                        <thead>
                            <tr class="">
                                <th>Weekday</th>
                                <th>Date In (Morning)</th>
                                <th>Date Out (Morning)</th>
                                <th>Date In (Afternoon)</th>
                                <th>Date Out (Afternoon)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->
                            <tr>
                                <th>Monday</th>
                                <td><input type="text" placeholder="Type here"
                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                <td><input type="text" placeholder="Type here"
                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                <td><input type="text" placeholder="Type here"
                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                <td><input type="text" placeholder="Type here"
                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                            </tr>
                            <!-- row 1 -->
                            <tr>
                                <th>Tuesday</th>
                                <td><input type="text" placeholder="Type here"
                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                <td><input type="text" placeholder="Type here"
                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                <td><input type="text" placeholder="Type here"
                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                <td><input type="text" placeholder="Type here"
                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                            </tr>
                            <!-- row 1 -->
                            <tr>
                                <th>Wednesday</th>
                                <td><input type="text" placeholder="Type here"
                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                <td><input type="text" placeholder="Type here"
                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                <td><input type="text" placeholder="Type here"
                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                <td><input type="text" placeholder="Type here"
                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                            </tr>
                            <!-- row 1 -->
                            <tr>
                                <th>Thursday</th>
                                <td><input type="text" placeholder="Type here"
                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                <td><input type="text" placeholder="Type here"
                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                <td><input type="text" placeholder="Type here"
                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                <td><input type="text" placeholder="Type here"
                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                            </tr>
                            <!-- row 1 -->
                            <tr>
                                <th>Friday</th>
                                <td><input type="text" placeholder="Type here"
                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                <td><input type="text" placeholder="Type here"
                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                <td><input type="text" placeholder="Type here"
                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                                <td><input type="text" placeholder="Type here"
                                        class="input input-bordered input-info w-full max-w-xs" /></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Butttons -->
                <div class="flex justify-end mr-8 mt-4">
                    <button class="btn btn-outline btn-primary mr-4"
                        @click="currentStep--"
                        v-show="currentStep > 0">
                        Previous
                    </button>
                    <button class="btn btn-outline btn-primary"
                        @click="currentStep++"
                        v-show="currentStep < 2">
                        Next
                    </button>
                    <button class="btn btn-outline btn-primary"
                        @click="submit"
                        v-show="currentStep == 2">
                        Send
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>