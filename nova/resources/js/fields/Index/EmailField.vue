<template>
  <div :class="`text-${field.textAlign}`">
    <a
      v-if="hasValue"
      @click.stop
      :href="`mailto:${field.value}`"
      class="link-default whitespace-nowrap"
      >{{ field.value }}</a
    >
    <p v-else>&mdash;</p>
  </div>
</template>

<script>
export default {
  props: ['resourceName', 'field'],

  computed: {
    /**
     * Determine if the field has a value other than null.
     */
    hasValue() {
      return this.field.value !== null
    },
  },
}
</script>
