<template>
    <div class="login-page">
        <h1 class="-title">Welcome to your todo list</h1>
        <form-container class="-login">
            <form v-on:submit.prevent>
                <input-field label="name">
                    <input type="text" v-model="name" name="name">
                    
                </input-field>
                <input-field label="pass">
                    <input type="password" v-model="pass" name="pass">
                </input-field>
                <input-field>
                    <!-- <input class="-button" type="submit" @click="login()" value="Login"> -->
                    <a class="-button" @click="login()">Login</a>
                </input-field>
            </form>
        </form-container>

        <a class="-button" @click="toggleRegisterForm()" v-text="(registerUser) ? 'Close' : 'Register'"></a>
        
        <form-container class="-register" v-if="registerUser">
            <p class="message" v-if="regMessage.body" :class="'-'+regMessage.type">{{regMessage.body}}</p>
            <form v-on:submit.prevent>
                <input-field label="name">
                    <input type="text" v-model="newName" name="name">
                    <h1 class="hint">At least 3 characters, max. 20</h1>
                </input-field>
                <input-field label="E-mail">
                    <input type="email" v-model="userMail" name="usermail">
                </input-field>
                <input-field label="pass">
                    <input type="password" v-model="newPass" name="pass">
                    <h1 class="hint">At least 3 characters, max. 20</h1>
                </input-field>
                <input-field>
                <a class="-button" @click="register()" >Register</a>
                </input-field>
            </form>
        </form-container>

    </div>
</template>

<script>
export default {
    name: 'Login',
    data() {
        return {
            name: '',
            pass: '',
            newName: '',
            newPass: '',
            userMail: '',
            regMessage: {
                type: '',
                body: ''
            },
            registerUser: false
        }
    },
    methods: {
        toggleRegisterForm() {
            this.registerUser = !this.registerUser
            this.newName = '';
            this.newPass = '';
            this.userMail= '';
            this.regMessage = {
                type: '',
                body: ''
            }
        },
        login() {
            this.$router.push('/main');
            this.$store.dispatch('user/sendLoginForm', { name: this.name, pass: this.pass });
        },
        register() {
            this.regMessage = {
                type: '',
                body: ''
            }
            this.$store.dispatch('user/create', { name: this.newName, pass: this.newPass, email: this.userMail}).then(res => {
                let data = res.data;
                let type = Object.keys(res.data)
                this.regMessage.type = type;
                this.regMessage.body = data[type];
            });
        }
    }
}
</script>