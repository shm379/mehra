<template>
  <div :class="`text-${field.textAlign}`">
    <Link
      @click.stop
      v-if="hasValue && !isPivot && authorizedToView"
      :href="$url(`/resources/${resourceName}/${field.value}`)"
      class="link-default"
    >
      {{ field.value }}
    </Link>
    <p v-else-if="hasValue">
      {{ field.pivotValue || field.value }}
    </p>
    <p v-else>&mdash;</p>
  </div>
</template>

<script>
import isNil from 'lodash/isNil'

export default {
  props: ['resource', 'resourceName', 'field'],

  computed: {
    /**
     * Determine if the field has a value other than null.
     */
    hasValue() {
      return this.field.value !== null
    },

    isPivot() {
      return !isNil(this.field.pivotValue)
    },

    authorizedToView() {
      return this.resource?.authorizedToView ?? false
    },
  },
}
</script>
