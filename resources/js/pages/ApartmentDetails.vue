<template>
    <section class="container">
        <div class="row align-items-center">
            <div v-if="apartment">
                <div
                    class="col-12 d-flex justify-content-center align-items-center"
                >
                    <h1 class="d-inline mt-3">{{ apartment.name }}</h1>
                </div>
                <div class="col-sm-12 col-md-6 my-4" v-if="apartment.image">
                    <img
                        class="img-fluid"
                        :src="apartment.image"
                        alt="apartment.name"
                    />
                </div>
                <div
                    v-for="service in apartment.services"
                    :key="`service-${service.id}`"
                >
                    <span>{{ service.name }}</span>
                    <img class="w-25" :src="service.icon" alt="service.name" />
                </div>

                <div class="col-sm-12 col-md-6">
                    <p>{{ apartment.description }}</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import axios from "axios";
export default {
    name: "ApartmentDetail",

    data() {
        return {
            apartment: null,
        };
    },
    created() {
        this.getApartmentDetail();
    },
    methods: {
        getApartmentDetail() {
            // CHIAMATA APARTMENT TRAMITE API
            axios
                .get(
                    `http://127.0.0.1:8000/api/apartments/${this.$route.params.slug}`
                )
                .then((res) => {
                    this.apartment = res.data;
                    if (res.data.not_found) {
                        this.$router.push({ name: "not-found" });
                    } else {
                        this.apartment = res.data;
                    }
                })
                .catch((err) => log.error(err));
        },
    },
};
</script>

<style></style>
