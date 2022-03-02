<template>
    <header class="bg-dark">
        <nav class="navbar navbar-expand-lg navbar-dark container">
            <div class="row justify-content-between w-100">
                <!-- Left side -->
                <div>
                    <img
                        class="icon"
                        src="../../../public/storage/icon/Logo-icon-color.png"
                        alt="Logo Icon"
                    />
                    <a class="navbar-brand" href="#">BoolBnB</a>
                </div>

                <!-- Central Side -->
                <div class="central-side">
                    <ul class="navbar-nav flex-row">
                        <li class="nav-item mx-2 mx-md-3 mx-lg-3">
                            <router-link class="nav-link" :to="{ name: 'home' }"
                                >Home</router-link
                            >
                        </li>
                        <li class="nav-item mx-2 mx-md-3 mx-lg-3">
                            <router-link class="nav-link" :to="{ name: 'home' }"
                                >Advanced Search</router-link
                            >
                        </li>
                        <li class="nav-item mx-2 mx-md-3 mx-lg-3">
                            <router-link class="nav-link" :to="{ name: 'home' }"
                                >Contact Us</router-link
                            >
                        </li>
                    </ul>
                </div>

                <!-- Right Side -->
                <div>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a
                                id="navbarDropdown"
                                class="nav-link dropdown-toggle"
                                href="#"
                                role="button"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                                v-pre
                            >
                                Menu
                            </a>
                            <div
                                class="dropdown-menu dropdown-menu-right"
                                aria-labelledby="navbarDropdown"
                            >
                                <a
                                    class="dropdown-item"
                                    href="http://127.0.0.1:8000/login"
                                >
                                    Log In
                                </a>
                                <a
                                    class="dropdown-item"
                                    href="http://127.0.0.1:8000/register"
                                >
                                    Register
                                </a>
                                <a
                                    class="dropdown-item"
                                    href="http://127.0.0.1:8000/admin"
                                >
                                    View profile
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
export default {
    name: "Header",
    /* COME CALCOLARE LA DISTANZA PD */
    data() {
        return {
            lat1 : 45.47289, //Milano
            lon1 : 9.12244, //Milano
            lat2 : 45.464211, //Duomo
            lon2 : 9.191383, //Duomo

            d : null, //Distance
        }
    },
    created() {
        this.getDiscance(this.lat1,this.lon1,this.lat2,this.lon2);
    },
    methods: {
        distance(lat1, lon1, lat2, lon2) { 
            var p = 0.017453292519943295;
            var c = Math.cos; 
            var a = 0.5 - c((lat2 - lat1) * p)/2 + c(lat1 * p) * c(lat2 * p) * (1 - c((lon2 - lon1) * p))/2; 
            var distance = 12742 * Math.asin(Math.sqrt(a));
            console.log( distance.toFixed(3) );
            return this.d = distance.toFixed(3);
        },
        getDiscance(lat1, lon1, lat2, lon2) {
            this.distance(lat1, lon1, lat2, lon2);
            console.log( this.d);
        }
    },
};
</script>

<style lang="scss" scoped>
.central-side {
    display: flex;
    justify-content: center;
    flex-grow: 1;
    text-align: center;
}
</style>
