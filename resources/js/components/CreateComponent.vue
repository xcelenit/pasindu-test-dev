<template>
    <div class="containeer">
        <div class="row justify-center-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Create New Student</div>
                    <div class="card-body">
                        <form>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" v-model="name" class="form-control" id="name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Email address</label>
                            <input type="email" v-model="email" class="form-control" id="exampleInputEmail" placeholder="Enter Email" aria-describedby="emailHelp">
                        </div>
                        <div class="form-check">
                            <label for="phone">Name</label>
                            <input type="number" v-model="phone" class="form-control" id="phone" placeholder="Enter Phone">
                        </div>
                        <button type="submit" @click.prevent="saveStudent" class="btn btn-primary">Submit</button>f
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">All Students</div>
                    <div class="card-body">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(student,index) in students.data" :key="student.id">
                                <th scope="row">{{ index + 1 }}</th>
                                <td>{{ student.name }}</td>
                                <td>{{ student.email }}</td>
                                <td>{{ student.phone }}</td>
                                <td>
                                    <button type="button" @click="editStudent(student.id)" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                        Edit
                                    </button>
                                    <button type="button" @click="deleteStudent(student.id)" class="btn btn-danger">
                                        Delete
                                    </button>
                                </td>
                                </tr>
                            </tbody>
                            </table>
                            <pagination :data="students" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
            </div>
        </div>




        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" v-model="editname" class="form-control" id="name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Email address</label>
                            <input type="email" v-model="editemail" class="form-control" id="exampleInputEmail" placeholder="Enter Email" aria-describedby="emailHelp">
                        </div>
                        <div class="form-check">
                            <label for="phone">Name</label>
                            <input type="number" v-model="editphone" class="form-control" id="phone" placeholder="Enter Phone">
                        </div>
                        <button type="submit" @click.prevent="updateStudent" data-dismiss="modal" class="btn btn-success">Update</button>
                        </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

    export default{
        data(){
            return{
                students:{},
                id : '',
                name : '',
                email : '',
                phone : '',
                editname : '',
                editemail : '',
                editphone : ''
            }
        },
        mounted(){
            console.log('Component mounted')
            this.getResults();
        },
        methods:{
            saveStudent(){
                axios.post('save_student',{
                    name : this.name,
                    email : this.email,
                    phone : this.phone,
                })
                .then(response => console.log(response));
            },
            getResults(page = 1){
                axios.get('all_students?page=' + page)
                .then(response=>{
                    console.log(response.data)
                    this.students =response.data;
                });
            },
            editStudent(id){
                axios.get('edit_student/'+id)
                .then(response => {
                    this.response = response.data.id;
                    this.editname = response.data.name;
                    this.editemail = response.data.email;
                    this.editphone = response.data.phone;
                });
            },
            updateStudent(){
                axios.put('update_student',{
                    id : this.id,
                    name : this.editname,
                    email : this.editemail,
                    phone : this.editphone,
                })
                .then(response => {
                    this.getResults();
                });
            },
            deleteStudent(id){
                axios.delete('delete_student/'+id)
                .then(response => {
                    this.getResults();
                });
            }
        }
    }
</script>
