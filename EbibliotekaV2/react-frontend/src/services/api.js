import axios from "axios";

// Kreiramo instancu axios-a za Laravel API
const api = axios.create({
    baseURL: "http://127.0.0.1:8000", // Laravel backend
    withCredentials: true, // obavezno za Sanctum da bi slao cookies
    headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
    },
});

// Helper funkcija da prvo uzmemo CSRF cookie
export async function getCsrfCookie() {
    await api.get("/sanctum/csrf-cookie");
}

// Registracija korisnika
export async function registerUser(userData) {
    await getCsrfCookie(); // prvo CSRF cookie
    return api.post("/register", userData);
}

// Login korisnika
export async function loginUser(credentials) {
    await getCsrfCookie(); // prvo CSRF cookie
    return api.post("/login", credentials);
}

// Logout korisnika
export async function logoutUser() {
    return api.post("/logout");
}

// Dohvatanje trenutno ulogovanog korisnika
export async function getUser() {
    return api.get("/api/user");
}

export default api;
