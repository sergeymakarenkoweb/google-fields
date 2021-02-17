export default {
  mounted() {
    this.registerDependencyWatchers(this.$root)
  },
  data() {
    return {
      isUpdated: false,
      newValue: ''
    }
  },
  computed: {
    isEmptyValue() {
      return this.isEmpty(this.value)
    },
  },
  methods: {
    isEmpty(value) {
      return value === ""
        || value === 0
        || value === "0"
        || value === null
        || value === false
        || value === undefined
        || ( Array.isArray(value) && value.length === 0 )
    },
    registerDependencyWatchers (root) {
      root.$children.forEach(component => {
        if (this.componentIsDependency(component)) {
          const attribute = this.field['dependsAttribute']
          component.$watch(attribute, (value) => {
            if ((!value || (!this.field.alwaysUpdate && !this.isEmpty()))) {
              if (!this.isEmptyValue
                && this.value !== value
                && !this.isEmpty(value)) {
                this.isUpdated = true
                this.newValue = value
              }
              return
            }
            this.setValue(value)
          }, { immediate: true })
        }
        this.registerDependencyWatchers(component)
      });
    },
    refresh() {
      this.isUpdated = false
      this.setValue(this.newValue)
    },
    setValue(value) {
      this.value = value
    },
    setNewValue(value) {
      this.newValue = value
    },
    componentIsDependency(component) {
      if (component.field === undefined) {
        return false
      }
      return component.field.attribute === this.field.addressFieldName
    }
  }
}