<template>
  <div class="card text-center m-3">
    <h1 class="text-danger">Todo list</h1>
    <div class="row">
      <div class="col-lg-6">
        <add-task-form
          class="m-auto text-center mt-3"
          v-on:reloadlist="getItems()"
        />
      </div>
      <div class="col-lg-6">
        <add-subtask-form
          :items="items"
          class="m-auto text-center mt-3"
          v-on:reloadlist="getItems()"
          @reloadsubtasks="reloadSubItems"
        />
      </div>
      <div class="col-lg-6">
        <list-view
          :items="items"
          v-on:reloadlist="getItems()"
          class="text-center mt-3"
          @subtasks="getSubtasks"
        />
      </div>
      <div class="col-lg-6">
        <list-view-sub
          :subtasks="subtasks"
          @reloadsubtasks="reloadSubItems"
          class="text-center mt-3"
        />
      </div>
    </div>
  </div>
</template>

<script>
import addTaskForm from "./addTaskForm";
import addSubtaskForm from "./addSubtaskForm";
import listView from "./listView";
import listViewSub from "./listViewSub";

export default {
  components: {
    addTaskForm,
    addSubtaskForm,
    listView,
    listViewSub,
  },

  data: function () {
    return {
      items: [],
      subtasks: this.getSubItems()
        ? [
            {
              title: "No subtasks yet here",
              status: "",
              term: "",
              description: "",
            },
          ]
        : this.getSubItems(),
      task_id: "",
    };
  },
  methods: {
    getSubtasks(value) {
      if (value.length) this.subtasks = value;
      else
        this.subtasks = [
          {
            title: "No subtasks yet here",
            status: "",
            term: "",
            description: "",
          },
        ];
    },
    reloadSubItems(task_id) {
      console.log(task_id);
      //console.log("Task_id-->"+this.item.id);
      axios
        .get("api/subtasks/" + task_id)
        .then((res) => {
          console.log(res.data.length);
          if (res.data.length) this.subtasks = res.data;
          else
            this.subtasks = [
              {
                title: "No subtasks yet here",
                status: "",
                term: "",
                description: "",
              },
            ];
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getSubItems() {
      axios
        .get("api/subtasks/" + this.task_id)
        .then((res) => {
          console.log(res.data.length);
          if (res.data.length) this.subtasks = res.data;
          else
            this.subtasks = [
              {
                title: "No subtasks yet here",
                status: "",
                term: "",
                description: "",
              },
            ];
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getItems() {
      axios
        .get("api/tasks")
        .then((res) => {
          this.items = res.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  created() {
    this.getItems();
  },
};
</script>

<style scoped></style>