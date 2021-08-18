import Login from "./Components/Auth/Login";
import Logout from "./Components/Auth/Logout";
import Home from "./Components/Admin/Home";
import User from "./Components/User/User";
import Role from "./Components/Role/Role";
import Permission from "./Components/Permission/Permission";

export const routes = [
    {path: '/', component: Login, name: '/'},
    {path: '/login', component: Login, name: '/login'},
    {path: '/logout', component: Logout, name: 'logout'},
    {path: '/home', component: Home, name: 'home'},
    {path: '/user', component: User, name: 'user'},
    {path: '/role', component: Role, name: 'role'},
    {path: '/permission', component: Permission, name: 'permission'},
]
