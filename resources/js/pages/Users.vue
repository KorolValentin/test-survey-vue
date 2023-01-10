<template>
    <ul>
        <li v-for="user in users">Name: {{ user.name }} (email: {{ user.email }})</li>
    </ul>
</template>

<script>
export default {
    name: "Users",
    data() {
        return {
            users: [],
      }
    },
    mounted() {
        this.getUsers();
    },
    methods: {
        getUsers() {
            axios.get('/api/users').then( response => {
                this.users = response.data;
            })
        }
    }
}
</script>

<style scoped>

</style>
