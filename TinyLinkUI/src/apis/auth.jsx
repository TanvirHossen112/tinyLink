import apiClient from "../helpers/api.jsx";

export const register = async (data) => {
    try {
        const response = await apiClient().post('/auth/register', data);
        return Promise.resolve(response);
    } catch (error) {
        return Promise.reject(error);
    }
};

export const login = async (credentials) => {
    try {
        const response = await apiClient().post('/auth/login', credentials);
        return Promise.resolve(response);
    } catch (error) {
        return Promise.reject(error);
    }
};

export const logout = async () => {
    try {
        const response = await apiClient().post('/auth/logout');
        return Promise.resolve(response);
    } catch (error) {
        return Promise.reject(error);
    }
};