import axios from 'axios';

export default class PermitForm {

    constructor (data) {
        for (let field in data) {
            this[field]       = data[field];
            this.hasError     = false;
            this.errorMessage = "";
            this.errorCode    = "";
            this.success      = false;
        }
    }
    submit () {
        axios.post(this.url, {
            name:      this.name,
            email:     this.email,
            maxWidth:  this.maxWidth,
            maxDepth:  this.maxDepth,
            bedrooms:  this.bedrooms,
            bathrooms: this.bathrooms,
            elevator:  this.elevator,
            floodZone: this.floodZone,
            comments:  this.comments,
        }).then(() => {
            this.success = true;
            this.clearForm();
        }).catch(err => {
            this.hasError     = true;
            this.errorMessage = err.response.data.message;
            this.errorCode    = err.response.data.code;
        });
    }
    clearForm() {
        this.name      = "";
        this.email     = "";
        this.maxWidth  = "";
        this.maxDepth  = "";
        this.bedrooms  = "";
        this.bathrooms = "";
        this.elevator  = "No";
        this.floodZone = "No";
        this.comments  = "";
    }
}