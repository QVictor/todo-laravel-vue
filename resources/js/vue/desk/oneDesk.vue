<template>
    <div>
        <input type="text"
               class="desk-name"
               v-model="desk.name"/>
        <add-task :desk_id="desk.id" @add="addTaskInListTasks($event)"/>
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
        }
    }
}
</script>

<style scoped>
    .desk-name {
        text-align: center;
    }
</style>
