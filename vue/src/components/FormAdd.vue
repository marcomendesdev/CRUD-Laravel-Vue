<template>
  <div
    class="d-flex justify-center align-center bg-blue-grey-darken-3"
    style="min-height: 100vh"
  >
    <v-card class="mx-auto px-6 py-8 w-100 aaa" max-width="344">
      <v-card-title class="text-center mb-2 w-100">Add new course</v-card-title>
      <v-form v-model="form" @submit.prevent="onSubmit">
        <v-text-field
          v-model="name"
          :readonly="loading"
          :rules="[required]"
          class="mb-2"
          clearable
          label="Name"
          variant="solo"
          density="comfortable"
        ></v-text-field>

        <v-text-field
          v-model="description"
          :readonly="loading"
          :rules="[required]"
          class="mb-2"
          clearable
          label="Description"
          variant="solo"
          density="comfortable"
        ></v-text-field>

        <br />

        <v-btn
          :loading="loading"
          block
          color="success"
          size="large"
          type="submit"
          variant="elevated"
        >
          Submit
        </v-btn>
      </v-form>
    </v-card>
  </div>
</template>

<script setup>
import axiosClient from "@/axiosClient";
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";

const form = ref(false);
const name = ref(null);
const loading = ref(false);
const description = ref(null);
const userId = ref(null);
const router = useRouter();

const onSubmit = () => {
  if (!form.value) return;

  loading.value = true;

  setTimeout(() => (loading.value = false), 2000);

  addCourse();
};

async function addCourse() {
  try {
    const response = await axiosClient.post(`/products/${userId.value}`, {
      name: name.value,
      description: description.value,
      user_id: userId.value,
    });
    console.log(response);
  } catch (err) {
    console.log(err);
  } finally {
    loading.value = false;
    router.push({ name: "MyCourses" });
  }
}

const required = (v) => {
  return !!v || "Field is required";
};

onMounted(async () => {
  const response = await axiosClient.get('/user');
  userId.value = response.id;
  console.log(response);
})
</script>

<style scoped>
.aaa {
  animation: fadeindown 0.25s ease-in-out;
}

@keyframes fadeindown {
  from {
    opacity: 0;
    transform: translate3d(0, -50%, 0);
  }
  to {
    opacity: 1;
    transform: translate3d(0, 0, 0);
  }
}
</style>
