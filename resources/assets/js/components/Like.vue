<style>
    .avatar-like {
        border-radius: 50%;
    }
</style>

<template>
    <div>    

        <hr>
        <p class="text-center" v-for="like in post.likes">
            <img v-bind:src="like.user.avatar"  height="20px" width="20px" class="avatar-like">
        </p>
        <hr>

        <button class="btn btn-xs btn-primary" v-if="!authUserLikesPost" @click="like">
            like post    
        </button>    

        <button class="btn btn-xs btn-danger" v-else @click="unlike">
            unLike post
        </button>
    </div>
</template>

<script>
export default {
    props: ['id'],
    data () {
        return {
            
        }
    }, 
    methods: {
        like () {
            this.$http.post('/like', {
                post_id: this.id
            }).then( (response) => {
                this.$store.commit('UPDATEPOSTLIKES', {
                    id: this.id,
                    like: response.body
                });

                new Noty({
                    type: 'success',
                    layout: 'topRight',
                    text: 'You have liked a post'
                }).show();
            });
        },
        unlike () {
            this.$http.post('/unlike', {
                post_id: this.id
            }).then( (response) => {                
                this.$store.commit('REMOVEPOST', {
                    post_id: this.id,
                    like_id: response.body
                }); 

                new Noty({
                    type: 'success',
                    layout: 'topRight',
                    text: 'You have unliked a post'
                }).show();
            });
        }
    },
    mounted () {
        
    }, 
    computed: {
        likers () 
        {
            let likers = [];
            
            this.post.likes.forEach( (like) => {
                likers.push(like.user.id);
            });        

            return likers;
        },
        authUserLikesPost () {
            // var check = this.likes.indexOf(
            //     this.$store.state.auth.id
            // );

            if (this.likers.includes(this.$store.state.auth.id))
                return true;
            else
                return false;
        },
        post() {
            return this.$store.state.posts.find( (post) => {
                return post.id === this.id;
            })
        }
    }
}
</script>
