<template>
    <section class="container">
        <div v-if="apartment">
            <h1>{{ apartment.name }}</h1>
            <Service :list="apartment.service" />
            <figure v-if="apartment.image">
                <img :src="apartment.image" alt="apartment.name" />
            </figure>

            <p>{{ apartment.description }}</p>
        </div>
    </section>
</template>

<script>
import axios from "axios";
import Services from "../components/Services.vue";
export default {
    name: "ApartmentDetail",
    components: {
        Services,
    },

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
