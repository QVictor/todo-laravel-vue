<template>
    <div class="desk d-flex flex-column gap-1">
        <div class="desk d-flex justify-content-center">
            <div class="fa fa-align-justify handle col-1 align-self-center" role="button"></div>
            <div>
                <input type="text"
                       class="form-control desk-name col-8"
                       @change="updateName()"
                       v-model="desk.name"/>
            </div>
            <button @click="removeDesk()" class="trashcan col-2">
                <i class="fas fa-trash"></i>
            </button>
        </div>
        <add-task
            :desk_id="desk.id"
            @add="addTaskInListTasks($event)"/>
        <list-tasks
            :tasks="desk.tasks"
            :desk_id="desk.id"
        />
    </div>
</template>

<script>
import listTasks from "../task/listTasks"
import addTask from "../task/addTask";

export default {
    components: {
        listTasks,
        addTask
    },
    props: ['desk'],
    methods: {
        addTaskInListTasks($task) {
            this.desk.tasks.push($task);
        },
        removeDesk() {
            console.log(this.desk.id);
            axios.delete('api/desk/' + this.desk.id)
                .then(response => {
                    if (response.status === 200) {
                        this.$emit('remove-desk', response.data.id)
                    } else if (response.status === 204) {
                        console.log('element not found');
                    }
                })
                .catch(error => {
                    console.log(error)
                })
        },
        updateName() {
            console.log(this.desk);
            axios.put('api/desk/' + this.desk.id, this.desk)
                .then(response => {
                    if (response.status === 200) {
                        console.log('update name success');
                    } else if (response.status === 204) {
                        console.log('desk not found');
                    } else {
                        console.log('unknown status')
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        }
    }
}
</script>

<style scoped>
.trashcan {
    background: #e6e6e6;
    border: none;
    color: #ff0000;
    outline: none;
}
</style>
