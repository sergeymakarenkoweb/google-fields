<template>
  <panel-item :field="field">
    <div slot="value">
      <span v-if="!field.isLink">{{field.value}}</span>
      <span v-else><a target="_blank" :href="field.value">{{field.value}}</a></span>
    </div>
  </panel-item>
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
}
</script>
