import axios from 'axios'
import { defineStore } from 'pinia'
import { ref } from 'vue'

// You can name the return value of `defineStore()` anything you want,
// but it's best to use the name of the store and surround it with `use`
// and `Store` (e.g. `useUserStore`, `useCartStore`, `useProductStore`)
// the first argument is a unique id of the store across your application
export const usePostStore = defineStore('posts', () => {

    const recentPosts = ref(null)

    const toggleLikePost = async ({
        userId, postId
    }) => {

        try {
            const resp = await axios.post(`/posts/like/${postId}`, {
                user_id: userId,
                post_id: postId
            })

            if (resp.data.success) {

                const post = recentPosts.value.data.find(post => post.id === postId)
                console.log(post.is_liked)
   
                    if (!post.is_liked) {
                        post.is_liked = resp.data.data
                    } else {
                        post.is_liked = null
                }
            }

        } catch (error) {
            console.log(error)
        }


    }


    return { toggleLikePost, recentPosts }
})