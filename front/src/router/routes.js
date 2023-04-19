//import Login from "pages/Login";
const User = import('../pages/User.vue')
const Login = import('../pages/Login.vue')
const Pedido = import('../pages/Pedido.vue')
const Proyecto = import('../pages/Proyecto.vue')
const DetallePedidos = import('../pages/Detalle.vue')
const Departamentos = import('../pages/Departamento.vue')
const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
    { path: '', component: () => import('pages/IndexPage.vue') },
   
      { path: '/User', component: User,meta: { requiresAuth: true }},
      { path: '/Pedidos', component: Pedido,meta: { requiresAuth: true }},
      { path: '/Proyectos', component: Proyecto,meta: { requiresAuth: true }},
      { path: '/Departamentos', component:Departamentos,meta: { requiresAuth: true }},
      { path: '/DetallePedidos/:id/view',  name: 'DetallePedidos.view',component: DetallePedidos,meta: { requiresAuth: true}},
    //  { path: 'Deposito', component: Deposito,meta: { requiresAuth: true }},
    ]
  },
  {
    path: '/login',
    component: Login,
  },
  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  }
]

export default routes
