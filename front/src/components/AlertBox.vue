<template>
    <div class="alert-container">
        <transition-group name="alert-transition" tag="div">
            <div v-if="alert.show" class="alert" :class="`-${alert.type}`">
                    <div class="alert-close" @click="closeAlert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>
                    </div>
                <div class="alert-content">
                    <div class="alert-message">{{alert.message}}</div>
                </div>
            </div>
        </transition-group>
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useAlertState } from '../store/alert';

const alert = useAlertState();

function closeAlert() {
    alert.show = false;
    alert.message = '';
    alert.type = '';
}

onMounted(() => {
    setTimeout(() => {
        closeAlert();
    }, 5000);
});
</script>

<style lang="sass" scoped>
    .alert-container 
        position: absolute
        top: 0
        left: 0
        width: 100%
        height: 100px
        z-index: 9999
        border-radius: 0 0 5px 5px
        display: flex
        align-items: center
        justify-content: center

        .-info
            background-color: #f3d91e
        .-error
            background-color: #e74c3c
        .-success
            background-color: #2ecc71

    .alert
        position: relative
        margin: auto
        top: 0
        left: 0
        width: 50vw
        height: 100%
        background-color: #fff
        border-radius: 5px
        box-shadow: 0 0 5px rgba(0,0,0,.2)
        display: flex
        flex-direction: column
        align-items: center
        justify-content: center
        transition: all .3s ease

    .alert-close
        align-self: flex-end
        cursor: pointer
        margin: 0 2px 5px 0
        padding: 5px
    
    .alert-content
        padding: 10px

    .alert-message
        font-size: 1.2em
        font-weight: bold
        text-align: center
        color: #000
</style>