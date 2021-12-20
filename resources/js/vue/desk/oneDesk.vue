<template>
    <div>
        <input type="text"
               v-model="desk.name"/>
        <list-tasks
            :tasks="desk.tasks"
            :desk_id="desk.id"
            v-on:taskchanged="$emit('reloadlist')"
        />
    </div>
</template>

<script>
import listTasks from "../task/listTasks"

export default {
    components: {
        listTasks
    },
    props: ['desk']
}
</script>

<style scoped>

</style>
