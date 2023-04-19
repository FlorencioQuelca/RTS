import { defineStore } from 'pinia';

export const globalStore = defineStore('global', {
  state: () => ({
    counter: 0,
    user: {},
    user: {},
    roles: [],
    isLoggedIn: !!localStorage.getItem('tokenRTS'),
    usuarios:false,
    pedidos:false,
    depositos:false,
    fotos:false,
    proyectos:false,
    departamentos:false,
  
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