<template>
  <div v-if="allowedTypes.indexOf(type) > -1" class="input-text">
    <label :for="name">{{ label }}</label>
    <input
      :type="type"
      :name="name"
      :id="name"
      v-model="value"
      @input="onInput"
    />
  </div>
</template>

<script setup lang="ts">
import { ref } from "vue";

interface TextInputProps {
  name: string;
  label: string;
  type?: string;
}

const allowedTypes = ["text", "email", "password", "number"];	

const value = ref("");
const emits = defineEmits(["input"]);

const props = withDefaults(defineProps<TextInputProps>(), {
  type: 'text',
});

if (allowedTypes.indexOf(props.type) === -1) {
  console.error(`"${props.type}" is not a valid type: "${allowedTypes.join('", "')}"`);
}

const onInput = (e: any) => {
  value.value = e.target.value;
  emits("input", e);
};
</script>

<style lang="sass" scoped>
    .input-text
        display: flex
        flex-direction: column
        align-items: flex-start
        justify-content: flex-start
        margin: 0.5rem 0

        label
            margin: 0 0.2em 5px
            font-weight: bold

        input
            flex-basis: auto
            width: 100%
            max-width: 500px
            margin: 0 auto
            display: flex
            flex-direction: column
            align-items: center
            justify-content: center
            padding: 0.5rem
            border: 1px solid #2c3e50
            border-radius: 5px
            background-color: #fff
            box-shadow: 0 0 5px #2c3e50
</style>