<template>
    <div class="container">
        <h1>Project To-do list</h1>
        <p style="font-size: 26px">
            <router-link :to="{name: 'about'}">about project</router-link>
            <router-link :to="{name: 'desk'}">list desks</router-link>
        </p>
        <router-view></router-view>
    </div>
</template>

<script>
export default {

}
</script>
