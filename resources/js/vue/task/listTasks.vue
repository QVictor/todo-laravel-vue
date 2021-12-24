<template>
    <div>
        <div v-for="(task,index) in tasks" :key="index">
            <one-task
                :task="task"
                class="task"
                v-on:taskchanged="$emit('reloadlist')"
                @remove-task="removeTask($event)"
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
        removeTask(taskId) {
            this.tasks.forEach((task, index) => {
                if (task.id === taskId) {
                    this.tasks.splice(index, 1);
                }
            })
        }
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
