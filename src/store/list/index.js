import actions from './actions'
import mutations from './mutations'
import state from './state'


export default {
    list: {
        namespaced: true,
        
        actions,
        mutations,
        state
    }
}