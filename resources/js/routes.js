import Login from "./Components/Auth/Login";
import Logout from "./Components/Auth/Logout";
import Home from "./Components/Admin/Home";
import User from "./Components/User/User";
import Role from "./Components/Role/Role";

export const routes = [
    {path: '/', component: Login, name: '/'},
    {path: '/logout', component: Logout, name: 'logout'},
    {path: '/home', component: Home, name: 'home'},
    {path: '/user', component: User, name: 'user'},
    {path: '/role', component: Role, name: 'role'},
]
