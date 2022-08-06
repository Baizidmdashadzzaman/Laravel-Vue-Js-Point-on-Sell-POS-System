<template>
       <section class="section-content padding-y-sm bg-default " style="padding:50px">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12 card padding-y-sm card ">
               <div class="row">
                  <div class="col-md-6"><h3>Order view</h3></div>
                  <div class="col-md-6">
                    <form action="#" class="search-wrap" style="float:right">
                      <div class="input-group">
                        <div class="text-end">
                          <router-link :to="{name:'orderlist'}" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i> Back to order list</router-link>
                          <button v-print="printObj" type="button" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
                         </div>
                      </div>
                    </form>
                  </div>
               </div>
               <hr>
               <ul class="nav bg radius nav-pills nav-fill mb-3 bg" role="tablist">
               </ul>
               <span id="items">
                  
                 <div class="container">
    <div class="card">
        <div class="card-body" id="printMe" >
            <div id="invoice" >
                <div class="toolbar hidden-print">
                    
                </div>
                <div class="invoice overflow-auto">
                    <div style="min-width: 600px">
                        <header>
                            <div class="row">
                                <div class="col">
                                    <a href="javascript:;">
    									<h1><b>Larevel vue pos</b></h1>
									</a>
                                </div>
                                <div class="col company-details">
                                    <h2 class="name">
                                        <a target="_blank" href="javascript:;">
									LV-POS
									</a>
                                    </h2>
                                    <div>Pahartoli 12 quater, Chittagong, Bangladesh</div>
                                    <div>8801862420119</div>
                                    <div>baizid.md.ashadzzaman@gmail.com</div>
                                </div>
                            </div>
                        </header>
                        <main>
                            <div class="row contacts">
                                <div class="col invoice-to">
                                    <div class="text-gray-light">INVOICE TO:</div>
                                    <h2 class="to">{{order.customername}}</h2>
                                    <div class="email">Phone : <a href="#">{{order.customerphone}}</a>
                                    </div>
                                </div>
                                <div class="col invoice-details">
                                    <h1 class="invoice-id">INVOICE {{order.ordernumber}}</h1>
                                    <div class="date">Date of Invoice: {{order.created_at}}</div>
                                </div>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th class="text-left">IMAGE</th>
                                        <th class="text-right">NAME</th>
                                        <th class="text-right">PRICE</th>
                                        <th class="text-right">QUANTITY</th>
                                        <th class="text-right">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(orderp , index) in orderproduct" :key="orderp.id" >
                                        <td class="no">{{index+1}}</td>
                                        <td class="text-left"><img :src="orderp.image" style="width:100px"></td>
                                        <td class="text-left">{{orderp.name}}</td>
                                        <td class="unit">{{orderp.price}}</td>
                                        <td class="qty">{{orderp.quantity}}</td>
                                        <td class="total">{{orderp.total}}</td>
                                    </tr>
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td colspan="2">SUBTOTAL</td>
                                        <td>${{sum}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td colspan="2">TAX 0%</td>
                                        <td>$00.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td colspan="2">GRAND TOTAL</td>
                                        <td>${{sum}}</td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="thanks">Thank you!</div>
                            <div class="notices">
                                <div>NOTICE:</div>
                                <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                            </div>
                        </main>
                        <footer>Invoice was created on a computer and is valid without the signature and seal.</footer>
                    </div>
                    <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                    <div></div>
                </div>
            </div>
        </div>
    </div>
</div>


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
            printLoading: true,
            printObj: {
              id: "printMe",
              popTitle: 'Order report',
              extraHead: '<meta http-equiv="Content-Language"content="zh-cn"/>',
              beforeOpenCallback (vue) {
                vue.printLoading = true
                console.log('asadzaman')
              },
              openCallback (vue) {
                vue.printLoading = false
                console.log('asadzaman')
              },
              closeCallback (vue) {
                console.log('asadzaman')
              }
            },
            auth:{
                email:"",
                password:""
            },
            processing:false,
            order:{},
            orderproduct:[],
            sum:0,
        }
    },
    created() {
            this.getResults();
    },
    methods:{
      getResults()
      {
             axios
            .get(`/api/order-view/${this.$route.params.id}`)
            .then((response) => {
              
                this.order=response.data.order;
                this.orderproduct=response.data.orderproduct;
                this.sum=response.data.sum;
              
            });
            
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