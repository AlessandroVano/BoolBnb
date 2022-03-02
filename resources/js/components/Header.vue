<template>
    <header class="mb-5">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <img class="icon" src="../../../public/storage/icon/Logo-icon-color.png" alt="Logo Icon">
            <a class="navbar-brand" href="#">BoolBnB</a>
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
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'home' }"
                            >Home</router-link>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
</template>

<script>
export default {
    name: "Header",
};
</script>

<style></style>
