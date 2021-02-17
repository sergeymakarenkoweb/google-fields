<template>
    <div class="flex border-b border-40 -mx-6 px-6">
      <div class="w-1/4 py-4">
        <h4 class="font-normal text-80">{{field.name}}</h4>
      </div>
      <div class="w-3/4 py-4 break-words">
        <div class="flex flex-col" v-if="valueIsNotEmpty">
          <div class="flex border-b border-40 my-1">
            <div class="flex w-1/3">
              <h4 class="font-normal text-80">Day</h4>
            </div>
            <div class="flex w-1/3">
              <h4 class="font-normal text-80">Open time</h4>
            </div>
            <div class="flex w-1/3">
              <h4 class="font-normal text-80">Close time</h4>
            </div>
          </div>
          <div class="flex my-1" v-for="(item, key) in field.value" :key="key">
            <div class="flex w-1/3">
              {{getDayName(item.day)}}
            </div>
            <div class="flex flex w-1/3">
              {{item.open_time | hoursFormat}}
            </div>
            <div class="flex flex w-1/3">
              {{item.close_time | hoursFormat}}
            </div>
          </div>
        </div>
        <div class="flex" v-else>
          No Data
        </div>
      </div>
    </div>
</template>

<script>
import ScheduleMixin from '../../mixins/ScheduleMixin'

export default {
  mixins: [ScheduleMixin],
  props: ['resource', 'resourceName', 'resourceId', 'field'],
  computed: {
    valueIsNotEmpty() {
      return this.field.value && Array.isArray(this.field.value) && this.field.value.length > 0
    },
  }
}
</script>
