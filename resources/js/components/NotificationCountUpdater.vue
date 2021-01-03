<script>
    export default {
        props: {
            authUserId: {
                type: Number
            },
            notificationCountElementsName: {
                type: String
            },
            numUnreadNotifications: {
                type: Number
            }
        },
        methods: {
            updateNumUnreadNotifications: function (numUnreadNotifications) {
                document.getElementsByName(this.notificationCountElementsName).forEach(elem => {
                    elem.innerHTML = numUnreadNotifications;
                });
            }
        },
        mounted() {
            this.updateNumUnreadNotifications(this.numUnreadNotifications);
            Echo.private(`App.Models.User.${this.authUserId}`)
                .notification(() => {
                    this.updateNumUnreadNotifications(++this.numUnreadNotifications);
                });
        }
    }
</script>
