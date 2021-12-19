<template>
    <div class="listDesk">
        <div class="desks" v-for="(desk,index) in desks" :key="index">
            <one-desk
                :desk="desk"
                class="desk"
                v-on:taskchanged="$emit('reloadlist')"
            />
        </div>
    </div>
</template>

<script>
import oneDesk from "./oneDesk";

export default {
    components: {oneDesk},
    props: ['desks'],
}
</script>

<style scoped>
.listDesk {
    display: flex;
}
</style>
