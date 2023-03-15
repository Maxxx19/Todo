<template>
    <div class="mt-4">
        <h4>Subtasks list</h4>
        <hr class="w-50 m-auto mb-3" />
        <ul>
            <!-- class="list-group m-auto" -->
            <list-item
                :item="item"
                v-on:itemchanged="$emit('reloadlist')"
                v-for="item in subtasks"
                :key="item.id"
                
                @itemchanged="changeSubtasks"
            />
            <!-- class="m-auto my-1 text-justify text-wrap" -->
        </ul>
    </div>
</template>

<script>
import listItem from "./listSubtask";

export default {
    components: {
        listItem
    },
    props: ["subtasks"],
    methods: {
        changeSubtasks(value) {
            console.log("Task:" + value);
            this.$emit('reloadsubtasks', value);
        },
    },
};
</script>

<style scoped></style>