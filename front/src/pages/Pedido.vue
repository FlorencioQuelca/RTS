<template>
  <div class="q-pa-md">
    <q-btn
      label="Nuevo Pedido"
      color="positive"
      @click="nuevo_form"
      icon="add_circle"
      class="q-mb-xs"
    />
       <!-- Nuevo usuario-->
<!-- TABLA PRINCIPAL -->
    <q-table :filter="filter" title="Usuarios del sistema"
      :rows="data"
      :columns="columns"
      row-key="name"
      :rows-per-page-options="[10,50,100,0]"
       separator="cell"
       dense
       >
      <template v-slot:top-right>
        <q-input outlined borderless dense debounce="300" v-model="filter" placeholder="Buscar">
          <template v-slot:append>
            <q-icon name="search" />
          </template>
        </q-input>
      </template>
      <template v-slot:body="props">
        <q-tr :props="props">
          <q-td key="codigo" :props="props">
            {{props.row.codigo}}
          </q-td>
           <q-td key="departamento" :props="props">
            {{props.row.user.apartment}}
          </q-td>
          <q-td key="solicitante" :props="props">
            {{props.row.user.name}}
          </q-td>
          <q-td key="fecha" :props="props">
            {{props.row.fecha}} a:  {{props.row.hora}}
          </q-td>
           <q-td key="proyecto" :props="props">
            {{props.row.proyecto.nombre}}
          </q-td>
          <q-td key="justificacion" :props="props">
            {{props.row.justificacion}}
          </q-td>
          <q-td key="monto" :props="props">
            {{props.row.total}}
          </q-td>
          <q-td key="etapa" :props="props">
            {{props.row.etapa}}
          </q-td>
            <q-td key="estado" :props="props">
            {{props.row.estado}}
          </q-td>
            <q-td key="saldo" :props="props">
            {{props.row.saldo}}
          </q-td>
          <q-td key="opcion" :props="props">
          <q-btn
              dense
              round
              flat
              color="yellow"
              @click="editRow(props)"
              icon="edit"
          />
             <q-btn 
                        dense
                        round
                        flat
                        color="blue"
                        @click="verRow(props)"
                        icon="groups"
                      ></q-btn>
                       <q-btn v-if="store.user.type==='ADMINISTRADOR'"
                        dense
                        round
                        flat
                        color="green"
                        @click="click_send(props)"
                        icon="lock_open"
                      ></q-btn>
            <q-btn v-if="store.user.type==='ADMINISTRADOR'"
              dense
              round
              flat
              color="red"
              @click="deleteRow(props)"
              icon="delete"
            ></q-btn>
          </q-td>
        </q-tr>
      </template>
    </q-table>
   <!--  nuevo Pedido -->
    <q-dialog v-model="dialog_add">
      <q-card style="max-width: 80%; width: 50%">
        <q-card-section class="bg-green-14 text-white">
          <div class="text-h6"><q-icon name="add_circle" /> Nuevo Pedido de : {{ store.user.name }}</div>
        </q-card-section>
        <q-card-section class="q-pt-xs">
          <q-form @submit="onSubmit" class="q-gutter-md">
            <div class="row">
              <div class="col-12">
                <q-select
                  outlined
                  dense
                  v-model="proyecto"
                  :options="proyectos"
                  options-dense
                  type="text"
                  label="Nombre del Proyecto"
                  hint="Nombre del Proyecto"
                />
             <q-input
                  outlined
                  dense
                  v-model="dato.justificacion"
                  type="textarea"
                  label="justificacion"
                  hint="justificacion"
                  lazy-rules
                  :rules="[(val) => (val && val.length > 0) || 'Por favor ingresa datos']"
                />
               
              </div>
             
            </div>

            <div>
              <q-btn label="Crear" type="submit" color="positive" icon="add_circle" />
              <q-btn label="Cancelar" icon="delete" color="negative" v-close-popup />
            </div>
          </q-form>
        </q-card-section>
      </q-card>
    </q-dialog>

 <!--  editar Pedido -->
    <q-dialog v-model="dialog_mod">
      <q-card style="max-width: 80%; width: 50%">
        <q-card-section class="bg-green-14 text-white">
          <div class="text-h6"><q-icon name="edit" /> Modificar proyecto</div>
        </q-card-section>
        <q-card-section class="q-pt-xs">
          <q-form @submit="onMod" class="q-gutter-md">
            <div class="row">
              <div class="col-12">
                  <q-select
                  outlined
                  dense
                  v-model="proyecto"
                  :options="proyectos"
                  options-dense
                  type="text"
                  label="Nombre del Proyecto"
                  hint="Nombre del Proyecto"
                />
               
                <q-input
                  outlined
                  dense
                  v-model="dato2.justificacion"
                  type="textarea"
                  label="justificacion"
                  hint="justificacion"
                  lazy-rules
                  :rules="[(val) => (val && val.length > 0) || 'Por favor ingresa datos']"
                />
              </div>
             
            </div>

            <div>
              <q-btn label="Crear" type="submit" color="positive" icon="add_circle" />
              <q-btn label="Cancelar" icon="delete" color="negative" v-close-popup />
            </div>
          </q-form>
        </q-card-section>
      </q-card>
    </q-dialog>



  </div>
