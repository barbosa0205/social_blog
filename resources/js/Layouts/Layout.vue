<template  lang="">
   <div class="max-w-screen-2xl mx-auto bg-slate-100">

   <nav class="bg-zinc-50 shadow-sm px-4 py-6 flex items-center justify-between">

      <Link href="/"><h1 class="font-bold text-2xl from-rose-600 to-purple-600 bg-gradient-to-tr bg-clip-text text-transparent">Social Blog</h1>
</Link>
      <ul v-if="!user">
<NavLink href="/login">Sign In</NavLink>
      </ul>
      <ul v-else>
         <button @click="logout">
            <i class="ri-logout-box-r-line"></i>
         </button>
      </ul>
 </nav>

 <slot/>
 <footer>
    <h1>FOOTER</h1>
 </footer>
</div>

</template>
<script setup>

import { onMounted } from 'vue';
import { storeToRefs } from 'pinia';
//Stores
import { useAuthStore } from '@/stores/authStore'
import { useUserStore } from '@/stores/userStore'
import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/vue3';


const authStore = useAuthStore()
const userStore = useUserStore()

const { logout } = authStore
const { getUser } = userStore

const { user } = storeToRefs(userStore)

onMounted(() => {
   getUser()
})


</script>