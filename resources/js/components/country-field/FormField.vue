<template>
  <form-belongs-to-field
    ref="belongs"
    :shown-via-new-relation-modal="shownViaNewRelationModal"
    :via-resource="viaResource"
    :via-resource-id="viaResourceId"
    :via-relationship="viaRelationship"
    :show-help-text="showHelpText"
    :field="field"
    :resource-name="resourceName"
    :resource-id="resourceId"
    :errors="errors"
  />
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'
import DependFromAddress from '../../mixins/DependFromAddress'

export default {
  mixins: [
    FormField,
    HandlesValidationErrors,
    DependFromAddress,
  ],

  props: {
    resourceId: {},
  },

  mounted () {
    this.$refs.belongs.$watch('selectedResourceId', (value) => {
      this.value = value
    })
    this.value = this.$refs.belongs.$data.selectedResourceId
  },

  methods: {
    setValue(value) {
      this.$refs.belongs.$data.selectedResourceId = value
    },
  },
}
</script>