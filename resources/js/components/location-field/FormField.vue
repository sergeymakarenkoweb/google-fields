<template>
  <default-field :field="field" :errors="errors" :show-help-text="showHelpText">
    <template slot="field">
      <div class="flex flex-col">
        <div class="flex">
          <label class="inline-flex items-center" :for="field.name + 'longitude'">lng:</label>
          <input
            :id="field.name + 'longitude'"
            type="number"
            class="w-full form-control form-input form-input-bordered"
            :class="errorClasses"
            placeholder="Longitude"
            :step="0.00000001"
            v-model="longitude"
          />
          <label class="inline-flex items-center" :for="field.name + 'latitude'">lat:</label>
          <input
            :id="field.name + 'latitude'"
            type="number"
            class="w-full form-control form-input form-input-bordered"
            :class="errorClasses"
            placeholder="Latitude"
            :step="0.00000001"
            v-model="latitude"
          />
        </div>
        <button v-if="isUpdated"
                @click.prevent="refresh"
                class="btn btn-default btn-primary mt-3 cursor-pointer font-sans">Refresh
        </button>
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

  computed: {
    longitude: {
      set(value) {
        let val = this.getValue()
        val.longitude = value
        this.value = JSON.stringify(val)
      },
      get() {
        const value = this.getValue()
        return value.hasOwnProperty('longitude') ? value.longitude : '';
      }
    },
    latitude: {
      set(value) {
        let val = this.getValue()
        val.latitude = value
        this.value = JSON.stringify(val)
      },
      get() {
        const value = this.getValue()
        return value.hasOwnProperty('latitude') ? value.latitude : '';
      }
    }
  },

  methods: {

    getValue() {
      return !this.isEmptyValue ? JSON.parse(this.value) : {}
    },
    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue() {
      this.value = !this.isEmpty(this.field.value) ? JSON.stringify(this.field.value) : ''
    },

    setValue(value) {
      if (value.hasOwnProperty('latitude')) {
        this.latitude = value.latitude
      }
      if (value.hasOwnProperty('longitude')) {
        this.longitude = value.longitude
      }
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill(formData) {
      formData.append(this.field.attribute, this.value || '')
    },
  },
}
</script>
