import inputField from './input-field'
import formContainer from './form-container'
import Vue from 'vue'

export default {
    inputField: Vue.component(inputField.name, inputField),
    formContainer: Vue.component(formContainer.name, formContainer)
}