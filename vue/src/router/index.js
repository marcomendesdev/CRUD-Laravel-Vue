import Default from "@/layouts/Default.vue";
import Guest from "@/layouts/Guest.vue";
import Dashboard from "@/components/Dashboard.vue";
import Login from "@/components/Login.vue";
import Register from "@/components/Register.vue";
import FormAdd from "@/components/FormAdd.vue";
import FormUpdate from "@/components/FormUpdate.vue";
import Courses from "@/components/Courses.vue";
import MyCourses from "@/components/MyCourses.vue";
import { createRouter, createWebHistory } from "vue-router";

const routes = [
  {
    path: "/",
    redirect: "/dashboard",
    component: Default,
    meta: { requiresAuth: true },
    children: [
      {
        path: "/dashboard",
        name: "Dashboard",
        redirect: "/courses",
        component: Dashboard,
        children: [
          {
            path: "/courses",
            name: "Courses",
            component: Courses,
          },
          {
            path: "/mycourses",
            name: "MyCourses",
            component: MyCourses,
          },
          {
            path: "/formadd",
            name: "FormAdd",
            component: FormAdd,
          },
          {
            path: "/formupdate/:id",
            name: "FormUpdate",
            component: FormUpdate,
          },
        ],
      },
    ],
  },
  {
    path: "/guest",
    redirect: "/login",
    component: Guest,
    meta: { isGuest: true },
    children: [
      {
        path: "/login",
        name: "Login",
        component: Login,
      },
      {
        path: "/register",
        name: "Register",
        component: Register,
      },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !localStorage.getItem("token")) {
    next({name: "Login"});
  }
  else if (to.meta.isGuest && localStorage.getItem("token")) {
    next({name: "Courses"});
  }
  else {
    next();
  }
});

export default router;
