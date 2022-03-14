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
                        class="fs-10 border-custom fw-light form-control input-search"
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
                            <h5 class="mb-2 color-h5">Services</h5>
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
                                        <h5 class="mb-2 color-h5">How many guests?</h5>
                                        <div class="input-group-prepend">
                                            <label
                                                class="input-group-text "
                                                for="inputGroupSelect01"
                                                >Guest/s</label
                                            >
                                            <select
                                                class="custom-select input-search-1"
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
                                        <h5 class="mb- color-h5">How many rooms?</h5>
                                        <div class="input-group-prepend">
                                            <label
                                                class="input-group-text"
                                                for="inputGroupSelect01"
                                                >Rooms</label
                                            >
                                            <select
                                                class="custom-select input-search-1"
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
                                                class="custom-select input-search-1"
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
                        class=" mt-4  btn mx-auto btn-transparent"
                        @click="postFilteredAparments"
                    >
                        Start you Research
                    </button>
                    


                        <!-- Card Appartamenti -->
                    <div
                        v-if="filteredAparments === null"
                        class="d-flex flex-wrap my-3 justify-content-center"
                    >
                    <h3 class="col-12 text-center" v-if="apartmentsList !== null"
                    >Some of our best apartments</h3>
                        <div
                            v-for="(apartment, index) in apartmentsList"
                            :key="`apartment-${index}`"
                            class="card mt-2 mb-3 col-10 col-md-5 mx-3 hover-card "
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
                                                class="link-custom mb-2 btn"
                                                :to="{
                                                    name: 'apartment-details',
                                                    params: {
                                                        slug: apartment.slug,
                                                    },
                                                }"
                                                >Details
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
                                    </div>
                                    <div class="text-right">
                                        <router-link
                                            class="link-custom mb-2 btn"
                                            :to="{
                                                name: 'apartment-details',
                                                params: {
                                                    slug: apartment.slug,
                                                },
                                            }"
                                            >Details
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h2 v-else class="text-center my-5 col-12">No apartment Found</h2>
                </section>
                <!-- Loader -->
                    <div class="my-5">
                        <Loader class="mx-auto" v-if="apartmentsList === null || filteredAparments === null"/>
                    </div>
            </section>
        </div>
    </section>
</template>

<script>
import axios from "axios";
import Loader from "../components/Loader";

export default {
    name: "AdvancedSearch",
    components: {
        Loader,
    },
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
        };
    },
    mounted() {
        this.getServices();
        if (sessionStorage.query) {
            this.query = sessionStorage.query;
            this.selectedLat = sessionStorage.selectedLat;
            this.selectedLon = sessionStorage.selectedLon;
            this.postFilteredAparments();
        };
        this.getApartments();
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
    background-color: transparent;
    border: 3px solid  #ff385c;
    color: #ff385c;
    display: inline-block;
    user-select: none;
    position: relative;
    overflow: hidden;
    vertical-align: middle;
    transition: color 0.3s ease;
    text-decoration: none;
    //text-decoration: none;
    //line-height: 1.5;
    //padding: 10px 28px;
    //border-radius: 30px;
    //font-weight: 600;
    //text-transform: capitalize;
    //font-family: inherit;
    //font-size: 16px;
}
.link-custom::after{
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 0%;
    background-color: #f07b9052;
    z-index: 1;
    transition: width 0.6s ease;
}
.link-custom:hover::after{
width: 100%;
}
.link-custom:focus {
    box-shadow: none !important;
}

.filter-section {
    box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px;

    border-radius: 20px;
    width: 30%;
      &:hover{
        transition: 0.4s ease-in-out;
         box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
     }
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
.input-search  {
    flex-grow: 1;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px;
    &:focus {
        box-shadow: #ff385dc9 0px 0px 0px 3px ;
        border: none;
    }
}
.input-search:hover{
      /*  transition: 0.4s ease-in-out; */
        box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
         box-shadow: #ff385dc9 0px 0px 0px 3px ;
        border: none;
}
.input-search-1{
    flex-grow: 1;
&:focus {
    box-shadow: #ff385dc9 0px 0px 0px 1.9px;
    border: none;
}
}
.hover-card{
    box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px;
    transition: 0.25s all;
    &:hover{
        box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
    }
}
</style>
