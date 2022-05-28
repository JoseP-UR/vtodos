import { defineStore } from 'pinia'

export const useUserState = defineStore('userStore', {
  state: () => ({
    name: '',
    pass: '',
    uid: '',
    isLogged: false,
  })
})