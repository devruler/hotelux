<template>
<div class="container-fluid">

    <h1 class="my-4">Bookings</h1>

    <div class="row">
        <div class="col-12">
            <div class="table-responsive-md">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Nights</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Booked at</th>
                            <th>Status</th>
                            <th colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="booking in bookings.data" :key="booking.id">
                            <th>{{booking.id}}</th>
                            <td>{{booking.user.first_name + ' ' + booking.user.last_name}}</td>
                            <td>{{calculateNights(booking.check_in, booking.check_out)}}</td>
                            <td>{{new Date(booking.check_in).toDateString()}}</td>
                            <td>{{new Date(booking.check_out).toDateString()}}</td>
                            <td>{{new Date(booking.created_at).toDateString()}}</td>
                            <td><span :class="['badge', booking.invoice ? (booking.invoice.status ? 'badge-success' : 'badge-danger') : 'badge-default']" >{{booking.invoice ? (booking.invoice.status ? 'Paid' : 'Unpaid') : 'N/A'}}</span></td>
                            <td><a class="btn btn-default rounded-0 btn-sm" href="#" @click.prevent="showBooking(booking)"><i class="fas fa-eye"></i> View</a></td>
                            <!-- <td><a class="btn btn-default rounded-0 btn-sm" href="#" @click.prevent="confirmBooking()"><i class="fas fa-check"></i> Confirm</a></td> -->
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li :class="['page-item', bookings.prev_page_url ? '' : 'disabled']"><a class="page-link" href="#" @click.prevent="getBookings(bookings.current_page - 1)">Previous</a></li>
                    <li :class="['page-item', bookings.current_page === (index + 1) ? 'active' : '']" v-for="(page, index) of bookings.last_page" :key="index"><a class="page-link" @click.prevent="getBookings(index + 1)" href="#">{{index + 1}}</a></li>
                    <li :class="['page-item', bookings.next_page_url ? '' : 'disabled']"><a class="page-link" href="#" @click.prevent="getBookings(bookings.current_page + 1)">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <show-booking :booking='booking'/>

</div>
</template>

<script>
import ShowBooking from '../components/bookings/ShowBooking'
export default {
    components:{
        ShowBooking
    },
    data() {
        return {
            bookings: {},
            booking: {}
        }
    },
    methods: {
        async getBookings(page = 1) {
            this.$store.state.isLoading = true
            try {
                const result = await axios.get(`/api/admin/bookings?page=${page}`)
                this.bookings = result.data.bookings
            } catch (error) {
                if(error.response.status === 401) this.$store.dispatch('logout')
            }
            this.$store.state.isLoading = false
        },
        calculateNights(from, to) {
            return ((new Date(to).getTime() - new Date(from).getTime()) / (1000 * 3600 * 24)).toFixed()
        },
        showBooking(booking){
            this.booking = booking

            $('#showBooking').modal('show')
        }
    },
    mounted() {
        this.getBookings()
    }
}
</script>

<style>

</style>
