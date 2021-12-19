<template>
    <div>
        <input type="text"
               v-model="desk.name"/>
        <list-view
            :tasks="desk.tasks"

        />
    </div>
</template>

<script>
import listView from "../task/listView";

export default {
    components: {
        listView
    },
    props: ['desk']
}
</script>

<style scoped>

</style>
