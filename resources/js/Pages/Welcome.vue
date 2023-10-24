<template lang="">
   <main>
    <ul v-if="recentPosts" class="px-2 flex flex-col mt-6 rounded-lg w-full">
      <Post v-for="recentPost in recentPosts.data" :key="recentPost.id" :recentPost="recentPost"/>  
    </ul>
   </main>
</template>
<script setup>
import Post from '@/Components/Posts/Post.vue';
import { usePostStore } from '@/stores/postStore';
import { storeToRefs } from 'pinia';
import { defineProps,onMounted } from 'vue';

const postStore = usePostStore()

const {recentPosts} = storeToRefs(postStore)

const  props = defineProps({
    recentPostsProp: Object
 })

 onMounted(() => {
   recentPosts.value = props.recentPostsProp
 })


</script>
