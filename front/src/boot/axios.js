import { boot } from 'quasar/wrappers'
import axios from 'axios'
import {globalStore} from "stores/globalStore";
// Be careful when using SSR for cross-request state pollution
// due to creating a Singleton instance here;
// If any client changes this (global) instance, it might be a
// good idea to move this instance creation inside of the
// "export default () => {}" function below (which runs individually
// for each client)
const api = axios.create({ baseURL: process.env.API })

export default boot(({ app,router}) => {
  // for use inside Vue files (Options API) through this.$axios and this.$api

  app.config.globalProperties.$axios = axios
  // ^ ^ ^ this will allow you to use this.$axios (for Vue Options API form)
  //       so you won't necessarily have to import axios in each vue file

  app.config.globalProperties.$api = api

  const token = localStorage.getItem('tokenRTS')
  if (token) {
    api.defaults.headers.common.Authorization = `Bearer ${token}`
    api.post('me').then((response) => {
      //console.log(response.data)
      globalStore().user = response.data
      globalStore().isLoggedIn = true
      response.data.permisos.forEach(r => {
        //  if(r.id==0) globalStore().booluser=true
         
      });
    }).catch((error) => {
      app.config.globalProperties.$api.defaults.headers.common['Authorization']=''
      globalStore().user={}
      localStorage.removeItem('tokenRTS')
      globalStore().isLoggedIn=false
     
      router.push('/login')
    })
  }else {
    router.push('/login')
    globalStore().user={}
    globalStore().isLoggedIn=false
    localStorage.removeItem('tokenRTS')
    globalStore().isLoggedIn=false
  }
  // ^ ^ ^ this will allow you to use this.$api (for Vue Options API form)
  //       so you can easily perform requests against your app's API
})

export { api }
