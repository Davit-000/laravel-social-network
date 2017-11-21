<style lang="css">

</style>

<template>
    <li>
        <a href="/notifications">
            Unread notifications
            <span class="badge">{{ allNotsCount }}</span>
        </a>
    </li>
</template>

<script>
export default {
    methods: {
        getUnread () {
            this.$http.get('/get/unread')
                .then( (response) => {
                    response.body.forEach( (not) => {
                        this.$store.commit('ADDNOTE', not);
                    });
                });
        }
    },
    mounted () {
        this.getUnread()
    }, 
    computed: {
        allNotsCount () {
            return this.$store.getters.allNotificationsCount;
        }
    }
}
</script>
