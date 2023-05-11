<template>
  <div
    class="d-flex justify-center align-center bg-blue-grey-darken-3"
    style="min-height: 100vh"
  >
    <v-card class="mx-auto px-6 py-8 w-100 aaa" max-width="344">
      <v-card-title class="text-center mb-2 w-100">Register</v-card-title>
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
          v-model="email"
          :readonly="loading"
          :rules="[required]"
          class="mb-2"
          clearable
          label="Email"
          variant="solo"
          density="comfortable"
        ></v-text-field>

        <v-text-field
          v-model="password"
          :readonly="loading"
          :rules="[required]"
          clearable
          label="Password"
          placeholder="Enter your password"
          variant="solo"
          density="comfortable"
        ></v-text-field>

        <v-text-field
          v-model="password_confirmation"
          :readonly="loading"
          :rules="[required]"
          clearable
          label="Confirm Password"
          placeholder="Confirm your password"
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
          Sign Up
        </v-btn>
      </v-form>
      <v-card-text class="text-center mt-2 w-100"
        >Already registered?
        <router-link class="text-decoration-none" to="/login"
          >Log in</router-link
        ></v-card-text
      >
    </v-card>
  </div>
</template>

<script setup>
import { ref } from "vue";
import {useAppStore} from '@/store/app'
import {useRouter} from 'vue-router'

const appStore = useAppStore()
const router = useRouter()

const form = ref(false);
const loading = ref(false);
const name = ref(null);
const email = ref(null);
const password = ref(null);
const password_confirmation = ref(null);

const onSubmit = () => {
  if (!form.value) return;

  loading.value = true;

  setTimeout(() => (loading.value = false), 2000);

  const userPayload = {
    name: name.value,
    email: email.value,
    password: password.value,
    password_confirmation: password_confirmation.value,
  };

  appStore.registerUser(userPayload)
    .then(() => {
      router.push({name: 'Dashboard'})
    })
    .catch((err) => {
      console.log(err)
    })
};

const required = (v) => {
  return !!v || "Field is required";
};
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
