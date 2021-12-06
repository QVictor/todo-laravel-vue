<template>
    <div class="container">
        <h1>Project To-do list</h1>
        <p style="font-size: 26px">
            <router-link :to="{name: 'home'}">list desks</router-link>
            <router-link :to="{name: 'app'}">list tasks</router-link>
        </p>
        <router-view></router-view>
    </div>
</template>

<script>
export default {

}
</script>
