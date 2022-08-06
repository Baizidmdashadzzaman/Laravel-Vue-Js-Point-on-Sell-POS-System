<template>
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 col-md-6 offset-md-3">
                <div class="card shadow md">
                    <div class="card-body">
                        <h2 class="text-center">Laravel Vue Vuex Counter Application</h2>
                        <hr/>
                        <center>
                        <img src="/laravel-vue.png" style="width:300px">
                        <div class="col-12 mb-2">
                                <button type="button" @click="decrementMeth" class="btn btn-success ">
                                    Decrement
                                </button>
                                <button type="button" @click="decrementMeth100" class="btn btn-success ">
                                   Decrement by 100
                                </button>
                        </div>
                        <h1 class="text-center">Count: {{count}}</h1>
                        <div class="col-12 mb-2">
                                <button type="button" @click="incrementMeth" class="btn btn-success ">
                                    Increment
                                </button>
                                <button type="button" @click="incrementMeth100" class="btn btn-success ">
                                   Increment by 100
                                </button>
                        </div>
                        </center>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions } from 'vuex'
export default {
    name:"counter",
    data(){
        return {
            auth:{
                email:"",
                password:""
            },
            count:this.$store.state.counter.count,
            processing:false
        }
    },
    methods:{
        ...mapActions({
            incrementVuex:'counter/increment',
            incrementVuex100:'counter/increment100',
            decrementVuex:'counter/decrement',
            decrementVuex100:'counter/decrement100',
        }),
        incrementMeth(){
            this.incrementVuex()
            this.count = this.$store.state.counter.count    
        },
        incrementMeth100(){
            this.incrementVuex100()
            this.count = this.$store.state.counter.count 
        },
        decrementMeth(){
            this.decrementVuex()
            this.count = this.$store.state.counter.count    
        },
        decrementMeth100(){
            this.decrementVuex100()
            this.count = this.$store.state.counter.count 
        },
    }
}
</script>