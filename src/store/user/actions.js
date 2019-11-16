import axios from 'axios';

export default {
    sendLoginForm: (state, payload) => {
        console.log(state);
        console.log(payload);
        // axios.get('http://localhost/').then(function(res) {
        //     console.log(res);
        // }).catch(function(error) {
        //     console.log(error);
        // }).finally(function(a) {
        //     console.log(a);
        // })
        axios.get('http://localhost/').then(function(response) {
            console.log(response)
        }).catch(function(error) {
            console.log(error)
        });
    }
}