<template>
    <div class="deskContainer">
        <list-desk
            :desks="desks"
            v-on:reloadlist="getList()"/>
    </div>
</template>

<script>
import listDesk from "./listDesk";

export default {
    components: {listDesk},
    data: function () {
        return {
            desks: []
        }
    },
    methods: {
        getList() {
            axios.get('api/desks')
                .then(response => {
                    console.log(response.data);
                    this.desks = response.data
                })
                .catch(error => {
                    console.log(error);
                })
        }
    },
    created() {
        this.getList();
    }
}
</script>

<style scoped>

</style>
