import axios from 'axios';

export default {
    sendLoginForm: (state, payload) => {
        axios.get('http://localhost/', {
            teste: 'test',
            testando: 'testing'
        }).then(function (response) {
            console.log(response)
        }).catch(function (error) {
            console.log(error)
        });
    },
    create: (state, payload) => {
        console.log(payload);
        axios({
            method: 'POST',
            url: 'http://localhost/user',
            headers: {
                "Content-Type": "application/json"
            },
            data: payload
        }
        ).then(function (response) {
            console.log(response)
        }).catch(function (error) {
            console.log(error)
        });
    }
}