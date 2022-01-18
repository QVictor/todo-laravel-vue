<template>
    <div class="desks container">
        <div class="row">
            <div class="desk col-sm" v-for="(desk,index) in desks" :key="index">
                <one-desk
                    :desk="desk"
                    v-on:reload="reload()"
                    @remove-desk="removeDesk($event)"
                />
            </div>
            <add-desk class="col-sm" @add-desk="addDesk($event)"/>
        </div>
    </div>
</template>

<script>
import oneDesk from "./oneDesk";
import addDesk from "./addDesk";

export default {
    components: {oneDesk, addDesk},
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
        },
        removeDesk(deskId) {
            this.desks.forEach((desk, index) => {
                if (desk.id === deskId) {
                    this.desks.splice(index, 1);
                }
            })
        },
        addDesk($desk) {
            this.desks.push($desk);
        }
    },
}
</script>

<style scoped>

</style>
