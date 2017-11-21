<style lang="css">

</style>

<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <input v-model="query" type="text" class="form-control input-lg" placeholder="Search for other users..." @keyup.enter="search">
                <br>
                <div class="row" v-if="results.length">
                    <div class="text-center" v-for="user in results">
                        <img v-bind:src="user.avatar" v-bind:alt="user.name" height="50" width="50">
                        <h4 class="text-center">{{ user.name }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return  {
            query: '',
            results: []
        }
    },
    methods: {
        search() {
            AlgoliaIndex.search(this.query, (error, content) => {
                if (!error) 
                {
                    this.results = content.hits;
                }
            });
        }
    },
    mounted () {
        
    }
}
</script>
