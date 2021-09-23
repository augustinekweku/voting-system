export default{
    data(){
        return{

        }
    },
    methods:{
        async callApi(method, url, dataObj) {
            // Send a POST request
            try {
                return await axios({
                    method: method,
                    url: url,
                    data: dataObj
                });               
            } catch (e) {
                return e.response
            }

        },
        warning(desc){
            this.$bvToast.toast(desc, {
                title: 'Alert',
                variant: 'danger',
                toaster: 'b-toaster-top-center',
                solid: true
            })
        },
        success(desc){
            this.$bvToast.toast(desc, {
                title: 'Alert',
                variant: 'success',
                toaster: 'b-toaster-top-center',
                solid: true
            })
        },
        info(desc){
            this.$bvToast.toast(desc, {
                title: 'Alert',
                variant: 'info',
                toaster: 'b-toaster-top-center',
                solid: true
            })
        },
        error(desc){
            this.$bvToast.toast(desc, {
                title: 'Error',
                variant: 'danger',
                toaster: 'b-toaster-top-center',
                solid: true
            })
        },
        swr(desc = 'Something went wrong'){
            this.$bvToast.toast(desc, {
                title: 'Error',
                variant: 'danger',
                toaster: 'b-toaster-top-center',
                solid: true
            })
        }
    }
}