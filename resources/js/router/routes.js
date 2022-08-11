function page(path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  { path: '/', name: 'welcome', component: page('welcome.vue') },

  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/register', name: 'register', component: page('auth/register.vue') },
  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },
  { path: '/recipe', name: 'list.recipe', component: page('auth/list/recipe.vue') },

  { path: '/home', name: 'home', component: page('home.vue') },

  { path: '/list/recipe', name: 'list.recipe', component: page('list/recipe.vue') },
  { path: '/list/ingredient', name: 'list.ingredient', component: page('list/ingredient.vue') },

  { path: '/create/recipe', name: 'create.recipe', component: page('create/recipe.vue') },
  { path: '/create/ingredient', name: 'create.ingredient', component: page('create/ingredient.vue') },


  { path: '/edit/recipe', name: 'edit.recipe', component: page('edit/recipe.vue') },
  { path: '/edit/ingredient', name: 'edit.ingredient', component: page('edit/ingredient.vue') },

  {
    path: '/settings',
    component: page('settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile',  name: 'settings.profile',  component: page('settings/profile.vue') },
      { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
    ]
  },

  { path: '*', component: page('errors/404.vue') }
]
