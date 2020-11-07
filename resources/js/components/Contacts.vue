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


       <hr>
       <div class="container">
            <ul class="list-group">
                <p class="lead">All Contacts</p>
                <li class="list-group-item" v-for="contact in list">

                    <ul class="list-group">
                        <li class="list-group-item text-small"><strong>Name: </strong> {{ contact.name }}</li>
                        <li class="list-group-item text-small"><strong>Email: </strong> {{ contact.email }}</li>
                        <li class="list-group-item text-small"><strong>Phone: </strong> {{ contact.phone }}</li>
                        <li class="list-group-item text-small"><strong>Note: </strong> "{{ contact.note }}"</li>
                    </ul>
                    <br>

                   <button class="btn btn-success" @click="showContact(contact.id)">Update</button>
                   <button class="btn btn-danger" @click="deleteContact(contact.id)">Delete</button>                    
                </li>

            </ul>
        </div>

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
            this.fetchContactList()
        },

        methods: {
            fetchContactList: function(){
                console.log('fetching contacts');
                axios.get('api/contacts')
                .then(response=>{
                    console.log(response.data);
                    this.list = response.data;
                })
                .catch(err=>{
                    console.log(err);
                })
            },

            createContact: function(){
                console.log('Creating Contact now')
                let self = this;
                let params = Object.assign({}, self.contact)
                axios.post('api/contact/store', params)
                .then(function(){
                        self.contact.name  = '';
                        self.contact.email  = '';
                        self.contact.phone  = '';
                        self.contact.note  = '';
                        self.edit = false;
                })
                .catch(err=>{
                    console.log(err)
                })
                this.fetchContactList();
            },

            showContact: function(id){
                let self = this;
                axios.get('api/contact/'+id)
                .then(response=>{
                    self.edit = true;
                    self.contact.id  = response.data.id;
                    self.contact.name  = response.data.name;
                    self.contact.email  = response.data.email;
                    self.contact.phone  = response.data.phone;
                    self.contact.note  = response.data.note;
                    console.log(response.data)
                    
                })
                .catch(err=>{
                    console.log(err)
                })
            },

            updateContact: function(id){
               let self = this;
                let params = Object.assign({}, self.contact)
                axios.patch('api/contact/'+id, params)
                .then(function(){
                        self.contact.id  = '';
                        self.contact.name  = '';
                        self.contact.email  = '';
                        self.contact.phone  = '';
                        self.contact.note  = '';
                        self.edit = false;
                })
                .catch(err=>{
                    console.log(err)
                })
                this.fetchContactList();
                
            },

            deleteContact: function(id){
                axios.delete('api/contact/'+id)
                .then(function(){
                    self.contact.name  = '';
                    self.contact.email  = '';
                    self.contact.phone  = '';
                    self.contact.note  = '';
                    self.edit = false;
                })
                .catch(err=>{
                    console.log(err);
                })
                this.fetchContactList();
            }

        }
    }
</script>