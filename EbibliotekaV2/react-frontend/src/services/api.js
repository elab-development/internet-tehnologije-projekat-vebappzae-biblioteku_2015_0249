// src/services/api.js
import axios from "axios";

const api = axios.create({
    baseURL: "http://127.0.0.1:8000/api", // baseURL već sadrži /api
    withCredentials: true, // korisno za Sanctum (cookie auth) i CORS
    headers: {
        Accept: "application/json",
    },
});

// Dodaj Bearer token iz localStorage ako postoji
api.interceptors.request.use(
    (config) => {
        const token = localStorage.getItem("auth_token");
        if (token) {
            config.headers = config.headers || {};
            config.headers.Authorization = `Bearer ${token}`;
        }
        return config;
    },
    (error) => Promise.reject(error)
);

// Helper za Laravel Sanctum CSRF cookie
export const getCsrfCookie = () =>
    axios.get("http://127.0.0.1:8000/sanctum/csrf-cookie", {
        withCredentials: true,
    });

// REST helpers
export const register = (data) => api.post("/register", data);
export const login = (data) => api.post("/login", data);
export const logoutUser = () => api.post("/logout");
export const getUser = () => api.get("/user");
export const getBooks = () => api.get("/books");
export const getBook = (id) => api.get(`/books/${id}`);
export const createSubscription = (data) => api.post("/subscriptions", data);

export default api;
