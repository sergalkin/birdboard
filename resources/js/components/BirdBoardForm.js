class BirdBoardForm {
    constructor(data) {
        this.originalData = JSON.parse(JSON.stringify(data));

        Object.assign(this, data);

        this.errors = {};
        this.submited = false;
    }

    data() {
        let data = {};

        for (let attribute in this.originalData) {
            data[attribute] = this[attribute];
        }

        return data;
    }

    post(endpoint) {
        this.submit(endpoint, 'post');
    }

    patch(endpoint) {
        this.submit(endpoint, 'patch');
    }

    delete(endpoint) {
        this.submit(endpoint, 'delete');
    }

    submit(endpoint, requestType = 'post') {
        return axios[requestType](endpoint, this.data())
            .catch(this.onFail.bind(this))
            .then(this.onSuccess.bind(this));
    }

    onSuccess(response) {
        this.submited = true;
        this.errors = {};

        return response;
    }

    onFail(error) {
        this.errors = error.response.data.errors;
        this.submited = false;

        throw error;
    }

    reset() {
        Object.assign(this, this.originalData);
    }
}

export default BirdBoardForm;