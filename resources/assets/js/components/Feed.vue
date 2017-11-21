<style lang="css">
    .avatar-feed {
        border-radius: 50%;
    }
</style>

<template>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default" v-for="post in posts">
                    <div class="panel-heading">
                        <p class="panel-title">
                            <img v-bind:src="post.user.avatar" v-bind:alt="post.user.name" width="40xp" height="40px" class="avatar-feed">
                            {{ post.user.name }}
                            <span class="pull-right">
                                {{ post.created_at }}
                            </span>
                        </p>
                    </div>
                    <div class="panel-body">
                        <p class="text-center">
                            {{ post.content }}
                        </p>

                        <like :id="post.id"></like>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {

        }
    },
    methods: {
        getFeed () {
            this.$http.get('/feed')
                .then( (response) => {
                    response.body.forEach( (post) => {
                        this.$store.commit('ADDPOST', post);
                    });      
                });
        }    
    },
    mounted () {
        this.getFeed();
    },
    computed: {
        posts () {
            return this.$store.getters.allPosts;
        }
    }
}
</script>
