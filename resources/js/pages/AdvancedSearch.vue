<template>
    <section class="container">
        <h1 class="my-5 text-center">
            <i class="fa-solid fa-map"></i> Search your next place
        </h1>
        <div class="my-2 my-lg-0">
            <div class="mb-3">
                <div class="d-flex">
                    <input
                        type="text"
                        class="fs-10 border-custom fw-light form-control"
                        placeholder="Select your place"
                        aria-label="Search"
                        aria-describedby="addon-wrapping"
                        v-model="query"
                        @keyup="getAddress()"
                    />
                </div>

                <ul class="list-unstyled cursor-pointer bg-white text-dark rounded">
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
            <section class="my-4">
                <section class="row">
                    <div class="filter-section p-3 col-12">
                        <div class="filter-container">
                            <h3 class="text-center">Choose your filters</h3>
                            <h5>Services</h5>
                                <ul class="row d-flex">
                                    <li
                                        v-for="service in servicesList"
                                        :key="`service-${service.id}`"
                                        class="custom-control custom-switch col-6 col-sm-4 col-md-3 col-lg-2 d-inline-block"
                                    >
                                        <input
                                            type="checkbox"
                                            class="custom-control-input"
                                            :id="`customSwitch-${service.id}`"
                                            :value="service.id"
                                            v-model="filteredServices"
                                        />
                                        <label
                                            class="custom-control-label"
                                            :for="`customSwitch-${service.id}`"
                                            >{{ service.name }}
                                        </label>
                                    </li>
                                </ul>
                            <h3 class="text-center">Additional filters</h3>
                            <ul class=" row p-0 d-flex justify-content-md-around">
                                <li class="col-12 col-md-4">
                                    <div
                                        class="input-group mb-3 d-flex flex-column"
                                    >
                                        <h5>How many guests?</h5>
                                        <div class="input-group-prepend">
                                            <label
                                                class="input-group-text"
                                                for="inputGroupSelect01"
                                                >Guest/s</label
                                            >
                                            <select
                                                class="custom-select"
                                                id="inputGroupSelect01"
                                                v-model="maxPeople"
                                            >
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-12 col-md-4" >
                                    <div
                                        class="input-group mb-3 d-flex flex-column"
                                    >
                                        <h5>How many rooms?</h5>
                                        <div class="input-group-prepend">
                                            <label
                                                class="input-group-text"
                                                for="inputGroupSelect01"
                                                >Rooms</label
                                            >
                                            <select
                                                class="custom-select"
                                                id="inputGroupSelect01"
                                                v-model="numRooms"
                                            >
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-12 col-md-4">
                                    <div
                                        class="input-group mb-3 d-flex flex-column"
                                    >
                                        <h5>Selecet Distance</h5>
                                        <div class="input-group-prepend">
                                            <label
                                                class="input-group-text"
                                                for="inputGroupSelect01"
                                                >Km</label
                                            >
                                            <select
                                                class="custom-select"
                                                id="inputGroupSelect01"
                                                v-model="selectedDistance"
                                            >
                                                <option value="20">20</option>
                                                <option value="40">40</option>
                                                <option value="60">60</option>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                     <button
                        class=" my-3 btn mx-auto btn-transparent"
                        @click="postFilteredAparments"
                    >
                        Start you Research
                    </button>
                    
                        <!-- Card Appartamenti -->
                    <div
                        v-if="filteredAparments === null"
                        class="d-flex flex-wrap my-3 justify-content-center"
                    >
                        <div
                            v-for="(apartment, index) in apartmentsList"
                            :key="`apartment-${index}`"
                            class="card mb-3 col-12 col-md-5 mx-3 "
                        >
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img
                                        class="img-apartment img-custom"
                                        :src="apartment.image"
                                        :alt="apartment.name"
                                    />
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i
                                                class="fa-solid fa-house mr-2"
                                            ></i>
                                            {{ apartment.name }}
                                        </h5>
                                        <p
                                            v-if="apartment.description != null"
                                            class="card-text"
                                        >
                                            <i
                                                class="fa-solid fa-rectangle-list mr-2"
                                            ></i>
                                            {{
                                                getExcerpt(
                                                    apartment.description,
                                                    120
                                                )
                                            }}

                                        </p>
                                        <p v-else class="card-text">
                                            <i
                                                class="fa-solid fa-rectangle-list mr-2"
                                            ></i>
                                          Description not available
                                        </p>
                                        <div class="card-subtitle mb-2">
                                            <i
                                                class="fa-solid fa-location-dot mr-2"
                                            ></i>
                                            {{ apartment.address }}
                                        </div>
                                        <div class="card-subtitle mb-2">
                                            <i
                                                class="fa-solid fa-money-bill-wave mr-2"
                                            ></i>
                                            {{ apartment.price }} € / notte
                                        </div>
                                        <!-- <div card-subtitle>{{ apartment.services.name }}</div> -->
                                        <div class="text-right">
                                            <router-link
                                                class="link-custom mb-2 p-1"
                                                :to="{
                                                    name: 'apartment-details',
                                                    params: {
                                                        slug: apartment.slug,
                                                    },
                                                }"
                                                >Find More
                                            </router-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        v-else-if="filteredAparments.length >= 1"
                        class="d-flex flex-wrap my-3 justify-content-center"
                    >
                        <div
                            v-for="(apartment, index) in filteredAparments"
                            :key="`apartment-${index}`"
                            class="card mb-3 col-12 col-md-5 mx-3 justify-content-center"
                        >
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img
                                        class="img-apartment img-custom"
                                        :src="apartment.image"
                                        :alt="apartment.name"
                                    />
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"
                                            :class="{pink: apartment.sponsorship == true}">
                                            <i
                                                class="fa-solid fa-house mr-2"
                                            ></i>
                                            {{ apartment.name }}
                                        </h5>
                                        <p
                                            v-if="apartment.description != null"
                                            class="card-text"
                                        >
                                            <i
                                                class="fa-solid fa-rectangle-list mr-2"
                                            ></i>
                                            {{
                                                getExcerpt(
                                                    apartment.description,
                                                    120
                                                )
                                            }}

                                        </p>
                                        <p v-else class="card-text">
                                            <i
                                                class="fa-solid fa-rectangle-list mr-2"
                                            ></i>
                                          Description not available
                                        </p>
                                        <div class="card-subtitle mb-2">
                                            <i
                                                class="fa-solid fa-location-dot mr-2"
                                            ></i>
                                            {{ apartment.address }}
                                        </div>
                                        <div class="card-subtitle mb-2">
                                            <i
                                                class="fa-solid fa-money-bill-wave mr-2"
                                            ></i>
                                            {{ apartment.price }} € / notte
                                        </div>
                                        <div class="text-right">
                                            <router-link
                                                class="link-custom mb-2"
                                                :to="{
                                                    name: 'apartment-details',
                                                    params: {
                                                        slug: apartment.slug,
                                                    },
                                                }"
                                                >Find More
                                            </router-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h2 v-else class="text-center my-5 col-12">No apartment Found</h2>
                </section>
            </section>
        </div>
    </section>
