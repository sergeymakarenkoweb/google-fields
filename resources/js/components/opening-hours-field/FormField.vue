<template>
  <div class="flex border-b border-40">
    <div class="w-1/5 px-8 py-6">
      <label class="inline-block text-80 pt-2 leading-tight" :for="field.name">{{field.name}}</label>
    </div>
    <div class="w-4/5 px-8 py-6">
      <button v-if="emptyPeriods" class="btn btn-default btn-primary" @click.prevent="addPeriod(firstPeriod)">Add Period</button>
      <div class="flex flex-col">
        <period-item v-for="(period, key) in periods"
                     :day="period.day"
                     :open-time="period.open_time"
                     :close-time="period.close_time"
                     @change-data="changePeriod"
                     @add-period="addPeriod"
                     @remove="deletePeriod"
                     :index="key"
                     :key="key"
                     class="mt-2"
        />
      </div>
    </div>
  </div>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'
import DependFromAddress from '../../mixins/DependFromAddress'
import PeriodItem from './PeriodItem'

export default {
  components: { PeriodItem },
  mixins: [FormField, HandlesValidationErrors, DependFromAddress],

  props: ['resourceName', 'resourceId', 'field'],

  data() {
    return {
      periods: [],
      firstPeriod: {
        day: 1,
        index: 0,
      }
    }
  },
  computed: {
    emptyPeriods() {
      return this.periods.length < 1
    }
  },
  watch: {
    periods(val) {
      this.value = JSON.stringify(val)
    }
  },
  methods: {
    changePeriod(data) {
      this.periods[data.index][data.field] = data.value
      this.$set(this.periods, data.index, this.periods[data.index])
    },

    addPeriod(data, openTime = '1000', closeTime = '1800') {
      this.periods.splice(data.index, 0, {
        day: data.day,
        open_time: openTime,
        close_time: closeTime,
      })
    },

    setValue(value) {
      if (!Array.isArray(value)) {
        return
      }
      this.periods = []
      value.forEach((period, index) => {
        this.addPeriod({
          day: period.close.day,
          index: index,
        }, period.open.time, period.close.time)
      })
    },

    deletePeriod(index) {
      this.periods.splice(index, 1)
    },

    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue() {
      if (this.field.value && Array.isArray(this.field.value)) {
        this.field.value.forEach((period) => {
          this.periods.push(period)
        })
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
