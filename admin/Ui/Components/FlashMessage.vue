<template>
  <div>
    <div v-if="$page.props.flash.error" class="text-red-500 border-red-500 bg-red-50 border p-5 rounded-lg mb-10 duration-1000">
      {{ $page.props.flash.error }}
    </div>
    <div v-if="$page.props.flash.success" class="text-emerald-500 border-green-500 bg-emerald-50 border p-5 rounded-lg mb-10 duration-1000">
      {{ $page.props.flash.success }}
    </div>
  </div>
</template>
