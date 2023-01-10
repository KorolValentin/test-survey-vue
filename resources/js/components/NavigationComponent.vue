<template>
    <div>
        {{ isAdmin }}
        <div class="nav-item p-2">
            <router-link class="uk-button uk-button-primary m-2" v-if="!token" to="/login">Login</router-link>
            <router-link class="uk-button uk-button-primary m-2" v-if="!token" to="/registration">Registration</router-link>
            <router-link class="uk-button uk-button-primary m-2" v-if="token" @click.prevent="logout" to="/login">Logout</router-link>
        </div>
    </div>

    <div class="navbar uk-flex uk-background-muted">
        <template v-for="nav_link in nav_links">
            <div class="nav-item p-2">
                <router-link class="uk-button uk-button-primary" :to="nav_link.path">{{ nav_link.title }}</router-link>
            </div>
        </template>
    </div>
</template>

<script>
import routes from '../routes_links';
import axios from "axios";

export default {
    name: "NavigationComponent",
    data() {
      return {
          routes,
          token: null,
          isAdmin: false,
          nav_links: [],
          route_links: [
              'users',
              'survey',
              'statistic',
          ]
      }
    },
    mounted() {
        this.getUser();
        this.prepareRoutes();
        this.getToken();
    },
    watch: {
        $route (to, from){
            this.getToken();
        }
    },
    methods: {
        prepareRoutes() {
            routes.forEach( route => {
                if(this.route_links.includes(route.name)) {
                    this.nav_links.push(route);
                }
            })
        },
        getToken() {
            this.token = localStorage.getItem('x_xsrf_token');
        },
        logout() {
            axios.post('/logout').then(response => {
                localStorage.removeItem('x_xsrf_token');
                // this.getToken();
                this.$router.push("/login")

            }).catch(error => {
                location.reload();
            });
        },
        getUser() {
            axios.get('/api/user').then( response => {
                console.log(response.data['id']);
                console.log(response.data['is_admin']);
                this.isAdmin = response.data['is_admin'];
                // this.prepareRoutes();
            })
        }
    }
}
</script>

<style scoped>

</style>
