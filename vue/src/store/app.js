import axiosClient from '@/axiosClient';
import { defineStore } from 'pinia'

export const useAppStore = defineStore('app', {
  state: () => ({
   user: {
    data: {},
    token: localStorage.getItem('token'),
   }
  }),
  actions: {
    async registerUser(user) {
      try {
        const response = await axiosClient.post('/register', user);
        localStorage.setItem('token', response.token);
      } catch (error) {
        console.log(error);
      }
    },
    async login(user) {
      try {
        const response = await axiosClient.post('/login', user);
        localStorage.setItem('token', response.token);
      } catch (error) {
        console.log(error);
      }
    },
    userLogout() {
      localStorage.removeItem('token');
    }
  },
  getters: {},
})
