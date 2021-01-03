<template>
    <span>Characters remaining: {{ charsRemaining }}</span>
</template>

<script>
    export default {
        props: {
            maxChars: {
                type: Number
            },
            charCountElementId: {
                type: String
            }
        },
        data() {
            return {
                charsRemaining: this.maxChars
            }
        },
        methods: {
            updateCharCount: function () {
                const currentChars = document.getElementById(this.charCountElementId).value.length;
                this.charsRemaining = this.maxChars - currentChars;
            }
        },
        mounted() {
            this.updateCharCount();
        }
    }
</script>
