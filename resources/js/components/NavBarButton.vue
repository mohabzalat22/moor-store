<template>
    <button class="navbar-toggler border-0" type="button" :class="{'transitionEffect' : NavButtonToggled}" @click="CallNavButtonToggleMethod">
        <span class="button-line"></span>
        <span class="button-line"></span>
    </button>
</template>
<script>
export default{
    props:['NavButtonToggled'],
    emits:['UpdateNavButtonToggleMethod'],
    data(){
        return {
        }
    },
    methods:{
        CallNavButtonToggleMethod(){
            this.$emit('UpdateNavButtonToggleMethod');
        }
    },
}
</script>
<style>
    .navbar-toggler{
        height: 30px;
        width: 30px;
        padding: 0;
    }
    .button-line{
        display: block;
        height: 2px;
        background-color: black;
        transition-duration: .5s;
        transition-timing-function: ease;
    }  
    /* .button-line:nth-child(1){
    } */
    .button-line:nth-child(2){
        margin-top: 10px;
        background-color:black;
    }
    .transitionEffect .button-line:nth-child(1){
        transform: rotate(45deg);
    }
    .transitionEffect .button-line:nth-child(2){
        margin-top: -1px;
        transform: rotate(-45deg);
    }
</style>