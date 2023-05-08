<template>
  <div class="q-pa-md">
    <q-btn
      label="Nuevo Departamentos"
      color="positive"
      @click="nuevo_form"
      icon="add_circle"
      class="q-mb-xs"
    />
    
<!-- TABLA PRINCIPAL -->
    <q-table :filter="filter" title="DEPARTAMENTOS DE RTS"
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
        
           <q-td key="nombre" :props="props">
            {{props.row.nombre}}
          </q-td>
          
          <q-td key="estado" :props="props">
            {{props.row.estado}}
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
              color="red"
              @click="deleteRow(props)"
              icon="delete"
            ></q-btn>
          </q-td>
        </q-tr>
      </template>
    </q-table>

    <!--  nuevo departamento -->
    <q-dialog v-model="dialog_add">
      <q-card style="max-width: 80%; width: 50%">
        <q-card-section class="bg-green-14 text-white">
          <div class="text-h6"><q-icon name="add_circle" /> Nuevo Departamento</div>
        </q-card-section>
        <q-card-section class="q-pt-xs">
          <q-form @submit="onSubmit" class="q-gutter-md">
            <div class="row">
              <div class="col-12">
             
                <q-input
                  filled
                  dense
                  v-model="dato.nombre"
                  type="text"
                  label="Nombre del Departamento"
                  hint="Nombre del Departamento"
                  lazy-rules
                  :rules="[(val) => (val && val.length > 0) || 'Por favor ingresa datos']"
                />
                <q-select
                  filled
                  dense
                  v-model="dato.estado"
                   :options="options"
                  options-dense
                  type="text"
                  label="Lugar del Departamento"
                  hint="Lugar del Departamento"
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


 <!--  editar Departamento-->
    <q-dialog v-model="dialog_mod">
      <q-card style="max-width: 80%; width: 50%">
        <q-card-section class="bg-green-14 text-white">
          <div class="text-h6"><q-icon name="edit" /> Modificar Departamento</div>
        </q-card-section>
        <q-card-section class="q-pt-xs">
          <q-form @submit="onMod" class="q-gutter-md">
            <div class="row">
              <div class="col-12">
               
                <q-input
                  filled
                  v-model="dato2.nombre"
                  dense
                  type="text"
                  label="Nombre del Departamento"
                  hint="Nombre del Departamento"
                  lazy-rules
                  :rules="[(val) => (val && val.length > 0) || 'Por favor ingresa datos']"
                />
                <q-select
                  filled
                  dense
                  v-model="dato2.estado"
                  :options="options"
                  options-dense 
                  type="text"
                  label="Lugar del Departamento"
                  hint="Lugar del Departamento"
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
import { date } from 'quasar'
const { addToDate } = date
export default {
  name: `Departamento`,
  data() {
    return {
      columns: [
       // {name: "codigo", align: "left", label: "Codigo", field: "codigo", sortable: true,},
        {name: "nombre", align: "left", label: "nombre", field: "nombre", sortable: true,},
       // {name: "lugar", align: "left", label: "Lugar", field: "lugar", sortable: true,},
        {name: "estado", align: "center", label: "estado", field: "estado", sortable: true,},
        {name: "opcion", align: "right", label: "opcion", field: "opcion", sortable: false},
      ],
      data: [],
      dialog_add: false,
      dialog_mod: false,
      filter:'',
      dato: {},
      dato2: {},
      options: [
        'ACTIVO', 'PASIVO'
      ]
       
    };
  },
  created() {

    this.misdatos();
   
    
  },
  methods: {
     misdatos(){
        this.$q.loading.show();
      this.$api.get('departamentos').then(res=>{
        //console.log(res.data)
       this.data=res.data
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
   nuevo_form(){
     this.dialog_add=true
      this.dato.codigo=""
      this.dato.nombre=""
      this.dato.lugar=""
   },
    onSubmit(){
       this.$q.loading.show();
       this.dato.estado="ACTIVO"
      this.$api.post( "departamentos", this.dato).then((res) => {
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
                  title: 'Eliminar Departamento',
                  message: '¿Esta seguro de eliminar la departamento?',
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
                this.$api.delete("departamentos/" + this.dato2.id ).then((res) => {
                            this.$q.notify({
                              textColor: "positive",
                              icon: "done",
                              message: "Departamento Eliminado",
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
     this.dialog_mod=true
     },
      onMod() {
      this.$q.loading.show();
    
      this.$api.put("departamentos/" + this.dato2.id, this.dato2).then((res) => {
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
  }
};
</script>