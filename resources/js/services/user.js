import axios from 'axios';

const BASE_URL = 'http://localhost:8000/api';

function _getUsers(url = '', params) {
    const urls = url ? `${url}` : `${BASE_URL}/user`;
    return axios.get(`${urls}`, { params }).then(response => response.data);
}

export { _getUsers };