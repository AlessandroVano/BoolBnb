<template>
    <!-- FORM MESSAGE -->
    <div class="row mt-5 d-flex justify-content-center">
        <div class="col-10 card c-custom p-3">
            <h3>Need more informations? <i class="fa-solid fa-circle-question ml-2"></i></h3>
            <!-- Name -->
            <form @submit.prevent="apartmentForm">
                <div class="form form-distance">
                    <input
                        placeholder=""
                        class="form_input"
                        type="text"
                        id="name"
                        v-model="name"
                    />

                    <label for="form-label" class="form_label" form="name"
                        >Name</label
                    >
                    <div
                        v-for="(error, index) in errors.name"
                        :key="`err-name-${index}`"
                        class="t-danger text-danger"
                    >
                        {{ error }}
                    </div>
                </div>
                <!-- Email -->
                <div class="my-3 form">
                    <input
                        placeholder=""
                        class="form_input"
                        type="text"
                        id="email"
                        v-model="email"
                    />
                    <label
                        for="form-label"
                        class="form_label form-label"
                        form="email"
                        >Email</label
                    >
                    <div
                        v-for="(error, index) in errors.email"
                        :key="`err-email-${index}`"
                        class="t-danger text-danger"
                    >
                        {{ error }}
                    </div>
                </div>
                <!-- Textarea -->
                <div class="form m">
                    <textarea
                        class="form_input_text_area"
                        rows="4"
                        id="message"
                        v-model="message"
                        placeholder=""
                    ></textarea>
                    <label class="form_label form-label" for="message"
                        >Message</label
                    >
                    <div
                        v-for="(error, index) in errors.message"
                        :key="`err-message-${index}`"
                        class="text-danger t-600"
                    >
                        {{ error }}
                    </div>
                </div>

                <button
                    class="btn btn-pink mt"
                    data-toggle="modal"
                    data-target="#exampleModal"
                    type="submit"
                >
                    Send <i class="fa-solid fa-paper-plane ml-2"></i>
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
                            <h5 class="modal-title text-danger" id="exampleModalLabel">
                                Warning <i class="fa-solid fa-triangle-exclamation ml-2"></i>
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
                                class="btn btn-danger"
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
                            <h5 class="modal-title text-success" id="exampleModalLabel">
                                Perfect! <i class="fa-solid fa-circle-check ml-2"></i>
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
                                class="btn btn-pink"
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
.form {
    position: relative;
    width: 100%;

    height: 3;
    .form_input {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 3px solid #ced4da;
        border-radius: 10px;
        outline: none;
        padding: 1.25rem;
        background: none;
    }
    .form_input_text_area {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        border: 3px solid #ced4da;
        border-radius: 10px;
        outline: none;
        padding: 1.25rem;
        background: none;
    }
    .form_input:hover,
    .form_input_text_area:hover {
        border-color: #ced4da;
    }
    .form_input:focus,
    .form_input_text_area:focus {
        border-color: #ff385c;
    }
    .form_label {
        position: absolute;
        left: 1rem;
        top: 0.8rem;
        padding: 0 0.5rem;
        cursor: text;
        transition: top 200ms ease-in, left 200ms ease-in,
            font-size 200ms ease-in;
    }
    .form_input_text_area:focus ~ .form_label,
    .form_input_text_area:not(:placeholder-shown)
        .form_input_text_area:not(:focus)
        ~ .form_label {
        top: -0.5rem;
        font-size: 0.7rem;
        left: 0.8rem;
        background-color: white;
        border-radius: 20px;
        color: #ff385c;
    }
    .form_input:focus ~ .form_label,
    .form_input:not(:placeholder-shown).form_input:not(:focus) ~ .form_label {
        top: -0.5rem;
        font-size: 0.7rem;
        left: 0.8rem;
        background-color: white;
        border-radius: 20px;
        color: #ff385c;
    }
}
.t-danger {
    transform: translateY(200%);
}
.form-distance {
    margin-top: 20px;
    margin-bottom: 79px;
}
.m {
    margin-top: 140px;
}
.mt {
    margin-top: 160px;
}
.mb1 {
    margin-top: 142px;
}

.t-600 {
  transform: translateY(600%);
}
</style>
