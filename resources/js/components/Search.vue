<template>
    <div>
        <label for="address" class="form-label">Address</label>
        <input
            v-model="query"
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
                v-for="(element, index) in array" :key="`addres${index}`">
                    {{ element.address.freeformAddress }} {{element.position.lat}} *** {{element.position.lon}}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "Search",

    data() {
        return {
            result: "",
            query: "",
            value: "",
            array: [],
        };
    },

    methods: {
        getAddress() {
            axios
                .get(
                    `https://api.tomtom.com/search/2/search/${this.query}.json?key=rSkxFlbVNJrDJk4qCwxbY0Z0qN6UEcFu&limit=5`
                )
                .then((res) => {
                    this.result = res.data.results;
                    this.array = res.data.results;
                    console.log(this.array);
                });
        },

        setValue(index){
        let element = document.getElementById(index)
        this.query = element.innerHTML.trim();
        this.array = []
        },
    },
};
</script>

<style scoped lang="scss">

li{
    cursor:pointer;
}
</style>
