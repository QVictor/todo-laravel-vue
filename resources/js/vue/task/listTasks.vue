<template>
    <draggable
        @start="dragging=true"
        @end="dragging=false;"
        v-model="tasks"
        :animation="100"
        @sort="setSort"
        handle=".handle">
        <div v-for="(task,index) in tasks" :key="index">
            <one-task
                :task="task"
                @remove-task="removeTask($event)"
            />
        </div>
    </draggable>
</template>

<script>
import oneTask from "./oneTask";
import addTask from "./addTask";
import draggable from 'vuedraggable';

export default {
    props: ['tasks', 'desk_id'],
    components: {
        oneTask,
        addTask,
        draggable
    },
    methods: {
        removeTask(taskId) {
            this.tasks.forEach((task, index) => {
                if (task.id === taskId) {
                    this.tasks.splice(index, 1);
                }
            })
        },
        setSort(e) {
            console.log(this.tasks);
            let sort = {};
            this.tasks.forEach((task, index) => {
                sort[index] = {
                    'id': task.id,
                    'sort': index
                };
            });
            console.log(sort);
            axios.post('api/task/sort', sort)
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
