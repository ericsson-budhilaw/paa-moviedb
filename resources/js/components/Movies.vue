<template>
    <div id="app">
        <div class="container mx-auto p-6">
            <router-link to="/login" class="text-lg lg:text-sm font-bold py-2 px-4 rounded bg-yellow-400 text-yellow-700">Login here</router-link>
            <router-link to="#" class="text-lg lg:text-sm font-bold py-2 px-4 rounded bg-yellow-400 text-yellow-700">Register here</router-link>

            <div class="my-8">
                <input type="search" name="search" id="search" placeholder="Ketik Judul / Ketik :tahun untuk mencari berdasarkan tahun rilis"
                       class="w-full p-4 bg-gray-600 text-white outline-none"
                        v-model="search"
                        v-on:change="searchBtn"/>
                <div class="flex justify-end">
                <button
                    class="bg-gray-300 text-gray-700 font-semibold py-2 px-8 mx-4 rounded-b inline-flex items-center outline-none"
                    v-on:click="resetBtn">Reset</button>
                <button
                    class="bg-gray-300 text-gray-700 font-semibold py-2 px-8 rounded-b inline-flex items-center outline-none"
                    v-on:click="searchBtn">Cari</button>
                </div>
            </div>

            <div>
                <div class="dropdown inline-block relative">
                    <button class="bg-gray-300 text-gray-700 font-semibold py-2 px-8 rounded inline-flex items-center">
                        <span class="mr-1">Sort By</span>
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/> </svg>
                    </button>
                    <ul class="dropdown-menu absolute hidden text-gray-700 pt-1">
                        <li class="">
                            <button
                                class="rounded bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                                v-on:click="sortByYear">
                                Release Date
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div v-if="error" class="mt-20 my-8 p-4 bg-red-300 text-2xl container mx-auto">{{ error }}</div>

        <div v-if="!loading && data.title" class="h-screen">
            <div class="flex flex-wrap flex--movie">
                <div class="w-full md:w-full lg:w-1/2 max-w-4xl rounded overflow-hidden shadow-lg m-4 flex justify-between">
                    <div class="md:flex-shrink-0">
                        <img class="md:w-56"
                             v-bind:src="data.poster"
                             v-bind:alt="data.title"/>
                    </div>
                    <div class="flex flex-col flex-grow px-8 py-4 bg-color-333">
                        <h3 class="font-bold text-4xl md:text-2xl lg:text-2xl text-gray-200 movie--title">{{ data.title }}</h3>
                        <span class="movie--year text-xl lg:text-sm lg:mb-4">{{ data.year }}</span>
                        <div class="flex-grow">
                            <p class="text-xl md:text-base lg:text-base text-gray-100 leading-snug break-all">
                                {{ data.description }}
                            </p>
                        </div>
                        <div class="button-container flex justify-between mb-2">
                            <button class="text-lg mr-4 lg:text-sm text-gray-200">More Info</button>
                            <button class="text-lg lg:text-sm font-bold py-2 px-4 rounded bg-yellow-400 text-yellow-700">Add to Review</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="!loading && data && data.length">
            <div v-for="movie of data" class="flex flex-wrap flex--movie">
                <div class="w-full md:w-full lg:w-1/2 max-w-4xl rounded overflow-hidden shadow-lg m-4 flex justify-between">
                    <div class="md:flex-shrink-0">
                        <img class="md:w-56"
                             v-bind:src="movie.poster"
                             v-bind:alt="movie.title"/>
                    </div>
                    <div class="flex flex-col flex-grow px-8 py-4 bg-color-333">
                        <h3 class="font-bold text-4xl md:text-2xl lg:text-2xl text-gray-200 movie--title">{{ movie.title }}</h3>
                        <span class="movie--year text-xl lg:text-sm lg:mb-4">{{ movie.year }}</span>
                        <div class="flex-grow">
                            <p class="text-xl md:text-base lg:text-base text-gray-100 leading-snug break-all">
                                {{ movie.description }}
                            </p>
                        </div>
                        <div class="button-container flex justify-between mb-2">
                            <button class="text-lg mr-4 lg:text-sm text-gray-200">More Info</button>
                            <button class="text-lg lg:text-sm font-bold py-2 px-4 rounded bg-yellow-400 text-yellow-700">Add to Review</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="loading" class="mt-20 p-4 bg-gray-300 text-2xl container mx-auto">Loading data..</div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: 'App',
        data() {
            return {
                data: null,
                loading: true,
                error: null,
                search: null
            }
        },
        mounted() {
            axios.get('https://paa-moviedb.test/api/v1/movies', {
                method: 'get',
                headers: {
                    'content-type': 'application/json'
                }
            }).then(json => {
                this.data = json.data;
            }).then(() => {
                this.loading = false;
            })
        },
        methods: {
            sortByYear: function() {
                this.loading = true;

                axios.get('https://paa-moviedb.test/api/v1/movies/sort/year', {
                    method: 'get',
                    headers: {
                        'content-type': 'application/json'
                    }
                }).then(json => {
                    this.data = json.data;
                }).then(() => {
                    this.loading = false;
                })
            },
            searchBtn: function() {
                if(this.search === '' || this.search === null) {
                    alert("Silahkan isi kolom searchnya dahulu.");
                    return
                }

                if(this.search.includes(":tahun")) {
                    let res = this.search.replace(":tahun ", "");
                    this.loading = true;

                    axios.get('https://paa-moviedb.test/api/v1/movies/search/year/' + res, {
                        method: 'get',
                        headers: {
                            'content-type': 'application/json'
                        }
                    }).then(res => {
                        this.data = res.data;
                        this.search = null;
                    }).catch(err => {
                        this.error = err.response.data;
                        setTimeout(() => this.error = null, 1100);
                        this.resetBtn();
                    }).then(() => {
                        this.loading = false;
                    })
                    return;
                } else {
                    axios.get('https://paa-moviedb.test/api/v1/movies/search/' + this.search.toLowerCase(), {
                        method: 'get',
                        headers: {
                            'content-type': 'application/json'
                        }
                    }).then(json => {
                        this.data = json.data;
                        this.search = null;
                    }).catch(err => {
                        this.error = err.response.data;
                        setTimeout(() => this.error = null, 1100);
                        this.resetBtn();
                    }).then(() => {
                        this.loading = false;
                    })
                }
            },
            resetBtn: function() {
                this.search = null;
                axios.get('https://paa-moviedb.test/api/v1/movies', {
                    method: 'get',
                    headers: {
                        'content-type': 'application/json'
                    }
                }).then(json => {
                    this.data = json.data;
                }).catch(err => {
                    this.error = err.response.data;
                    setTimeout(() => this.error = null, 1100);
                }).then(() => {
                    this.loading = false;
                })
            }
        }
    }
</script>

<style scoped>
#movies {
    background: #111;
    width: 100%;
    font-size: 16px;
}

#app {
    background: #111;
    width: 100%;
    font-size: 16px;
    height: 100%;
}

.flex--movie {
    max-width: 80%;
    margin: 0 auto;
}

.bg-color-333 {
    background-color: #333;
}

.movie--year {
    font-variant-numeric: ordinal;
    font-weight: 700;
    color: #fff;
    letter-spacing: 0.07em;
    font-family: monospace;
}

.truncate-overflow {
    --max-lines: 3;
    position: relative;
    max-height: calc(1.375rem * 5);
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 5;
    -webkit-box-orient: vertical;
}
</style>
