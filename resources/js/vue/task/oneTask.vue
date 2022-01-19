<template>
    <div class="container task">
        <div class="row">
            <div class="col-2">
                <input type="checkbox"
                       @change="updateCheck()"
                       v-model="task.completed"/>
            </div>
            <div class="col-8">
                <input v-model="task.name"
                       @change="updateName()"
                       :class="[task.completed ? 'completed' : '', 'taskText']">
            </div>
            <div class="col-1">
                <button @click="removeTask()" class="trashcan">
                    <font-awesome-icon icon="trash"/>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['task'],
    methods: {
        updateCheck() {
            axios.put('api/task/' + this.task.id, this.task)
                .then(response => {
                    if (response.status === 200) {
                        console.log('update check success');
                    } else if (response.status === 204) {
                        console.log('task not found');
                    } else {
                        console.log('unknown status')
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        },
        updateName() {
            axios.put('api/task/' + this.task.id, this.task)
                .then(response => {
                    if (response.status === 200) {
                        console.log('update name success');
                    } else if (response.status === 204) {
                        console.log('task not found');
                    } else {
                        console.log('unknown status')
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
                        this.$emit('remove-task', response.data.id)
                    } else if (response.status === 204) {
                        console.log('element not found');
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

.task {
    background: #dddddd;
    padding: 5px;
    margin: 5px;
}

.task > input {
    text-align: center;
    background: #f7f7f7;
    border: 0px;
    outline: none;
    padding: 5px;
    margin-right: 10px;
    width: 100%;
}

.taskText {
    width: 100%;
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
