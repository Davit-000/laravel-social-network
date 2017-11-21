<style lang="css">

</style>

<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">        
                <div class="panel-body">
                    <textarea v-model="content" class="form-control"  rows="5"></textarea>
                    <br>
                    <button class="btn btn-success pull-right" :disabled="notWork" @click="createPost">
                        Create post
                    </button>
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
            content: '',
            notWork: true
        }
    },
    methods: {
        createPost () {
            this.$http.post('/create/post', {
                content: this.content
            })
            .then( (response) => {
                this.content = '';
                new Noty({
                    type: 'success',
                    type: 'success',
                    text: 'Your post has been published'
                }).show();        
            });
        }
    },
    mounted () {

    },
    watch: {
        content() {
            if (this.content.length > 0)
                this.notWork = false;
            else
                this.notWork = true;
        }
    }
}
</script>


