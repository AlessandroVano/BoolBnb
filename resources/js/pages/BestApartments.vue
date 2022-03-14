<template>
    <div class="container py-5">
        <h1><i class="fa-solid fa-star"></i> Best Apartments</h1>
        <div class="row justify-content-center">
            <div
                class="card card-custom m-3 col-lg-5 col-10"
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
                            <p
                                v-if="apartment.description != null"
                                class="card-text"
                            >
                                <i class="fa-solid fa-rectangle-list mr-2"></i>
                                {{ getExcerpt(apartment.description, 120) }}
                            </p>
                            <p v-else class="card-text">
                                <i class="fa-solid fa-rectangle-list mr-2"></i>
                                Description not available
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
                                    >Details
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
        getExcerpt(text, maxLength) {
            if (text.length > maxLength) {
                return text.substr(0, maxLength) + "...";
            }
            return text;
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
    /*     border-radius: 10px;
    padding: 0.1rem;
    border: 3px solid #ff385c;
    color: #ff385c;
    text-decoration: none; */
    line-height: 1.5;
    background-color: transparent;
    border: 3px solid #ff385c;
    color: #ff002f;
    padding: 6px 15px;
    display: inline-block;
    font-weight: 500;
    text-transform: capitalize;
    font-family: inherit;
    font-size: 16px;
    cursor: pointer;
    user-select: none;
    position: relative;
    overflow: hidden;
    vertical-align: middle;
    transition: color 0.3s ease;
    text-decoration: none;
}
.link-custom::before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 0%;
    background-color: #f07b9065;
    z-index: 1;
    transition: width 0.6s ease;
}
.link-custom:hover::before {
    width: 100%;
}
.link-custom:hover {
    color: #ff0000;
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
