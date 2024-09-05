<template>
    <div class="mx-auto max-w-4xl py-6">
        <div class="flex justify-center items-center ">
            <div class="flex items-center space-x-4 p-4 bg-white rounded-lg shadow-md dark:bg-gray-800 mb-6">
                <input type="text" v-model="Username" name="Username" placeholder="Введите имя" class="p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <select v-model="CategoryId" name="CategoryId" class="p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value="">Выберите категорию</option>
                    <option v-for="category in categories" :value="category.id">{{ category.Title }}</option>
                </select>
                <input type="text" v-model="Content" name="Content" placeholder="Введите сообщение" class="p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <button @click.prevent="store" type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Отправить
                </button>
            </div>
        </div>
        <h3 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
            Tweets
        </h3>
        <div class="mx-auto max-w-4xl bg-white border border-gray-200 rounded-lg shadow dark:border-gray-700 overflow-y-auto" style="height: 80vh;">
            <div class="p-4">
                <div v-for="tweet in tweets" class="p-6 mb-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mx-auto">
                    <div v-for="category in categories">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white" v-if="category.id === tweet.CategoryId">
                            {{ category.Title }}
                        </h5>
                    </div>
                    <a href="#">
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 break-words">id {{ tweet.id }}</p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 break-words">Username {{ tweet.Username }}</p>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 break-words">{{ tweet.Content }}</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 break-words">{{ tweet.created_at }}</p>
                </div>
            </div>
        </div>

    </div>
</template>
<script>

import data from "bootstrap/js/src/dom/data.js";

export default {
    name: 'Index',
    props: [
        'tweets',
        'categories',

    ],

    data() {
        return {
            Username: '',
            CategoryId: '',
            Content: '',

        }
    },

    created() {

        window.Echo.channel('storeTweet').listen('.store_tweetss', res => {
            this.tweets.unshift(res.msg)
        });

    },


    methods: {

        store() {

            axios.post('/messagesSend', {Content: this.Content, CategoryId: this.CategoryId, Username: this.Username,})
                .then(res => {
                    this.tweets.unshift(res.data)
                    this.Content = ''
                    this.CategoryId = ''
                    this.Username = ''
                })


        },

    }

}


</script>

<style scoped>

</style>
