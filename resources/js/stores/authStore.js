import { router } from '@inertiajs/vue3'
import axios from 'axios'
import { defineStore } from 'pinia'
import { onMounted, reactive } from 'vue'

// You can name the return value of `defineStore()` anything you want,
// but it's best to use the name of the store and surround it with `use`
// and `Store` (e.g. `useUserStore`, `useCartStore`, `useProductStore`)
// the first argument is a unique id of the store across your application
export const useAuthStore = defineStore('auth', () => {



    const logout = () => {
        console.log('waSA')
        router.post('/logout')
        window.location.reload()
    }


    return { logout }
})