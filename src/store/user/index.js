import actions from './actions'
import mutations from './mutations'
import state from './state'


export default {
    user: {
        namespaced: true,
    
        actions,
        mutations,
        state
    }
}