<template>
  <PanelItem :index="index" :field="field">
    <template #value>
      <p v-if="field.value" class="text-90 flex items-center">
        <a :href="`mailto:${field.value}`" class="link-default">
          {{ field.value }}
        </a>
      </p>
      <p v-else>&mdash;</p>
    </template>
  </PanelItem>
</template>

<script>
export default {
  props: ['index', 'resource', 'resourceName', 'resourceId', 'field'],
}
</script>
