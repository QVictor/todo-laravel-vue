<template>
    <div class="addDesk container px-0">
        <div class="input-group">
            <input type="text"
                   class="form-control col-9"
                   id="name"
                   placeholder="add new desk"
                   v-model="desk.name"/>
            <div class="input-group-append">
                <button
                class="btn btn-outline-success"
                @click="addDesk()"
                :class="[ desk.name ? 'active' : 'inactive']">+</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [],
    data: function () {
        return {
            desk: {
                name: "",
            }
        }
    },
    methods: {
        addDesk() {
            if (this.desk.name === '') {
                return;
            }
            axios.post('api/desk/store', {
                "name": this.desk.name,
                "sort": this.desk.id,
            })
                .then(response => {
                    if (response.status === 201) {
                        this.$emit('add-desk', response.data);
                        this.desk.name = "";
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
