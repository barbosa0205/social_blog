<template lang="">
        <button :class="`w-full hover:bg-zinc-200 ${styles}`">
    <slot/>
 </button>
</template>
<script setup>
 defineProps({
    styles: String
 })
</script>
