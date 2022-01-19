<template>
    <div>
        <div v-for="(task,index) in tasks" :key="index">
            <one-task
                :task="task"
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

</style>
