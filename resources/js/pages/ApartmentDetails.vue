<template>
    <section class="container my-4">
        <div class="card p-4">
            <div v-if="apartment">
                <!-- name -->
                <div
                    class="col-12 justify-content-center align-items-center text-center"
                >
                    <h1 class="d-inline title mt-3">
                        <i class="fa-solid fa-house mr-2"></i>
                        {{ apartment.name }}
                    </h1>
                </div>

                <!-- image -->
                <div class="my-4" v-if="apartment.image">
                    <img
                        class="img-1 rounded"
                        :src="apartment.image"
                        :alt="apartment.name"
                    />
                </div>

                <!-- service -->
                <div class="container border-bottom">
                    <h2 class="pt-4 border-top">
                        Services <i class="fa-solid fa-list mr-1"></i>
                    </h2>
                    <section class="circle service_icon">
                        <div
                            class="p-3 p-md-2 p-lg-1"
                            v-for="service in apartment.services"
                            :key="`service-${service.id}`"
                        >
                            <img
                                class="service-img"
                                :src="service.icon"
                                alt="service.name"
                            />
                            <div class="service_name d-none d-lg-block">
                                {{ service.name }}
                            </div>
                        </div>
                    </section>
                </div>
                <!-- Maps + Detail apartment -->
                <section
                    class="mt-4 container description_maps border-bottom pb-5"
                >
                    <div class="d-flex justify-content-between w-70"></div>
                    <div class="row d-flex">
                        <div class="col-lg-6 col-md-12 mt-3">
                            <h2>
                                Info
                                <i class="fa-solid fa-circle-info mx-2"></i>
                            </h2>
                            <div class="card p-4">
                                <div class="mb-3 d-flex">
                                    <strong class="flex-shrink-0 mr-1"
                                        ><i
                                            class="fa-solid fa-rectangle-list mr-1"
                                        ></i>
                                        Description:</strong
                                    >
                                    <p class="d-inline m-0">
                                        {{
                                            getExcerpt(
                                                apartment.description,
                                                100
                                            )
                                        }}
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <strong class="mr-1"
                                        ><i
                                            class="fa-solid fa-door-closed mr-1"
                                        ></i
                                        >Number of rooms:</strong
                                    >
                                    <span>{{ apartment.rooms }}</span>
                                </div>
                                <div class="mb-3">
                                    <strong class="mr-1"
                                        ><i
                                            class="fa-solid fa-money-bill-wave mr-1"
                                        ></i>
                                        Price:</strong
                                    >
                                    <span>{{ apartment.price }} €</span>
                                </div>
                                <div class="mb-3 d-flex">
                                    <strong class="flex-shrink-0 mr-1"
                                        ><i
                                            class="fa-solid fa-location-dot mr-1"
                                        ></i>
                                        Address:</strong
                                    >
                                    <span>{{ apartment.address }}</span>
                                </div>
                                <div class="mb-3">
                                    <strong class="mr-1"
                                        ><i
                                            class="fa-solid fa-border-top-left mr-1"
                                        ></i>
                                        Square meters:</strong
                                    >
                                    <span>
                                        {{ apartment.square_meters }} m²
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 mt-3">
                            <h2>
                                Position
                                <i class="fa-solid fa-location-dot"></i>
                            </h2>
                            <div id="cartina">
                                <div class="marker">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                            </div>
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
                            `https://api.tomtom.com/map/1/staticimage?key=A7Tus1YOQbGV9cHnXAwNc3DFV88QJw2X&zoom=16&center=${res.data.longitude},${res.data.latitude}&width=500&height=500&`
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
        getExcerpt(text, maxLength) {
            if (text.length > maxLength) {
                return text.substr(0, maxLength) + "...";
            }
            return text;
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
    display: flex;
    text-align: center;
    flex-wrap: wrap;
    justify-content: center;
    border: 0.5px solid lightgray;
    border-radius: 10px;
    padding: 1rem;
    margin: 2rem;
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
// .description_maps {
//     margin-left: 22px;
// }

#cartina {
    display: flex;
    justify-content: center;
    align-items: center;
    background-position: center;
    background-repeat: no-repeat;
    object-fit: contain;
    border-radius: 10px;
    height: 300px;
}

.marker {
    color: #ff385c;
    font-size: 2.5rem;
}
.w-70 {
    width: 70%;
}
</style>
