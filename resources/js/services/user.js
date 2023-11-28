import axios from 'axios';

const BASE_URL = 'http://localhost:8000/api';

function _getUsers(url = '', params) {
    const urls = url ? `${url}` : `${BASE_URL}/user`;
    return axios.get(`${urls}`, { params }).then(response => response.data).catch(error => {
        console.error('Error fetching user:', error);
        throw error;
    });
}

function _createUser(data) {
    return axios.post(`${BASE_URL}/user`, data).then(response => response.data).catch(error => {
        console.error('Error creating user:', error);
        throw error;
    });
}

function _updateUser(id, data) {
    return axios.put(`${BASE_URL}/user/${id}`, data).then(response => response.data).catch(error => {
        console.error('Error updating user:', error);
        throw error;
    });
}

function _deleteUser(id) {
    return axios.delete(`${BASE_URL}/user/${id}`).then(response => response.data).catch(error => {
        console.error('Error deleting user:', error);
        throw error;
    });
}

export { _getUsers, _createUser, _updateUser, _deleteUser };