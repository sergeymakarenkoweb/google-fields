<template>
  <default-field :field='field' :errors='errors' :show-help-text='showHelpText'>
    <template slot='field'>
      <input type='text'
             v-model='value'
             class='w-full form-control form-input form-input-bordered'
             :class='errorClasses'
             :placeholder='field.name'
             :id='field.name'
             ref='input'>
    </template>
  </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'
import Autocomplete from  '@trevoreyre/autocomplete-vue'

export default {
  mixins: [FormField, HandlesValidationErrors],

  props: ['resourceName', 'resourceId', 'field'],
  components: {
    Autocomplete,
  },
  data() {
    return {
      data: null,
      hasNewAddress: false,
      autocomplete: null,
    }
  },
  computed: {
    country() {
      const country = this.findByType('country')
      return country ? country.short_name : country
    },
    city() {
      const city = this.findByType('postal_town')
      return city ? city.long_name : ''
    },
    state() {
      const state = this.findByType('administrative_area_level_1')
      return state ? state.short_name : ''
    },
    zip() {
      const postalCode = this.findByType('postal_code')
      return postalCode ? postalCode.long_name : ''
    },
    name() {
      if (!this.data) {
        return ''
      }
      return this.data.name
    },
    website() {
      if (!this.data) {
        return ''
      }
      return this.data.website
    },
    addressComponents() {
      if (!this.data) {
        return undefined
      }
      return this.data.address_components
    },
    phone() {
      if (!this.data) {
        return undefined
      }
      return this.data.formatted_phone_number
    },
    placeId() {
      if (!this.data) {
        return ''
      }
      return this.data.place_id
    },
    location() {
      if (!this.data) {
        return null
      }
      return {
        latitude: this.data.geometry.location.lat(),
        longitude: this.data.geometry.location.lng(),
      }
    },
    openingHours() {
      if (!this.data) {
        return null
      }
      return this.data.opening_hours.periods
    }
  },
  mounted () {
    const options = {
      componentRestrictions: { country: this.field.availableCountries },
      fields: [
        'icon',
        'name',
        'rating',
        'reviews',
        'website',
        'geometry',
        'place_id',
        'formatted_address',
        'address_components',
        'opening_hours.periods',
        'formatted_phone_number',
        'opening_hours.weekday_text',
      ],
      strictBounds: false,
    }
    this.autocomplete = new google.maps.places.Autocomplete(this.$refs.input, options)
    this.autocomplete.addListener('place_changed', this.fillInAddress)
  },
  methods: {
    findByType(searchType) {
      if (!this.addressComponents) {
        return undefined
      }
      return this.addressComponents.find((element) => {
        return !!element.types.find(type => type === searchType)
      })
    },

    refreshAddressData() {
      this.$emit('refresh-address-data')
    },

    setInitialValue() {
      this.value = this.field.value || ''
    },

    fillInAddress() {
      this.hasNewAddress = this.value !== ''
      this.data = this.autocomplete.getPlace()
      this.value = this.data.formatted_address
    },

    getResultValue(result) {
      return result.formattedAddress
    },

    fill(formData) {
      formData.append(this.field.attribute, this.value || '')
    },
  },
}
</script>
<style lang='sass'>
</style>