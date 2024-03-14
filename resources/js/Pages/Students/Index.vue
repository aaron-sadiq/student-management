<template>
  <v-container fluid>
    <v-row>
      <v-col :cols="{ xs: 12, md: 6 }">
        <FormComponent />
      </v-col>
    </v-row>
    <v-row class="mt-4">
      <v-col :cols="{ xs: 12, md: 6 }">
        <DataTableComponent :items="students" :total="total" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup lang="ts">
import { defineProps } from 'vue';
import FormComponent from '../../components/FormComponent.vue';
import DataTableComponent from '../../components/DataTableComponent.vue';
import { Student } from '../../utils/types';


const props = defineProps({
  students: Array as () => Student[] | null,
  total: Number,

});
</script>

<style scoped>
.v-card {
  width: 100%;
  padding: 20px;
  max-width: 600px;
  margin: auto;
}

.mt-4 {
  margin-top: 16px;
}
</style>
