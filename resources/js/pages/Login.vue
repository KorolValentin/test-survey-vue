<template>
    <h3>Login</h3>
    <div>
        <form class="uk-form-stacked">
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
    name: "Login",
    data() {
        return {
            email: 'admin@test.com',
            password: 'password',
        }
    },
    methods: {
        login() {
            axios.get('/sanctum/csrf-cookie').then(response => {

                axios.post('/login', {
                    email: this.email,
                    password: this.password,
                }).then(responseLogin => {
                    // console.log(responseLogin);
                    localStorage.setItem("x_xsrf_token", responseLogin.config.headers['X-XSRF-TOKEN']);
                    this.$router.push({ name: 'survey'});
                }).catch(error => {
                    // console.log(error)
                })
            })
        }
    }
}

</script>

<style scoped>

</style>