</template>

<script>
import axios from "axios";

export default {
    name: "AdvancedSearch",
    components: {},
    data() {
        return {
            numRooms: 0,
            maxPeople: 0,
            selectedDistance: 20,
            filteredServices: [],
            query: "",
            apartmentsList: null,
            filteredAparments: null,
            servicesList: null,
            newArray: [],
            suggestionsArray: [],
            selectedLat: "",
            selectedLon: "",
            d: 0,
            pagination: null,
        };
    },
    mounted() {
        this.getApartments();
        this.getServices();
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
        getApartments() {
            axios
                .get("http://127.0.0.1:8000/api/apartments")
                .then((response) => {
                    this.apartmentsList = response.data;
                })
                .catch((error) => console.log(error));
        },
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
        postFilteredAparments(page = 1) {
            if(this.query.length > 1) {
                axios.post(`http://127.0.0.1:8000/api/apartments/?page=${page}`, {
                    selectedLat: this.selectedLat,
                    selectedLon: this.selectedLon,
                    selectedDistance: this.selectedDistance,
                    filteredServices: this.filteredServices,
                    maxPeople: this.maxPeople,
                    maxRoom: this.numRooms,
                })
                .then((result => {
                    console.log(result.data);
                    this.filteredAparments = result.data;
                    this.pagination = {
                        current: res.data.current_page,
                        last: res.data.last_page
                    }
                }))
                .catch((error => {
                    console.log(error)
                }));
            }
        },
    },
};
</script>

<style lang="scss" scoped>

.img-custom {
    object-fit: cover;
    padding: 0.5rem;
    border-radius: 15px;
}
.link-custom {
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

.pink {
    color: #ff385c;
}
</style>
