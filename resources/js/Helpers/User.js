import AppStorage from "./AppStorage";

class User {

    responseAfterLogin(res){
        const access_token = res.data.original.access_token
        const username = res.data.original.name
        AppStorage.store(access_token,username)
    }

    hasToken(){
        const storeToken = localStorage.getItem('token');
        return !!storeToken;
    }

    loggedIn(){
        return this.hasToken()
    }

    token(){
        if (this.loggedIn()){
            return localStorage.getItem('token')
        }
        return false
    }

    username(){
        if (this.loggedIn()){
            return localStorage.getItem('username')
        }
    }

    id(){
        if (this.loggedIn()){
            return localStorage.getItem('token')
            // const payload = Token.payload(localStorage.getItem('token'));
            // return payload.sub
        }
        return false
    }

}

export default User = new User();
