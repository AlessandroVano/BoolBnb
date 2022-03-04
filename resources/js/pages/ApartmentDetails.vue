<template>
    <section class="container">
        <div>
            <div v-if="apartment">
                <!-- name -->
                <div
                    class="col-12 mt-3 justify-content-center align-items-center text-center"
                >
                    <h1 class="d-inline mt-3">{{ apartment.name }}</h1>
                </div>

                <!-- image -->
                <div class="my-4" v-if="apartment.image">
                    <img
                        class="img-1"
                        :src="apartment.image"
                        alt="apartment.name"
                    />
                </div>

                <!-- service -->
                <section class="w-100 justify-content-around d-flex mb-5">
                    <div
                        class="text-center"
                        v-for="service in apartment.services"
                        :key="`service-${service.id}`"
                    >
                        <img
                            class="service-img"
                            :src="service.icon"
                            alt="service.name"
                        />
                        <div class="mt-1">{{ service.name }}</div>
                    </div>
                </section>
                <!-- Maps + Detail apartment -->
                <section  class="mt-5 container">
                    <div class="col-5">
                        <div>
                           <h5>Description:</h5>
                           <p>{{ apartment.description }}</p>
                        </div>  
                          <div class="d-flex ">
                           <h5>Number of rooms:</h5>
                           <p class="mx-3">{{ apartment.rooms }}</p>
                        </div> 
                           <div class="d-flex ">
                           <h5>Price:</h5>
                           <p class="mx-3">{{ apartment.price }}</p>
                        </div> 
                          <div class="d-flex ">
                           <h5>Address:</h5>
                           <p class="mx-3">{{ apartment.address }}</p>
                        </div> 
                          <div class="d-flex ">
                           <h5>Square meters:</h5>
                           <p class="mx-3">{{ apartment.square_meters }}</p>
                        </div> 
                    </div>
                    <div class="col-7"></div>
                </section>

                <!-- description -->
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

<style lang="scss" scoped>
.img-1 {
    width: 100%;
    object-fit: contain;
    height: 350px;
}
.service {
    display: flex;
    flex-direction: row;
}
.service-img {
    width: 30px;
}
</style>
