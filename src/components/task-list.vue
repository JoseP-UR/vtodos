<template>
    <div class="task-list">
        <task-item v-for="task in tasks" :key="task.id" :task="task"></task-item>
    </div>
</template>

<script>
import taskItem from './task-item'
import { mapState } from 'vuex'

export default {
    name: 'task-list',
    data() {
        return {

        }
    },
    components: {
        taskItem
    },
    computed: {
        ...mapState({
            tasks: state => state.list.tasks    
        })
    }

}
</script>

<style lang="sass" scoped>
    .task-list
        margin-top: 20px
        border: 1px solid #DDD
        min-height: 700px
        border-radius: $borderRadius
        background: #fff
        box-shadow: 0px 0px 10px -5px #000
        display: flex
        flex-direction: column
        padding: 15px
        max-height: 700px
        overflow-y: auto
</style>