</template>

<script>
import {globalStore} from "stores/globalStore";
import { date } from 'quasar'
const { addToDate } = date
export default {
  name: `Pedido`,
  data() {
    return {
  
      columns: [
        {name: "codigo", align: "left", label: "N° ", field: "codigo", sortable: true,},
        {name: "departamento", align: "left", label: "Departamento", field: "departamento", sortable: true,},
        {name: "solicitante", align: "left", label: "Solicitante", field: "solicitante", sortable: true,},
        {name: "fecha", align: "left", label: "Fecha y Hora", field: "fecha", sortable: true,},
        {name: "proyecto", align: "left", label: "Nombre del Proyecto", field: "proyecto", sortable: true,},
        {name: "justificacion", align: "left", label: "Justificacion", field: "justificacion", sortable: true,},
        {name: "monto", align: "left", label: "Monto Solicitado", field: "monto", sortable: true,},
        {name: "etapa", align: "left", label: "Etapa", field: "etapa", sortable: true,},
        {name: "estado", align: "left", label: "Estado", field: "estado", sortable: true,},
        {name: "saldo", align: "left", label: "Saldo", field: "saldo", sortable: true,},
        { name: "opcion", label: "Opcion", field: "action", sortable: false },
      ],
       data: [],
      dialog_add: false,
      dialog_mod: false,
      filter:'',
      dato: {},
      dato2: {},
      options: [
        'ACTIVO', 'PASIVO'
      ],
      proyectos:[],
      proyecto:{},
      autorizadores:[],
       store: globalStore(),
    };
  },
  created() {
    this.misdatos();
    this.misproyectos();
    this.misautorizados();
  },
 methods: {
     misdatos(){
        this.$q.loading.show()
        this.$api.get('pedidos').then(res=>{
      //  console.log(res.data)
         this.data=res.data
         this.$q.loading.hide()
         }).catch(err=>{
            this.$q.notify({
          message:err.response.data.message,
          icon:'close',
          color:'red'
        })
        this.$q.loading.hide()
     })
     },
     misproyectos(){
       // this.$q.loading.show()
        this.proyectos=[]
      this.$api.get('proyectosactivos').then(res=>{
             res.data.forEach((it)=>{
              this.proyectos.push({label:it.nombre, value:it.id})
            })
    }).catch(err=>{
        this.$q.notify({
          message:err.response.data.message,
          icon:'close',
          color:'red'
        })
     
     })
     },
      misautorizados(){
        this.autorizadores=[]
      this.$api.get('usersadmin').then(res=>{
      //  console.log(res.data);
             res.data.forEach((it)=>{
              this.autorizadores.push(it.name)
            })
    }).catch(err=>{
        this.$q.notify({
          message:err.response.data.message,
          icon:'close',
          color:'red'
        })
     })
     },
   nuevo_form(){
     this.dato.codigo=""
      this.dato.nombre=""
      this.dato.lugar=""
     // this.misproyectos()
       if(this.proyectos.length!=null){
         
         this.proyecto=this.proyectos[0]
       }else{
         this.proyecto ={label:'no existe proyectos registrados',value:0}
       }
      // this.misautorizados()
         this.dialog_add=true
   },
    onSubmit(){
      this.$q.loading.show()
      this.dato.proyecto_id=this.proyecto.value
      this.dato.user_id=this.store.user.id
      this.$api.post( "pedidos", this.dato).then((res) => {
        this.$q.notify({
          color: "green-4",
          textColor: "white",
          icon: "cloud_done",
          message: "Creado correctamente",
        });
        this.dialog_add = false;
        this.misdatos();
       this.$q.loading.hide()
      }).catch(err=>{
        console.log(err.response.data);
        this.$q.notify({
          message:err.response.data.message,
          icon:'close',
          color:'red'
        })
        this.$q.loading.hide()
      })
    },
    deleteRow(props){
      this.dato2=props.row
        this.$q.dialog({
                  title: 'Eliminar Pedido',
                  message: '¿Esta seguro de eliminar el Pedido?',
                  ok: {
                  push: true,
                   color: 'positive'
                  },
                    cancel: {
                  push: true,
                    color: 'negative'
                   }
                }).onOk(() => {
                 this.$q.loading.show()
                this.$api.delete("pedidos/" + this.dato2.id ).then((res) => {
                            this.$q.notify({
                              textColor: "positive",
                              icon: "done",
                              message: "Pedido Eliminado",
                            });
                          this.$q.loading.hide()
                          this.misdatos()
                  }).catch(err=>{
                      console.log(err.response.data);
                      this.$q.notify({
                        message:err.response.data.message,
                        icon:'close',
                        color:'red'
                      })
                  this.$q.loading.hide()
                })
                }).onCancel(() => {
                    this.$q.loading.hide()
                })
     },
     editRow(props){
      this.dato2=props.row
      this.proyecto={}
      this.proyectos.forEach(it => {
           if(it.label===props.row.proyecto.nombre){
                this.proyecto={label:it.label,value:it.value}
           }
        });
      this.dialog_mod=true
     },
      onMod() {
      this.$q.loading.show();
      this.dato2.proyecto_id=this.proyecto.value
      this.$api.put("pedidos/" + this.dato2.id, this.dato2).then((res) => {
          this.$q.notify({
            color: "green-4",
            textColor: "white",
            icon: "cloud_done",
            message: "Modificado correctamente",
          });
          this.dialog_mod = false;
          this.misdatos();
          this.$q.loading.hide()
        }).catch(err=>{
        console.log(err.response.data);
        this.$q.notify({
          message:err.response.data.message,
          icon:'close',
          color:'red'
        })
        this.$q.loading.hide()
      })
    },
    verRow(item){
      this.dato2 = item.row;
      this.$router.push({name: 'DetallePedidos.view', params: {id:this.dato2.id}})
    },
    click_send(item){

                 this.$q.dialog({
                  title: 'Habilitar Pedido',
                  message: '¿Esta seguro HABILITAR el pedido para edicion ?',
                  ok: {
                  push: true,
                   color: 'positive'
                  },
                    cancel: {
                  push: true,
                    color: 'negative'
                   }
                }).onOk(() => {
                 this.$q.loading.show()
             
                  this.$api.put("pedidoedit/"+item.row.id, {etapa:"NUEVO"}).then((res) => {
                    this.$q.notify({
                        color: "green-4",
                        textColor: "white",
                        icon: "cloud_done",
                        message: "Enviado correctamente",
                    });
                    this.misdatos();
                    this.$q.loading.hide()
                    }).catch(err=>{
                    console.log(err.response.data);
                    this.$q.notify({
                    message:err.response.data.message,
                    icon:'close',
                    color:'red'
                    })
                    this.$q.loading.hide()
                })
                }).onCancel(() => {
                    this.$q.loading.hide()
                })
     
     }
  }
  
};
</script>