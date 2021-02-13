Nova.booting((Vue, router, store) => {
  Vue.component('index-address-fields', require('./components/address-field/IndexField'))
  Vue.component('detail-address-fields', require('./components/address-field/DetailField'))
  Vue.component('form-address-fields', require('./components/address-field/FormField'))

  Vue.component('index-city-field', require('./components/city-field/IndexField'))
  Vue.component('detail-city-field', require('./components/city-field/DetailField'))
  Vue.component('form-city-field', require('./components/city-field/FormField'))

  Vue.component('index-country-field', require('./components/country-field/IndexField'))
  Vue.component('detail-country-field', require('./components/country-field/DetailField'))
  Vue.component('form-country-field', require('./components/country-field/FormField'))

  Vue.component('index-state-field', require('./components/state-field/IndexField'))
  Vue.component('detail-state-field', require('./components/state-field/DetailField'))
  Vue.component('form-state-field', require('./components/state-field/FormField'))

  Vue.component('index-location-field', require('./components/location-field/IndexField'))
  Vue.component('detail-location-field', require('./components/location-field/DetailField'))
  Vue.component('form-location-field', require('./components/location-field/FormField'))
})
