import "./bootstrap";
import "flowbite";
import Alpine from "alpinejs";
// import "./chart";
// import "./descriptionField";
// import "./dropzoneFieldPhoto";
// import "./dropzonePayment";
// import "./editor";
// import "./editorUpdate";
// import "./tableArticle";
// import "./tableBooking";
// import "./tableVoucher";

document.addEventListener("alpine:init", () => {
    Alpine.store("user", {
        authenticated: false,
        data: null,
        token: null,
        setUser(userData) {
            this.authenticated = true;
            this.data = userData;
        },
        setToken(token) {
            this.token = token;
            console.log(token);
            // Store the token in localStorage
            localStorage.setItem("auth_token", token);
            axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
        },
        clearUser() {
            this.authenticated = false;
            this.data = null;
            this.token = null;
            // Remove the token from localStorage
            localStorage.removeItem("auth_token");
            // Remove the Authorization header for Axios
            delete axios.defaults.headers.common["Authorization"];
        },
        async authCheck() {
            try {
                console.log("authCheck");
                const response = await axios.get(
                    "http://localhost:8000/api/users/current",
                    { withCredentials: true }
                );
                this.authenticated = true;
                this.setUser(response.data.data.user);
                console.log(response.data.data);
                console.log(this.authenticated);
            } catch (error) {
                this.isAuthenticated = false;
                window.location.href = "/users/login";
                // Redirect ke halaman login
            }
        },
        async guestOnly() {
            try {
                console.log("authCheck");
                const response = await axios.get(
                    "http://localhost:8000/api/users/current",
                    { withCredentials: true }
                );
                this.authenticated = true;
                this.setUser(response.data.data.user);
                console.log(response.data.data);
                console.log(this.authenticated);
                window.location.href = "/";
            } catch (error) {
                this.isAuthenticated = false;
                // Redirect ke halaman login
            }
        },
    });
});

Alpine.start();
window.Alpine = Alpine;
