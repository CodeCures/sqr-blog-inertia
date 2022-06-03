<template>
<!-- Section 1 -->
<HomeNav />

<!-- Section 2 -->
<section class="relative w-full bg-white">
    <div class="absolute w-full h-32 bg-gradient-to-b from-gray-100 to-white"></div>
    <div class="relative w-full px-5 py-10 mx-auto sm:py-12 md:py-16 md:px-10 max-w-7xl">

        <h1 class="mb-1 text-4xl font-extrabold leading-none text-gray-900 lg:text-5xl xl:text-6xl sm:mb-3"><a href="#_">The Project Blog</a></h1>
        <p class="text-lg font-medium text-gray-500 sm:text-2xl">Designs and layouts to help you with your app.</p>
        <div class="flex grid h-full grid-cols-12 gap-10 pb-10 mt-8 sm:mt-16">
            <div class="grid grid-cols-12 col-span-12 gap-7">
                <PostItem v-for="post in posts" :key="post.id" />
            </div>
        </div>
    </div>
</section>

<!-- Section 3 -->
<Footer />
</template>

<script>
    import HomeNav from "./Components/HomeNav.vue";
    import Footer from "./Components/Footer.vue";
    import PostItem from "./Components/PostItem.vue";

    export default {
        components: { Footer, HomeNav, PostItem },
        props: {
            posts: Object
        },
        data(){
            return {
                showMenu: false
            }
        }
    }
</script>