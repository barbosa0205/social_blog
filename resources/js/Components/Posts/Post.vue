<template lang="">
<article class="flex flex-col justify-between w-full max-w-xl min-w-[250px] s:min-h-[17rem] sm:min-h-[18rem] mx-auto my-6 bg-white border border-zinc-300 rounded-xl">
           <div>
            <header class="px-2">
                <div class="px-2 py-4">
                    <img class="w-16 h-16 rounded-full object-cover" :src="recentPost.user.images[0].url" :alt="`${recentPost.user.name} Profile Picture`" :title="`${recentPost.user.name} Profile Picture`">
                </div>
            </header>

            <section class="p-4">
                {{recentPost.content}}
            </section>

           </div>
            <footer class="flex justify-between bg-zinc-50 border-t border-zinc-300">
                <Button class=" rounded-bl-xl" @click="toggleLikePost({
                    postId: recentPost.id,
                    userId: user.id
                })"><i :class="`${likeStyles} text-xl s:text-3xl`"></i></Button>    
                <Button @click="toggleCommentBox" class="ri-chat-1-line text-xl s:text-3xl"></Button>
                <Button class="ri-share-forward-line text-xl s:text-3xl"></Button>
            </footer>

        </article>
</template>
<script setup>
import {computed} from 'vue'
import { usePostStore } from '@/stores/postStore'
import Button from './Button.vue';
import { storeToRefs } from 'pinia';
import { useUserStore } from '@/stores/userStore';
const props = defineProps({
    recentPost: Object
})
const postStore = usePostStore()

const {toggleLikePost} = postStore

const userStore = useUserStore()

const {user} = storeToRefs(userStore)

const showCommentBox = ref(false)

const toggleCommentBox = () => {
    showCommentBox.value = !showCommentBox.value
}

const likeStyles = computed(() => {
    return props.recentPost.is_liked?.id ? 'text-indigo-600 ri-thumb-up-fill' : 'text-slate-700 ri-thumb-up-line' 
})
</script>
<style lang="">
    
</style>