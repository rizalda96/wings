import Vue from 'vue'
import Router from 'vue-router'
import Container from '@components/Container'
import ProductList from '@components/ProductList'
import ProductDetail from '@components/ProductDetail'
import CartDetail from '@components/CartDetail'


Vue.use(Router)

export const createRouter = () => {
  const mainRoutes = [
    {
      path: '/',
      redirect: '/',
      component: Container,
      children: [
        {
          path: '/',
          name: 'home',
          component: ProductList,
        },
        {
          path: '/product/:index/:code/detail',
          props: true,
          name: 'product-detail',
          component: ProductDetail,
        },
        {
          path: '/:slug/cart',
          name: 'cart',
          props: true,
          component: CartDetail,
        },
      ],
    },
  ]

  const router = new Router({
    mode: 'history',
    base: '',
    scrollBehavior: () => ({ y: 0, x: 0 }),
    routes: mainRoutes
  })

  router.beforeEach((to, from, next) => {
    next()
  })
  return router
}



