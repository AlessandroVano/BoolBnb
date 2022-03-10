<template>
    <main>
        <section class="bg-dark pt-5">
            <div class="container">
                <h1 class="mb-4 text-center text-white">Welcome to BoolBnb</h1>
                <div
                    class="votati d-flex flex-column justify-content-center align-content-center mb-5"
                >
                    <h2 class="text-center text-white">
                        Explore and Discover our best apartments
                    </h2>
                    <button class="btn btn-link text-white">
                        <router-link
                        class="link-custom"
                        :to="{ name: 'bestapartments' }"
                        >Find More
                    </router-link>
                    </button>
                </div>
            </div>

            <div
                class="ricerca d-flex flex-column justify-content-center align-content-centermb-5"
            >
                <h2 class="text-center text-white">
                    Find the best solution for your Holiday!
                </h2>
                <button class="btn btn-link text-white">
                    <router-link
                        class="link-custom"
                        :to="{ name: 'advanced-search' }"
                        >Find More
                    </router-link>
                </button>
            </div>
        </section>
    </main>
</template>

<script>
import AdvancedSearch from "./AdvancedSearch.vue";
export default {
    name: "Home",
    components: { AdvancedSearch }
};
</script>

<style scoped lang="scss">
h2 {
    font-size: 2.5rem;
}
.link-custom {
    border-radius: 10px;
    padding: 0.5rem;
    border: 3px solid white;
    font-size: 1.5rem;
    color: #ffff;
    text-decoration: none;
}
.votati {
    background-color: #ff385c;
    height: 500px;
    border-radius: 1rem;
}

.ricerca {
    color: white;
    background-image: url("https://www.mensjournal.com/wp-content/uploads/2022/01/Zionheader.jpg?quality=55&strip=all");
    background-position: center;
    height: 800px;
}
</style>
