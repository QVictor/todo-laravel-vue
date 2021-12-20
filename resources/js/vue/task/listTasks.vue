<template>
    <div>
        <add-task :desk_id="desk_id" @add-task="reloadListTask()"/>
        <div v-for="(task,index) in tasks" :key="index">
            <one-task
                :task="task"
                class="task"
                v-on:taskchanged="$emit('reloadlist')"
            />
        </div>
    </div>
</template>

<script>
import oneTask from "./oneTask";
import addTask from "./addTask";

export default {
    props: ['tasks', 'desk_id'],
    components: {
        oneTask,
        addTask
    },
    methods: {
        reloadListTask() {
            console.log('reloadListTask');
            axios.get('api/desks')
                .then(response => {
                    Object.entries(response.data).forEach(element => {
                        if (element[1].id === this.desk_id) {
                            this.tasks = element[1].tasks
                        }
                    });
                    console.log(this.tasks);
                })
                .catch(error => {
                    console.log(error);
                })
        },
    },
}
</script>

<style scoped>
.task {
    background: #dddddd;
    padding: 5px;
    margin: 5px;
}
</style>
