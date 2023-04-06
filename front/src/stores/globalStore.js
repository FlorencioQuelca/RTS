import { defineStore } from 'pinia';

export const globalStore = defineStore('global', {
  state: () => ({
    counter: 0,
    user: {},
    user: {},
    roles: [],
    isLoggedIn: !!localStorage.getItem('tokenRTS'),
    

  }),
  getters: {
    doubleCount: (state) => state.counter * 2,
  },
  actions: {
    increment() {
      this.counter++;
    },
  },
});