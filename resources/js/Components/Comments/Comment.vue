<!-- Comment Component -->
<template lang="">
   <article class="flex p-2">
        <img class="w-10 h-10 rounded-full mr-2" :src="comment.user.profile_photo_url" alt="">
    <section class="w-fit py-2 px-4 pr-8 bg-zinc-100 rounded-2xl">
        <Link href="/user/profile"> <p class="inline-block font-bold s:text-lg">{{comment.user.name}}</p> </Link>
        
    
            <p class="break-all">{{comment.comment}}</p>

    </section>
    
   </article>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';


    defineProps({
        comment: Object
    })
</script>
