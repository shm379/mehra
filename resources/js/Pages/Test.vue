<template>
    <div min-h-screen bg-slate-100 border-2 border-slate-300>
        <h1>خوش آمدید</h1>
        <div class="rounded-lg bg-gray-300">
            <nav>
                <ul>
                    <li>
                        <Link href="/users">users</Link>
                    </li>
                    <li>
                        <Link href="/settings">Setting</Link>
                    </li>
                    <li>
                        <Link href="/orders">Orders</Link>
                    </li>
                    <li>
                        <Link href="/comments">Comments</Link>
                    </li>
                    <li>
                        <Link as="button" method="post" href="/logout">Logout</Link>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script setup>
import {Link} from '@inertiajs/inertia-vue3'
import {ref, defineProps} from "vue";
const props = defineProps({
    name: String
})
const myvar = ref(1)
function dothis(){
    myvar.value = myvar.value + 2
}
</script>

<style lang="scss" scoped>

</style>
