<template>
    <div class="addTask">
        <input type="text" v-model="task.name"/>
        <font-awesome-icon
            icon="plus-square"
            @click="addTask()"
            :class="[ task.name ? 'active' : 'inactive', 'plus']"/>
    </div>
</template>

<script>
export default {
    props: ['desk_id'],
    data: function () {
        return {
            task: {
                name: "",
                desk_id: this.desk_id
            }
        }
    },
    methods: {
        addTask() {
            if (this.task.name === '') {
                return;
            }
            axios.post('api/task/store', {
                task: this.task,
                desk_id: this.desk_id
            })
                .then(response => {
                    if (response.status === 201) {
                        this.$emit('add', response.data);
                        this.task.name = "";
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        }
    }
}
</script>

<style>
.addTask {
    display: flex;
    justify-content: center;
    align-items: center;
}

input {
    text-align: center;
    background: #f7f7f7;
    border: 0px;
    outline: none;
    padding: 5px;
    margin-right: 10px;
    width: 100%;
}

.plus {
    font-size: 20px;
}

.active {
    color: #00CE25;
}

.inactive {
    color: gray;
}

</style>
