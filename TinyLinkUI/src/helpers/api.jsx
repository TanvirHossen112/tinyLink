import axios from "axios";

const createAxios = () => {

    const api = axios.create({
        baseURL: import.meta.env.VITE_API_BASE_URL,
        withCredentials: true,
    });

    api.interceptors.response.use(response => {
        if (String(response.data.code).substring(0, 1) === "4") {
            return Promise.reject(response.data);
        }
        return Promise.resolve(response.data);
    }, error => {
        const statusCode = parseInt(error.response.status);
        if (statusCode === 409) {
            return Promise.reject(error.response);
        }
        if (statusCode === 410) {
            return resetTokenAndReattemptRequest(error);
        }
        if (statusCode === 401) {
            // make logout and redirect to login page
        }

        return Promise.reject(error.response);
    });

    return api;
}

const apiClient = () => createAxios();

export default apiClient;

let isAlreadyAttemptingAccessToken = false;
let subscribers = [];

const resetTokenAndReattemptRequest = (error) => {
    try {
        const {response: errorResponse} = error;

        const retryOriginalRequest = new Promise((resolve, reject) => {
            addSubscribers(() => {
                resolve(apiClient().request(errorResponse.config));
            });
        });

        if (!isAlreadyAttemptingAccessToken) {
            isAlreadyAttemptingAccessToken = true;
            return refreshApi.then((response) => {
                isAlreadyAttemptingAccessToken = false;
                reCallRequestFromQueue();
                return retryOriginalRequest;
            }).catch(error => {
                return Promise.reject(error);
            });
        } else {
            return retryOriginalRequest;
        }
    } catch (error) {
        return Promise.reject(error);
    }
}

const refreshApi = async () => {
    try {
        const response = await apiClient().post('/auth/refresh');
        return Promise.resolve(response);
    } catch (error) {
        return Promise.reject(error);
    }
}

const reCallRequestFromQueue = () => {
    subscribers.forEach(subscriber => subscriber());
    subscribers = [];
}

const addSubscribers = (subscriber) => subscribers.push(subscriber);
