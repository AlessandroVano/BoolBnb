<template>
    <header class="bg-dark">
        <nav class="navbar navbar-expand-lg navbar-dark container">
            <div
                class="row justify-content-between w-100 d-flex align-items-center"
            >
                <!-- Left side -->
                <div class="d-flex justify-content-center align-items-center">
                    <router-link
                        :to="{ name: 'home' }"
                        class="nav-item nav-link fs-c pr-0"
                    >
                        <i class="fab fa-airbnb text-pink h2 icon"></i>
                    </router-link>
                    <router-link
                        :to="{ name: 'home' }"
                        class="nav-link Boolbnb text-white text-decoration-none vertical-align-center fs-c pl-0 d-none d-sm-block d-dm-block d-lg-block d-xl-block"
                    >
                        BoolBnb
                    </router-link>
                </div>

                <!-- Central Side -->
                <div class="central-side">
                    <ul class="navbar-nav flex-row">
                        <li class="nav-item mx-md-3 mx-lg-3">
                            <router-link
                                class="nav-link d-none d-md-block d-lg-block d-xl-block"
                                :to="{ name: 'home' }"
                                >Home</router-link
                            >
                            <router-link
                                class="nav-link d-md-none d-lg-none"
                                :to="{ name: 'home' }"
                                ><i class="fa-solid fa-house icon-h"></i
                            ></router-link>
                        </li>
                        <li class="nav-item mx-5 mx-md-3 mx-lg-3">
                            <router-link
                                class="nav-link d-none d-md-block d-lg-block d-xl-block"
                                :to="{ name: 'advanced-search' }"
                                >Advanced Search</router-link
                            >
                            <router-link
                                class="nav-link d-md-none d-lg-none"
                                :to="{ name: 'advanced-search' }"
                                ><i
                                    class="fa-solid fa-magnifying-glass icon-h"
                                ></i
                            ></router-link>
                        </li>
                        <li class="nav-item mx-md-3 mx-lg-3">
                            <router-link
                                class="nav-link d-none d-md-block d-lg-block d-xl-block"
                                :to="{ name: 'bestapartments' }"
                                >Best Apartments</router-link
                            >
                            <router-link
                                class="nav-link d-md-none d-lg-none"
                                :to="{ name: 'bestapartments' }"
                                ><i class="fa-solid fa-medal icon-h"></i
                            ></router-link>
                        </li>
                    </ul>
                </div>

                <!-- Right Side -->
                <div>
                    <!-- ICON -->
                    <div class="btn-group dropleft">
                        <button
                            type="button"
                            class="btn btn-c-after dropdown-toggle d-block d-md-none d-lg-none d-xl-none text-white"
                            data-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <i class="fa-solid fa-bars icon-h"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a
                                class="dropdown-item"
                                href="http://127.0.0.1:8000/login"
                            >
                                <i
                                    class="fa-solid fa-arrow-right-to-bracket mr-2"
                                ></i>
                                Log In
                            </a>
                            <a
                                class="dropdown-item"
                                href="http://127.0.0.1:8000/register"
                            >
                                <i class="fa-solid fa-registered mr-2"></i>
                                Register
                            </a>
                            <a
                                class="dropdown-item"
                                href="http://127.0.0.1:8000/admin"
                            >
                                <i class="fa-solid fa-user mr-2"></i> View
                                profile
                            </a>
                        </div>
                        <!-- MENU -->
                        <button
                            type="button"
                            class="btn bt dropdown-toggle d-none d-md-block d-lg-block d-xl-block text-white"
                            data-toggle="dropdown"
                            aria-expanded="false"
                        >
                            Menu
                        </button>
                        <div class="dropdown-menu">
                            <a
                                class="dropdown-item"
                                href="http://127.0.0.1:8000/login"
                            >
                                <i
                                    class="fa-solid fa-arrow-right-to-bracket mr-2"
                                ></i>
                                Log In
                            </a>
                            <a
                                class="dropdown-item"
                                href="http://127.0.0.1:8000/register"
                            >
                                <i class="fa-solid fa-registered mr-2"></i>
                                Register
                            </a>
                            <a
                                class="dropdown-item"
                                href="http://127.0.0.1:8000/admin"
                            >
                                <i class="fa-solid fa-user mr-2"></i> View
                                profile
                            </a>
                        </div>
                    </div>
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
        return {};
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

.fs-c {
    font-size: 1.2rem;
}

.icon-h {
    font-size: 1.2rem;
}
.nav-link:hover {
    color: #ff385c !important;
}

.central-side .nav-link.active {
    color: #ff385c !important;
}

.Boolbnb.active {
    color: white !important;
}
.bt {
    box-shadow: none !important;
}
</style>
