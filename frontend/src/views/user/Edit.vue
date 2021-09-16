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
                <form action="">
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
                            <input type="password" class="form-control" id="passwordInput" v-model="user.password" maxlength="255" placeholder="Введите пароль" :required="!newPassword" :disabled="!newPassword">
                        </div>
                        <div class="form-group col">
                            <label for="deliveryPriceInput">Подтвердите пароль</label>
                            <input type="password" class="form-control" id="deliveryPriceInput" v-model="user.password_confirmation" maxlength="255" placeholder="Введите пароль еще раз" :required="!newPassword" :disabled="!newPassword">
                        </div>

                        <div class="w-100"></div>

                        <div class="col-12" v-if="errors">
                            <div class="alert alert-danger" v-for="(value, key) in errors" :key="key">
                                <p class="mb-0" v-for="error in value" :key="error" v-text="error"></p>
                            </div>
                        </div>

                        <div class="col">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="passwordCheckbox">
                                <label class="custom-control-label" for="passwordCheckbox" @click="setNewPassword()">Новый пароль ?</label>
                            </div>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary btn-block" @click="update($event)">Редактировать</button>
                        </div>
                    </div>
                </form>
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
                title: "Редактирование пользователя #" + this.$route.params.id,
                userId: this.$route.params.id,
                user: {},
                newPassword: false,
                errors: null
            }
        },
        components: {
            Sidebar,
            App
        },
        mounted() {
            this.show(this.userId)
        },
        methods: {
            setNewPassword() {
                this.newPassword = !this.newPassword;
            },
            show(id) {
                this.axios.get(`${process.env.VUE_APP_URL}/users/${id}`)
                    .then(response => {
                        this.user = response.data;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            update(e) {
                e.preventDefault();

                this.axios.patch(`${process.env.VUE_APP_URL}/users/${this.userId}`, this.user)
                    .then(response => {
                        if(response.status === 204) {
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