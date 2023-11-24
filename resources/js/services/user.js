import axios from 'axios';

const BASE_URL = 'http://localhost:8000/api';

function _getUsers(params) {
    return axios.get(`${BASE_URL}/user`,{params}).then(response => response.data);
}

export { _getUsers };