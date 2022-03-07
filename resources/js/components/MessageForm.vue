<template>
    <!-- FORM MESSAGE -->

    <div class="row">
        <div class="col-sm-12">
            <!-- Name -->
            <form @submit.prevent="apartmentForm">
                <div class="mb-3">
                    <label for="form-label" form="name">Name</label>
                    <input
                        class="form-control"
                        type="text"
                        id="name"
                        v-model="name"
                    />
                    <div
                        v-for="(error, index) in errors.name"
                        :key="`err-name-${index}`"
                        class="text-danger"
                    >
                        {{ error }}
                    </div>
                </div>
                <!-- Email -->

                <div class="mb-3">
                    <label for="form-label" form="email">email</label>
                    <input
                        class="form-control"
                        type="text"
                        id="email"
                        v-model="email"
                    />
                    <div
                        v-for="(error, index) in errors.email"
                        :key="`err-email-${index}`"
                        class="text-danger"
                    >
                        {{ error }}
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="message">message</label>
                    <textarea
                        class="form-control"
                        id="message"
                        rows="5"
                        v-model="message"
                    ></textarea>
                    <div
                        v-for="(error, index) in errors.message"
                        :key="`err-message-${index}`"
                        class="text-danger"
                    >
                        {{ error }}
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "MessageForm",

    props: {
        apartment_id: Number,
    },
    data() {
        return {
            name: "",
            email: "",
            message: "",
            errors: {},
        };
    },

    methods: {
        apartmentForm() {
            axios
                .post("http//127.0.0.1:8000/api/messages", {
                    apartment_id: this.apartment_id,
                    name: this.name,
                    emai: this.email,
                    message: this.message,
                })
                .then((res) => {
                    console.log(res.data);
                })
                .catch((err) => console.log(err));
        },
    },
};
</script>

<style></style>
