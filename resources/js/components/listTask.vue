<template>
  <div class="list-group-item">
    <li class="d-flex justify-content-between w-auto">
    <input
      type="checkbox"
      @change="updateCheck()"
      v-model="item.status"
      class="mr-3"
      :checked="item.status=='Завершено' ? 'checked' : ''"
    />
    <span :class="[(item.status=='Завершено') ? 'completed' : '', 'item']">
      {{ item.title }}
    </span>
    <span>{{ item.status }}</span>
    <span>{{ item.term }}</span>
    <!-- <list-view
          :subtasks="subtasks"
          v-on:reloadlist="getItems()"
          class="m-auto text-center mt-3"
    hidden /> -->
    <button class="btn-success ml-3" @click="showSubtasks()" @reloadlist="showSubtasks()">Subtasks</button>
    <button class="btn-danger ml-3" @click="removeItem()">X</button>
  </li>
  </div>
  
</template>

<script>
import listView from "./listSubtask";
export default {
  components: {
    listView,
  },
  props: ["item"],
  data: function () {
    return {
        subtasks: [],
    };
  },
  methods: {
    updateCheck() {
        this.item.status = 'Завершено',
      axios
        .put(`api/task/${this.item.id}`, {
          item: this.item,
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
    showSubtasks(){
        console.log("Task_id->"+this.item.id);
        axios
        .get(`api/subtasks/${this.item.id}`)
        .then((res) => {
          this.subtasks = res.data;
          this.$emit('subtasks', res.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    removeItem() {
      axios
        .delete(`api/task/${this.item.id}`)
        .then((res) => {
          if (res.status == 200) {
            this.$emit("itemchanged");
            this.subtasks = [
            {
              title: "No subtasks yet here",
              status: "",
              term: "",
              description: "",
            },
          ];
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