export default {
    data(){
        return {

        }
    },
    methods: {
        info (desc, title="Hey!") {
            this.$Notice.info({
                title: title,
                desc: desc
            });
        },
        success (desc, title ="Great!") {
            this.$Notice.success({
                title: title,
                desc: desc
            });
        },
        warning (desc, title ="Oops!") {
            this.$Notice.warning({
                title: title,
                desc: desc
            });
        },
        error (desc, title="Error!") {
            this.$Notice.error({
                title: title,
                desc: desc
            });
        },
        swr (desc ="Something went wrong!", title ="Oops!") {
            this.$Notice.error({
                title: title,
                desc: desc
            });
        },

    },
}
