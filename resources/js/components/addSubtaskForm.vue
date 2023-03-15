<template>
  <div class="mt-3">
    <div class="container m-2 w-100">
      <h2>Add subtask form</h2>
      <div class="m-2">Chose the task:</div>
      <div class="d-flex justify-content-center">
        <select
          class="form-select w-auto m-2"
          @input="saveTaskId($event.target.value)"
        >
          <option :value="null" disabled selected>Select the Task</option>
          <option v-for="task in items" :key="task.title" :value="task.id">
            {{ task.title }}
          </option>
        </select>
      </div>
      <div class="m-2">
        <input
          type="test"
          placeholder="Add subtask title"
          class="border"
          v-model="item.title"
        />
      </div>
      <div class="m-2">
        <div>Chose deadline:</div>
        <DatePicker
          v-model="item.term"
          :min-date="new Date()"
          mode="date"
          ref="calendar"
        />
      </div>
      <div class="m-2">Status:</div>
      <div class="d-flex justify-content-center">
        <select v-model="item.status" class="form-select w-auto m-2 border">
          <option value="Ждет">Ждет</option>
          <option value="В работе">В работе</option>
          <option value="Завершено">Завершено</option>
        </select>
      </div>
      <div class="m-2">
        <div>Description:</div>
        <textarea class="border" v-model="item.description"> </textarea>
      </div>
      <button
        :class="[
          item.name && item.status && item.term
            ? 'active btn btn-primary'
            : 'notactive btn btn-primary',
        ]"
        @click="addItem()"
      >
        Add +
      </button>
    </div>
  </div>
</template>
  <script>
import { Calendar, DatePicker } from "v-calendar";
import "v-calendar/dist/style.css";
export default {
  components: {
    Calendar,
    DatePicker,
  },
  props: ["items"],
  data: function () {
    return {
      //const calendar = this.$refs.calendar;
      item: {
        term: "",
      },
      task_id: "",
    };
  },
  methods: {
    saveTaskId(value) {
      this.task_id = value;
      console.log(this.task_id);
    },
    addItem() {
      if (this.item.title == "") {
        return;
      }
      axios
        .post("api/subtask/store/" + this.task_id, {
          item: this.item,
        })
        .then((res) => {
          if (res.status == 201) {
            this.item.name = "";
            this.$emit("reloadlist");
            this.$emit("reloadsubtasks", this.task_id);
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
  
  <style scoped>
.active {
  color: white;
  background-color: blue;
}
.inactive {
  color: gray;
}
</style>