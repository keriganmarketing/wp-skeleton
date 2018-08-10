<template>
    <div style="margin: 80px auto;">
        <div class="alert alert-danger" role="alert" v-if="hasError && !success">
            {{ form.errorMessage }}
        </div>
        <div class="alert alert-success" role="alert" v-if="success && !hasError">
            Thank you for submitting a Plans & Permitting request. We'll review the details and get back with you as soon as we can.
        </div>
        <form>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            placeholder="Enter first and last name"
                            autocomplete="name"
                            v-model="form.name"
                            :class="{'border border-danger': errorCode === 'name_required'}"
                            autofocus
                        >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            placeholder="Enter your email address"
                            autocomplete="email"
                            :class="{'border border-danger': errorCode === 'email_required'}"
                            v-model="form.email"
                        >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="form-group">
                        <label for="max-width">Max Buildable Width</label>
                        <input
                            type="text"
                            class="form-control"
                            id="max-width"
                            v-model="form.maxWidth"
                        >
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="form-group">
                        <label for="max-depth">Max Buildable Depth</label>
                        <input
                            type="text"
                            class="form-control"
                            id="max-width"
                            v-model="form.maxDepth"
                        >
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="form-group">
                        <label for="bedrooms">Number of bedrooms</label>
                        <input
                            type="number"
                            class="form-control"
                            id="bedrooms"
                            v-model="form.bedrooms"
                        >
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="form-group">
                        <label for="bathrooms">Number of bathrooms</label>
                        <input
                            type="number"
                            class="form-control"
                            id="bathrooms"
                            v-model="form.bathrooms"
                        >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <fieldset class="form-group">
                        <legend>Elevator</legend>
                        <b-form-group>
                            <b-form-radio-group id="elevator" v-model="form.elevator" name="elevator">
                                <b-form-radio value="No" selected>No</b-form-radio>
                                <b-form-radio value="Yes">Yes</b-form-radio>
                            </b-form-radio-group>
                        </b-form-group>
                    </fieldset>
                </div>
                <div class="col-md-6">
                    <fieldset class="form-group">
                        <legend>Flood Zone</legend>
                        <b-form-group>
                            <b-form-radio-group id="floodzone" v-model="form.floodZone" name="floodzone">
                                <b-form-radio value="No" selected>No</b-form-radio>
                                <b-form-radio value="Yes">Yes</b-form-radio>
                            </b-form-radio-group>
                        </b-form-group>
                    </fieldset>
                </div>
            </div>
            <div class="form-group">
                <label for="comments">Additional Information</label>
                <textarea
                    class="form-control"
                    id="comments"
                    rows="3"
                    v-model="form.comments"
                >
                </textarea>
            </div>
            
            <button
                type="submit"
                class="btn btn-primary"
                @click.prevent="formSubmitted"
            >
                Submit
            </button>
        </form>
    </div>
</template>

<script>
    import permitForm from '../models/permit-form';
    import bFormGroup from 'bootstrap-vue/es/components/form-group/form-group';
    import bFormRadio from 'bootstrap-vue/es/components/form-radio/form-radio';
    import bFormRadioGroup from 'bootstrap-vue/es/components/form-radio/form-radio-group';

    export default {
        components: {
            'b-form-group': bFormGroup,
            'b-form-radio': bFormRadio,
            'b-form-radio-group': bFormRadioGroup
        },
        data () {
            return {
                form: new permitForm({
                    name: '',
                    email: '',
                    maxWidth: '',
                    maxDepth: '',
                    bedrooms: '',
                    bathrooms: '',
                    elevator: 'No',
                    floodZone: 'No',
                    comments: '',
                    url: '/wp-json/kerigansolutions/v1/submit-permit-form'
                }),
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

<style>

</style>
