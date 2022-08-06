<template>
       <section class="section-content padding-y-sm bg-default " style="padding:50px">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12 card padding-y-sm card ">
               <div class="row">
                  <div class="col-md-6"><h3>Order list</h3></div>
                  <div class="col-md-6">
                    <form action="#" class="search-wrap" style="float:right">
                      <div class="input-group">
                        <input type="text" placeholder="Search" class="form-control" v-on:keyup="keymonitor" v-model="ThisIsField1" > 
                        <div class="input-group-append"><button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button></div>
                      </div>
                    </form>
                  </div>
               </div>
               
               <ul class="nav bg radius nav-pills nav-fill mb-3 bg" role="tablist">
               </ul>
               <span id="items">
                  
                  <table class="table table-bordered table-hover ">
                       <thead class=" bg-primary ">
                         
                         <tr>
                           <th scope="col"><font style="color:white">ID</font></th>
                           <th scope="col"><font style="color:white">Order number</font></th>
                           <th scope="col"><font style="color:white">Customer name</font></th>
                           <th scope="col"><font style="color:white">Action</font></th>
                         </tr>

                       </thead>
                       <tbody>
                         <tr v-for="order in allorder" :key="order.id" >
                           <th scope="row">{{order.id}}</th>
                           <td>{{order.ordernumber}}</td>
                           <td>{{order.customername}}</td>
                           <td><router-link :to="{name:'orderview', params: { id: order.id }}" class="btn btn-primary">View</router-link></td>
                         </tr>
                       </tbody>
                 </table>



               </span>
            </div>
         </div>
      </div>
      <!-- container //  -->
   </section>
</template>

<script>
import { mapActions } from 'vuex'
export default {
    name:"login",
    data(){
        return {
            auth:{
                email:"",
                password:""
            },
            processing:false,
            allorder:[],
            ThisIsField1: '',
            search:{
              query:''
            },
        }
    },
    created() {
            this.getOrder();
    },
    methods:{
      keymonitor() {
			  this.search.query = this.ThisIsField1;
           let uri = '/api/order-search';
           axios.post(uri, this.search).then((response) => {
              this.allorder = response.data.allData; 
           })
		  },
       getOrder()
        {
               axios.get('/api/order-list')
                    .then(res=>{
                        this.allorder = res.data.allData;
               }).catch(error=>{console.log(error.response.data)});
        },
        ...mapActions({
            signIn:'auth/login'
        }),
        async login(){
            this.processing = true
            await axios.get('/sanctum/csrf-cookie')
            await axios.post('/login',this.auth).then(({data})=>{
                this.signIn()
            }).catch(({response:{data}})=>{
                alert(data.message)
            }).finally(()=>{
                this.processing = false
            })
        },
    }
}
</script>