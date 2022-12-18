<template>
  <div>
    <div v-if="$page.props.flash.error" class="message-error">
      {{ $page.props.flash.error }}
    </div>
    <div v-if="$page.props.flash.success" class="message-success">
      {{ $page.props.flash.success }}
    </div>
  </div>
</template>
