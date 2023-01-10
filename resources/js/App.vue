<template>
    <div class="app">
        <navigation-component />
        <router-view />
    </div>
</template>

<script>

import NavigationComponent from "./components/NavigationComponent.vue";
export default {
    name: "App",
    components: {
        NavigationComponent
    }
}
</script>

<style scoped>

</style>
