<template>
    <!-- FORM MESSAGE -->
    <div class="row mt-5 d-flex justify-content-center">
        <div class="col-sm-4 col-md-8 col-lg-10 card c-custom p-3">
            <h3>Need more informations?</h3>
            <!-- Name -->
            <form @submit.prevent="apartmentForm">
                <div>
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

                <div class="my-3">
                    <label for="form-label" form="email">Email</label>
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
                    <label class="form-label" for="message">Message</label>
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

                <button
                    class="btn btn-pink"
                    data-toggle="modal"
                    data-target="#exampleModal"
                    type="submit"
                >
                    Send
                </button>
            </form>
            <div
                v-if="!success"
                class="modal fade"
                id="exampleModal"
                tabindex="-1"
                aria-labelledby="exampleModalLabel"
                aria-hidden="true"
            >
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                Warning
                            </h5>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">Please complete the form</div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                            >
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div
                v-else
                class="modal fade"
                id="exampleModal"
                tabindex="-1"
                aria-labelledby="exampleModalLabel"
                aria-hidden="true"
            >
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                Perfect!
                            </h5>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">Message sent successfully</div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                            >
                                Close
                            </button>
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
            success: false,
        };
    },

    methods: {
        apartmentForm() {
            axios
                .post("http://127.0.0.1:8000/api/messages", {
                    apartment_id: this.apartment_id,
                    name: this.name,
                    email: this.email,
                    message: this.message,
                })
                .then((res) => {
                    if (res.data.errors) {
                        this.errors = res.data.errors;
                        this.success = false;
                    } else {
                        this.name = "";
                        this.email = "";
                        this.message = "";
                        this.success = true;
                        this.errors = {};
                    }
                })
                .catch((err) => console.log(err));
        },
    },
};
</script>

<style lang="scss" scoped>
.custom-container {
    border: 1px solid black;
}

.btn-pink {
    color: #fff !important;
    background-color: #ff385c !important;
    border: 2px solid #ff385c !important;
    font-weight: 600 !important;
    transition: all 0.3s !important;

    &:hover {
        color: #ff385c !important;
        background-color: transparent !important;
        box-shadow: 0 0 6px 0 #ff385c !important;
    }
}

.c-custom {
    transition: all 0.3s;
    &:hover {
        box-shadow: 0px 10px 31px -2px rgba(0, 0, 0, 0.75);
        -webkit-box-shadow: 0px 10px 31px -2px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: 0px 10px 31px -2px rgba(0, 0, 0, 0.75);
    }
}
</style>
