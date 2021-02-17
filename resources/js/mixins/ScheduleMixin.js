export default {
  data() {
    return {
      days: [
        {
          value: 1,
          label: 'Monday',
        },
        {
          value: 2,
          label: 'Tuesday',
        },
        {
          value: 3,
          label: 'Wednesday',
        },
        {
          value: 4,
          label: 'Thursday',
        },
        {
          value: 5,
          label: 'Friday',
        },
        {
          value: 6,
          label: 'Saturday',
        },
        {
          value: 0,
          label: 'Sunday',
        },
      ],
    }
  },
  methods: {
    getDayName(dayId) {
      const day = this.days.find((item) => {
        return item.value === dayId
      })
      if (!day) {
        return ''
      }
      return day.label
    }
  },
  filters: {
    hoursFormat(val) {
      return val.substring(0, 2) + ':' + val.substring(2, 4)
    }
  }
}