import Home from "./Pages/Home";
import Form from "./Pages/Form";
import About from "./Pages/About";
import Search from "./Pages/Search";
import Register from "./Pages/Register";
import Auth from "./Pages/Auth";
import MePage from "./Pages/MePage";

export default [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/form',
        name: 'form',
        component: Form
    },
    {
        path: '/about',
        name: 'about',
        component: About
    },
    {
        path: '/search',
        name: 'search',
        component: Search
    },
    {
        path: '/register',
        name: 'register',
        component: Register
    },
    {
        path: '/auth',
        name: 'auth',
        component: Auth
    },
    {
        path: '/me',
        name: 'me',
        component: MePage
    },
]
