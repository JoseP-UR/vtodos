export default {
    SET_USER_DATA(state, payload) {
        state.data = payload;
    },
    SET_FORM_FIELD(state, field, value) {
        state.form[field] = value;
    }
}