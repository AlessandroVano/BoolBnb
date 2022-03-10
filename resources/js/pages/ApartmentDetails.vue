<template>
    <section class="container my-4">
        <div class="card p-4">
            <div v-if="apartment">
                <!-- name -->
                <div
                    class="col-12 justify-content-center align-items-center text-center"
                >
                    <h1 class="d-inline title mt-3">{{ apartment.name }}</h1>
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
                <section class="circle container service_icon mb-5">
                    <div
                        v-for="service in apartment.services"
                        :key="`service-${service.id}`"
                    >
                        <img
                            class="service-img"
                            :src="service.icon"
                            alt="service.name"
                        />
                        <div class="service_name">{{ service.name }}</div>
                    </div>
                </section>
                <!-- Maps + Detail apartment -->
                <section class="mt-5 container description_maps">
                    <div class="row d-flex">
                        <div class="col-6">
                            <div class="card p-4">
                                <div>
                                    <strong>Description:</strong>
                                    <p>{{ apartment.description }}</p>
                                </div>
                                <div class="d-flex mt-2">
                                    <strong>Number of rooms:</strong>
                                    <span class="mx-3">{{
                                        apartment.rooms
                                    }}</span>
                                </div>
                                <div class="d-flex mt-2">
                                    <strong>Price:</strong>
                                    <span class="mx-3"
                                        >{{ apartment.price }} €</span
                                    >
                                </div>
                                <div class="d-flex mt-2">
                                    <strong>Address:</strong>
                                    <span class="mx-3">{{
                                        apartment.address
                                    }}</span>
                                </div>
                                <div class="d-flex mt-2">
                                    <strong>Square meters:</strong>
                                    <span class="mx-3">
                                        {{ apartment.square_meters }} m2
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-6" id="cartina">
                            <div class="marker"></div>
                        </div>
                    </div>
                </section>

                <!-- MessageForm -->
                <MessageForm :apartment_id="apartment.id" />
            </div>
        </div>
    </section>
</template>

<script>
import axios from "axios";
import MessageForm from "../components/MessageForm.vue";
export default {
    name: "ApartmentDetail",

    components: {
        MessageForm,
    },

    data() {
        return {
            apartment: null,
            latitude: 0,
            longitude: 0,
        };
    },
    created() {
        this.getApartmentDetail();
        // this.getCartina();
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
                    this.latitude = res.data.latitude;
                    this.longitude = res.data.longitude;
                    if (res.data.not_found) {
                        this.$router.push({ name: "not-found" });
                    } else {
                        this.apartment = res.data;
                    }
                    axios
                        .get(
                            `https://api.tomtom.com/map/1/staticimage?key=A7Tus1YOQbGV9cHnXAwNc3DFV88QJw2X&zoom=16&center=${res.data.longitude},${res.data.latitude}&width=400&height=400&`
                        )
                        .then((res1) => {
                            /*  console.log(res1); */
                            let cartina = document.getElementById("cartina");
                            cartina.style.backgroundImage = `url("${res1.config.url}")`;

                            // let circle = document.createElement('div')
                            // circle.classList.add('marker')
                            // cartina.append(circle)
                        });
                });
        },
    },
};
</script>

<style lang="scss" scoped>
.title {
    color: #ff385c;
}
strong {
    color: #ff385c;
}
.img-1 {
    width: 100%;
    object-fit: contain;
    height: 350px;
}
.service_icon {
    margin-left: 38px;
    display: flex;
    text-align: center;
    flex-wrap: wrap;
}
.service_name {
    padding: 20px 20px;
    margin-top: -19px;
}

.service {
    display: flex;
    flex-direction: row;
}
/* .circle{
    width: 20px;
    height: 20px;
    background-color: #ff385c;
} */

.service-img {
    width: 30px;
}
.description_maps {
    margin-left: 22px;
}

#cartina {
    display: flex;
    justify-content: center;
    align-items: center;
    background-position: center;
    background-repeat: no-repeat;
    object-fit: contain;
    border-radius: 10px;
}

.marker {
    width: 34px;
    height: 34px;
    background-color: #ff385c;
    border-radius: 17px;
}
</style>
