import axios from "axios";
window.axios = axios;

// window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
// axios.defaults.headers.common["X-CSRF-TOKEN"] = document
//     .querySelector('meta[name="csrf-token"]')
//     .getAttribute("content");

axios.defaults.baseURL = "http://localhost:8000/api";
// axios.defaults.withCredentials = true;
// Optionally, set the Authorization header if you have a token
const token = localStorage.getItem("auth_token");
if (token) {
    axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
}
