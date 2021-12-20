<template>
    <div class="listDesk">
        <div class="desks" v-for="(desk,index) in desks" :key="index">
            <one-desk
                :desk="desk"
                class="desk"
                v-on:reload="reload()"
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
    methods: {
        reload() {
            console.log('getList');
            axios.get('api/desks')
                .then(response => {
                    console.log(response);
                    this.tasks = response.data
                })
                .catch(error => {
                    console.log(error);
                })
        }
    },
}
</script>

<style scoped>
.listDesk {
    display: flex;
}
</style>
