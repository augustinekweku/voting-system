import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

import CoreMembers from './pages/core-members.vue'
import Results from './pages/results.vue'
import AdminCandidates from './pages/admin-candidates.vue'
import AdminVoters from './pages/admin-voters.vue'
import AdminWinners from './pages/admin-winners.vue'
import login from './pages/login.vue'
import register from './pages/register.vue'
import verify from './pages/verify.vue'
import AdminRoles from './pages/admin-roles.vue'

const routes = [
    {
        path:  '/admin-roles',
        component: AdminRoles,
        name: 'AdminRoles'
    },
    {
        path:  '/login',
        component: login,
        name: 'login'
    },
    {
        path:  '/verify',
        component: verify,
        name: 'verify'
    },
    {
        path:  '/register',
        component: register,
        name: 'register'
    },
    {
        path:  '/admin-winners',
        component: AdminWinners,
        name: 'AdminWinners'
    },
    {
        path:  '/admin-voters',
        component: AdminVoters,
        name: 'AdminVoters'
    },
    {
        path:  '/core-members',
        component: CoreMembers,
        name: 'CoreMembers'
    },
    {
        path:  '/results',
        component: Results,
        name: 'Results'
    },
    {
        path:  '/admin-candidates',
        component: AdminCandidates,
        name: 'AdminCandidates'
    },
]

export default new Router ({
    mode: 'history',
    routes,
})