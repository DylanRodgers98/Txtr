<template>
    <button v-on:click="followOrUnfollow" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-full">
        <p v-if="isFollowing">Unfollow</p>
        <p v-else>Follow</p>
    </button>
</template>

<script>
    export default {
        props: {
            profileUserId: {
                type: Number
            },
            authUserId: {
                type: Number
            },
            followerCountElementId: {
                type: String
            }
        },
        data() {
            return {
                isFollowing: false
            };
        },
        beforeMount() {
            axios.get(`/api/users/${this.authUserId}/isFollowing/${this.profileUserId}`)
                .then(res => this.isFollowing = res.data.isFollowing)
                .catch(err => console.error(err));
        },
        methods: {
            followOrUnfollow: function () {
                const followOrUnfollow = this.isFollowing ? 'unfollow' : 'follow';
                axios.post(`/api/users/${this.authUserId}/${followOrUnfollow}/${this.profileUserId}`)
                    .then(res => {
                        this.isFollowing = res.data.isFollowing
                        if (this.followerCountElementId) {
                            document.getElementById(this.followerCountElementId).innerHTML = res.data.numberOfFollowers;
                        }
                    })
                    .catch(err => console.error(err));
            }
        }
    }
</script>
