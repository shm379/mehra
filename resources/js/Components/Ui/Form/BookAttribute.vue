<template>
  <div>
    {{ form.attributes }}
    <div v-for="item,i in attributes" :key="i">
      <component :is="`ui-form-attributes-${attributeFields[item.type]}`" v-model="form.attributes" :attribute="item" />
    </div>
  </div>
</template>

<script>
import UiFormAttributesMultiChoice from "@/Components/Ui/Form/Attributes/MultiChoice.vue";
import UiFormAttributesColor from "@/Components/Ui/Form/Attributes/Color.vue";
import UiFormAttributesDimension from "@/Components/Ui/Form/Attributes/Dimension.vue";
import UiFormAttributesInput from "@/Components/Ui/Form/Attributes/Input.vue";
import UiFormAttributesNumber from "@/Components/Ui/Form/Attributes/Number.vue";
import UiFormAttributesSingleChoice from "@/Components/Ui/Form/Attributes/SingleChoice.vue";
import UiFormAttributesTextarea from "@/Components/Ui/Form/Attributes/Textarea.vue";
import UiFormAttributesWeight from "@/Components/Ui/Form/Attributes/Weight.vue";
import UiFormAttributesYesOrNo from "@/Components/Ui/Form/Attributes/YesOrNo.vue";

export default {
  components: {
    UiLabel,
    UiFormAttributesMultiChoice,
    UiFormAttributesColor,
    UiFormAttributesDimension,
    UiFormAttributesInput,
    UiFormAttributesNumber,
    UiFormAttributesSingleChoice,
    UiFormAttributesTextarea,
    UiFormAttributesWeight,
    UiFormAttributesYesOrNo,
  },
};
</script>

<script setup>
import { ref } from "vue";
const props = defineProps({
  form: Object,
});
const attributes = ref();

const attributeFields = ref({
  1: "multi-choice",
  2: "single-choice",
  3: "yes-or-no",
  4: "number",
  5: "color",
  6: "textarea",
  7: "input",
  8: "weight",
  9: "dimension",
});

load();
async function load() {
  attributes.value = await fetch("/api/v1/ac/attributes").then((response) =>
    response.json()
  );
}
</script>
