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
                        <a class="text-decoration-none text-white" href="/"
                            >Find more</a
                        >
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
                    <a class="text-decoration-none text-white" href="/"
                        >Find more</a
                    >
                </button>
            </div>
        </section>
    </main>
</template>

<script>

export default {
    name: "Home",
};
</script>

<style scoped lang="scss">
h2 {
    font-size: 2.5rem;
}
a {
    border-radius: 10px;
    padding: 0.5rem;
    border: 1px solid white;
    font-size: 1.5rem;
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
