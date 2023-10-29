<template lang="">
<article class="flex flex-col justify-between w-full max-w-xl min-w-[250px] mx-auto my-6 bg-white rounded-xl shadow-md shadow-zinc-200">
           <div>
            <header class="px-2">
                <div class="px-2 py-4">
                    <img class="w-16 h-16 rounded-full object-cover" :src="recentPost.user.profile_photo_url" :alt="`${recentPost.user.name} Profile Picture`" :title="`${recentPost.user.name} Profile Picture`">
                </div>
            </header>

            <section class="px-4 pt-4 pb-8">
                {{recentPost.content}}
            </section>

           </div>
            <footer class="flex justify-between border bg-zinc-50">
                <Button  styles="border-r border-zinc-300" @click="toggleLikePost({
                    postId: recentPost?.id,
                    userId: user?.id
                })"><i :class="`${likeStyles} text-xl s:text-3xl`"></i></Button>    
                <Button @click="toggleCommentBox"><i class="ri-chat-1-line text-xl s:text-3xl"></i></Button>
                <Button styles="border-l border-zinc-300"><i class="ri-share-forward-line text-xl s:text-3xl"></i></Button>
            </footer>

            <!-- Comment Seciton -->
            
            <CommentBox v-if="showCommentBox" :post="recentPost" @comment-post="commentPost"/>

            <ul v-if="recentPost.comments.length">
                <Comment v-for="(comment, index) in recentPost.comments" :key="comment.id" :comment="comment"/>
            </ul>
        </article>

        <!-- End of the Comment Seciton -->
</template>
<script setup>
import {computed, ref} from 'vue'
import { usePostStore } from '@/stores/postStore'
import { storeToRefs } from 'pinia';
import { useUserStore } from '@/stores/userStore';

import Button from './Button.vue';
import CommentBox from '@/Components/Comments/CommentBox.vue';
import Comment from '@/Components/Comments/Comment.vue';
import { router } from '@inertiajs/vue3';


const props = defineProps({
    recentPost: Object
})

const postStore = usePostStore()

const {toggleLikePost, findPostById,createCommentInPost} = postStore

const userStore = useUserStore()

const {user} = storeToRefs(userStore)

const showCommentBox = ref(false)

const toggleCommentBox = () => {
    if(!user.value?.id) {
                return router.visit('/login', {
                    method: 'get'
                })
            }
    showCommentBox.value = !showCommentBox.value
   
}

const commentPost = async (data) => {

   const post = findPostById(data.postId)

 
   const resp = await axios.post(`/posts/comment/${data.postId}`, {
         'user_id': user.value.id,
         'post_id': post.id,
         'comment': data.comment
     })

     if (resp.data.success) {
         createCommentInPost({
            data: resp.data,
            postId: post.id
         })

       
     }

}

const likeStyles = computed(() => {
    return props.recentPost.is_liked?.id ? 'text-indigo-600 ri-thumb-up-fill' : 'text-slate-700 ri-thumb-up-line' 
})
</script>
<style lang="">
    
</style>