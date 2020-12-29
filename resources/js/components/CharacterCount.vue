<template>
    <span>Characters remaining: {{ postCharsRemaining }}</span>
</template>

<script>
    export default {
        data() {
            return {
                maxPostChars: 140,
                postCharsRemaining: 140
            }
        },
        methods: {
            updateCharCount: function() {
                const postBodyLength = document.getElementById('postBody').value.length;
                this.postCharsRemaining = this.maxPostChars - postBodyLength;
            }
        },
        mounted() {
            this.updateCharCount();
        }
    }
</script>
