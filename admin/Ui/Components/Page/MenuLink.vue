<template>
    <Link
        :method="method"
        as="a"
        :href="routeIndex"
        :class="[
                routes.includes(route().current()) ? 'font-bold text-red-600' : '',
                props.class,
            ]"
    >
          <span>
              <svg
                  v-bind="$attrs"
                  class="group-hover:scale-105 group-hover:fill-red-600 duration-100 delay-75"
                  width="32"
                  height="26"
                  viewBox="0 0 32 26"
                  :fill="routes.includes(route().current()) ? '#E3272F' : '#A3A3A3'"

                  xmlns="http://www.w3.org/2000/svg">
                  <slot></slot>
            </svg>
          </span>
        <span
            v-if="sidebar"
            class="group-hover:text-red-600 group-hover:scale-105 duration-100 delay-75"
        >
            {{title}}
        </span>
    </Link>
</template>

<script setup>
import {computed, ref} from "vue";

const props = defineProps({
    title: String,
    class: {
        type: String,
        default: 'flex flex-row gap-8 justify-start items-center group pr-5 cursor-pointer'
    },
    sidebar:Boolean,
    routeBase: String,
    routeName: {
        type: String,
        default: null
    },
    routes:{
        type: [Object,Array],
        default: []
    },
    method: {
        default: ''
    }
})
const routes = ref(props.routes)
const routeIndex = computed(() => props.routeName!==null ? route('admin.'+props.routeName) : route('admin.'+props.routeBase+'.index'))
if(props.routeBase)
    routes.value = [
        'admin.'+ props.routeBase +'.index',
        'admin.'+ props.routeBase +'.create',
        'admin.'+ props.routeBase +'.profile',
    ]
else
    routes.value = [props.route]

function isActive(route){
    return route
}
</script>

<style lang="scss" scoped></style>
