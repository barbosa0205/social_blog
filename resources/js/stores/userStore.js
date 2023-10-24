import axios from 'axios'
import { defineStore } from 'pinia'
import { onMounted, ref } from 'vue';

// You can name the return value of `defineStore()` anything you want,
// but it's best to use the name of the store and surround it with `use`
// and `Store` (e.g. `useUserStore`, `useCartStore`, `useProductStore`)
// the first argument is a unique id of the store across your application
export const useUserStore = defineStore('user', () => {
  
   const user = ref(null)

   const getUser = async () => {
      const resp = await axios.post('/get_user');
      user.value = resp.data.user
    }

   
    
  

   return {user,getUser}
})