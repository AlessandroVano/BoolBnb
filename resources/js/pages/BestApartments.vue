<template>
    <div class="container py-5">
        <h1><i class="fa-solid fa-star"></i> Best Apartments</h1>
        <div class="row">
            <div
                class="card card-custom m-3 col-lg-5 col-sm-12"
                v-for="apartment in apartmentsList"
                :key="`apartment-${apartment.id}`"
                style="max-width: 540px"
            >
                <div class="row no-gutters">
                    <div class="col-lg-5">
                        <img
                            class="img-apartment img-custom"
                            :src="apartment.image"
                            :alt="apartment.name"
                        />
                    </div>
                    <div class="col-lg-7">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fa-solid fa-house mr-2"></i>
                                {{ apartment.name }}
                            </h5>
                            <p class="card-text">
                                <i class="fa-solid fa-rectangle-list mr-2"></i>
                                {{ apartment.description }}
                            </p>
                            <div class="card-subtitle mb-2">
                                <i class="fa-solid fa-location-dot mr-2"></i>
                                {{ apartment.address }}
                            </div>
                            <div class="card-subtitle mb-2">
                                <i class="fa-solid fa-money-bill-wave mr-2"></i>
                                {{ apartment.price }} € / notte
                            </div>
                            <!-- <div class="card-subtitle mb-2">
                                <span>Services <i class="fa-solid fa-angle-down"></i></span>
                                <ul class="px-3">
                                    <li
                                        v-for="service in apartment.services"
                                        :key="`service-${service.id}`"
                                    >
                                        {{ service.name }}
                                    </li>
                                </ul>
                            </div> -->
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

<style scoped lang="scss">
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
    h1 {
        color: #ff385c;
    }
    // .filter-container {
    // }
}
.box {
    border: 1px solid black;
}

.service-img {
    width: 30px;
}

ul {
    list-style: none;
}
</style>
