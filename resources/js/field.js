Nova.booting((Vue) => {
  Vue.component('index-address-field', require('./components/address-field/IndexField'))
  Vue.component('detail-address-field', require('./components/address-field/DetailField'))
  Vue.component('form-address-field', require('./components/address-field/FormField'))

  Vue.component('index-country-field', require('./components/country-field/IndexField'))
  Vue.component('detail-country-field', require('./components/country-field/DetailField'))
  Vue.component('form-country-field', require('./components/country-field/FormField'))

  Vue.component('index-location-field', require('./components/location-field/IndexField'))
  Vue.component('detail-location-field', require('./components/location-field/DetailField'))
  Vue.component('form-location-field', require('./components/location-field/FormField'))

  Vue.component('index-general-depend-field', require('./components/general-depend-field/IndexField'))
  Vue.component('detail-general-depend-field', require('./components/general-depend-field/DetailField'))
  Vue.component('form-general-depend-field', require('./components/general-depend-field/FormField'))

  Vue.component('index-opening-hours-field', require('./components/opening-hours-field/IndexField'))
  Vue.component('detail-opening-hours-field', require('./components/opening-hours-field/DetailField'))
  Vue.component('form-opening-hours-field', require('./components/opening-hours-field/FormField'))
})
