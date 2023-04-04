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

        <q-toolbar-title>
          EMPRESAM CONSTRUCTORA RTS
        </q-toolbar-title>

        <div>rts</div>
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
               clickable v-ripple to="/Login" exact>
          <q-item-section avatar>
            <q-icon color="teal" name="login" />
          </q-item-section>
          <q-item-section>Ingreso</q-item-section>
        </q-item>


          <q-item  
           clickable   active-class="my-menu-link" to="/Usuarios" exact>
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
import { defineComponent, ref } from 'vue'
 export default defineComponent({
  name: 'MainLayout',

  components: {
   // EssentialLink
  },

  setup () {
    const leftDrawerOpen = ref(false)

    return {
    //  essentialLinks: linksList,
      leftDrawerOpen,
      toggleLeftDrawer () {
        leftDrawerOpen.value = !leftDrawerOpen.value
      }
    }
  },
   methods:{
    logout(){
      this.$q.loading.show()
      this.$store.dispatch('login/logout')
        .then(() => {
          this.$q.loading.hide()
          this.$router.push('/login')
        })
    }
  },
  mounted() {
    // console.log(this.$store.state.login.user.name)
  }
})
</script>
<style lang="sass">
.my-menu-link
  color: blue
  background: #F2C037
</style>