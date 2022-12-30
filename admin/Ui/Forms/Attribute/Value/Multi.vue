<template>
    <div class="flex flex-col gap-4">
  <div
    v-for="(item, i) in items"
    :key="key"
    class="flex flex-row gap-4 items-center justify-start "
  >
    <div class="grow bg-neutral-200 border flex items-center justify-start p-3 rounded-lg border">
      {{ item }}
    </div>
    <div class="w-8 h-8">
      <svg
        width="32"
        height="37"
        viewBox="0 0 32 37"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        @click="remove(i)"
      >
        <path
          d="M12.9453 0.5H19.4844C20.4688 0.5 21.3125 1.0625 21.875 1.83594L23.8438 5H31.4375C31.7188 5 32 5.28125 32 5.5625C32 5.91406 31.7188 6.125 31.4375 6.125H1.0625C0.710938 6.125 0.5 5.91406 0.5 5.5625C0.5 5.28125 0.710938 5 1.0625 5H8.58594L10.5547 1.83594C11.1172 1.0625 11.9609 0.5 12.9453 0.5ZM12.9453 1.625C12.3828 1.625 11.8203 1.97656 11.5391 2.46875L9.92188 5H22.5078L20.8906 2.46875C20.6094 1.97656 20.0469 1.625 19.4844 1.625H12.9453ZM5.84375 32.8438C5.98438 34.3203 7.17969 35.375 8.65625 35.375H23.7734C25.25 35.375 26.4453 34.3203 26.5859 32.8438L28.625 8.9375C28.625 8.58594 28.9062 8.375 29.1875 8.375C29.5391 8.44531 29.75 8.72656 29.6797 9.00781L27.7109 32.9141C27.5703 34.9531 25.8125 36.5 23.7734 36.5H8.65625C6.61719 36.5 4.85938 34.9531 4.71875 32.9141L2.75 9.00781C2.67969 8.72656 2.89062 8.44531 3.24219 8.375C3.52344 8.375 3.80469 8.58594 3.80469 8.9375L5.84375 32.8438Z"
          fill="#36BABB"
        />
      </svg>
    </div>
  </div>
  <div class="flex flex-row gap-4 items-center justify-start">
    <ui-input v-model="newItem" class="grow"></ui-input>
    <div class="w-8 h-8" @click="add">
      <svg
        width="30"
        height="31"
        viewBox="0 0 30 31"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          d="M29.875 15.5C29.875 15.8516 29.5938 16.0625 29.3125 16.0625H15.8125V29.5625C15.8125 29.9141 15.5312 30.1953 15.25 30.1953C14.8984 30.1953 14.6875 29.9141 14.6875 29.5625V16.0625H1.1875C0.835938 16.0625 0.625 15.8516 0.625 15.5703C0.625 15.2188 0.835938 14.9375 1.1875 14.9375H14.6875V1.4375C14.6875 1.15625 14.8984 0.945312 15.25 0.945312C15.5312 0.945312 15.8125 1.15625 15.8125 1.4375V14.9375H29.3125C29.5938 14.9375 29.875 15.2188 29.875 15.5Z"
          fill="#A3A3A3"
        />
      </svg>
    </div>
  </div>
</div>
</template>

<script setup>
import { ref, reactive } from "vue";
;
const newItem = ref();
const key = ref(1);
const items = ref([]);
if (props.form.value && isArray(props.form.value)) items.value = props.form.value;
const props = defineProps({
  form: Object,
});
function add() {
  if (props.form.value && props.form.value[0]) {
    console.log(newItem.value);
    items.value.push(newItem.value);
  } else {
    items.value = [newItem.value];
      console.log(items.value);
  }
    props.form.value = items.value;
  newItem.value = "";
  reload()
}

function reload() {
    key.value = key.value +1
}

function remove(i) {
    items.value.splice(i,1)
    props.form.value = items.value
    reload()
}
</script>
