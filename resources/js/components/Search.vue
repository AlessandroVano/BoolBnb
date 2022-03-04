<template>
    <div>
        <label for="address" class="form-label">Address</label>
        <input
            @keyup="getAddress()"
            type="text"
            class="form-control"
            name="address"
            id="address"
        />

        <div class="bg-white text-dark">
            <ul>
                <li
                    :id="`${index}`"
                    @click="setValue(index)"
                    class="list-unstyled cursor-pointer"
                    v-for="(element, index) in array"
                    :key="`addres${index}`"
                >
                    {{ element.address.freeformAddress }}
                </li>
            </ul>
        </div>

        <!-- LAT -->
        <label for="latitude" class="form-label" hidden>Latitude</label>
        <input
            v-model="lat"
            type="text"
            class="form-control"
            name="latitude"
            id="latitude"
            hidden
        />
        <!-- LON -->
        <label for="longitude" class="form-label" hidden>Longitude</label>
        <input
            v-model="lon"
            type="text"
            class="form-control"
            name="longitude"
            id="longitude"
            hidden
        />
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "Search",

    data() {
        return {
            query: "",
            value: "",
            array: [],
            lat: "",
            lon: "",
        };
    },

    methods: {
        getAddress() { 
            let test = document.getElementById('address').value;
            this.query = test;
            axios
                .get(
                    `https://api.tomtom.com/search/2/search/${this.query}.json?key=rSkxFlbVNJrDJk4qCwxbY0Z0qN6UEcFu&limit=5`
                )
                .then((res) => {
                    this.array = res.data.results;
                });
        },

        setValue(index) {
            let element = document.getElementById(index);
            this.query = element.innerHTML.trim();
            this.lat = this.array[index].position.lat;
            this.lon = this.array[index].position.lon;
            this.array = [];
        },
    },
};


</script>

<style scoped lang="scss">
li {
    cursor: pointer;
}
</style>
