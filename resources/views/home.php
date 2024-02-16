<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="storage/assets/js/garuda.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<br><br>
<div class="container" id="app">
<div class="card">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">+Add</button>

  <div class="card-body">
    
        <div v-for="data in users">
            <div class="card" style="width: auto;">
                <img src="https://media.istockphoto.com/id/1522484673/id/foto/pengembang-wanita-muda-menunjuk-jari-ke-layar-laptop-dengan-kode-javascript.webp?s=2048x2048&w=is&k=20&c=CPDsI3ohkWUj6wR7N3K0_aXesZ-FfN0pdrg5c0ksRf0=" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{data.username}}</h5>
                    <p class="card-text">{{data.email}}</p>
                    <a href="#" class="btn btn-primary">{{data.birthday}}</a>
                    <button class="btn btn-danger" @click="deleteData(data.id)">x</button>
                </div>
            </div> <br>
        </div>
   
  </div>

</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Username</span>
            <input type="text" class="form-control" v-model="username" ref="username" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
            </div>

            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Email</span>
            <input type="text" class="form-control"  v-model="email" ref="email" placeholder="Email" aria-label="Username" aria-describedby="basic-addon1">
            </div>

            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Birthday</span>
            <input type="date" class="form-control" v-model="birthday" placeholder="Birthday" aria-label="Birthday" aria-describedby="basic-addon1">
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" @click="save">Save</button>
      </div>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script>
    const { createApp } = Vue 
    const CSRF_TOKEN = "<?= csrf_token() ?>";

    createApp({
        data() {
            return {
                users: null
            }
        },
        methods:{
            deleteData:function(id){
                __({
                    url : 'delete-user',
                    method:'post',
                    data : {
                        _token : CSRF_TOKEN,
                        id : id
                    }
                }).request($response=>{
                    var response = JSON.parse($response);
                    if (response){
                        alert("delete data success !")
                    }else{
                        alert("delete data failed !")
                    }
                    this.loadApp()
                })
            }, 
            loadApp: function(){
                __({
                    url : 'get-users',
                    method:'post',
                    data : {
                        _token : CSRF_TOKEN
                    }
                }).request($response=>{
                    this.users = JSON.parse($response)
                })
            }
        },
        mounted(){
            this.loadApp();
        }
    }).mount('#app')

    createApp({
        data() {
            return {
                username : null,
                email : null,
                birthday : null
            }
        },
        methods:{
             
            save : function(){
                if (this.username==null){
                    this.$refs.username.focus();
                    return;
                }
                if (this.email==null){
                    this.$refs.email.focus();
                    return;
                }


                __({
                    url : 'add-user',
                    method:'post',
                    data : {
                        _token : CSRF_TOKEN,
                        username : this.username,
                        email: this.email,
                        birthday : this.birthday
                    }
                }).request($response=>{
                    var response = JSON.parse($response);
                    if (response){
                        alert("Add data success !")
                    }else{
                        alert("Add data failed !")
                    }
                    _refresh()
                })
            }
        },
        mounted(){
           
        }
    }).mount('#modalAdd')
</script>

</body>
</html>