<template>
    <div class="desks container">
        <draggable
            class="row"
            v-model="desks"
            @start="dragging=true"
            @end="dragging=false;"
            @sort="setSort"
            :animation="100"
            handle=".handle"
        >
            <div class="desk col-sm" v-for="(desk,index) in desks" :key="index">
                <one-desk
                    :desk="desk"
                    v-on:reload="reload()"
                    @remove-desk="removeDesk($event)"
                />
            </div>
            <add-desk slot='footer' class="col-sm" @add-desk="addDesk($event)"/>
        </draggable>
    </div>
</template>

<script>
import oneDesk from "./oneDesk";
import addDesk from "./addDesk";
import draggable from 'vuedraggable';

export default {
    components: {oneDesk, addDesk, draggable},
    props: ['desks'],
    dragging: false,
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
        },
        setSort(e) {
            let sort = {};
            this.desks.forEach((desk, index) => {
                sort[index] = {
                    'id': desk.id,
                    'sort': index
                };
            });
            console.log(sort);
            axios.post('api/desk/sort', sort)
                .then(response => {
                    console.log('success set sorting');
                    console.log(response);
                })
                .catch(error => {
                    console.log('error set sorting');
                    console.log(error);
                });
        }
    },
}
</script>

<style scoped>
</style>
