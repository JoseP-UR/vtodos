<template>
    <div class="login-page">
        <h1 class="-title">Welcome to your todo list</h1>
        <form-container class="-login">
              <p class="message" v-if="loginMessage.body" :class="'-'+loginMessage.type">{{loginMessage.body}}</p>
            <form v-on:submit.prevent>
                <input-field label="name">
                    <input type="text" v-model="form.name" name="name">
                    
                </input-field>
                <input-field label="pass">
                    <input type="password" v-model="form.pass" name="pass">
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
                    <input type="text" v-model="form.name" name="name">
                    <h1 class="hint">At least 3 characters, max. 20</h1>
                </input-field>
                <input-field label="E-mail">
                    <input type="email" v-model="form.mail" name="usermail">
                </input-field>
                <input-field label="pass">
                    <input type="password" v-model="form.pass" name="pass">
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
import { mapState } from 'vuex'

export default {
    name: 'Login',
    data() {
        return {
            regMessage: {
                type: '',
                body: ''
            },
            loginMessage: {
                type: '',
                body: ''
            },
            registerUser: false
        }
    },
    computed: {
        ...mapState({
            form: state => state.user.form
        })
    },
    methods: {
        toggleRegisterForm() {
            this.registerUser = !this.registerUser
            this.regMessage = {
                type: '',
                body: ''
            };
            this.loginMessage = {
                type: '',
                body: ''
            }
        },
        login() {
            this.loginMessage = {
                type: '',
                body: ''
            }
            let that = this;
            this.$store.dispatch('user/login', { name: this.form.name, pass: this.form.pass }).then(res => {
                let type = Object.keys(res.data)
                this.loginMessage.type = type;
                this.loginMessage.body = res.data[type];
                if (!res.data.error) {
                    this.$store.commit('user/SET_USER_DATA', res.data);
                    this.$session.set('name', res.data.name);
                    this.$session.set('pass', res.data.pass);
                    this.$router.push('/main');
                }
            });
        },
        register() {
            this.regMessage = {
                type: '',
                body: ''
            }
            this.$store.dispatch('user/create', { name: this.form.name, pass: this.form.pass, email: this.form.mail}).then(res => {
                let type = Object.keys(res.data)
                this.regMessage.type = type;
                this.regMessage.body = res.data[type];
            });
        }
    },
    mounted() {

        if (this.$session.has('name') && this.$session.has('pass')) {
            this.$store.dispatch('user/login', { name: this.$session.get('name'), pass: this.$session.get('pass'), session: true }).then(res => {
                let type = Object.keys(res.data)
                this.loginMessage.type = type;
                this.loginMessage.body = res.data[type];
                if (!res.data.error) {
                    this.$store.commit('user/SET_USER_DATA', res.data);
                    this.$session.set('name', res.data.name);
                    this.$session.set('pass', res.data.pass);
                    this.$router.push('/main');
                }
            })
        }
        
    }
}
</script>