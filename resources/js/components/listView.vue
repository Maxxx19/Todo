<template>
    <div class="mt-4">
        <h4>Tasks list</h4>
        <hr class="w-50 m-auto mb-3" />
        <ul>
            <list-item
                :item="item"
                v-on:itemchanged="$emit('reloadlist')"
                v-for="item in items"
                :key="item.id"
                class="my-1 text-justify text-wrap"
                @subtasks="getSubtasks"
            />
        </ul>
    </div>
</template>

<script>
import listItem from "./listTask";

export default {
    components: {
        listItem
    },
    props: ["items"],
    methods: {
        getSubtasks(value) {
            this.$emit('subtasks', value);
        },
    },
};
</script>

<style scoped></style>