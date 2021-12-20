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
import listView from "./listTasks";
import addTaskForm from "./addTask";

export default {
    components: {addTaskForm, listView},
    comments: {
        addTaskForm,
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
