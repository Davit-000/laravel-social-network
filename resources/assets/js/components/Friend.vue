<template>
    <div class="row">
        <p class="text-center" v-if="loading">
            Loading...
        </p>
        <p class="text-center" v-if="!loading">
            <button class="btn btn-success" v-if="status == 0" @click="addFriend">
                Add friend
            </button>
            <button class="btn btn-success" v-if="status == 'pending'" @click="acceptFriend">
                Accept friend
            </button>
            <span class="text-success" v-if="status == 'waiting'">Waiting for response</span>
            <span class="text-success" v-if="status == 'friends'">Friends</span>
        </p>        
    </div>
</template>

<script>
    export default {
        props: ['profile_user_id'],
        data () {
            return {
                status: '',
                loading: true, 
            }
        },
        methods: {
            addFriend () {
                this.loading = true;
                this.$http.get('/add/friend/' + this.profile_user_id)
                    .then( (response) => {
                        if (response.body == 1)
                        {
                            this.status = 'waiting';   
                            
                            new Noty({
                                'layout': 'topRight',
                                'text': 'Friend request sent',
                                'type': 'success'
                            }).show();
                        }

                        this.loading = false;
                    });
            },
            acceptFriend () {
                this.loading = true;

                this.$http.get('/accept/friend/' + this.profile_user_id)
                    .then( (response) => {
                        if (response.body == 1)
                        {
                            this.status = 'friends';

                            new Noty({
                                'layout': 'topRight',
                                'text': 'You are now friend\'s',
                                'type': 'success'
                            }).show();
                        }

                        this.loading = false;
                    });
            }
        },
        mounted() {
            this.$http.get('/check/relationship/status/' + this.profile_user_id)
                .then( (response) => {                
                    this.status = response.body.status;  
                    this.loading = false;
                });
        }
    }
</script>
