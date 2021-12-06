<template>
    <div>
        <div v-for="(task,index) in tasks" :key="index">
            <list-task
                :task="task"
                class="task"
                v-on:taskchanged="$emit('reloadlist')"
            />
        </div>
    </div>
</template>

<script>
import listTask from "./listTasks";

export default {
    props: ['tasks'],
    components: {
        listTask
    }
}
</script>

<style scoped>
.task {
    background: #dddddd;
    padding: 5px;
    margin: 5px;
}
</style>
