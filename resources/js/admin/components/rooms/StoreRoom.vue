<template>
  <div>
      <div class="modal" id="new-room" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered  modal-lg">

                <div class="modal-content rounded-0">
<form action="#" method="post" @submit.prevent="storeRoom(newRoom.id)">
                    <div class="modal-header">
                        <h5 class="modal-title">Add new room</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" v-model="newRoom.title" name="title" id="title" class="form-control" placeholder="Room title" minlength="3" maxlength="80" required>
                        </div>
                        <div class="form-group">
                            <label for="title">Description</label>
                            <ckeditor v-model="newRoom.description" required></ckeditor>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-12 col-sm-6">
                                <label for="price">Price</label>
                                <input type="number" v-model="newRoom.price" min="1" name="price" id="price" class="form-control" placeholder="Price" required>
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <label for="price">Capacity</label>
                                <input type="number" v-model="newRoom.capacity" min="1" name="price" id="capacity" class="form-control" placeholder="capacity" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="price">Images (max 5)</label>
                            <input type="file" ref="file" multiple="multiple" id="images" class="form-control-file" :required="!newRoom.images">
                            <small class="text-danger" v-if="newRoom.errors.images.length > 0">{{newRoom.errors.images}}</small>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="alert alert-success" role="alert" v-show="success">
                            Success..
                        </div>

                        <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning text-white rounded-0" :disabled="isLoading">Save changes</button>
                    </div>
</form>
                </div>

        </div>
    </div>
  </div>
</template>

<script>
export default {
    props: ['newRoom'],
    data: () => ({
        isLoading: false,
        success: false
    }),
    methods:{
        toggleNewRoom(room = null) {
            $('#new-room').modal('toggle')
            this.newRoom.id = room.id || null
            this.newRoom.title = room.title || ""
            this.newRoom.description = room.description || ""
            this.newRoom.price = room.price || null
            this.newRoom.capacity = room.capacity || null
            this.newRoom.images = room.images || null

        },
        async storeRoom(id = null) {

            this.isLoading = true

            let dataToSubmit = new FormData

            // Initiate errors for new submition
            this.$emit('resetErrors')

            // Check images
            if (this.$refs.file.files) {
                if (this.$refs.file.files.length > 5) {
                    this.newRoom.errors.images = "You can only upload 5 images at max!"
                    this.isLoading = false

                    return false
                }

                for (let i = 0; i < this.$refs.file.files.length; i++) {

                    let file = this.$refs.file.files[i]

                    console.log(file.type)

                    if (file.type !== 'image/png' && file.type !== 'image/jpeg') {
                        this.newRoom.errors.images = "Invalid image type!"
                        this.isLoading = false

                        return false
                    }

                    dataToSubmit.append('images[' + i + ']', file)

                }
            }

            dataToSubmit.append('title', this.newRoom.title)
            dataToSubmit.append('description', this.newRoom.description)
            dataToSubmit.append('price', this.newRoom.price)
            dataToSubmit.append('capacity', this.newRoom.capacity)

            if (id !== null) {

                dataToSubmit.append('_method', 'put')
                try {

                    const result = await axios.post(`/api/admin/rooms/${id}/update`,
                        dataToSubmit, {
                            headers: {
                                'Content-Type': 'multipart/form-data',
                            },
                        }
                    )

                    document.getElementById('images').value = ""

                    $('#new-room').modal('toggle')

                    this.$emit('getRooms')

                    console.log(result)

                } catch (error) {

                    console.log(error)

                }

            } else {

                try {

                    const result = await axios.post(`/api/admin/rooms`,
                        dataToSubmit, {
                            headers: {
                                'Content-Type': 'multipart/form-data',
                            },
                        }
                    )
                    document.getElementById('images').value = ""

                    $('#new-room').modal('toggle')

                    this.$emit('getRooms')

                } catch (error) {
                    console.log(error)
                }

            }

            this.$emit('resetInputs')

            this.isLoading = false


        },
    }
}
</script>

<style>

</style>
