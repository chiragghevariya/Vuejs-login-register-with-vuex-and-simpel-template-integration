import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'

Vue.use(Vuex)
Vue.use(VueAxios, axios)
Vue.use(VueRouter);

export const store = new Vuex.Store({

    state:{ 

        loading:false,
        isLoggedIn: !!localStorage.getItem('token'),
        token: localStorage.getItem('token'),
        userData:{}
    },
    actions:{

        loginSave({commit},payload){
            
            this.state.loading = true;
            let uri = 'http://localhost/vue-laravel/api/login';
            axios.post(uri,payload).then((response) => {
                
                if (response.data.status == 200) {

                    this.state.loading = false;

                    Vue.notify({
                        group: 'foo',
                        title: 'Login successfully done.',
                        type:'success'
                    });

                    let token = response.data.access_token;
                    localStorage.setItem('token',token);
                    commit('SET_TOKEN');
                    commit('SET_AUTHENTICATE_DATA',response.data.data);
                    window.location ='dashboard';
                }
                
                
            }).catch(error => {
                
                this.state.loading = false;

                if(error.response.data.status == false){
                    Vue.notify({
                        group: 'foo',
                        title: error.response.data.message,
                        type:'error'
                    });
                }
               
            });
        }, 
        
        setUserData({commit},payload){

            let uri = 'http://localhost/vue-laravel/api/me';
            axios.post(uri).then((response) => {
                
                console.log("set user data",response.data.data);                
                if (response.data.status == 200) {
                    
                    commit('SET_TOKEN');
                    commit('SET_AUTHENTICATE_DATA',response.data.data);
                }
            
            }).catch(error => {
                
                console.log(error.response.data);
                if (error.response.data.status == 401) {
                   
                    commit('SOMETHING_WANT_WRONG_LOGOUT');
                     Vue.notify({
                        group: 'foo',
                        title: "Session is expire please login again",
                        type:'error'
                    });

                     
                    window.location ='';
                }
            });

        },
        logout({commit},payload){

            console.log("payload",payload);
            let uri = 'http://localhost/vue-laravel/api/logout';
            axios.post(uri,{'payload':payload}).then((response) => {

                console.log("logout",response.data);
                if (response.data.status == 200) {
                    
                    console.log("in logout");
                    commit('SET_LOGOUT');
                    Vue.notify({
                        group: 'foo',
                        title: 'Logout successfully done.',
                        type:'success'
                    });

                    window.location ='login';

                }
                
                
            }).catch(error => {
                
                console.log("logout error",error.response.data);
                commit('SET_LOGOUT');
                Vue.notify({
                    group: 'foo',
                    title: 'Logout errror.',
                    type:'success'
                });

                window.location ='login';

            });

        }

    },
    mutations:{
        
        SET_TOKEN(state){

            this.state.token = localStorage.getItem('token');
            this.state.isLoggedIn = true;
        },
        SET_AUTHENTICATE_DATA(state,data){

            this.state.userData = data;
        },
        SET_LOGOUT(state){

            this.state.userData = '';
            this.state.isLoggedIn = false;
            this.state.token = '';
            
            localStorage.removeItem('token');
            delete axios.defaults.headers.common["Authorization"];
        },
        SOMETHING_WANT_WRONG_LOGOUT(state){

            this.state.userData = '';
            this.state.isLoggedIn = false;
            this.state.token = '';

            localStorage.removeItem('token');
            delete axios.defaults.headers.common["Authorization"];
        },

        saveRegister(state,payload){
            
            this.state.loading = true;
            let uri = 'http://localhost/vue-laravel/api/register';
            axios.post(uri,payload).then((response) => {
                
                if (response.data.status == 200) {

                    payload.name = ''; 
                    payload.email = ''; 
                    payload.password = ''; 
                    this.state.loading = false;

                    Vue.notify({
                        group: 'foo',
                        title: 'Register successfully done.',
                        type:'success'
                    });
                    
                    window.location.href='login';      
                }
                
                
            }).catch(error => {
                
                this.state.loading = false;

                if(error.response.data.status == false){
                    Vue.notify({
                        group: 'foo',
                        title: error.response.data.message,
                        type:'error'
                    });
                }
               
            });
        } 
    },
    getters: {
    isLoggedIn: state => state.isLoggedIn,
    userData: state => state.userData,
    token: state => state.token,
  }

})