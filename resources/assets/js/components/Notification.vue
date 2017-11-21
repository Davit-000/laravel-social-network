<style lang="css">

</style>

<template>
    <div>

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
        listen () {
            Echo.private('App.User.' + this.id)
                .notification( (notification) => {
                    new Noty({
                        'layout': 'topRight',
                        'type': 'success',
                        'text': notification.message
                    }).show();

                    this.$store.commit('ADDNOTE', notification);
                    
                    document.getElementById('noty-audio').play();
                });
        }
    },
    mounted () {
        this.listen()
    }
}
</script>
