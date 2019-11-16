<template>
    <div class="login-page">
        <h1>Welcome to your todo list</h1>
        <form-container class="-login">
            <form v-on:submit.prevent>
                <input-field label="Username">
                    <input type="text" v-model="username" name="username">
                </input-field>
                <input-field label="Password">
                    <input type="password" v-model="password" name="password">
                </input-field>
                <input-field>
                    <!-- <input class="button" type="submit" @click="login()" value="Login"> -->
                    <a class="button" @click="login()">Login</a>
                </input-field>
            </form>
        </form-container>

        <a class="button" @click="toggleRegisterForm()" v-text="(registerUser) ? 'Close' : 'Register'"></a>
        
        <form-container class="-register" v-if="registerUser">
            <form v-on:submit.prevent>
                <input-field label="Username">
                    <input type="text" v-model="newUser" name="username">
                </input-field>
                <input-field label="E-mail">
                    <input type="email" v-model="userMail" name="usermail">
                </input-field>
                <input-field label="Password">
                    <input type="password" v-model="newPassword" name="password">
                </input-field>
                <input-field>
                <a class="button" @click="register()" >Register</a>
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
            username: '',
            password: '',
            newUser: '',
            newPassword: '',
            userMail: '',
            errorFields: [],
            registerUser: false
        }
    },
    methods: {
        toggleRegisterForm() {
            this.registerUser = !this.registerUser
            this.newUser = '';
            this.newPassword = '';
            this.userMail= '';
        },
        login() {
            this.$router.push('/main');
            this.$store.dispatch('user/sendLoginForm', { user: this.username, pass: this.password });
        },
        register() {
            console.log(this.newUser, this.newPassword)
        }
    }
}
</script>