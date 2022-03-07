<template>
    <section class="container">
        <h1 class="my-4">
            <i class="fa-solid fa-map"></i> Search your next place
        </h1>
        <div class="my-2 my-lg-0">
            <div class="mb-3">
                <label for="address" class="form-label"></label>
                <input
                    type="text"
                    class="mr-3 fs-10 border-custom fw-light form-control"
                    placeholder="Search"
                    aria-label="Search"
                    aria-describedby="addon-wrapping"
                    v-model="query"
                    @keyup ="getAddress()"
                />
            <ul class="list-unstyled  cursor-pointer bg-white text-dark">
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
            <div class="bg-white text-dark">
        </div>
            </div>
            <section>
                <section class="row">
                    <div class="filter-section p-3 col-sm-12 col-md-6 col-lg-4">
                        <div class="filter-container">
                            <h1>Select filters</h1>
                            <h3>Services</h3>
                            <ul>
                                <li
                                    v-for="service in servicesList"
                                    :key="`service-${service.id}`"
                                    class="custom-control custom-switch"
                                >
                                    <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        :id="`customSwitch-${service.id}`"
                                        :value="service.name"
                                        v-model="filteredServices"
                                        @change="filteredSearch()"
                                    />
                                    <label
                                        class="custom-control-label"
                                        :for="`customSwitch-${service.id}`"
                                        >{{ service.name }}
                                    </label>
                                </li>
                            </ul>
                            <h1>Additional filters</h1>
                            <ul>
                                <li>
                                    <div
                                        class="input-group mb-3 d-flex flex-column"
                                    >
                                        <h3>How many guests?</h3>
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
                                <li>
                                    <div
                                        class="input-group mb-3 d-flex flex-column"
                                    >
                                        <h3>How many rooms?</h3>
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
                            </ul>
                        </div>
                    </div>
                     <div 
                     v-if="!filteredAparments || query == ''"
                     class="d-flex flex-column col-sm-12 col-md-6 col-lg-8">
                        <div
                            
                            v-for="(apartment, index) in apartmentsList"
                            :key="`apartment-${index}`"
                            class="card mb-3"
                            style="max-width: 540px"
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
                                        <p class="card-text">
                                            <i
                                                class="fa-solid fa-rectangle-list mr-2"
                                            ></i>
                                            {{ getExcerpt(apartment.description, 120) }}
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

                    <div v-else
                     class="d-flex flex-column col-sm-12 col-md-6 col-lg-8">
                        <div
                            v-for="(apartment, index) in filteredAparments"
                            :key="`apartment-${index}`"
                            class="card mb-3"
                            style="max-width: 540px"
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
                                        <p class="card-text">
                                            <i
                                                class="fa-solid fa-rectangle-list mr-2"
                                            ></i>
                                            {{ getExcerpt(apartment.description, 120) }}
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

                </section>
            </section>
        </div>

        <!-- <section v-if="newText != ''" class="mt-5">
            <ul class="card-container row">
                <li
                    class="card border-rounded col-12 col-md-6 col-lg-4 my-3"
                    v-for="(apartment, index) in inputSearch"
                    :key="`apartment-${index}`"
                >
                    <div class="text-center img-container rounded-pills">
                        <img
                            class="card-img-top img-apartment w-0"
                            :src="apartment.image"
                            :alt="apartment.name"
                        />
                    </div>
                    <div
                        class="card-body p-1 text-center detail-container my-3"
                    >
                        <h5 class="card-title">{{ apartment.name }}</h5>
                        <p class="card-text">
                            {{ apartment.description }}
                        </p>
                        <div card-subtitle>{{ apartment.address }}</div>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </li>
            </ul>
        </section> -->
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
            filteredServices: [],
            query: "",
            apartmentsList: null,
            filteredAparments: null,
            servicesList: null,
            newArray: [],
            suggestionsArray : [],
            selectedLat : "",
            selectedLon : "",
            d : 0,
        };
    },
    mounted() {
        this.getApartments();
        this.getServices();
    },
    // computed: {
    //     inputSearch() {
    //         if (this.newText.length > 0) {
    //             return this.apartmentsList.filter((item) => {
    //                 return this.newText
    //                     .toLowerCase()
    //                     .split(" ")
    //                     .every((v) => item.address.toLowerCase().includes(v));
    //             });
    //         } else {
    //             return this.apartmentsList;
    //         }
    //     },
    // },
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

         //Funzione per calcolare la distanza in km tra due punti terrrestr
        distance(startLat, startLon, lat2, lon2) { 
            const p = 0.017453292519943295;
            const c = Math.cos; 
            const a = 0.5 - c((lat2 - startLat) * p)/2 + c(startLat * p) * c(lat2 * p) * (1 - c((lon2 - startLon) * p))/2; 
            const distance = 12742 * Math.asin(Math.sqrt(a));
            this.d = distance.toFixed(3);
            console.log(this.d)
        },

        setValue(index) {
            this.filteredAparments = [];
            let element = document.getElementById(index);
            this.query = element.innerHTML.trim();
            this.selectedLat = this.suggestionsArray[index].position.lat;
            this.selectedLon = this.suggestionsArray[index].position.lon;
            this.suggestionsArray = [];

            this.apartmentsList.forEach( element => {
                this.distance(this.selectedLat, this.selectedLon, element.latitude, element.longitude);
                    console.log(element)
                    
                if(this.d < 20) {
                    this.filteredAparments.push(element)
                }
            });
           

        },
        getExcerpt(text, maxLength) {
            if (text.length > maxLength) {
                return text.substr(0, maxLength) + "...";
            }
            return text;
        },
        filteredSearch() {
            this.apartmentsList.filter((apartment) => {
                apartment.services.forEach((service) => {
                    if (this.filteredServices.includes(service.name)) {
                        if (!this.newArray.includes(apartment)) {
                            return this.newArray.push(apartment);
                         } 
                        // else if (this.newArray.includes(apartment)) {
                        //     return this.newArray.shift(apartment)
                        // }
                    }
                });
            });
            // this.apartmentsList.forEach((apartment) => {
            //     let apartmentService = apartment.services;
            //     apartmentService.forEach((service) => {
            //         if (this.filteredServices.includes(service.name)) {
            //             if (!this.newArray.includes(apartment)) {
            //                 this.newArray.push(apartment);
            //             }
            //         } else if (!this.filteredServices.includes(service.name)) {
            //             this.newArray = this.newArray.filter(el => {
            //                 el.services.forEach((service) => {
            //                     this.filteredServices.includes(service)
            //                     return el
            //                 })
            //             });
            //         }
            //     });
            // });
            // this.apartmentsList.forEach((apartment) => {
            //     let apartmentService = apartment.services;
            //     apartmentService.forEach((service) => {
            //         // console.log(service.name)
            //         if (myService === service.name) {
            //             if (!this.newArray.includes(apartment)) {
            //                 this.newArray.push(apartment);
            //             }
            //         } else if (myService != service.name) {
            //             this.newArray = this.newArray.filter(el => {
            //                 if (!this.filteredServices.includes(service.name)) {
            //                     return el
            //                 }
            //             });
            //         }
            //     });
            // });
        },
        getAddress(){
            delete axios.defaults.headers.common['X-Requested-With'];
            axios.get(`https://api.tomtom.com/search/2/search/${this.query}.json?key=ue74ZxVT9w3YLf0sEeYAz5GOv1v6G1md&limit=5`)
            .then((res) => {
                this.suggestionsArray = res.data.results;
        });
         }
    }
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
    h1 {
        color: #ff385c;
    }
    // .filter-container {
    // }
}
</style>
