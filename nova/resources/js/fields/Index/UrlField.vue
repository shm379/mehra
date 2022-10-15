<template>
  <div :class="`text-${field.textAlign}`">
    <template v-if="hasValue">
      <div v-if="field.asHtml" @click.stop v-html="field.value"></div>
      <span v-else class="whitespace-nowrap">
        <a
          class="link-default"
          :href="field.value"
          rel="noreferrer noopener"
          target="_blank"
          @click.stop
        >
          {{ field.displayedAs }}
        </a>
      </span>
    </template>
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
