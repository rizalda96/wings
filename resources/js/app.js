import '@js/bootstrap'
import Vue from 'vue'
import App from '@js/MainApp'
import BootstrapVue from 'bootstrap-vue'

import { axios } from '@js/axios-config'
import { createRouter } from '@js/router'

window._token = document.head.querySelector('meta[name="csrf-token"]').content

Vue.use(BootstrapVue)

export const createApp = () => {
    Vue.prototype.$app = window.settings
    Vue.prototype.$http = axios
    Vue.prototype.$app.route = window.route
    /**
     * Object to FormData converter
     */
    let objectToFormData = (obj, form, namespace) => {
        let fd = form || new FormData()

        for (let property in obj) {
            if (!obj.hasOwnProperty(property)) {
                continue
            }

            let formKey = namespace ? `${namespace}[${property}]` : property

            if (obj[property] === null) {
                fd.append(formKey, '')
                continue
            }
            if (typeof obj[property] === 'boolean') {
                fd.append(formKey, obj[property] ? '1' : '0')
                continue
            }
            if (obj[property] instanceof Date) {
                fd.append(formKey, obj[property].toISOString())
                continue
            }
            if (
                typeof obj[property] === 'object' &&
                !(obj[property] instanceof File)
            ) {
                objectToFormData(obj[property], fd, formKey)
                continue
            }
            fd.append(formKey, obj[property])
        }

        return fd
    }

    Vue.prototype.$app.objectToFormData = objectToFormData

    Vue.prototype.$moment = moment

    const router = createRouter(Vue.prototype.$app)
    const app = new Vue({
        router,
        render: h => h(App)
    })

    return { app, router }
}
if (document.getElementById('app')) {
    const { app } = createApp()
    app.$mount('#app')
}
