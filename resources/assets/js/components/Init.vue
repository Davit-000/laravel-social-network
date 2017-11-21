<template>
    <div>

    </div>
</template>

<script>
export default {
    methods: {
        getAuthUser() {
            this.$http.get('/get/auth/user')
                .then( (response) => {
                    this.$store.commit('STOREAUTHUSER', response.body);
                });
        }
    },
    mounted () {
        this.getAuthUser()
    }
}
</script>
