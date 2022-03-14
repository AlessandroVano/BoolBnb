<template>
    <main>
        <section class="bg-dark pt-5">
            <h1 class="mb-4 text-center text-white">Welcome to BoolBnb</h1>
            <div class="container">
                <div class="mb-1 row justify-content-center">
                    <div
                        class="d-flex col-12 flex-wrap"
                    >
                        <!-- SEARCHBAR -->
                        <input
                            type="text"
                            class="input-search fs-10 border-custom fw-light form-control col-9 offset-1"
                            placeholder="Select your place"
                            aria-label="Search"
                            aria-describedby="addon-wrapping"
                            v-model="query"
                            @keyup="getAddress()"
                        />
                        <router-link
                            :to="{ name: 'advanced-search' }"
                            class="btn btn-transparent col-1 mx-2 px-1"
                            @click="persist"
                        >
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </router-link>
                        <ul
                            class="list-unstyled cursor-pointer text-dark rounded justify-self-start offset-1 p-0 col-9"
                        >
                            <li
                                :id="`${index}`"
                                @click="setValue(index)"
                                class="list-unstyled p-1 bg-white"
                                v-for="(element, index) in suggestionsArray"
                                :key="`suggestion${index}`"
                            >
                                {{ element.address.freeformAddress }}
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ADVANCE SEARCH BTN -->
                <div
                    v-if="filteredAparments"
                    class="d-flex justify-content-center mb-2"
                >
                    <!-- <router-link
                        class="btn btn-pink mb-2 p-1 text-center"
                        :to="{ name: 'advanced-search' }"
                        ><i class="fa-solid fa-align-justify"></i> Improve your
                        search
                    </router-link> -->
                </div>
                <!-- APARTMENT SEARCH RESAULT -->
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
                                <h5
                                    class="card-title text-center mt-2 mb-1"
                                    :class="{
                                        pink: apartment.sponsorship == true,
                                    }"
                                >
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

                <!-- SPONSORERD APARTMENTS -->

                <div
                    class="votati d-flex flex-column justify-content-center align-content-center mb-5"
                >
                    <h2 class="text-center text-white">
                        Explore and Discover our best apartments
                    </h2>
                    <div class="overflow-auto">
                        <div v-if="bestApartments && !filteredAparments">
                            <h4 class="text-center pink">
                                <i class="fa-solid fa-star"></i> Our best apartments
                            </h4>
                            <div
                                class="d-flex flex-wrap my-3 justify-content-center"
                            >
                                <div
                                    v-for="(apartment, index) in bestApartments"
                                    :key="`apartment-${index}`"
                                    class="card mb-3 col-12 col-md-5 col-lg-3 mx-3 c-custom"
                                >
                                    <div class="row no-gutters grow">
                                        <div class="col-12 ">
                                            <h5
                                                class="card-title pink text-center mt-2 mb-1"
                                            >
                                                <i
                                                    class="fa-solid fa-house mr-2"
                                                ></i>
                                                {{ apartment.name }}
                                            </h5>
                                            <img
                                                class="img-apartment img-custom"
                                                :src="apartment.image"
                                                :alt="apartment.name"
                                            />
                                        </div>
                                        <div class="col-12 align-self-end">
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
                        </div>
                    </div>
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
            bestApartments: [],
        };
    },
    created() {
        sessionStorage.query = "";
        sessionStorage.selectedLat = null;
        sessionStorage.selectedLon = null;
    },
    mounted() {
        this.getServices();
        this.getBestAparments();
        if (sessionStorage.query) {
            this.query = sessionStorage.query;
            this.selectedLat = sessionStorage.selectedLat;
            this.selectedLon = sessionStorage.selectedLon;
        }
    },
    watch: {
        query(newQuery) {
            sessionStorage.query = newQuery;
        },
        selectedLat(newSelectedLat) {
            sessionStorage.selectedLat = newSelectedLat;
        },
        selectedLon(newSelectedLon) {
            sessionStorage.selectedLon = newSelectedLon;
        },
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
                        this.filteredAparments = result.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },
        getBestAparments() {
            axios
                .get("http://127.0.0.1:8000/api/apartments")
                .then((res) => {
                    console.log(res.data);
                    this.bestApartments = res.data;
                })
                .catch((error) => console.log(error));
        },
        persist() {
            sessionStorage.query = this.query;
            sessionStorage.selectedLat = this.selectedLat;
            sessionStorage.selectedLon = this.selectedLon;
        },
    },
};
</script>

<style scoped lang="scss">
.input-search {
    flex-grow: 1;
    &:focus {
        box-shadow: #ff385d7c 0px 0px 0px 3px;
        border: none;
    }
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

    &:hover {
        text-decoration: none;
    }
}
.votati {
    background-color: #ff385c;
    border-radius: 1rem;
    padding: 2rem 1rem;
    height: 565px;
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
        box-shadow: 0px 10px 31px -2px #ffffff5e;
        //-webkit-box-shadow: 0px 10px 31px -2px #ffffff5a;
        -moz-box-shadow: 0px 10px 31px -2px #ffffff5a;
    }
}

.pink {
    color: #ff385c;
}

.grow {
    flex-grow: 1;
}

.btn-link {
    margin: 0 auto;
}
</style>
