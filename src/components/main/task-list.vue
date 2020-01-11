<template>
  <div class="task-list">
    <div class="task" v-for="task in tasks" :key="task.id">
      <div class="header">
        <span class="date">
          <b>Created:</b> {{task.dateCreated}}
        </span>

        <span class="date">
          <b>Due:</b> {{task.dueDate}}
        </span>

        <a class="-button" v-if="!task.editing" @click="edit(task)">Edit</a>
        <a class="-button" @click="del(task)">Delete</a>

      </div>
      <div class="body" v-if="!task.editing" v-html="task.description"></div>
      <div class="body" v-if="task.editing">
          <input-field class="-task">
            <input type="text" v-model="newBody" name="name">
            <a class="-button" @click="edit(task)">Save</a>
          </input-field>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
    name: 'task-list',
    data() {
        return {
            newBody: '',
            editMode: false
        }
    },
    computed: {
        ...mapState({
            tasks: state => state.list.tasks,
            user: state => state.user.data,
        })
    },
    methods: {
        edit(task) {
          if(!task.editing) {
            this.$store.commit('list/SET_EDITABLE', {task, mode: true});
            this.newBody = task.description
            return;
          }

          let user = this.user;
          task.description = this.newBody;

          this.$store.dispatch('list/edit', {task, user}).then(res => {
            this.$store.commit('list/SET_EDITABLE', {task, mode: false});
            this.$emit('update');
          });
        },
        del(task) {
          let user = this.user;

          this.$store.dispatch('list/delete', {task, user}).then(res => {
            this.$emit('update');

          });
        }
    }
};
</script>

<style lang="sass" scoped>
    .task-list
        margin-top: 20px
        border: 1px solid black
        border-radius: 5px
        padding: 10px


        >.task
            border: 1px solid black
            margin-top: 15px

            >.header
                border-bottom: 1px solid black
                text-align: left
                padding: 10px 0
                background-color: #e8e8e8
                >.-button
                    height: auto
                    display: inline-block
                    width: 50px
                    margin-left: 15px
                
                >.date
                    margin-left: 15px
                    >b
                        font-weight: bold
            
            >.body
                min-height: 40px
                text-align: left
                padding: 10px
</style>