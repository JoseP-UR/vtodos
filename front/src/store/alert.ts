import { defineStore } from 'pinia'

export const useAlertState = defineStore('alertStore', {
  state: () => ({
    show: false,
    type: '',
    message: '',
  })
})