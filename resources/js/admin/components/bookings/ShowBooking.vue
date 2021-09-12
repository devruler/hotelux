<template>
  <div>
      <div class="modal" id="showBooking" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered  modal-lg" v-if="booking.id">
            <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title">Booking #{{booking.id}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <carousel
                                        :per-page="1"
                                        :paginationColor="'#A0AEC0'"
                                        :paginationActiveColor="'#447695'"
                                        :paginationPadding='4'
                                        :centerMode='true'
                                        >
                                        <slide v-for="(img,index) in booking.room.images" :key="index">
                                            <img :src="'/images/rooms/' + img" style="object-fit:cover;width:100%;height:100%" />
                                        </slide>
                                        </carousel>
                                    </div>
                                    <div class="col-12">
                                        <h5 class="mb-3">Room information:</h5>
                                        <p>Room: {{booking.room.title}}</p>
                                        <p>Description:</p>
                                        <div v-html="booking.room.description"></div>
                                        <p>Price: ${{booking.room.price}} / Night</p>
                                        <a :href="'/rooms/' + booking.room.slug" target="_blank" class="btn btn-warning text-white rounded-0">Show Room</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <div>
                                    <h5 class="mb-3">Customer Details:</h5>
                                    <p>Full name: {{booking.user.first_name + ' ' + booking.user.last_name}}</p>
                                    <p>Email: {{booking.user.email}}</p>
                                    <p>Phone number: {{booking.phone}}</p>
                                </div>
                                <hr>
                                <div>
                                    <h5 class="mb-3">Booking Details:</h5>
                                    <p>Check in date: {{booking.check_in}}</p>
                                    <p>Check out date: {{booking.check_out}}</p>
                                    <p>Number of guests: {{booking.guests}}</p>
                                    <p v-if="booking.invoice">Status: {{booking.invoice.status ? 'Paid' : 'Unpaid'}}</p>
                                </div>
                                <hr>
                                <div>
                                    <h5 class="mb-3">Invoice details:</h5>
                                    <p>Payment method: {{booking.invoice.payment_type}}</p>
                                    <p>Total: {{booking.invoice.total}}$</p>
                                </div>
                            </div>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
            </div>
        </div>
        </div>
  </div>
</template>

<script>
import { Carousel, Slide } from 'vue-carousel';

export default {
    props:['booking'],
components: {
    Carousel,
    Slide
  }
}
</script>

<style>

</style>
