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
    }
}