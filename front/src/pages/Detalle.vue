<template>
  <div class="q-pa-md">
  <q-btn
      label="Atras"
      color="secondary"
      icon="arrow_back"
      @click="this.$router.push('/Pedidos')"
      class="q-mb-xs"
    />
    <q-card
      class="my-card text-white"
      style="
        background: radial-gradient(circle, #35a2ff 0%, #014a88 100%);
        padding: 0px;
      "
      square
      flat
       bordered
     >
      <q-card-section>
        <div class="row" style="padding: 0px">
          <div class="q-pa-md col-12" style="padding: 0px">
            <div class="row" style="padding: 0px; border: 0px; display: flex">
              <div
                class="q-pa-md col-8"
                style="
                  color: white;
                  text-align: right;
                  padding: 0px;
                  border: 0px;
                ">
                <span>DATOS GENERALES DEL PEDIDO </span>
              </div>
            </div>
            <q-table
              class="my-sticky-header-column-table"
              :rows="rows"
              :columns="columna"
               row-key="titulo"
              separator="cell"
              :rows-per-page-options="[0]"
              hide-bottom
              dense
            >
             <template v-slot:body="props">
              <q-tr :props="props">
                <q-td key="titulo" :props="props">
                  {{ props.row.titulo }}
                </q-td>
                 <q-td key="descripcion" :props="props" v-if="props.row.titulo!=='Total del Pedido [Bs] : '" >
                  {{ props.row.descripcion }}
                </q-td>
                 <q-td key="descripcion" :props="props"  v-if="props.row.titulo==='Total del Pedido [Bs] : '" style="color:blue; font-weight:700" >
                  {{ adicionarComas(props.row.descripcion) }}
                </q-td>
                </q-tr>
                </template>
            </q-table>
          </div>
        
        </div>
      </q-card-section>


        
        <q-btn v-if="this.data.etapa==='NUEVO'"
                icon="send"
                 label="ENVIAR PEDIDO PARA APROBACION"
                @click="click_send"
                color="red-14"
               
        />

<!--   lista-->
    
        <q-card-section class="bg-green-14 text-white" style="padding: 2px 2px 2px 25px">
         <div class="row"  style="
              display: flex;
              flex-direction: row;
              justify-content: space-between;
            " >
           <q-btn  v-if="this.data.etapa==='NUEVO'"
                icon="add_circle"
                 label="Nuevo"
                @click="click_add"
                color="blue"
              
              />
          <div class="text-h6" dense>DETALLE DEL PEDIDO</div>
             
             <div/>
             {{total}}
              </div>
             
        </q-card-section>
        <q-card-section class="q-pt-xs">
          <q-table
            :rows="data.detalles"
            :columns="subcol1"
            separator="cell"
            dense
            :rows-per-page-options="[0]"
          >
            <template v-slot:body="props">
              <q-tr :props="props">
                <q-td key="num" :props="props">
                  {{ props.row.num }}
                </q-td>
                <q-td key="cantidad" :props="props">
                  {{ props.row.cantidadrecibo }}
                </q-td>
                <q-td key="unidad" :props="props">
                  {{ props.row.unidad }}
                </q-td>
                <q-td key="detalle" :props="props">
                  {{ props.row.detallerecibo }}
                </q-td>
                <q-td key="precio" :props="props">
                  {{ props.row.preciorecibo }}
                </q-td>
                 <q-td key="subtotal" :props="props">
                  {{ props.row.subtotalrecibo }}
                </q-td>
                <q-td key="opcion" :props="props">
                    <q-btn v-if="this.data.etapa==='NUEVO'"
                        dense
                        round
                        flat
                        color="yellow"
                        @click="editRow(props)"
                        icon="edit"
                    />
                        <q-btn  v-if="this.data.etapa==='NUEVO'"
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
        </q-card-section>

        <q-expansion-item
        dense
        dense-toggle
        expand-separator
        icon="perm_identity"
        label="Account settings"
        header-class="text-purple"
         default-opened
      >
      <q-card>
        <q-card-section class="bg-green-14 text-white" style="padding: 2px 2px 2px 25px">
         <div class="row"  style="
              display: flex;
              flex-direction: row;
              justify-content: space-between;
            " >
           <q-btn
                icon="add_circle"
                 label="IMAGEN"
                @click="click_add"
                color="blue"
              
              />
                <div class="text-h6" dense>cargar cotizaciones</div>
             <div/>
             {{total}}
              </div>
             
        </q-card-section>



        <q-card-section class="q-pt-xs">
         <q-carousel
                swipeable
                animated
                arrows
                v-model="slide"
                v-model:fullscreen="fullscreen"
                infinite
              >
                 <q-carousel-slide :name="1" img-src="https://cdn.quasar.dev/img/mountains.jpg" />
      <q-carousel-slide :name="2" img-src="https://cdn.quasar.dev/img/parallax1.jpg" />
      <q-carousel-slide :name="3" img-src="https://cdn.quasar.dev/img/parallax2.jpg" />
      <q-carousel-slide :name="4" img-src="https://cdn.quasar.dev/img/quasar.jpg" />
                
                <template v-slot:control>
        <q-carousel-control
          position="bottom-right"
          :offset="[18, 18]"
        >
          <q-btn
            push round dense color="white" text-color="primary"
            :icon="fullscreen ? 'fullscreen_exit' : 'fullscreen'"
            @click="fullscreen = !fullscreen"
          />
        </q-carousel-control>

         

        </template>
</q-carousel>

        </q-card-section>
        </q-card>
      </q-expansion-item>
        
        


      </q-card>


 <!--  Nuevo item de Pedido -->
    <q-dialog v-model="dialog_add_detalle">
      <q-card style="max-width: 80%; width: 50%">
        <q-card-section class="bg-green-14 text-white">
          <div class="text-h6"><q-icon name="add_circle" />Nuevo Item</div>
        </q-card-section>
        <q-card-section class="q-pt-xs">
          <q-form @submit="onAddDetalle" class="q-gutter-md">
            
              <div class="row">
                <div class="col-6">
                  <q-input
                  outlined
                  dense
                  v-model="dato.cantidadrecibo"
                  type="number"
                   step="1"
                  label="Cantidad "
                  hint="Cantidad "
                  lazy-rules
                  :rules="[(val) => (val  > 0) || 'Por favor ingresa datos']"
                  />  
                </div>
                <div class="col-6">
                        <q-input
                        outlined
                        dense
                        v-model="dato.unidad"
                        type="text"
                        label="Unidad"
                        hint="Cantidad "
                        lazy-rules
                        :rules="[(val) => (val && val.length > 0) || 'Por favor ingresa datos']"
                        /> 
                </div>
             </div>
                <div class="row">    
                          <div class="col-12">
                            <q-input
                            outlined
                            dense
                            v-model="dato.detallerecibo"
                            type="text"
                            label="Detalle"
                            hint="Detalle"
                            lazy-rules
                            :rules="[(val) => (val && val.length > 0) || 'Por favor ingresa datos']"
                            />
                          </div>
                     </div>
                <div class="row">  
                <div class="col-12">
                 <q-input
                  outlined
                  dense
                  v-model="dato.preciorecibo"
                  type="number"
                  step="0.01"
                  label="Precio"
                  hint="Precio"
                  lazy-rules
                  :rules="[(val) => (val  > 0) || 'Por favor ingresa datos']"
                />
                </div>
                </div>
                 <div style="color:red">
                subtotal : <span style="color:green; font-weight:700"> {{sumar}}</span>
               </div>
            <div>
              <q-btn label="Crear" type="submit" color="positive" icon="add_circle" />
              <q-btn label="Cancelar" icon="delete" color="negative" v-close-popup />
            </div>
          </q-form>
        </q-card-section>
      </q-card>
    </q-dialog>


 <!-- EDITAR ITEL DEL  pedido -->
    <q-dialog v-model="dialog_mod_detalle">
      <q-card style="max-width: 80%; width: 50%">
        <q-card-section class="bg-green-14 text-white">
          <div class="text-h6"><q-icon name="edit" />Edit Item N° {{dato2.num}} :  {{dato2.detallerecibo}}</div>
        </q-card-section>
        <q-card-section class="q-pt-xs">
          <q-form @submit="onModDetalle" class="q-gutter-md">
            
              <div class="row">
                <div class="col-6">
                  <q-input
                  outlined
                  dense
                  v-model="dato2.cantidadrecibo"
                  type="number"
                   step="1"
                  label="Cantidad "
                  hint="Cantidad "
                  lazy-rules
                  :rules="[(val) => (val  > 0) || 'Por favor ingresa datos']"
                  />  
                </div>
                <div class="col-6">
                        <q-input
                        outlined
                        dense
                        v-model="dato2.unidad"
                        type="text"
                        label="Unidad"
                        hint="Cantidad "
                        lazy-rules
                        :rules="[(val) => (val && val.length > 0) || 'Por favor ingresa datos']"
                        /> 
                </div>
             </div>
                <div class="row">    
                          <div class="col-12">
                            <q-input
                            outlined
                            dense
                            v-model="dato2.detallerecibo"
                            type="text"
                            label="Detalle"
                            hint="Detalle"
                            lazy-rules
                            :rules="[(val) => (val && val.length > 0) || 'Por favor ingresa datos']"
                            />
                          </div>
                     </div>
                <div class="row">  
                <div class="col-6">
                 <q-input
                  outlined
                  dense
                  v-model="dato2.preciorecibo"
                  type="number"
                  step="0.01"
                  label="Precio"
                  hint="Precio"
                  lazy-rules
                  :rules="[(val) => (val  > 0) || 'Por favor ingresa datos']"
                />
                </div>
                 <div class="col-6">
                  <q-input
                  outlined
                  dense
                  v-model="dato2.num"
                  type="number"
                  step="1"
                  label="Numero de Item"
                  hint="Numero de Item"
                  lazy-rules
                  :rules="[(val) => (val  > 0) || 'Por favor ingresa datos']"
                />
                </div>
                 
                </div>
                <div style="color:red">
                  subtotal : <span style="color:green; font-weight:700"> {{sumar2}}</span>
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
 const reverseFecha=(fecha)=>{
         let fecha1=fecha.split("-")
         let ans=""
         let meses={
            1:"enero",
            2:"febrero",
            3:"marzo",
            4:"abril",
            5:"mayo",
            6:"junio",
            7:"julio",
            8:"agosto",
            9:"septiembre",
            10:"octubre",
            11:"noviembre",
            12:"diciembre",
         }
         return Number(fecha1[2])+" de "+meses[Number(fecha1[1])]+" de "+fecha1[0]
      }
     const horalarga=(hora)=>{
         let hora1=hora.split(":")
         let answer=""
          if(Number(hora1[0])>=12){
            answer=Number(hora1[0])+" : "+Number(hora1[1])+" PM"
          }else{
            answer=Number(hora1[0])+" : "+Number(hora1[1])+" AM"
          }
        return answer
      }
 const columna = [{
    name: 'titulo',required: true,label: 'Titulo',align: 'right',field: 'titulo'
  },
  { name: 'descripcion',   align:'lefth', label: 'Descripcion', field: 'descripcion' },
];
export default {
     name: `Detalle`,
  data: () => ({
     store: globalStore(),
    data: {},
    dato: {},
    dato2:{},
    rows:[],
    columna,
    total:0,
    dialog_add_detalle:false,
    dialog_mod_detalle:false,
    filter:'',
    slide: 1,
    fullscreen:false,
    expanded: false,
    subcol1: [
    {name: "num",required: true, label: "N°",align: "left",field: "num",sortable: false,},
    {name: "cantidad",label: "Cantidad",align: "left",field: "cantidad",sortable: false,},
    {name: "unidad",label: "Unidad",align: "left",field: "unidad",sortable: false,},
    {name: "detalle",label: "Detalle",align: "left",field: "detalle",sortable: false,},
    {name: "precio",label: "Precio Unitario",align: "left",field: "precio",sortable: false,},
    {name: "subtotal",label: "Costo [Bs]",align: "center",field: "subTotal",sortable: false,},
    {name: "opcion",label: "opcion",align: "left",field: "opcion",sortable: false,},
    ],
    group: "op1",
  }),
  computed:{
    sumar(){
        return Number.parseFloat(Number(this.dato.cantidadrecibo)*Number(this.dato.preciorecibo)).toFixed(2)
     },
    sumar2(){
        return Number.parseFloat(Number(this.dato2.cantidadrecibo)*Number(this.dato2.preciorecibo)).toFixed(2)
     }
  },
  created() {
    this. misdatos()

  },
  mounted() {
   // this.cargarConsultores();
    //this.cargarEmpresas();
    //this.cargarSociedades();
    //this.misdatos();
  },
  methods: {
     misdatos() {
      this.$q.loading.show();
      this.rows=[]
      this.$api.get("pedidoid/" + this.$route.params.id).then((res) => {
          this.data = res.data[0];
          this.total=0.0
           this.rows.push({titulo:"Codigo : ", descripcion: res.data[0].codigo})
           this.rows.push({titulo:"Departamento  y Solicitante: " , descripcion: res.data[0].user.apartment+  " , "+res.data[0].user.name})
           this.rows.push({titulo:"Fecha  y Hora de Solicitud :", descripcion: reverseFecha(res.data[0].fecha)+ " Horas: "+  horalarga(res.data[0].hora)})
           this.rows.push({titulo:"Nombre del Proyecto : ", descripcion: res.data[0].proyecto.nombre})
           this.rows.push({titulo:"Justificacion : ", descripcion: res.data[0].justificacion})
           this.rows.push({titulo:"Etapa  y Estado : ", descripcion: res.data[0].etapa +" , "+res.data[0].estado})
            res.data[0].detalles.forEach((it)=> {
                this.total+=Number(it.subtotalrecibo)
             })
           this.rows.push({titulo:"Total del Pedido [Bs] : ", descripcion:Number.parseFloat(this.total).toFixed(2) })
           this.rows.push({titulo:"Monto Transferido [Bs] :", descripcion: res.data[0].saldo})
           this.rows.push({titulo:"Por transferir [Bs] :", descripcion: res.data[0].saldo})

          this.$q.loading.hide();
        });
    },
    click_add(){
         this.dato.preciorecibo=0.3
         this.dato.cantidadrecibo=1
         this.dato.detallerecibo=""
         this.dato.unidad="Pza"
         this.dialog_add_detalle=true
        },
    onAddDetalle(){
        this.dato.subtotalrecibo= Number.parseFloat(this.dato.cantidadrecibo*this.dato.preciorecibo).toFixed(2)
          this.$q.loading.show()
         // console.log(this.data.id)
      this.dato.pedido_id=this.data.id
      this.$api.post( "detalle", this.dato).then((res) => {
        this.$q.notify({
          color: "green-4",
          textColor: "white",
          icon: "cloud_done",
          message: "Creado correctamente",
        });
        this.dialog_add_detalle = false;
        this.misdatos();
       this.$q.loading.hide()
      }).catch(err=>{
        console.log(err.response.data);
        this.$q.notify({
          message:err.response.data.message,
          icon:'close',
          color:'red'
        })
          this.dialog_add_detalle = false;
        this.$q.loading.hide()
      })
    },
    editRow(item){
        this.dato2=item.row
        this.dialog_mod_detalle=true
    },
    onModDetalle(){
          this.dato2.subtotalrecibo= Number.parseFloat(this.dato2.cantidadrecibo*this.dato2.preciorecibo).toFixed(2)
      this.$q.loading.show();
      this.$api.put("detalle/" + this.dato2.id, this.dato2).then((res) => {
          this.$q.notify({
            color: "green-4",
            textColor: "white",
            icon: "cloud_done",
            message: "Modificado correctamente",
          });
          this.dialog_mod_detalle=false
          this.misdatos();
          this.$q.loading.hide()
        }).catch(err=>{
        console.log(err.response.data);
        this.$q.notify({
          message:err.response.data.message,
          icon:'close',
          color:'red'
        })
        this.dialog_mod_detalle=false
        this.$q.loading.hide()
      })
    },
     deleteRow(props){
      this.dato2=props.row
        this.$q.dialog({
                  title: 'Eliminar Item',
                  message: '¿Esta seguro de eliminar el Item?',
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
                this.$api.delete("detalle/" + this.dato2.id ).then((res) => {
                            this.$q.notify({
                              textColor: "positive",
                              icon: "done",
                              message: "Item Eliminado",
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
     click_send(){

                 this.$q.dialog({
                  title: 'Enviar pedido para aprobacion',
                  message: '¿Esta seguro enviar el pedido para aprobacion ?',
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
             
                  this.$api.put("pedidoedit/"+this.$route.params.id, {etapa:"ENVIADO"}).then((res) => {
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
     
     },
       adicionarComas(numero){
      let cadena= numero.split('.')
      let ans=''
      let j=0
      switch (cadena[0].length) {
        case 1:
           ans=cadena[0]
          break;
        case 2:
           ans=cadena[0]
          break;
        case 3:
           ans=cadena[0]
          break;
        case 4:
           ans=cadena[0][0]+','+cadena[0][1]+cadena[0][2]+cadena[0][3]
          break;
        case 5:
           ans=cadena[0][0]+cadena[0][1]+','+cadena[0][2]+cadena[0][3]+cadena[0][4]
          break;
        case 6:
           ans=cadena[0][0]+cadena[0][1]+cadena[0][2]+','+cadena[0][3]+cadena[0][4]+cadena[0][5]
          break;
        case 7:
           ans=cadena[0][0]+','+cadena[0][1]+cadena[0][2]+cadena[0][3]+','+cadena[0][4]+cadena[0][5]+cadena[0][6]
          break;
        case 8:
           ans=cadena[0][0]+cadena[0][1]+','+cadena[0][2]+cadena[0][3]+cadena[0][4]+','+cadena[0][5]+cadena[0][6]+cadena[0][7]
          break;
        case 9:
           ans=cadena[0][0]+cadena[0][1]+cadena[0][2]+','+cadena[0][3]+cadena[0][4]+cadena[0][5]+','+cadena[0][6]+cadena[0][7]+cadena[0][8]
          break;
        case 10:
           ans=cadena[0][0]+','+cadena[0][1]+cadena[0][2]+cadena[0][3]+','+cadena[0][4]+cadena[0][5]+cadena[0][6]+','+cadena[0][7]+cadena[0][8]+cadena[0][9]
          break;
        default:
             ans=cadena[0]
          break;
      }
      return ans+'.'+cadena[1]
    }

      
  }
 };

</script>