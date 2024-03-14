<template>
  <v-data-table-server :headers="headers" :items="items" @update:options="loadItems" :loading="loading" :items-length="total" >
    <template v-slot:item.action="{ item }">
      <v-btn @click="deleteStudent(item)" color="red">Delete</v-btn>
    </template>
  </v-data-table-server>
</template>

<script setup lang="ts">


import { router, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { Student } from '../utils/types';


const props = defineProps({
  items: Array as () => Student[] | null,
  total: Number,
});

const loading = ref(false);
const perPage = ref(10)

const headers = [
  { align: "start", key: "id", sortable: true, title: "ID" },
  { key: "username", title: "Name", sortable: true },
  { key: "email", title: "Email", sortable: false },
  { key: "action", title: "Actions", sortable: false },
];

const loadItems = async({itemsPerPage, page, sortBy}) => {

  await router.get(route('students.index'), {perPage: itemsPerPage, page, sortBy}, {
    preserveState: true,
    preserveScroll: true,
    onStart: () => loading.value = false,
    onSuccess: () => loading.value = false
  })
}
const form = useForm({
    username: "",
    email: "",
});

const deleteStudent = (student: Student) => {
    const confirmation = confirm("Are you sure you want to delete this student?");
    if (confirmation) {
        form.delete(`students/${student.id}`);
    }
};
</script>
