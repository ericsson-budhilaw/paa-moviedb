<template>
    <div id="app">
        <main>
            <router-view />
        </main>
    </div>
</template>

<script>
    import Movies from "../components/Movies";

    export default {
        name: 'App',
        components: {
            Movies
        }
    };
</script>
