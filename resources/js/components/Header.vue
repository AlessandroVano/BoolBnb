<template>
    <header class="bg-black">
        <nav class="navbar navbar-expand-lg navbar-dark bg-black container">
            <div>
                <img
                    class="icon"
                    src="../../../public/storage/icon/Logo-icon-color.png"
                    alt="Logo Icon"
                />
                <a class="navbar-brand" href="#">BoolBnB</a>
            </div>
            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item mx-md-3 mx-lg-3">
                        <router-link class="nav-link" :to="{ name: 'home' }"
                            >Home</router-link
                        >
                    </li>
                    <li class="nav-item mx-md-3 mx-lg-3">
                        <router-link class="nav-link" :to="{ name: 'home' }"
                            >Advanced Search</router-link
                        >
                    </li>
                    <li class="nav-item mx-md-3 mx-lg-3">
                        <router-link class="nav-link" :to="{ name: 'home' }"
                            >Contact Us</router-link
                        >
                    </li>
                </ul>
                <!-- Right side -->
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
        </nav>
    </header>
</template>

<script>
export default {
    name: "Header",

    data() {},

    created() {},

    methods: {},
};
</script>

<style></style>
