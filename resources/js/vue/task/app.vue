<template>
    <div class="todoListContainer">
        <div class="heading">
            <h2 id="title">
                Todo List
            </h2>
            <add-task-form
                v-on:reloadlist="getList()"/>
        </div>
        <list-view
            :tasks="tasks"
            v-on:reloadlist="getList()"/>
    </div>
</template>

<script>
import listView from "./listView";
import addTaskForm from "./addTaskForm";
import {forEach} from "lodash/fp/_util";

export default {
    components: {addTaskForm: addTaskForm, listView},
    comments: {
        addTaskForm: addTaskForm,
        listView
    },
    data: function () {
        return {
            tasks: []
        }
    },
    methods: {
        getList() {
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
    created() {
        this.getList();
    }
}
</script>

<style scoped>
.todoListContainer {
    width: 350px;
    margin: auto;
}

.heading {
    background: #e6e6e6;
    padding: 10px;
}

#title {
    text-align: center;
}
</style>
