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
        isAdmin: false,
        token: null,
        setUser(userData) {
            this.authenticated = true;
            this.data = userData;
            // Store User Data
            localStorage.setItem("user_data", JSON.stringify(userData));
        },
        setToken(token) {
            this.token = token;
            console.log(token);
            // Store the token in localStorage
            localStorage.setItem("auth_token", token);

            this.authenticated = true;
            axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
        },
        clearUser() {
            this.authenticated = false;
            this.data = null;
            this.token = null;
            // Remove the token from localStorage
            localStorage.removeItem("auth_token");
            localStorage.removeItem("user_data");
            localStorage.removeItem("token_expiry");
            // Remove the Authorization header for Axios
            delete axios.defaults.headers.common["Authorization"];
        },
        unauthenticate() {
            this.authenticated = false;
            this.data = null;
            this.token = null;
            // Remove the token from localStorage
            localStorage.removeItem("auth_token");
            localStorage.removeItem("user_data");
            localStorage.removeItem("token_expiry");
            // Remove the Authorization header for Axios
            delete axios.defaults.headers.common["Authorization"];
        },
        errorHandler(error) {
            if (error.response) {
                switch (error.response.status) {
                    case 401:
                        // Handle unauthorized access
                        this.clearUser();
                        break;
                }
            }
        },
        async refreshLocalStorage() {
            try {
                console.log("Refreshing localStorage...");
                // Hapus data lama

                localStorage.removeItem("user_data");

                // Ambil data user & token baru dari API
                const response = await axios.get(
                    "http://localhost:8000/api/users/current"
                );
                console.log("API response received:", response.data);
                const user = response.data.data;
                console.log("User data fetched:", user);

                // Simpan ke localStorage
                localStorage.setItem("user_data", JSON.stringify(user));

                console.log("localStorage refreshed successfully");
                // Update Alpine store
                this.setUser(user);
                this.authenticated = true;
            } catch (error) {
                console.error("Error refreshing localStorage:", error);
                this.clearUser();
            }
        },
        async authCheck() {
            try {
                const cachedUser = localStorage.getItem("user_data");
                const cachedToken = localStorage.getItem("auth_token");
                const tokenExpiry = localStorage.getItem("token_expiry");

                if (cachedUser && cachedToken && tokenExpiry) {
                    const now = new Date().getTime();
                    if (now < parseInt(tokenExpiry)) {
                        this.authenticated = true;
                        this.data = JSON.parse(cachedUser);
                        this.token = cachedToken;
                        axios.defaults.headers.common[
                            "Authorization"
                        ] = `Bearer ${cachedToken}`;
                        return;
                    }
                }

                // Jika token tidak valid atau tidak ada cache, panggil API
                const response = await axios.get(
                    "http://localhost:8000/api/users/current"
                );
                this.authenticated = true;
                this.setUser(response.data.data.user);
                this.setToken(response.data.data.token);

                // Simpan token expiry (misalnya, 1 hari dari sekarang)
                const expiryTime = new Date().getTime() + 24 * 60 * 60 * 1000; // 1 hari
                localStorage.setItem("token_expiry", expiryTime);
            } catch (error) {
                this.clearUser();
            }
        },

        // async guestOnly() {
        //     try {
        //         console.log("authCheck");
        //         const response = await axios.get(
        //             "http://localhost:8000/api/users/current",
        //             { withCredentials: true }
        //         );
        //         this.authenticated = true;
        //         this.setUser(response.data.data.user);
        //         console.log(response.data.data);
        //         console.log(this.authenticated);
        //         window.location.href = "/";
        //     } catch (error) {
        //         this.isAuthenticated = false;
        //         // Redirect ke halaman login
        //     }
        // },
    });
    Alpine.store("storage", {
        url: "http://localhost:8000/storage/",
    });
    Alpine.store("format", {
        rupiah: (value) => {
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR",
            }).format(value);
        },
        date: (dateString) => {
            const options = { year: "numeric", month: "long", day: "numeric" };
            return new Date(dateString).toLocaleDateString("id-ID", options);
        },
    });
});
axios.defaults.baseURL = "http://127.0.0.1:8000/api/";
Alpine.start();
window.Alpine = Alpine;
