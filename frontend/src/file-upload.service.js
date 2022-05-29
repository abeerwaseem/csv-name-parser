import * as axios from 'axios';

const BASE_URL = 'http://php-test-csv.test/';

function upload(formData) {
    const url = `${BASE_URL}`;
    return axios.post( url, formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    });
}

export { upload }
