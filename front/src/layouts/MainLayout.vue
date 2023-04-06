<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="toggleLeftDrawer"
        />

        <q-toolbar-title class=" text-h4 text-bold">
          {{ store.user.name }}
          <span class=" text-subtitle2 text-red">{{ store.user.email }}</span>
        </q-toolbar-title>

       
        <div>
          <q-chip  color="red" v-if="store.eventNumber!=0" text-color="white" icon="warning_amber" :label="store.eventNumber+' Facturas no enviadas'" />
          <b>Usuario:</b>{{store.user.name}}
          <q-btn
            flat
            dense
            round
            icon="exit_to_app"
            aria-label="Menu"
            @click="logout"></q-btn>
        </div>
      </q-toolbar>
    </q-header>

 <q-drawer v-model="leftDrawerOpen" show-if-above bordered  class="bg-grey-1">
      <q-list bordered padding class="rounded-borders text-primary">
        <q-item-label header
        class="text-grey-8">   Opciones del menu </q-item-label>
    
              <q-item clickable active-class="my-menu-link" to="/" exact>
                    <q-item-section avatar>
                      <q-icon color="teal" name="home" />
                    </q-item-section>
                    <q-item-section>Principal</q-item-section>
              </q-item>
        
          <q-item 
               clickable v-ripple to="/login" exact>
          <q-item-section avatar>
            <q-icon color="teal" name="login" />
          </q-item-section>
          <q-item-section>Ingreso</q-item-section>
        </q-item>


          <q-item  
           clickable   active-class="my-menu-link" to="/User" exact>
          <q-item-section avatar>
            <q-icon color="teal" name="today" />
          </q-item-section>
          <q-item-section>Usuarios</q-item-section>
        </q-item>

         <q-item    
         clickable   active-class="my-menu-link" to="/" exact>
          <q-item-section avatar>
            <q-icon color="teal" name="summarize" />
          </q-item-section>
          <q-item-section>Reportes</q-item-section>
        </q-item>


        <q-item 
         clickable  @click="logout">
          <q-item-section avatar>
            <q-icon color="teal" name="logout" />
          </q-item-section>
          <q-item-section>Salir</q-item-section>
        </q-item>

      </q-list>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import {globalStore} from "stores/globalStore";
 export default {
  name: 'MainLayout',
  data () {
    return {
           leftDrawerOpen: false,
        store:globalStore()
      }
  },
  created() {
      this.eventSearch()
  },
   methods: {
    logout(){
      this.$q.dialog({
        title: 'Cerrar sesión',
        message: '¿Está seguro que desea cerrar sesión?',
        cancel: true,
        persistent: true
      }).onOk(() => {
        this.$q.loading.show()
        this.$api.post('logout').then(() => {
          globalStore().user={}
          localStorage.removeItem('tokenMulti')
          globalStore().isLoggedIn=false
          this.$router.push('/login')
          this.$q.loading.hide()
          globalStore().isLoggedIn=false
        })
      }).onCancel(() => {
      })
    },
      eventSearch(){
        this.$api.post('eventSearch').then(res=>{
          console.log(res.data)
          this.store.eventNumber=res.data
        })
      },
      toggleLeftDrawer() {
        this.leftDrawerOpen = !this.leftDrawerOpen
      }
    }
  }
</script>


<style lang="sass">
.my-menu-link
  color: blue
  background: #F2C037
</style>