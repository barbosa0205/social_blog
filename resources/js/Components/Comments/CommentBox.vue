<template lang="">
    <section class="border border-t-0">
        <!-- <div class="p-2 flex items-center border-b">
            <NavLink href="/user/profile"><img class="w-10 h-10 object-cover rounded-full" :src="user.profile_photo_url"></NavLink>
            <Link href="/user/profile" >
                <p class="ml-4">{{user.name}}</p>
            </Link>
            
        </div> -->
        <div class="w-full flex items-center  bg-zinc-50 rounded-sm ">
            <input v-model="commentText" @keyup.enter="comment" class="form-input w-full outline-none  border-none bg-transparent p-4" autocomplete="off" type="text" name="comment" placeholder="Say Something Great">
            <i @click="comment" class="ri-send-plane-2-fill px-2 cursor-pointer"></i>
        </div>
    </section>
</template>
<script setup>
import { useUserStore } from '@/stores/userStore';
import { usePostStore } from '@/stores/postStore';
import { storeToRefs } from 'pinia';
import { ref } from 'vue';
import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';


const commentText = ref('')

const props = defineProps({
    post: Object
})

// defineEmits(['commentPost'])

const userStore = useUserStore()

const { user } = storeToRefs(userStore)

const postStore = usePostStore()

const {recentPosts} = postStore


//guarda en la db los comentarios y lo agrega al array de comentarios en el post correspondiente
const comment = async () => {

    const resp = await axios.post(`/posts/comment/${props.post.id}`, {
        'user_id': user.value.id,
        'post_id': props.post.id,
        'comment': commentText.value
    })

    if (resp.data.success) {
        const post = recentPosts.data.find(post => post.id === props.post.id)
        post.comments = JSON.parse(JSON.stringify([...post.comments, resp.data.data]))
        commentText.value = ''

       
    }
}
</script>
