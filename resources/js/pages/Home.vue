<template>
    <main>
        <section class="bg-dark pt-5">
            <div class="container">
                <h1 class="mb-4 text-center text-white">Welcome to BoolBnb</h1>
                <div class="mb-1 d-flex justify-content-center">
                    <div
                        class="form-inline justify-content-center col-6 col-md-8 col-lg-8"
                    >
                        <div
                            class="d-flex justify-content-start flex-wrap w-100"
                        >
                            <input
                                type="text"
                                class="input-search fs-10 border-custom fw-light form-control mr-2 col-6 col-md-11 col-lg-11"
                                placeholder="Select your place"
                                aria-label="Search"
                                aria-describedby="addon-wrapping"
                                v-model="query"
                                @keyup="getAddress()"
                            />
                            <button
                                class="btn btn-transparent"
                                @click="postFilteredAparments"
                            >
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                            <ul
                                class="list-unstyled cursor-pointer bg-white text-dark rounded col-10"
                            >
                                <li
                                    :id="`${index}`"
                                    @click="setValue(index)"
                                    class="list-unstyled p-1"
                                    v-for="(element, index) in suggestionsArray"
                                    :key="`suggestion${index}`"
                                >
                                    {{ element.address.freeformAddress }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div 
                v-if="filteredAparments"
                class="d-flex justify-content-center mb-2">
                    <router-link
                        class="btn btn-pink mb-2 p-1 text-center"
                        :to="{ name: 'advanced-search' }"
                        ><i class="fa-solid fa-align-justify"></i> Improve your
                        search
                    </router-link>
                </div>

                <div
                    v-if="filteredAparments || query != ''"
                    class="d-flex flex-wrap my-3 justify-content-center"
                >
                    <div
                        v-for="(apartment, index) in filteredAparments"
                        :key="`apartment-${index}`"
                        class="card mb-3 col-12 col-md-5 col-lg-3 mx-3 c-custom"
                    >
                        <div class="row no-gutters">
                            <div class="col-12">
                                <h5 class="card-title text-center mt-2 mb-1">
                                    <i class="fa-solid fa-house mr-2"></i>
                                    {{ apartment.name }}
                                </h5>
                                <img
                                    class="img-apartment img-custom"
                                    :src="apartment.image"
                                    :alt="apartment.name"
                                />
                            </div>
                            <div class="col-12">
                                <div class="text-center">
                                    <router-link
                                        class="btn-transparent btn mb-2 p-1"
                                        :to="{
                                            name: 'apartment-details',
                                            params: {
                                                slug: apartment.slug,
                                            },
                                        }"
                                        >Show More
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
export default {
    name: "Home",
    components: {},
    data() {
        return {
            numRooms: 0,
            maxPeople: 0,
            selectedDistance: 20,
            filteredServices: [],
            query: "",
            filteredAparments: null,
            servicesList: null,
            newArray: [],
            suggestionsArray: [],
            selectedLat: "",
            selectedLon: "",
            d: 0,
        };
    },
    mounted() {
        this.getServices();
    },
    methods: {
        getServices() {
            axios
                .get("http://127.0.0.1:8000/api/services")
                .then((response) => {
                    this.servicesList = response.data;
                })
                .catch((error) => console.log(error));
        },
        setValue(index) {
            let element = document.getElementById(index);
            this.query = element.innerHTML.trim();
            this.selectedLat = this.suggestionsArray[index].position.lat;
            this.selectedLon = this.suggestionsArray[index].position.lon;
            this.suggestionsArray = [];
        },
        getExcerpt(text, maxLength) {
            if (text.length > maxLength) {
                return text.substr(0, maxLength) + "...";
            }
            return text;
        },
        getAddress() {
            delete axios.defaults.headers.common["X-Requested-With"];
            axios
                .get(
                    `https://api.tomtom.com/search/2/search/${this.query}.json?key=ue74ZxVT9w3YLf0sEeYAz5GOv1v6G1md&limit=5`
                )
                .then((res) => {
                    this.suggestionsArray = res.data.results;
                });
        },
        postFilteredAparments() {
            if (this.query.length > 1) {
                axios
                    .post(`http://127.0.0.1:8000/api/apartments/`, {
                        selectedLat: this.selectedLat,
                        selectedLon: this.selectedLon,
                        selectedDistance: this.selectedDistance,
                        filteredServices: this.filteredServices,
                        maxPeople: this.maxPeople,
                        maxRoom: this.numRooms,
                    })
                    .then((result) => {
                        console.log(result.data);
                        this.filteredAparments = result.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },
    },
};
</script>

<style scoped lang="scss">
.input-search {
    flex-grow: 1;
}
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

.img-custom {
    object-fit: cover;
    padding: 0.5rem;
    border-radius: 15px;
}
.link-custom-apartment {
    border-radius: 10px;
    padding: 0.1rem;
    border: 3px solid #ff385c;
    color: #ff385c;
    text-decoration: none;
}
.filter-section {
    border: 0.5px solid #000;
    border-radius: 20px;
    width: 30%;
    ul {
        list-style: none;
    }
    h3 {
        color: #ff385c;
    }
}

.c-custom {
    transition: all 0.3s;
    &:hover {
        box-shadow: 0px 10px 31px -2px #ff385d86;
        -webkit-box-shadow: 0px 10px 31px -2px #ff385d86;
        -moz-box-shadow: 0px 10px 31px -2px #ff385d86;
    }
}
</style>
