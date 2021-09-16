<template>
    <Sidebar></Sidebar>
    <App>
        <template v-slot:title>
            {{ title }}
        </template>
        <template v-slot:button>
            <router-link to="/users" class="btn btn-sm btn-primary shadow-sm">Назад</router-link>
        </template>

        <div class="card shadow">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col">
                        <label for="nameInput">ФИО</label>
                        <input type="text" class="form-control" id="nameInput" v-model="user.name" maxlength="100" placeholder="Введите ФИО" required>
                    </div>
                    <div class="form-group col">
                        <label for="emailInput">Эл. почта</label>
                        <input type="email" class="form-control" id="emailInput" v-model="user.email" maxlength="50" placeholder="Введите эл. почту" required>
                    </div>

                    <div class="w-100"></div>

                    <div class="form-group col">
                        <label for="passwordInput">Пароль</label>
                        <input type="password" class="form-control" id="passwordInput" v-model="user.password" maxlength="255" placeholder="Введите пароль" required>
                    </div>
                    <div class="form-group col">
                        <label for="passwordConfirmationInput">Подтвердите пароль</label>
                        <input type="password" class="form-control" id="passwordConfirmationInput" v-model="user.password_confirmation" maxlength="255" placeholder="Введите пароль еще раз" required>
                    </div>

                    <div class="w-100"></div>

                    <div class="col-12" v-if="errors">
                        <div class="alert alert-danger" v-for="(value, key) in errors" :key="key">
                            <p class="mb-0" v-for="error in value" :key="error" v-text="error"></p>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 offset-sm-6">
                        <button type="submit" class="btn btn-primary btn-block" @click="store()">Добавить</button>
                    </div>
                </div>
            </div>
        </div>
    </App>
</template>

<script>
    import Sidebar from "@/components/Sidebar";
    import App from "@/components/App";

    export default {
        data() {
            return {
                title: "Создание пользователя",
                user: {
                    name: "",
                    email: "",
                    password: "",
                    password_confirmation: ""
                },
                errors: null
            }
        },
        components: {
            Sidebar,
            App
        },
        methods:{
            store() {
                this.axios.post(`${process.env.VUE_APP_URL}/users/`, this.user)
                    .then(response => {
                        if(response.status === 201) {
                            this.$router.push({ name: 'users.index' });
                        }
                    })
                    .catch(error => {
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors;
                        }
                    });
            }
        }
    }
</script>

<style scoped>

</style>