import axios from 'axios';

export default {
    login: (state, payload) => {
        return axios({
            method: 'POST',
            url: 'http://localhost/user/login',
            headers: {
                "Content-Type": "application/json"
            },
            data: payload
        });
    },
    create: (state, payload) => {
        return axios({
            method: 'POST',
            url: 'http://localhost/user/register',
            headers: {
                "Content-Type": "application/json"
            },
            data: payload
        }
        )
    }
}