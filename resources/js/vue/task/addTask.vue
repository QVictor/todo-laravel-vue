<template>
    <div class="addTask">
        <label for="addTask">Add new task:</label>
        <input type="text" id="addTask" class="col-9" v-model="task.name"/>
        <font-awesome-icon
            icon="plus-square"
            @click="addTask()"
            class="col-2"
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
                "name": this.task.name,
                "desk_id": this.desk_id
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
