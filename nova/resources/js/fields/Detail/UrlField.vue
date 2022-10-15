<template>
  <PanelItem :index="index" :field="field">
    <template v-slot:value>
      <p v-if="!nullValues && !shouldDisplayAsHtml" class="text-90">
        <a
          class="link-default"
          :href="field.value"
          rel="noreferrer noopener"
          target="_blank"
        >
          {{ field.displayedAs }}
        </a>
      </p>
      <div
        v-else-if="!nullValues && shouldDisplayAsHtml"
        v-html="field.value"
      ></div>
      <p v-else>&mdash;</p>
    </template>
  </PanelItem>
</template>

<script>
export default {
  props: ['index', 'resource', 'resourceName', 'resourceId', 'field'],

  computed: {
    nullValues() {
      return Boolean(
        this.field.value === '' ||
          this.field.value === null ||
          this.field.value === undefined
      )
    },

    shouldDisplayAsHtml() {
      return this.field.asHtml
    },
  },
}
</script>
