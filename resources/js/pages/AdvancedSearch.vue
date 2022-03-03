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
            <button
                @click="getApartments"
                class="btn btn-dark my-2 my-sm-0 input-group-text border-custom"
                id="addon-wrapping "
                type="submit"
            >
                Search
            </button>
        </div>

        <!-- <section v-if="apartmentsList == null">
            <h2>Start your journey, choose a place</h2>
        </section> -->

        <section v-if="newText != ''" class="mt-5">
            <ul
                class="d-flex"
                v-for="(apartment, index) in inputSearch"
                :key="`apartment-${index}`"
            >
                <li class="card" v-if="apartment.visibility">
                    {{ apartment.name }}
                    {{ apartment.address }}
                    {{ apartment.bathroom }}
                </li>

                <li class="card" style="width: 18rem">
                    <img
                        :src="apartment.image"
                        class="card-img-top"
                        :alt="apartment.name"
                    />
                    <div class="card-body">
                        <h5 class="card-title">{{ apartment.name }}</h5>
                        <p class="card-text">
                            {{ apartment.description }}
                        </p>
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
        };
    },
    created() {
        this.getApartments();
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
