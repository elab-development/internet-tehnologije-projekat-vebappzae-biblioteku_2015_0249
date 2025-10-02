import axios from "axios";

const api = axios.create({
    baseURL: "http://127.0.0.1:8000",
    withCredentials: true,
});

// CSRF cookie
export const getCsrfCookie = () => api.get("/sanctum/csrf-cookie");

// Auth
// Auth
export const register = (data) => api.post("/api/register", data);
export const login = (data) => api.post("/api/login", data);
export const logoutUser = () => api.post("/api/logout");
export const getUser = () => api.get("/api/user");

export default api;
