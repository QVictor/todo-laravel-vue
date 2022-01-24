<template>
    <draggable
        @start="dragging=true"
        @end="dragging=false;"
        handle=".handle"
        :animation="100"
        @sort="setSort">
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
            let sortDesk = {};
            this.desks.forEach((desk, index) => {
                sortDesk[index] = {
                    'id': desk.id,
                    'sort': index
                };
            });
            console.log(sortDesk);
            axios.post('api/desk/sort', sortDesk)
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
