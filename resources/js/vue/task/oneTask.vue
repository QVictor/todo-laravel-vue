<template>
    <div class="task">
        <input type="checkbox"
               @change="updateCheck()"
               v-model="task.completed"/>
        <input v-model="task.name"
               @change="updateName()"
            :class="[task.completed ? 'completed' : '', 'taskText']">
        <button @click="removeTask()" class="trashcan">
            <font-awesome-icon icon="trash"/>
        </button>
    </div>
</template>

<script>
export default {
    props: ['task'],
    methods: {
        updateCheck() {
            axios.put('api/task/' + this.task.id, {
                task: this.task
            })
                .then(response => {
                    if (response.status === 200) {
                        console.log('update check success');
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        },
        updateName() {
            axios.put('api/task/' + this.task.id, {
                task:this.task
            })
            .then(response => {
                if (response.status === 200) {
                    console.log('update name success');
                }
            })
            .catch(error => {
                console.log(error);
            })
        },
        removeTask() {
            axios.delete('api/task/' + this.task.id)
                .then(response => {
                    if (response.status === 200) {
                        console.log(response.data);
                        this.$emit('remove-task', response.data)
                    }
                })
                .catch(error => {
                    console.log(error)
                })
        }
    }
}
</script>

<style scoped>
.completed {
    text-decoration: line-through;
    color: #999999;
}

.taskText {
    width: 100%;
    margin-left: 20px;
}

.task {
    display: flex;
    justify-content: center;
    align-items: center;
}

.trashcan {
    background: #e6e6e6;
    border: none;
    color: #ff0000;
    outline: none;
}
</style>
