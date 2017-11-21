import Vuex from 'vuex';

import Vue from 'vue';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        nots: [],
        posts: [],
        auth: {}
    },
    getters: {
        allNotifications (state) {
            return state.nots;
        },
        allNotificationsCount (state) {
            return state.nots.length;
        },
        allPosts (state) {
            return state.posts;
        }
    },
    mutations: {
        ADDNOTE (state, not) {
            state.nots.push(not)
        },
        ADDPOST(state, post) {
            state.posts.push(post);
        },
        STOREAUTHUSER(state, user)
        {
            state.auth = user;
        },
        UPDATEPOSTLIKES(state, payload) {
            var post = state.posts.find( (post) => {
                return post.id === payload.id
            });

            post.likes.push(payload.like);
        },
        REMOVEPOST(state, payload) {
            let post = state.posts.find( (p) => {
                return p.id === payload.post_id;
            });

            let like = post.likes.find( (l) => {
                return l.id === payload.like_id;
            });

            let index = post.likes.indexOf(like);

            post.likes.splice(index, 1);
        }
    },
    actions: {

    }
});