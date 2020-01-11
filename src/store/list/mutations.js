export default {
    UPDATE_LIST(state, payload) {
        state.tasks = payload;
    },
    SET_EDITABLE(state, {task, mode}) {
        let target = state.tasks.find(el => {
            return el.id == task.id
        })
        target.editing = mode;
    }
}