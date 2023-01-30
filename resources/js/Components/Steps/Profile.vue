<template>
    <div class="tabs">
        <a class="tab tab-bordered">Tab 1</a>
        <a class="tab tab-bordered">Tab 2</a>
        <a class="tab tab-bordered tab-active">Tab 3</a>
    </div>
    <div class="my-4 h-full">
        <form>
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <!-- head -->
                    <thead>
                        <tr>
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
                            <td><input type="text" placeholder="Type here" class="input input-bordered input-info w-full max-w-xs" /></td>
                            <td><input type="text" placeholder="Type here" class="input input-bordered input-info w-full max-w-xs" /></td>
                            <td><input type="text" placeholder="Type here" class="input input-bordered input-info w-full max-w-xs" /></td>
                            <td><input type="text" placeholder="Type here" class="input input-bordered input-info w-full max-w-xs" /></td>
                        </tr>
                        <!-- row 1 -->
                        <tr>
                            <th>Tuesday</th>
                            <td><input type="text" placeholder="Type here" class="input input-bordered input-info w-full max-w-xs" /></td>
                            <td><input type="text" placeholder="Type here" class="input input-bordered input-info w-full max-w-xs" /></td>
                            <td><input type="text" placeholder="Type here" class="input input-bordered input-info w-full max-w-xs" /></td>
                            <td><input type="text" placeholder="Type here" class="input input-bordered input-info w-full max-w-xs" /></td>
                        </tr>
                        <!-- row 1 -->
                        <tr>
                            <th>Wednesday</th>
                            <td><input type="text" placeholder="Type here" class="input input-bordered input-info w-full max-w-xs" /></td>
                            <td><input type="text" placeholder="Type here" class="input input-bordered input-info w-full max-w-xs" /></td>
                            <td><input type="text" placeholder="Type here" class="input input-bordered input-info w-full max-w-xs" /></td>
                            <td><input type="text" placeholder="Type here" class="input input-bordered input-info w-full max-w-xs" /></td>
                        </tr>
                        <!-- row 1 -->
                        <tr>
                            <th>Thursday</th>
                            <td><input type="text" placeholder="Type here" class="input input-bordered input-info w-full max-w-xs" /></td>
                            <td><input type="text" placeholder="Type here" class="input input-bordered input-info w-full max-w-xs" /></td>
                            <td><input type="text" placeholder="Type here" class="input input-bordered input-info w-full max-w-xs" /></td>
                            <td><input type="text" placeholder="Type here" class="input input-bordered input-info w-full max-w-xs" /></td>
                        </tr>
                        <!-- row 1 -->
                        <tr>
                            <th>Friday</th>
                            <td><input type="text" placeholder="Type here" class="input input-bordered input-info w-full max-w-xs" /></td>
                            <td><input type="text" placeholder="Type here" class="input input-bordered input-info w-full max-w-xs" /></td>
                            <td><input type="text" placeholder="Type here" class="input input-bordered input-info w-full max-w-xs" /></td>
                            <td><input type="text" placeholder="Type here" class="input input-bordered input-info w-full max-w-xs" /></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</template>

<script>
</script>