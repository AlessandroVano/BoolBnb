<template>
    <section class="container">
        <h1 class="my-4">
            <i class="fa-solid fa-map"></i> Search your next place
        </h1>
        <div class="my-2 my-lg-0">
            <div class="input-group mb-3">
                <input
                    type="text"
                    class="mr-3 fs-10 border-custom fw-light"
                    placeholder="Search"
                    aria-label="Search"
                    aria-describedby="addon-wrapping"
                    v-model.trim="newText"
                />
                <!-- <button
                    @click="getApartments"
                    class="btn btn-dark my-2 my-sm-0 input-group-text border-custom"
                    id="addon-wrapping "
                    type="submit"
                >
                    Search
                </button> -->
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
                    <div class="d-flex flex-column col-sm-12 col-md-6 col-lg-8">
                        <div
                            v-for="(apartment, index) in inputSearch"
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
                                            {{ apartment.description }}
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
                                        <!-- <div card-subtitle>{{ apartment.services }}</div> -->
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
            newText: "",
            apartmentsList: null,
            servicesList: null,
            newArray: [],
        };
    },
    mounted() {
        this.getApartments();
        this.getServices();
    },
    computed: {
        inputSearch() {
            if (this.newText.length > 0) {
                return this.apartmentsList.filter((item) => {
                    return this.newText
                        .toLowerCase()
                        .split(" ")
                        .every((v) => item.address.toLowerCase().includes(v));
                });
            } else {
                return this.apartmentsList;
            }
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
        setValue(text) {
            this.inputText = text;
        },
        filteredSearch() {
            this.apartmentsList.filter((apartment) => {
                apartment.services.forEach((service) => {
                    if (this.filteredServices.includes(service.name)) {
                        if (!this.newArray.includes(apartment)) {
                            return this.newArray.push(apartment);
                        } else if (this.newArray.includes(apartment)) {
                            return this.newArray.shift(apartment)
                        }
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
    h1 {
        color: #ff385c;
    }
    // .filter-container {
    // }
}
</style>
