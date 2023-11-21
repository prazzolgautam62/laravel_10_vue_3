import axios from 'axios';

const BASE_URL = 'http://localhost:8000/api';

function _getUsers() {
    return axios.get(`${BASE_URL}/user`).then(response => response.data);
}

export { _getUsers };