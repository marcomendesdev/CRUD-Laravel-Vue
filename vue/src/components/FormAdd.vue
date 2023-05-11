<template>
    <div class="d-flex justify-center align-center bg-blue-grey-darken-3" style="min-height: 100vh;">
      <v-card class="mx-auto px-6 py-8 w-100 aaa" max-width="344">
        <v-card-title class="text-center mb-2 w-100">Add new course</v-card-title>
        <v-form
          v-model="form"
          @submit.prevent="onSubmit"
        >
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
            v-model="password"
            :readonly="loading"
            :rules="[required]"
            clearable
            label="Confirm Password"
            placeholder="Enter your password"
            variant="solo"
            density="comfortable"
          ></v-text-field>
  
          <br>
  
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
  
  <script>
    export default {
      data: () => ({
        form: false,
        name: null,
        email: null,
        password: null,
        loading: false,
      }),
  
      methods: {
        onSubmit () {
          if (!this.form) return
  
          this.loading = true
  
          setTimeout(() => (this.loading = false), 2000)
        },
        required (v) {
          return !!v || 'Field is required'
        },
      },
    }
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