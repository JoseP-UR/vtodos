import axios from 'axios';


export default {
    create: (state, payload) => {
        return axios({
            method: 'POST',
            url: 'http://localhost/task/create',
            headers: {
                "Content-Type": "application/json"
            },
            data: payload
        }
        )
    },
    fetch: (state, uid) => {
        return axios({
            method: 'GET',
            url: 'http://localhost/task/list/'+uid,
        })
    },
    delete(state, payload) {
        return axios({
            method: 'DELETE',
            url: 'http://localhost/task/'+payload.task.id+'/delete',
            headers: {
                "Content-Type": "application/json"
            },
            data: {
                user: payload.user,
                description: payload.task.description
            }
        }
        )
    },
    edit(state, payload) {
        return axios({
            method: 'PUT',
            url: 'http://localhost/task/'+payload.task.id+'/edit',
            headers: {
                "Content-Type": "application/json"
            },
            data: {
                user: payload.user,
                description: payload.task.description
            }
        }
        )
    }
}