<template>
    <h3>Login</h3>
    <div>
        <form class="uk-form-stacked">
            <div class="uk-inline">
                <span class="uk-form-icon" uk-icon="icon: user"></span>
                <input v-model="name" type="name" placeholder="name" class="uk-input  uk-form-width-medium">
            </div>
            <div class="uk-inline">
                <span class="uk-form-icon" uk-icon="icon: mail"></span>
                <input v-model="email" type="email" placeholder="email" class="uk-input  uk-form-width-medium">
            </div>
            <div class="uk-inline">
                <span class="uk-form-icon" uk-icon="icon: lock"></span>
                <input v-model="password" type="password" placeholder="password" class="uk-input uk-form-width-medium">
            </div>
            <input @click.prevent="login" type="button" value="Button" class="uk-button uk-button-default">
        </form>
    </div>
</template>

<script>

export default {
    name: "Registration",
    data() {
        return {
            name: 'Dev',
            email: 'admin2@test.com',
            password: 'password',
            confirmed: 'password_confirmation',
        }
    },
    methods: {
        login() {
            axios.get('/sanctum/csrf-cookie').then(response => {

                axios.post('/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password
                }).then(responseLogin => {
                    console.log(responseLogin);
                    localStorage.setItem("x_xsrf_token", responseLogin.config.headers['X-XSRF-TOKEN']);
                    this.$router.push({ name: 'survey'});
                }).catch(error => {
                    console.log(error)
                })
            })
        }
    }
}

</script>

<style scoped>

</style>
