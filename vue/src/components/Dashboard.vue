<template>
  <v-app>
    <v-app-bar color="deep-purple-darken-4">
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

      <v-toolbar-title>Dashboard</v-toolbar-title>
    </v-app-bar>

    <v-navigation-drawer
      v-model="drawer"
      temporary
      color="deep-purple-darken-4"
    >
      <!--  -->
      <v-list>
        <v-list-item to="/courses">Courses</v-list-item>
        <v-list-item to="/mycourses">My Courses</v-list-item>
        <v-list-item @click.prevent="logout">Log out</v-list-item>
      </v-list>
    </v-navigation-drawer>

    <router-view></router-view>
  </v-app>
</template>

<script setup>
import { ref } from "vue";
import {useAppStore} from '@/store/app'
import {useRouter} from 'vue-router'

const appStore = useAppStore()
const router = useRouter()

const drawer = ref(null);

const logout = async () => {
  try {
    appStore.userLogout();
    router.push({ name: 'Login' });
  } catch (err) {
    console.log(err);
  }
};
</script>
