<template>
  <PanelItem :index="index" :field="field">
    <template #value>
      <p>
        <span v-if="field.value">
          {{ formattedDate }}
        </span>
        <span v-else>&mdash;</span>
      </p>
    </template>
  </PanelItem>
</template>

<script>
import { DateTime } from 'luxon'

export default {
  props: ['index', 'resource', 'resourceName', 'resourceId', 'field'],

  computed: {
    formattedDate() {
      if (this.field.usesCustomizedDisplay) {
        return this.field.value
      }

      return DateTime.fromISO(this.field.value, {
        setZone: Nova.config('userTimezone') || Nova.config('timezone'),
      }).toLocaleString({
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
      })
    },
  },
}
</script>
