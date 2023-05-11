<template>
  <v-main class="bg-grey-lighten-2">
    <v-container class="pa-12" fluid>
      <v-row>
        <v-col v-for="course in courses" :key="course" cols="12" sm="6" md="3">
          <v-card class="mx-auto d-flex flex-column mt-auto my-12" height="100%" max-width="250" rounded>
            <v-card-title>{{ course.name }}</v-card-title>
            <v-card-subtitle>About</v-card-subtitle>
            <v-card-text>{{ course.description }}</v-card-text>

            <v-spacer></v-spacer>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-main>
</template>

<script setup>
import axiosClient from "@/axiosClient";
import { ref, onMounted } from "vue";

const courses = ref([]);

const getCourses = async () => {
  try {
    const response = await axiosClient.get("/products");
    courses.value = response;
    console.log(response);
  } catch (err) {
    console.log(err);
  }
};

onMounted(() => {
  getCourses();
});
</script>
