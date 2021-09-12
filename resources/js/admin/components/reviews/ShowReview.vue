<template>
  <div>
      <div class="modal" id="showReview" tabindex="-1" >
        <div class="modal-dialog modal-dialog-centered " v-if="review.id">
            <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title">Review #{{review.id}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">

                    <div class="col-12 mb-3">

                        <p><strong>Customer:</strong> {{review.user.first_name + ' ' + review.user.last_name}}</p>
                        <p><strong>Email:</strong> {{review.user.email}}</p>
                        <p><strong>Phone:</strong> {{review.user.phone}}</p>
                    </div>

                    <div class="col-12 mb-3">
                        <p><strong>Rating:</strong> {{review.rating}} <i class="fas fa-star text-warning"></i></p>
                        <p><strong>Comment:</strong></p>
                        <div v-html="review.comment" class="border py-3 mb-4 px-3" ></div>
                        <a class="btn btn-warning text-white rounded-0 btn-sm" target="_blank" :href="'/rooms/' + review.room.slug">View Room</a>
                    </div>




                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success rounded-0" @click.prevent="() => $emit('approve', review.id)" v-show="!review.is_approved">Approve</button>
                <button type="button" class="btn btn-secondary rounded-0" @click.prevent="() => $emit('reject', review.id)" v-show="review.is_approved">Reject</button>
                <button type="button" class="btn btn-danger rounded-0" @click.prevent="() => $emit('delete', review.id)">Delete</button>

            </div>
            </div>
        </div>
        </div>
  </div>
</template>

<script>

export default {
    props:['review'],

}
</script>

<style>

</style>
