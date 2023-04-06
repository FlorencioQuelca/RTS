//import Login from "pages/Login";
const User = import('../pages/User.vue')
const Login = import('../pages/Login.vue')
const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
    { path: '', component: () => import('pages/IndexPage.vue') },
   
      { path: 'User', component: User,meta: { requiresAuth: true }},
  
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
