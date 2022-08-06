<template>
<div>
   <section class="header-main">
      <div class="container">
         <div class="row align-items-center">
            <div class="col-lg-3">
               <div class="brand-wrap">
                  <router-link :to="{name:'pos'}"><h2 class="logo-text"><b>Laravel Vue POS</b></h2></router-link>
               </div>
               <!-- brand-wrap.// -->
            </div>
            <div class="col-lg-6 col-sm-6">
               <form action="#" class="search-wrap">
                  <div class="input-group">
                     <input type="text" class="form-control" placeholder="Search">
                     <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                        <i class="fa fa-search"></i>
                        </button>
                     </div>
                  </div>
               </form>
               <!-- search-wrap .end// -->
            </div>
            <!-- col.// -->
            <div class="col-lg-3 col-sm-6">
               <div class="widgets-wrap d-flex justify-content-end">
                  
                  <div class="widget-header">
                     <router-link :to="{name:'pos'}" class="icontext">
                     <router-link :to="{name:'pos'}" class="btn btn-primary m-btn m-btn--icon m-btn--icon-only">
                     <i class="fa fa-fax"></i>
                     </router-link>
                     </router-link>
                  </div>
                  <div class="widget-header">
                     <router-link :to="{name:'orderlist'}" class="icontext">
                     <router-link :to="{name:'orderlist'}" class="btn btn-primary m-btn m-btn--icon m-btn--icon-only">
                     <i class="fa fa-shopping-basket"></i>
                     </router-link>
                     </router-link>
                  </div>
                  
               </div>
               <!-- widgets-wrap.// -->	
            </div>
            <!-- col.// -->
         </div>
         <!-- row.// -->
      </div>
      <!-- container.// -->
   </section>

   <router-view></router-view>


</div>

    <!-- <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-success">
            <a href="" target="_blank" class="navbar-brand">Laravue</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" 
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
            aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <router-link :to="{name:'dashboard'}" class="nav-link">
                            Home <span class="sr-only">(current)</span></router-link>
                    </li>
                </ul>
                <div class="ml-auto">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ user.name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="javascript:void(0)" @click="logout">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main class="mt-3">
            <router-view></router-view>
        </main>
    </div> -->
</template>

<script>
import {mapActions} from 'vuex'
export default {
    name:"dashboard-layout",
    data(){
        return {
            user:this.$store.state.auth.user
        }
    },
    methods:{
        ...mapActions({
            signOut:"auth/logout"
        }),
        async logout(){
            await axios.post('/logout').then(({data})=>{
                this.signOut()
                this.$router.push({name:"login"})
            })
        }
    }
}
</script>