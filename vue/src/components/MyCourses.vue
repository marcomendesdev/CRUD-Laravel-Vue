<template>
  <v-main class="bg-grey-lighten-2">
    <v-container class="pa-12" fluid>
      <v-row>
        <v-col
          v-for="course in courses"
          :key="course.id"
          cols="12"
          sm="6"
          md="3"
        >
          <v-card
            class="mx-auto d-flex flex-column my-12"
            max-width="250"
            height="100%"
            rounded
          >
            <v-card-title>{{ course.name }}</v-card-title>
            <v-card-subtitle>About</v-card-subtitle>
            <v-card-text>{{ course.description }}</v-card-text>

            <v-card-actions class="ml-auto">
              <v-row justify="center">
                <v-btn color="primary" @click="getCourseId(course.id)">Edit</v-btn>
              </v-row>

              <v-btn color="red" @click="deleteCourse(course)">Delete</v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
      <h2 v-if="loading">Loading...</h2>

      <v-dialog v-model="dialog" persistent width="424">
        <v-card>
          <v-card-title>
            <span class="text-h5">Edit Course</span>
          </v-card-title>
          <v-card-text>
            <v-container>
              <v-row>
                <v-col>
                  <v-text-field v-model="name" label="Name"></v-text-field>
                  <v-text-field v-model="description" label="Description"></v-text-field>
                </v-col>
              </v-row>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue" @click="dialog = false">Cancel</v-btn>
            <v-btn color="blue" @click="updateCourse(selectedCourseId)">Save</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-container>
  </v-main>
</template>

<script setup>
import axiosClient from "@/axiosClient";
import { ref, onMounted } from "vue";

const courses = ref([]);
const loading = ref(true);
let userId = null;
const dialog = ref(false);
const name = ref("");
const description = ref("");
const selectedCourseId = ref(null);

const updateCourse = async (id) => {
  try {
    const response = await axiosClient.put(`/products/${id}`, {
      name: name.value,
      description: description.value,
    });
    courses.value = response;
  } catch (err) {
    console.log(err);
  } finally {
    loading.value = false;
    dialog.value = false;
    getCourses();
  }
};

const getCourses = async () => {
  try {
    const response = await axiosClient.get(`/products/${userId}`);
    courses.value = response;
  } catch (err) {
    console.log(err);
  } finally {
    loading.value = false;
  }
};

const deleteCourse = async (course) => {
    try {
      const response = await axiosClient.delete(`/products/${course.id}`);
      courses.value = response;
    } catch (err) {
      console.log(err);
    } finally {
      console.log(course.id);
      loading.value = false;
      getCourses();
    }
  };

const getCourseId = (id) => {
  selectedCourseId.value = id;
  dialog.value = true;
};

onMounted(async () => {
  try {
    const userResponse = await axiosClient.get("/user");
    userId = userResponse.id;
    getCourses();
  } catch (err) {
    console.log(err);
  }
});
</script>

