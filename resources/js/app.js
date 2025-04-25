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
            console.log(userData);
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
            // Remove the Authorization header for Axios
            delete axios.defaults.headers.common["Authorization"];
        },
        async authCheck() {
            try {
                console.log("authCheck");

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
                        console.log("User loaded from cache:", this.data);
                        return;
                    }
                }

                // Jika token tidak valid atau tidak ada cache, panggil API
                const response = await axios.get(
                    "http://localhost:8000/api/users/current",
                    { withCredentials: true }
                );
                this.authenticated = true;
                this.setUser(response.data.data.user);

                // Simpan token expiry (misalnya, 1 jam dari sekarang)
                const expiryTime = new Date().getTime() + 60 * 60 * 1000; // 1 jam
                localStorage.setItem("token_expiry", expiryTime);
                console.log(response.data.data);
            } catch (error) {
                this.authenticated = false;
                this.clearUser();
                window.location.href = "/users/login";
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
});

Alpine.start();
window.Alpine = Alpine;
