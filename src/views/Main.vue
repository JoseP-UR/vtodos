<template>
    <div class="Main">
      <h1 class="-title _reduced">Welcome to your main page.</h1>
      <control-panel>
        <control-item :icon="['fas', 'plus']"  iconColor="#339900">
            New
        </control-item>
      </control-panel>
      <task-list></task-list>  
    </div>
</template>

<script>
import taskList from '../components/task-list'
import controlPanel from '../components/control-panel'
import controlItem from '../components/control-item'

export default {
    name: 'Main',
    data() {
        return {

        }
    },
    components: {
        taskList,
        controlPanel,
        controlItem
    }

}
</script>

<style lang="sass" scoped>
    .Main
        padding: 20px

        >.-title
            margin: 0 auto 10px auto
</style>