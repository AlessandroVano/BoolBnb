<template>
    <div class="bg-dark">
        <div class="container py-5">
            <ul class="d-flex flex-wrap justify-content-center">
                <li
                    class="list-unstyled card m-1"
                    v-for="(element, index) in apartmentsList"
                    :key="`apartment${index}`"
                >
                    <h4>{{ element.name }}</h4>
                    <p>{{ element.description }}</p>
                    <p>{{element.price}}€</p>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "BestApartments",

    data() {
        return {
            apartmentsList: [],
        };
    },

    created() {
        this.getApartments();
    },

    methods: {
        getApartments() {
            axios.get("http://127.0.0.1:8000/api/apartments").then((res) => {
                this.apartmentsList = res.data;
            });
        },
    },
};
</script>

<style scoped lang="scss"></style>
