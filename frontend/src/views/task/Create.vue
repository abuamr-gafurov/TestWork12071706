<template>
    <Sidebar></Sidebar>
    <App>
        <template v-slot:title>
            {{ title }}
        </template>
        <template v-slot:button>
            <router-link to="/tasks" class="btn btn-sm btn-primary shadow-sm">Назад</router-link>
        </template>

        <div class="card shadow">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col">
                        <label for="userSelect">Пользователь</label>
                        <select class="form-control" id="userSelect" v-model="task.user_id">
                            <option value selected>Выберите пользователя</option>
                            <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
                        </select>
                    </div>
                    <div class="form-group col">
                        <label for="titleInput">Название</label>
                        <input type="text" class="form-control" id="titleInput" v-model="task.title" maxlength="100" placeholder="Введите ФИО" required>
                    </div>

                    <div class="w-100"></div>

                    <div class="form-group col">
                        <label for="descriptionTextarea">Описание</label>
                        <textarea class="form-control" v-model="task.description" id="descriptionTextarea" rows="3" placeholder="Введите описание"></textarea>
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
                title: "Создание задачи",
                task: {
                    user_id: "",
                    title: "",
                    description: "",
                },
                users: {},
                errors: null
            }
        },
        components: {
            Sidebar,
            App
        },
        mounted() {
            this.getUsers();
        },
        methods:{
            getUsers() {
                this.axios.get(`${process.env.VUE_APP_URL}/users/`)
                    .then(response => {
                        this.users = response.data.data;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            store() {
                this.axios.post(`${process.env.VUE_APP_URL}/tasks/`, this.task)
                    .then(response => {
                        if(response.status === 201) {
                            this.$router.push({ name: 'tasks.index' });
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