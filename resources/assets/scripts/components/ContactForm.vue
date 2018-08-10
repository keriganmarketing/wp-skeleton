<template>
    <div>
        <form>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <input
                            type="text"
                            class="form-control bg-dark border-0 text-white"
                            placeholder="Name"
                            v-model="form.name"
                            required
                        >
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input
                            type="email"
                            class="form-control bg-dark border-0 text-white"
                            placeholder="Email"
                            v-model="form.email"
                            required
                        >
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <textarea
                            class="form-control bg-dark border-0 text-white"
                            placeholder="Message"
                            v-model="form.comments"
                        >
                        </textarea>
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-outline-primary" @click.prevent="formSubmitted">Send Message &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></button>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
import ContactForm from '../models/contact-form';
    export default {
        data () {
            return {
                form: new ContactForm({
                    name: '',
                    email: '',
                    comments: '',
                    url: '/wp-json/kerigansolutions/v1/submit-contact-form'
                })
            }
        },
        computed: {
            hasError: function() {
                return this.form.hasError;
            },
            errorCode: function () {
                return this.form.errorCode;
            },
            success: function () {
                return this.form.success;
            }
        },
        methods: {
            formSubmitted () {
                this.form.submit();
            }
        }
    }
</script>
