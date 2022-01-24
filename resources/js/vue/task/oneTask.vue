<template>
    <div class="container task">
        <div class="input-group align-items-center gap-1">
            <div class="fa fa-align-justify handle col-1" role="button"></div>
            <div class="col-1">
                <input type="checkbox"
                       @change="updateCheck()"
                       class="form-check-input"
                       v-model="task.completed"/>
            </div>
            <div class="col-8 pl-0 pr-0">
                <input v-model="task.name"
                       class="form-control"
                       @change="updateName()"
                       :class="[task.completed ? 'completed' : '', 'taskText']">
            </div>
            <div class="col-1 px-0">
                <button @click="removeTask()" class="trashcan">
                    <i class="fas fa-trash"></i>
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
}

.taskText {
    width: 100%;
}

.trashcan {
    background: #e6e6e6;
    border: none;
    color: #ff0000;
    outline: none;
}
</style>
