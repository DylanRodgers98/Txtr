<template>
    <a v-if="isLiked" href="javascript:;" v-on:click="likeOrDislikePost">
        <b>Unlike {{ numberOfLikes }}</b>
    </a>
    <a v-else href="javascript:;" v-on:click="likeOrDislikePost">
        Like {{ numberOfLikes }}
    </a>
</template>

<script>
    export default {
        props: {
            numberOfLikes: {
                type: Number,
                default: 0
            },
            postId: {
                type: Number
            },
            authUserId: {
                type: Number
            }
        },
        data() {
            return {
                isLiked: false
            };
        },
        beforeMount() {
            axios.get(`/api/posts/${this.postId}/isLikedBy/${this.authUserId}`)
                .then(res => {
                    this.isLiked = res.data.isLiked;
                })
                .catch(err => {
                    console.error(err);
                });
        },
        methods: {
            likeOrDislikePost: function () {
                const likeOrDislike = this.isLiked ? 'dislike' : 'like';
                axios.post(`/api/posts/${this.postId}/${likeOrDislike}/${this.authUserId}`)
                    .then(res => {
                        this.numberOfLikes = res.data.numberOfLikes;
                        this.isLiked = !this.isLiked;
                    })
                    .catch(err => {
                        console.error(err);
                    });
            }
        }
    }
</script>
