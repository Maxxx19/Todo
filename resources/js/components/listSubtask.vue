<template>
  <div class="list-group-item">
    <li class="d-flex justify-content-between w-auto">
      <!-- class="list-group-item d-flex justify-content-between w-50" -->
      <!-- <div> -->
      <!-- <input
      type="checkbox"
      @change="updateCheck()"
      v-model="item.status"
      class="mr-3"
      :checked="item.status=='Завершено' ? 'checked' : ''"
    /> -->
      <span :class="[item.status == 'Завершено' ? 'completed' : '', 'item']">
        {{ item.title }}
      </span>
      <span>{{ item.status }}</span>
      <span class="mr-5">{{ item.term }}</span>
      <!-- </div> -->

      <button class="btn-danger ml-3" @click="removeItem()">X</button>
    </li>
    <li class="d-flex justify-content-between w-auto">
      <span>{{ item.description }}</span>
    </li>
  </div>
</template>
  
<script>
export default {
  props: ["item"],
  methods: {
    updateCheck() {
      axios
        .put(`api/subtask/${this.subtasks.id}`, {
          subtasks: this.subtasks,
        })
        .then((res) => {
          if (res.status == 200) {
            this.$emit("itemchanged");
          }
        })
        .catch((error) => {
          console.log("error from axios put", errors);
        });
    },
    removeItem() {
      //console.log(this.item);
      //console.log(this.item.task_id);
      axios
        .delete(`api/subtask/${this.item.id}`)
        .then((res) => {
          if (res.status == 200) {
            this.$emit("itemchanged", this.item.task_id);
          }
        })
        .catch((error) => {
          console.log("error from axios delete ", error);
        });
    },
  },
};
</script>
  
  <style>
.completed {
  text-decoration: line-through;
  color: gray;
}
.item {
  word-break: break-all;
}
</style>