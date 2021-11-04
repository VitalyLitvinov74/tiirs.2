var helpers = {
    toFormData(store) {
        const form = new FormData();
        for ( const key in store) {
            form.append(key, store[key]);
        }
        return form
    }
};
export default helpers;