<template>
    <div class="addDesk">
        <input type="text" id="name" v-model="desk.name"/>
        <font-awesome-icon
            icon="plus-square"
            @click="addDesk()"
            :class="[ desk.name ? 'active' : 'inactive', 'plus']"/>
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
            })
                .then(response => {
                    if (response.status === 201) {
                        this.$emit('add', response.data);
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
.addDesk {
    display: flex;
/*    justify-content: center;
    align-items: center;*/
}

/*input {
    text-align: center;
    background: #f7f7f7;
    border: 0px;
    outline: none;
    padding: 5px;
    margin-right: 10px;
    width: 100%;
}*/

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
