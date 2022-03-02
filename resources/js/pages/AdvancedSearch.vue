<template>
    <section class="container">
        <h1>Search your next place</h1>
        <form class="form-inline my-2 my-lg-0">
            <input
                class="form-control w-50 mr-sm-2"
                type="search"
                placeholder="Search"
                aria-label="Search"
            />
            <button class="btn btn-dark my-2 my-sm-0" type="submit">
                Search
            </button>
        </form>
    </section>
</template>

<script>
import axios from "axios"

export default {
    name: "AdvancedSearch",
    components: {},
    data() {
        return {
            apartmentsList: [],
        }
    },
    methods: {
        getApartments() {
            if (text === '') {
                this.apartmentsList = [];
            } else {
                axios
                .get('http://127.0.0.1:8000/api/apartments')
                .then(response => {
                this.apartmentsList = response.data
                })
                .catch (error => console.log(error))
            }
        }
    }
}
</script>

<style lang="scss" scoped>
</style>
