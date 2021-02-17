<template>
  <div class="flex">
    <select-control
      class="form-control form-select w-full"
      :class="{ 'border-danger': hasError }"
      :dusk="index"
      @change="selectDay"
      :options="this.days"
      :value="_day"
      :selected="_day"
    />
    <input class="w-full form-control form-input form-input-bordered ml-2" type="text"
           placeholder="Open Time" v-model="_openTime">
    <input class="w-full form-control form-input form-input-bordered ml-2"
           type="text" placeholder="Close Time" v-model="_closeTime">
    <button class="btn btn-default btn-primary ml-2" @click.prevent="addPeriod(1)">Add</button>
    <button class="btn btn-default btn-primary ml-2" @click.prevent="remove">Remove</button>
  </div>
</template>

<script>
import ScheduleMixin from '../../mixins/ScheduleMixin'

export default {
  mixins: [ScheduleMixin],
  props: {
    day: {
      type: Number,
      default: 1  ,
    },
    openTime: {
      type: String,
      default: '',
    },
    closeTime: {
      type: String,
      default: '',
    },
    index: {
      type: Number,
      default: 0,
    },
  },
  computed: {
    _day: {
      get () {
        return this.day
      },
      set (val) {
        this.emitChangeData('day', val)
      },
    },
    _openTime: {
      get () {
        return this.openTime
      },
      set (val) {
        this.emitChangeData('open_time', val)
      },
    },
    _closeTime: {
      get () {
        return this.closeTime
      },
      set (val) {
        this.emitChangeData('close_time', val)
      },
    },
  },
  methods: {
    emitChangeData (field, value) {
      this.$emit('change-data', {
        index: this.index,
        field,
        value,
      })
    },

    getNextDay() {
      return this._day === 6 ? 0 : this._day + 1
    },

    addPeriod() {
      this.$emit('add-period',
        {
          index: this.index + 1,
          day: this.getNextDay()
        })
    },

    remove() {
      this.$emit('remove', this.index)
    },

    selectDay (day) {
      this._day = parseInt(day.target.value)
    },
  },
}
</script>
