<template>
      <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    Customers
                    <span class="display-4 d-block">{{counts.customers}}</span>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <router-link class="small text-white stretched-link" to="/admin/customers">View Details</router-link>
                    <div class="small text-white">
                        <i class="fas fa-angle-right"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    Rooms
                    <span class="display-4 d-block">{{counts.rooms}}</span>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <router-link class="small text-white stretched-link" to="/admin/rooms">View Details</router-link>
                    <div class="small text-white">
                        <i class="fas fa-angle-right"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-green text-white mb-4">
                <div class="card-body">
                    Revenue (This month)
                    <div class="d-flex">
                    <span class="revenue">{{counts.revenue ? counts.revenue.toFixed(2) : null}} <span>$</span></span>

                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white">
                        <i class="fas fa-angle-right"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-secondary text-white mb-4">
                <div class="card-body">
                    Bookings
                    <span class="display-4 d-block">{{counts.bookings}}</span>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <router-link class="small text-white stretched-link" to="/admin/bookings">View Details</router-link>
                    <div class="small text-white">
                        <i class="fas fa-angle-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        counts: {}
    }),
    methods:{
        async getCountsData(){
            try {
                const counts = await axios.get(`/api/admin/counts`)
                console.log(counts)
                this.counts = counts.data
            } catch (error) {
                if(error.response.status === 401) this.$store.dispatch('logout')
            }
        }
    },
    mounted(){
        this.getCountsData()
    }
}
</script>

<style scoped>
.bg-green {
    background-color: #ABC32F
}
.card{
    height: 180px
}

.revenue{
    font-size: 36px;
    margin: 5px 0 0 0 ;
}
</style>
