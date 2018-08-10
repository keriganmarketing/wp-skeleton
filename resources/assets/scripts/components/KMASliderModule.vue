<template>
    <div>
        <div class="slider">
            <div class="slider-left icon" @click="clickPrev" >
                <i class="fa fa-angle-left fa-3" aria-hidden="true"></i>
            </div>

            <div class="slides" @mouseover="pauseSlide" @mouseleave="unpauseSlide">
                <div
                    v-for="(slide, index) in sliderData" :key="index" 
                    class="slide" 
                    :class="{
                        'active': index == activeSlide
                    }"
                    :style="{ 'background-image': 'url(' + slide.photo.url + ')' }">
                    <a class="slidelink" v-if="(slide.href != '')" :href="slide.href" :target="slide.target" ></a>
                </div>
            </div>

            <div class="slider-right icon" @click="clickNext" >
                <i class="fa fa-angle-right fa-3" aria-hidden="true"></i>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            category: {
                type: String,
                default: ''
            },
            limit: {
                type: Number,
                default: -1
            }
        },

        data() {
            return {
                sliderData: [],
                activeSlide: 0,
                paused: false
            }
        },

        created () {
            let category = (this.category != '' ? 'category=' + this.category : '');
            let limit = (this.limit != '' ? 'limit=' + this.limit : '');
            let request = '';

            if(category != '' || limit != -1){
                request = '?' + (category != '' ? category : '');
                if(category != '' && limit != -1){
                    request += '&' + limit;
                }else{
                    request += (limit != '' ? limit : '');
                }
            }

            axios.get("/wp-json/kerigansolutions/v1/slider" + request)
                .then(response => {
                    this.sliderData = response.data; 
                });
        },

        mounted () {
            
            setInterval(() => { if(this.paused === false){ this.nextSlide() } }, 6000);
        },

        methods: {
            nextSlide(){
                if(this.activeSlide === this.sliderData.length-1){
                    this.activeSlide = -1
                }
                this.activeSlide++
            },

            prevSlide(){
                this.activeSlide--
                if(this.activeSlide === -1){
                    this.activeSlide = this.sliderData.length-1
                }
            },

            clickNext(){
                this.nextSlide()
                this.pauseSlide()
            },

            clickPrev(){
                this.prevSlide()
                this.pauseSlide()
            },

            pauseSlide(){
                this.paused = true;
            },

            unpauseSlide(){
                this.paused = false;
            }

        }
    }
</script>
<style>
    .slider {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: #222;
    }
    .slide,
    .slider,
    .slides {
        height:100%;
        -webkit-transition: opacity linear 1.5s;
        transition:opacity linear 1.5s;
        background-size: cover;
    }

    .slides {
        flex-grow: 1;
    }

    .slider-right,
    .slider-left {
        position: absolute;
        z-index: 30;
        color: #FFF;
        text-shadow: 0 0 5px rgba(0,0,0,.5);
        padding: .5rem;
        font-size: 2rem;
        cursor: pointer;
    }

    .slider-right {
        right:0;
    }
    .slide {
        width:100%;
        -webkit-transition: all linear 1.5s;
        transition: all linear 1.5s;
        position: absolute;
        z-index: -1;
        opacity: 0;
        background-position: center;
        background-size: cover;
        left:0; right: 0; top: 0; bottom: 0;
        height: auto;

    }
    .slide.active {
        opacity: 1;
        z-index: 20;
    }
    .slide-container {
        align-items: center;
    }

    .slidelink {
        position: absolute;
        left:0; right: 0; top: 0; bottom: 0;
    }

</style>