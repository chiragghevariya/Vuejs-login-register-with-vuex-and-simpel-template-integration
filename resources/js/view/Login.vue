<template>
    <main id="main">

    <section class="hero-section inner-page">
      <div class="wave">

        <svg width="1920px" height="265px" viewBox="0 0 1920 265" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
              <path d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,667 L1017.15166,667 L0,667 L0,439.134243 Z" id="Path"></path>
            </g>
          </g>
        </svg>

      </div>

      <div class="container">
        <div class="row align-items-center">
          <div class="col-12">
            <div class="row justify-content-center">
              <div class="col-md-7 text-center hero-text">
                <h1 data-aos="fade-up" data-aos-delay="">Login</h1>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>

    <section class="section">
      <div class="container">
        <div class="row mb-5 align-items-end">
          <div class="col-md-6" data-aos="fade-up">
            <h2>Login Here</h2>
            <button class="btn btn-primary" @click="AuthProvider('github')">Github Login</button>
          </div>

        </div>

        <div class="row">
          
          <div class="col-md-6 mb-5 mb-md-0" data-aos="fade-up">
            <form v-on:submit.prevent="loginSave" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-12 form-group">
                  <label for="name">Email</label>
                  <input type="email" class="form-control" v-model="loginData.email" id="email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validate"></div>
                </div>
                <div class="col-md-12 form-group">
                  <label for="name">Password</label>
                  <input type="password" v-model="loginData.password" class="form-control" id="password" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validate"></div>
                </div>
                
                <div class="col-md-6 form-group">
                  <input type="submit" class="btn btn-primary d-block w-100" value="Login">
                </div>
              </div>

            </form>
          </div>

        </div>
      </div>
    </section>

    <!-- ======= CTA Section ======= -->
    <section class="section cta-section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 mr-auto text-center text-md-left mb-5 mb-md-0">
            <h2>Starts Publishing Your Apps</h2>
          </div>
          <div class="col-md-5 text-center text-md-right">
            <p><a href="#" class="btn"><span class="icofont-brand-apple mr-3"></span>App store</a> <a href="#" class="btn"><span class="icofont-ui-play mr-3"></span>Google play</a></p>
          </div>
        </div>
      </div>
    </section><!-- End CTA Section -->

  </main>
</template>
   
<script>
    export default {
        data(){

          return{

            loginData:{}
          }
        },
        mounted() {

        },
        methods:{

          loginSave(){

            this.$store.dispatch('loginSave',this.loginData);
          },
          AuthProvider(provider) {
            
              var self = this
              
              this.$auth.authenticate(provider).then(response =>{
                  self.SocialLogin(provider,response)
                }).catch(err => {
                    console.log({err:err})
                })
            },
            
            SocialLogin(provider,response){
                this.$http.post('/sociallogin/'+provider,response).then(response => {
                    
                    if (response.data.status == 200) {
                    
                    Vue.notify({
                        group: 'foo',
                        title: 'Login successfully done.',
                        type:'success'
                    });

                    let token = response.data.access_token;
                    localStorage.setItem('token',token);
                    this.$store.commit('SET_TOKEN');
                    window.location='dashboard';
                
                }

                }).catch(error => {

                    if(error.response.status == false){
                        Vue.notify({
                            group: 'foo',
                            title: error.response.message,
                            type:'error'
                        });
                    }
                    console.log({error:error});
                })
            }
        },
        metaInfo: {
            title: 'Login ',
            titleTemplate: '%s - VueJs',
            meta: [
              { name: "description", content: "Login" },
              { name: "keywords", content: "Login" }
            ]
        }
    }
</script>