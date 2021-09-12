<template>
<div>
    <!-- EDIT CUSTOMER MODAL -->
    <div class="modal fade" id="editCustomer" tabindex="-1" aria-labelledby="editCustomerLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-lg">
            <div class="modal-content rounded-0">
                <form @submit.prevent="editCustomer">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCustomerLabel">Edit customer #{{customer.id}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="form-group col-12 col-md-6">
                                <label for="first_name">First name</label>
                                <input v-model="customer.first_name" type="text" minlength="3" class="form-control" name="first_name" id="first_name" placeholder="First name" required>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="last_name">Last name</label>
                                <input v-model="customer.last_name" type="text" minlength="3" class="form-control" name="last_name" id="last_name" placeholder="Last name" required>
                            </div>

                        </div>

                        <div class="form-group ">
                            <label for="email">Email</label>
                            <input v-model="customer.email" type="email" class="form-control" name="email" id="email" placeholder="email" required />
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone number</label>
                            <input v-model="customer.phone" type="tel" class="form-control" name="phone" id="phone" placeholder="phone number" required>
                        </div>

                        <div class="row">
                            <div class="form-group col-12 col-md-6">
                                <label for="country">Country</label>
                                <input v-model="customer.country" type="text" pattern="[a-zA-Z]+" class="form-control" name="country" id="country" placeholder="country" required>
                            </div>

                            <div class="form-group col-12 col-md-6">
                                <label for="city">City</label>
                                <input v-model="customer.city" type="text" pattern="[a-zA-Z]+" class="form-control" name="city" id="city" placeholder="city" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input v-model="customer.address" type="text" class="form-control" name="address" id="address" placeholder="Address" required>
                        </div>

                        <div class="row">
                            <div class="form-group col-12 col-md-6">
                                <label for="postal_code">Postal code</label>
                                <input v-model="customer.postal_code" type="text" class="form-control" name="postal_code" id="postal_code" placeholder="Postal code" required>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="state">State</label>
                                <input v-model="customer.state" type="text" class="form-control" name="state" id="state" placeholder="State" required>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning rounded-0 text-white" v-show="!isLoading">Save changes</button>
                        <div class="lds-ring" v-show="isLoading"><div></div><div></div><div></div><div></div></div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ['customer'],
    data: () => ({
        isLoading: false,
    }),
    methods: {
        async editCustomer() {
            this.isLoading = true
            try {
                const result = await axios.put(`/api/admin/customers/${this.customer.id}`, this.customer)
                this.$emit('getCustomers')
            } catch (error) {
                console.log(error)
            }
            this.isLoading = false
        },
    }
}
</script>

<style>

</style>
