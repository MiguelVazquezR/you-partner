<template>
    <div v-if="rate==0">
        <i v-for="(star, index) in stars" :key="star" @click="rate=pos;" @mouseover="pos=star" @mouseout="pos=0" class="fa-regular fa-star text-xl text-gray-500"
        :class="index < pos ? 'text-yellow-500' : ''"></i>

    </div>
    <div v-if="rate!=0">
        <i v-for="(star, index) in stars" :key="star" @mouseover="pos=star" @click="rate=pos;" class="fa-regular fa-star text-2xl"
        :class="index < rate ? 'text-yellow-500' : ''"></i>
    </div>

</template>

<script>
export default {
    data() {
        return {
            stars: 5,
            pos: 0,
            rate: 0,
        }
    },
    components:{

    },
    props:{

    },
    methods:{
    }
}
</script>