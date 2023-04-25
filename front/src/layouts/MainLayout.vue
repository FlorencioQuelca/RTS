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
          <q-chip  color="red" v-if="store.eventNumber!=0" text-color="white" icon="warning_amber" :label="store.eventNumber+' Pendientes para envio'" />
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
        
         <q-item-label header class="text-center q-pa-none q-ma-none" style="background: #fffff">
          <q-img src="RTS.png" width="150px" />
        </q-item-label>



        <q-item-label header
        class="text-grey-8">   Opciones del menu </q-item-label>
    
        <q-expansion-item dense exact expand-separator icon="o_home" label="Principal" default-opened to="/" expand-icon="null"/>
        <q-expansion-item dense exact expand-separator icon="login" label="Login" default-opened to="/Login" expand-icon="null" active-class="my-menu-link" />
        <q-expansion-item dense exact expand-separator icon="o_people" label="Usuarios" to="/User" expand-icon="null" active-class="my-menu-link"  v-if="store.usuarios"/>
        <q-expansion-item dense exact expand-separator icon="format_list_bulleted" label="Pedidos" to="/Pedidos" expand-icon="null"  active-class="my-menu-link" v-if="store.pedidos"/>
        <q-expansion-item dense exact expand-separator icon="o_price_change" label="Depositos" to="/Deposito" expand-icon="null" active-class="my-menu-link"  v-if="store.depositos" />
        <q-expansion-item dense exact expand-separator icon="receipt_long" label="Facturas/Recibos" to="/Factura" expand-icon="null" active-class="my-menu-link" v-if="store.facturas" />
        <q-expansion-item dense exact expand-separator icon="o_home_work" label="Proyectos" to="Proyectos" expand-icon="null" active-class="my-menu-link" v-if="store.proyectos" />
        <q-expansion-item dense exact expand-separator icon="summarize" label="Departamentos" to="Departamentos" expand-icon="null" active-class="my-menu-link" v-if="store.departamentos" />
        
            


       

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
     // this.eventSearch()
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
          localStorage.removeItem('tokenRTS')
          globalStore().isLoggedIn=false
          this.$router.push('/login')
          this.$q.loading.hide()
          globalStore().isLoggedIn=false

            globalStore().usuarios=false
            globalStore().pedidos=false
            globalStore().depositos=false
            globalStore().fotos=false
            globalStore().proyectos=false
            globalStore().departamentos=false
        })
      }).onCancel(() => {
      })
    },
      eventSearch(){
        this.$api.post('eventSearch').then(res=>{
         // console.log(res.data)
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