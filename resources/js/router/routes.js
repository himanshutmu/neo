const routes = [
    {
        path: '/home',
        component: () => import('../components/Home.vue'),
        name: 'home'
    },
    {
        path: '/test',
        component: () => import('../components/ExampleComponent.vue'),
        name: 'test'
    },
    {
        path: '/neo-data',
        component: () => import('../components/Neo.vue'),
        name: 'neo-data'
    }
];

export default routes;