import {HttpStatus} from "./HttpStatus";
import {convertResponseToJson, isUndefinedOrNull} from "./Utils";
import AppStorage from "./AppStorage";
const axios = require('axios').default;

export default class Axios {
    static post(config){
        axiosWrapper(config, 'POST').then(() => {
            console.log('POST ok')
        })
    }
    static get(config){
        axiosWrapper(config, 'GET').then(() => {
            console.log('GET ok')
        })
    }
    static patch(config) {
        axiosWrapper(config, 'PATCH').then(() => {
            console.log('PATCH ok')
        })
    }
    static delete(config) {
        axiosWrapper(config, 'DELETE').then(() => {
            console.log('DELETE ok')
        })
    }
    static put(config) {
        axiosWrapper(config, 'PUT').then(() => {
            console.log('PUT ok')
        })
    }
}

async function axiosWrapper(config, method) {
    let axiosConfig = {
        method: method,
        url: config.url,
        headers: config.headers ? config.headers : {
            "Accept": "application/json"
        },
        data: config.payload,
    }
    if (isUndefinedOrNull(config.payload))
        delete axiosConfig.data
    else
        axiosConfig.headers = {...axiosConfig.headers, ...config.headers}
    if (!isUndefinedOrNull(config.authToken))
        axiosConfig.headers['Authorization'] = `Bearer ${config.authToken}`;
        try {
            await axios(axiosConfig).then(res => {
                if (res.status === HttpStatus.HTTP_200 || res.status === HttpStatus.HTTP_201 || res.status === HttpStatus.HTTP_204)
                    config.then(res)
                else if (res.status === HttpStatus.HTTP_400){
                    config.error({'msg': "No se pudo interpretar la solicitud dada o tiene sintaxis inválida"})
                } else if (res.status === HttpStatus.HTTP_403)
                    config.error({'msg': "No tiene permisos para realizar la acción."});
                else if (res.status === HttpStatus.HTTP_500)
                    config.error({'msg': 'Ups! ah ocurrido un error.'});
                else if (res.status === HttpStatus.HTTP_404)
                    config.error({'msg': 'El recurso buscado o solicitado no se encontró.'});
                else
                    config.error({'msg': `Ah ocurrido otro tipo de respuesta ${res.status}.`});
            }).catch(err => {
                if (err.response.status === HttpStatus.HTTP_401){
                    config.error({'msg': 'La sesión expiró'});
                    AppStorage.clear()
                    this.$store.commit('setUpdateUser', false)
                    this.$store.commit('setUserName', '')
                    this.$router.push({name: '/'})
                    window.location.reload()
                }
                else if (err.response.status === HttpStatus.HTTP_500){
                    config.error({'msg': 'Ups! ah ocurrido un error.'});
                    AppStorage.clear()
                    this.$store.commit('setUpdateUser', false)
                    this.$store.commit('setUserName', '')
                    this.$router.push({name: '/'})
                    window.location.reload()
                }
                else if (err.response.status === HttpStatus.HTTP_422){
                    config.formErrors(err.response.data)
                    config.error({'msg': "Error al enviar el formulario, validar los datos."});
                }
                else if (err.response.status === HttpStatus.HTTP_403)
                    config.error({'msg': "No tiene permisos para realizar la acción."});
                else
                    config.error({'msg': `Ah ocurrido otro tipo de respuesta: ${err.response.data.message}.`});
            });
        } catch (e) {
            return e.response
        }
}
