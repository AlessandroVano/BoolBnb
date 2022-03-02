<template>
    <section class="container">
        <h1>Search your next place</h1>
        <div class="input-group my-2 my-lg-0">
            <!-- <input
                class="form-control w-50 mr-sm-2"
                type="search"
                placeholder="Search"
                aria-label="Search"
                v-model="inputText"
            />
            <button
                @click="getApartments"
                class="btn btn-dark my-2 my-sm-0"
                type="submit"
            >
                Search
            </button> -->

            <input
                type="text"
                class="mr-3 fs-10 border-custom fw-light"
                placeholder="Search"
                aria-label="Search"
                aria-describedby="addon-wrapping"
                v-model.trim="newText"
                @keyup="inputSearch"
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

        <section v-if="apartmentsList == 0">
            <h2>Porco il clero</h2>
        </section>

        <section v-else>
            <h2>Elden ring è facile e Ale non vuole giocarci</h2>
            <ul
                class="d-flex"
                v-for="(apartment, index) in apartmentsList"
                :key="`apartment-${index}`"
            >
                <li class="card" v-if="apartment.visibility">
                    {{ apartment.name }}
                    {{ apartment.address }}
                    {{ apartment.bathroom }}
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
    methods: {
        getApartments() {
            axios
                .get("http://127.0.0.1:8000/api/apartments")
                .then((response) => {
                    this.apartmentsList = response.data;
                    console.log(this.apartmentsList);
                })
                .catch((error) => console.log(error));
        },
        setValue(text) {
            this.inputText = text;
        },
        inputSearch() {
            this.apartmentsList.forEach( element => {
                if (!element.name.toLowerCase().includes(this.newText.toLowerCase())) {
                    element.visibility = false;
                } else {
                   element.visibility = true;
                }
            });
        },
    },
};
</script>

<style lang="scss" scoped></style>
