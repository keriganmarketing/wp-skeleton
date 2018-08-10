<template>
    <ul>
        <li v-for="(navitem, index) in mobileNav" v-bind:key="index" class="nav-item" :class="{'dropdown': navitem.children.length > 0 }">
            <a :href="navitem.url" :class="'nav-link ' + filterClasses(navitem.classes)">{{ navitem.title }}</a>
            <span class="nav-icon" v-if="navitem.children.length > 0" @click="toggleSubMenu(index)">
                <i class="fa" :class="{
                    'fa-plus-circle': !navitem.subMenuOpen,
                    'fa-minus-circle': navitem.subMenuOpen
                    }" ></i>
            </span>
            <div class="dropdown-menu" v-if="navitem.subMenuOpen" >
                <li v-for="(child, i) in navitem.children" v-bind:key="i">
                    <a :href="child.url" :class="'nav-link ' + filterClasses(navitem.classes)">{{ child.title }}</a>
                </li>
            </div>
        </li>
    </ul>
</template>

<script>
    export default {

        props: {
            mobileNav: {}
        },

        methods: {
            filterClasses(classes) {
                if(classes != ''){
                    let classArray = classes.split(" ");
                    let output = [];
                    classArray.forEach( className => {
                        if(!className.match("i") && !className.match("(fa)") ){
                            output.push(className);
                        }
                    });
                    return output.join(" ");
                }else{
                    return '';
                }
            },

            toggleSubMenu(navitem){
                this.mobileNav[navitem].subMenuOpen = !this.mobileNav[navitem].subMenuOpen;
            }
        }

    }
</script>
<style>
    .mobile-menu {
        display: block;
        width: 100%;
        padding: 2rem 0;
        margin-top: -100%;
        transition: all ease-in 1s;
    }
    .mobile-menu .nav-icon {
        font-size:1.2em;
        padding: .25rem .5rem;
        position: absolute;
        right: 0;
        margin-top:-2.5rem;
        cursor: pointer;
    }
    .mobile-menu .dropdown-menu {
        border-radius: 0;
        border: 0;
        display: block;
        background-color: #FFF;
        padding: .5rem 1rem;
        box-shadow: inset 0 0 5px #555;
    }
</style>