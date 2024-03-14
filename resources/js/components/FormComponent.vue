<template>
  <v-card class="elevation-1 my-10">
    <v-form @submit.prevent="submitForm">
      <v-text-field v-model="form.username" label="Username" required></v-text-field>
      <div v-if="form.errors.username" class="text-red bg-danger p-2 rounded my-2">{{ form.errors.username }}</div>
      <v-text-field v-model="form.email" label="Email" required></v-text-field>
      <div v-if="form.errors.email" class="text-red bg-danger p-2 rounded my-2">{{ form.errors.email }}</div>
      <v-btn type="submit" class="mr-4" color="primary">Save</v-btn>
    </v-form>
  </v-card>
</template>

<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import { FormFields } from '../utils/types';


const form = useForm<FormFields>({
  username: "",
  email: "",
});

const submitForm = async () => {
form.post('/students', {
    onSuccess: () => form.reset(),
})

};
</script>
