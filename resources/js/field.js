Nova.booting((Vue, router) => {
    Vue.component('index-novamultiselectcheckboxes', require('./components/IndexField'));
    Vue.component('detail-novamultiselectcheckboxes', require('./components/DetailField'));
    Vue.component('form-novamultiselectcheckboxes', require('./components/FormField'));
})
