import { defineStore } from 'pinia'

interface ListItem {
    id: string
    description: string
    date_created: string
    due_date: string
}

const initialListState: ListItem[] = []

export const useUserState = defineStore('userStore', {
    state: () => ({
        list: initialListState
    }),
    actions: {
        addToList(payload: ListItem) {
            this.list.push(payload)
        },
        removeFromList(payload: string) {
            this.list = this.list.filter(item => item.id !== payload)
        },
        clearList() {
            this.list = []
        },
        setList(payload: ListItem[]) {
            this.list = payload
        }
    }
})