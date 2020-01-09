<template>
    <div class="user-management">
        <!-- Navbar -->
        <div class="list_user create-user container" v-if="checkIsAdmin">
            <div class="error">
                <span v-for="(err, index) in errors">
                    {{ err[0] }} <br>
                </span>
                <hr>
            </div>
            <!--<img :src="this.testRoute" height="0" width="0">-->
            <div class="row">
                <div class="col-md-3">
                    <input type="text" v-model="userCreate.name" class="form-control" placeholder="Name...">
                </div>
                <div class="col-md-3">
                    <input type="email" v-model="userCreate.email" class="form-control" placeholder="User email...">
                </div>
                <div class="col-md-3">
                    <select class="form-control" v-model="userCreate.role">
                        <option value="employee">Employee</option>
                        <option value="saler">Saler</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary" @click="createUser">Create</button>
                </div>
            </div>
        </div>
        <br>
        <!-- Table User -->
        <div class="list_user table-responsive container">
            <table class="table table-hover">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Role</td>
                    <td v-if="checkIsAdmin">Action</td>
                </tr>
                </thead>
                <tbody v-if="list_users.length">
                <tr v-for="(user, index) in list_users">
                    <td>{{ user.id }}</td>
                    <td v-if="user.isEdit">
                        <input type="text" class="form-control"
                               :class="errors['name'] != null ? 'is-invalid' : ''"
                               v-model="selectedUser.name">
                        <small class="text-danger">{{errors['name'] != null ? errors['name'][0] : ''}}</small>
                    </td>
                    <td v-else>{{ user.name }}</td>
                    <td v-if="user.isEdit">
                        <input type="text" class="form-control"
                               :class="errors['email'] != null ? 'is-invalid' : ''"
                               v-model="selectedUser.email">
                        <small class="text-danger">{{errors['email'] != null ? errors['email'][0] : ''}}</small>
                    </td>
                    <td v-else>{{ user.email }}</td>
                    <td>
                        <span v-for="(role, index) in user.roles">
                            {{index > 0 ? ', ' : ''}}{{role.name}}
                        </span>
                    </td>
                    <div v-if="checkIsAdmin">
                        <td v-if="user.isEdit">
                            <button class="btn btn-primary" @click="updateUser(index)">Save</button>
                            <button class="btn btn-danger" @click="user.isEdit = false">Cancel</button>
                        </td>
                        <td v-else>
                            <button class="btn btn-success" @click="selectUser(user)">Edit</button>
                            <button class="btn btn-danger" @click="deleteUser(user, index)">Delete</button>
                        </td>
                    </div>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['testRoute'],
        data() {
            return {
                userCreate: {
                    name: '',
                    email: '',
                    role: 'employee'
                },
                currentUser: {},
                selectedUser: {},
                list_users: [],
                errors: [],
            }
        },
        created() {
            this.getCurrentUser();
            this.getListUsers();
        },
        methods: {
            getCurrentUser() {
                axios.get('/getCurrentUser')
                    .then(response => {
                        this.currentUser = response.data;
                        // console.log(response.data);
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            getListUsers() {
                axios.get('/users')
                    .then(response => {
                        this.list_users = response.data;
                        this.list_users.forEach(user => {
                            Vue.set(user, 'isEdit', false);
                        })
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            createUser() {
                axios.post('/users', {
                    name: this.userCreate.name,
                    email: this.userCreate.email,
                    role: this.userCreate.role,
                })
                    .then(response => {
                        console.log(response);
                        this.userCreate = {};
                        this.getListUsers();
                        this.errors = [];
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                    })
            },
            selectUser(user) {
                this.errors = [];
                this.list_users.forEach(a_user => {
                    Vue.set(a_user, 'isEdit', false);
                });
                this.selectedUser = {...user};
                user.isEdit = true;
            },
            updateUser(index) {
                axios.put('/users/' + this.selectedUser.id, {
                    name: this.selectedUser.name,
                    email: this.selectedUser.email,
                })
                    .then(response => {
                        this.list_users[index].name = this.selectedUser.name;
                        this.list_users[index].email = this.selectedUser.email;
                        this.list_users[index].isEdit = false;
                        this.errors = [];
                    })
                    .catch(error => {
                        if (error.response != null) {
                            this.errors = error.response.data.errors;
                        }
                    })
            },
            deleteUser(user, index) {
                let check = confirm('Xóa nhé?');
                if (check) {
                    axios.delete('/users/' + user.id).then(response => {
                        console.log(response.data);
                        this.list_users.splice(index, 1);
                    }).catch(error => {
                        this.errors = error.response.data.errors.name
                    });
                }
            },
        },
        computed: {
            checkIsAdmin() {
                if (this.currentUser.roles) {
                    let check = false;
                    this.currentUser.roles.forEach(role => {
                        if (role.name === 'admin') {
                            check = true;
                        }
                    });
                    return check;
                }
            },
        }
    }
</script>

<style lang="scss" scoped>
</style>
