export const routes = [
  {
    path: '/',
    name: 'index',
    file: '@/pages/index.vue',
  },
  // {
  //   path: '/dashboard',
  //   name: 'dashboard.index',
  //   file: '@/pages/dashboard.vue',
  // },

  {
    path: '/login',
    name: 'login',
    file: '@/pages/auth/login.vue'
  },
  // {
  //   path: '/register',
  //   name: 'register',
  //   file: '@/pages/auth/register.vue'
  // },
  // {
  //   path: '/register/notice',
  //   name: 'registration.notice',
  //   file: '@/pages/auth/registration/notice.vue',
  // },
  {
    path: '/password/reset',
    name: 'password.request',
    file: '@/pages/auth/password/email.vue',
  },
  {
    path: '/password/reset/:token',
    name: 'password.reset',
    file: '@/pages/auth/password/reset.vue',
  },
  {
    path: '/email/verify/:id',
    name: 'verification.show',
    file: '@/pages/auth/verification/verify.vue',
  },
  {
    path: '/verification/resend',
    name: 'verification.index',
    file: '@/pages/auth/verification/resend.vue',
  },
  // admin routes
  {
    path: '/a/dashboard',
    name: 'admin::dashboard.index',
    file: '@/pages/skooltek/admin/dashboard.vue',
  },
  // teacher routes
  {
    path: '/t/dashboard',
    name: 'teacher::dashboard.index',
    file: '@/pages/skooltek/teacher/dashboard.vue',
  },
  // parent routes
  {
    path: '/p/dashboard',
    name: 'parent::dashboard.index',
    file: '@/pages/skooltek/parent/dashboard.vue',
  },
  // student routes
  {
    path: '/s/dashboard',
    name: 'student::dashboard.index',
    file: '@/pages/skooltek/student/dashboard.vue',
  }
]
