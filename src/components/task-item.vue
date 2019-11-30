<template>
    <div class="task-item">
        <div v-if="!editable" class="description">
            {{task.description}}
        </div>
        <div v-if="editable" class="description -form">
            <input class="-input" type="text" :placeholder="task.description" name="newDescription" v-model="newDescription">
        </div>
        <div v-if="!confirm" class="controls">
            <a class="-item"><font-awesome-icon class="_danger" :icon="['fas', 'times']"/></a>
            <a class="-item" @click="confirm = true"><font-awesome-icon :icon="['fas','edit']" color/></a>
        </div>
        <div v-if="confirm" class="controls">
            <a class="-item" @click="confirm = false"><font-awesome-icon class="_danger" :icon="['fas', 'times']"/> Cancel</a>
            <a class="-item" @click="confirm = !confirm"><font-awesome-icon :class="'_success'" :icon="['fas','check-circle']" color/>{{ ' Accept' }}</a>
        </div>
    </div>
</template>


<script>
import controlPanel from './control-panel'
import controlItem from './control-item'

export default {
    name: 'task-item',
    data() {
        return {
            editable: false,
            newDescription: '',
            confirm: false
        }
    },
    props: {
        task: {
            type: Object,
            required: true,
        }
    },
    methods: {
        edit() {
            if (!this.editable) {
                this.editable = true
                return
            }
        }
    },
    components: {
        controlPanel,
        controlItem
    }
}
</script>

<style lang="sass" scoped>

    $contentHeight: 40px

    .task-item
        border: 1px solid black
        min-height: 100px
        background: $primary
        color: #fff
        display: flex
        flex-direction: column
        border-radius: $borderRadius
        margin-bottom: 10px
        justify-content: space-between

        >.description
            border: 1px solid white
            height: $contentHeight
            margin: auto
            margin-top: 5px
            border-radius: $borderRadius
            line-height: $contentHeight
            background: #fff
            color: #000
            font-size: 20px
            width: 98%

            &.-form
                line-height: 1em
                >.-input
                    width: 90%
                    height: 85%
                    border-radius: $borderRadius
                    border: 1px solid black
                    padding-left: 15px
                    font-size: 20px
                    margin: 0
            
        >.controls
            height: $contentHeight
            line-height: $contentHeight
            border-radius: $borderRadius
            margin: auto
            margin-bottom: 5px 
            border: 1px solid white
            width: 98%
            text-align: left

            >.-item
                margin: 0 10px
                cursor: pointer
                &:hover
                    >*
                        transform: scale(1.2)

            


</style>