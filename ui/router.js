import Vue from 'vue'
import Router from 'vue-router'
import { scrollBehavior } from '~/utils'

Vue.use(Router)

const page = (path) => () =>
  import(`~/pages/${path}`).then((m) => m.default || m)

const routes = [
  {
    path: '/',
    name: 'index',
    component: page('index.vue'),
  },
  {
    path: '/dashboard',
    name: 'dashboard.index',
    component: page('dashboard.vue'),
  },

  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/register', name: 'register', component: page('auth/register.vue') },
  {
    path: '/register/notice',
    name: 'registration.notice',
    component: page('auth/registration/notice.vue'),
  },
  {
    path: '/password/reset',
    name: 'password.request',
    component: page('auth/password/email.vue'),
  },
  {
    path: '/password/reset/:token',
    name: 'password.reset',
    component: page('auth/password/reset.vue'),
  },
  {
    path: '/email/verify/:id',
    name: 'verification.show',
    component: page('auth/verification/verify.vue'),
  },
  {
    path: '/verification/resend',
    name: 'verification.index',
    component: page('auth/verification/resend.vue'),
  },

  // { path: '/home', name: 'home', component: page('home.vue') },
  // {
  //   path: '/settings',
  //   component: page('settings/index.vue'),
  //   children: [
  //     { path: '', redirect: { name: 'settings.profile' } },
  //     {
  //       path: 'profile',
  //       name: 'settings.profile',
  //       component: page('settings/profile.vue')
  //     },
  //     {
  //       path: 'password',
  //       name: 'settings.password',
  //       component: page('settings/password.vue')
  //     }
  //   ]
  // }

  {
    path: '/employees',
    name: 'employees',
    component: page('pim/employees.vue'),
    redirect: { name: 'employees.index' },
    children: [
      {
        path: '',
        name: 'employees.index',
        meta: { title: 'employees' },
        component: page('pim/employees/index.vue'),
      },
      {
        path: 'create',
        name: 'employees.create',
        meta: { title: 'create employees' },
        component: page('pim/employees/create.vue'),
      },
      {
        path: ':uuid',
        name: 'employees.show',
        meta: { title: '' },
        component: page('pim/employees/show.vue'),
      },
      //     {
      //       path: ':id/direct-reports',
      //       name: 'direct-report.index',
      //       meta: { title: 'Direct Reports' },
      //       component: page('pim/employees/direct-reports/index.vue'),
      //     },
      //     {
      //       path: ':id/indirect-reports',
      //       name: 'indirect-report.index',
      //       meta: { title: 'Indirect Reports' },
      //       component: page('pim/employees/indirect-reports/index.vue'),
      //     },
    ],
  },
]

export function createRouter() {
  return new Router({
    routes,
    scrollBehavior,
    mode: 'history',
  })
}
