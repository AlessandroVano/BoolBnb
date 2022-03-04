<template>
    <section class="container">
        <h1>Search your next place</h1>
        <div class="input-group my-2 my-lg-0">
            <input
                type="text"
                class="mr-3 fs-10 border-custom fw-light"
                placeholder="Search"
                aria-label="Search"
                aria-describedby="addon-wrapping"
                v-model.trim="newText"
            />
            <div class="dropdown mr-3">
                <button
                    class="btn btn-secondary dropdown-toggle"
                    type="button"
                    id="dropdownMenuButton"
                    data-toggle="dropdown"
                    aria-expanded="false"
                >
                    Select filter
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <div class="custom-control custom-switch" v-for="service in servicesList" :key="`service-${service.id}`">
                        <input
                            type="checkbox"
                            class="custom-control-input"
                            id="customSwitch1"
                        />
                        <label class="custom-control-label" for="customSwitch1"
                            >{{ service.name }}</label
                        >
                    </div>
                </div>
            </div>
            <button
                @click="getApartments"
                class="btn btn-dark my-2 my-sm-0 input-group-text border-custom"
                id="addon-wrapping "
                type="submit"
            >
                Search
            </button>
        </div>


        <section v-if="newText != ''" class="mt-5">
            <ul class="card-container row">
                <li
                    class="card border-rounded col-12 col-md-6 col-lg-4 my-3"
                    v-for="(apartment, index) in inputSearch"
                    :key="`apartment-${index}`"
                >
                    <div class="text-center img-container">
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
        </section>
    </section>
</template>

<script>
import axios from "axios";

export default {
    name: "AdvancedSearch",
    components: {},
    data() {
        return {
            newText: "",
            apartmentsList: null,
            servicesList: null,
        };
    },
    created() {
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
        // inputSearch() {
        //     this.apartmentsList.forEach( element => {
        //         if (!element.name.toLowerCase().includes(this.newText.toLowerCase())) {
        //             element.visibility = false;
        //         } else {
        //            element.visibility = true;
        //         }
        //     });
        // },
    },
};
</script>

<style lang="scss" scoped></style>
