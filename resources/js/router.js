import Home from "./Components/Home";
import Form from "./Components/Form";
import About from "./Components/About";
import Search from "./Components/Search";
import Register from "./Components/Register";
import Auth from "./Components/Auth";
import MePage from "./Components/MePage";

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
