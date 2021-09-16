<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Авторизация</h1>
                                    </div>
                                    <div class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" v-model="form.email" placeholder="Введите эл. почту">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" v-model="form.password" placeholder="Введите пароль">
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" @click="login()">Войти</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                secrets: {},
                form: {
                    email: '',
                    password: ''
                }
            }
        },
        methods: {
            login() {
                this.axios.post(`${process.env.VUE_APP_URL}/auth/login`, this.form)
                    .then(response => {
                        this.secrets = response.data;
                    })
                    .catch(error => {
                        console.log(error)
                    });
            }
        }
    }
</script>