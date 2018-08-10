<template>
    <div>
        <div class="photo-gallery">
            <div class="row" v-masonry transition-duration="0.3s" item-selector=".item" >
                <div v-masonry-tile class="col-sm-6 col-lg-4 item" v-for="(photo, index) in photos" v-bind:key="photo.id" >
                    <div class="photo-tile has-text-centered" @click="openViewer(index)">
                        <img :id="'photo-' + photo.id" :src="photo.sizes.medium" :alt="photo.title" class="img-fluid" >
                    </div>
                </div>
            </div>
        </div>
        <b-modal ref="gallery" hide-header hide-footer size="lg" centered >
            <div class="text-center image-container"><img v-if="activePhoto.sizes" :src="activePhoto.sizes.large" :alt="activePhoto.title" class="img-fluid" /></div>
            <div class="d-flex justify-content-center action-buttons">
                <a @click="prevPhoto(activePhoto.index)" class="btn btn-outline-white"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                <a @click="closeViewer" class="btn btn-outline-white" style="margin: 0 4px;">close</a>
                <a @click="nextPhoto(activePhoto.index)" class="btn btn-outline-white"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            </div>
        </b-modal>
    </div>
</template>

<script>
import bModal from 'bootstrap-vue/es/components/modal/modal'
import bModalDirective from 'bootstrap-vue/es/directives/modal/modal'

    export default {
        components: {
            'b-modal': bModal
        },
        directives: {
            'b-modal': bModalDirective
        },
        props: {
            dataPhotos: {
                type: Array,
                default: () => []
            }
        },
        data () {
            return {
                photos: [],
                prev: null,
                next: null,
                activePhoto: {},
                numPhotos: 0
            }
        },
        mounted () {
            this.photos = this.dataPhotos;
            this.numPhotos = this.photos.length;
        },
        methods: {
            openViewer(index){
                this.$refs.gallery.show()
                this.activePhoto = this.photos[index];
                this.activePhoto.index = index;
            },
            closeViewer(){
                this.$refs.gallery.hide()
            },
            nextPhoto(index){
                let newNum = (index !== this.numPhotos-1 ? index+1 : 0);
                this.activePhoto = this.photos[newNum];
                this.activePhoto.index = newNum;
            },
            prevPhoto(index){
                let newNum = (index !== 0 ? index-1 : this.numPhotos-1);
                this.activePhoto = this.photos[newNum];
                this.activePhoto.index = newNum;
            }
        }
    }
</script>

<style>
    .photo-gallery {
        padding: 2rem 0;
    }
    .photo-tile {
        margin-bottom: 1rem;
        cursor: pointer;
    }
    
    .modal .modal-content {
        background-color: transparent !important;
        border: none !important;
    }
    .modal .modal-body {
        padding: 0 !important;
    }
    .modal {
        background-color: rgba(0,0,0,.75);
    }
    .image-container {
        height: 80vh;
        margin-bottom: 1rem;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .action-buttons a {
        color: #FFF !important;
    }
    .action-buttons a:hover {
        color: #000 !important;
    }
</style>