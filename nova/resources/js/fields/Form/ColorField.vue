<template>
  <DefaultField
    :field="currentField"
    :errors="errors"
    :show-help-text="showHelpText"
  >
    <template #field>
      <input
        v-bind="defaultAttributes"
        class="bg-white form-control form-input form-input-bordered p-2"
        type="color"
        @input="handleChange"
        :value="value"
        :id="currentField.uniqueKey"
        :dusk="field.attribute"
        :disabled="currentlyIsReadonly"
        :list="`${field.attribute}-list`"
      />
    </template>
  </DefaultField>
</template>

<script>
import { DependentFormField, HandlesValidationErrors } from '@/mixins'

export default {
  mixins: [HandlesValidationErrors, DependentFormField],

  computed: {
    defaultAttributes() {
      return {
        class: this.errorClasses,
      }
    },
  },
}
</script>
