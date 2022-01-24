<template>
    <div class="addTask container px-0 g-10">
        <div class="input-group">
            <input type="text" class="form-control col-9" id="addTask" placeholder="add new task" aria-label="add new task" v-model="task.name">
            <div class="input-group-append">
                <button class="btn btn-outline-success"
                        @click="addTask()"
                        :class="[ task.name ? 'active' : 'inactive']"
                        type="button">+</button>
            </div>
        </div>
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
.active {
    color: #00CE25;
}

.inactive {
    color: gray;
}
</style>
