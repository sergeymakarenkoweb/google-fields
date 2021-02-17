<template>
  <default-field :field="field" :errors="errors" :show-help-text="showHelpText">
    <template slot="field">
      <div class="flex">
      <input
        :id="field.name"
        :type="getType"
        class="w-full form-control form-input form-input-bordered"
        :class="errorClasses"
        :placeholder="field.name"
        v-model="value"
      />
        <button v-if="isUpdated"
                @click.prevent="refresh"
                class="btn btn-default btn-primary ml-3 cursor-pointer font-sans">Refresh</button>
      </div>
    </template>
  </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'
import DependFromAddress from '../../mixins/DependFromAddress'

export default {
  mixins: [FormField, HandlesValidationErrors, DependFromAddress],

  props: ['resourceName', 'resourceId', 'field'],

  methods: {
    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue() {
      this.value = this.field.value || ''
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill(formData) {
      formData.append(this.field.attribute, this.value || '')
    },

    getValue(field) {
      return this.field.hasOwnProperty(field) ? this.field[field] : 'text'
    },
    getType() {
      return this.getValue('type')
    },
    getStep() {
      return this.getValue('step')
    },
    getMin() {
      return this.getValue('min')
    },
    getMax() {
      return this.getValue('max')
    },
  },
}
</script>
