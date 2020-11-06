<template>
    <div>
        <div class="jumbotron text-center">
            <h1>Contacts</h1>
            <p class="small-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi, ad beatae. Amet nam, vero aut modi earum mollitia labore quas non fugit reiciendis, quidem maiores ipsam ea iure ipsa perferendis!</p>
        </div>
        <hr>
     
        <form  action="#" @submit.prevent="edit ? updateContact(contact.id) : createContact()">
            <p class="lead text-center"></p>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input v-model="contact.name" type="text" class="form-control" name="name" placeholder="Name" required autofocus>
                        </div>
                    </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <input v-model="contact.email" type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <input v-model="contact.phone" type="text" class="form-control" name="phone" placeholder="Phone" required>
                    </div>
                </div>
                
            </div>

            <div class="form-group">
                <textarea v-model="contact.note" name="note" class="form-control" id="" cols="4" rows="4" placeholder="Leave a note" required></textarea>
            </div>

            <div class="form-group">
                <button v-show="!edit" type="submit" class="btn btn-primary">Create New Contact</button>
                <button v-show="edit" type="submit" class="btn btn-success">Update Contact</button>

            </div>
       </form>

    </div>
   
</template>





<script>
    export default{
        data: function(){
            return {
                edit: false,
                list: [],
                contact: {
                    id: '' ,
                    name: '' ,
                    phone: '' ,
                    note: '' 
                }
            }
        },

        mounted: function(){
            console.log('contacts loaded....')
        },

        methods: {
            createContact: function(){
                axios({
                    method: 'post',
                    url: '/contact/store',
                    data: {
                        name: 'Fred',
                        email: 'Flintstone',
                        phone: 'Flintstone',
                        note: 'Flintstone',

                    }
                });
            },

            updateContact: function($id){

            }
        }
    }
</script>