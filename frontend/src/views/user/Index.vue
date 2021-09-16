<template>
    <Sidebar></Sidebar>
    <App>
        <template v-slot:title>
            {{ title }}
        </template>
        <template v-slot:button>
            <router-link to="/users/create" class="btn btn-sm btn-primary shadow-sm">Добавить</router-link>
        </template>

        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ФИО</th>
                                <th>Эл.почта</th>
                                <th>Создано</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(user, index) in users" :key="user.id">
                                <th>{{ user.id }}</th>
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.created_at }}</td>
                                <td class="text-right">
                                    <router-link :to="{name: 'users.edit', params: {id: user.id}}" class="mr-2">
                                        <i class="fa fa-edit" title="Редактировать"></i>
                                    </router-link>

                                    <a href="#" @click="destroy(user.id, index)">
                                        <i class="fa fa-trash-alt text-danger" title="Удалить"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
<!--                <div class="d-flex justify-content-center">-->

<!--                </div>-->
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
                title: "Пользователи",
                users: []
            }
        },
        components: {
            Sidebar,
            App
        },
        mounted() {
            this.read();
        },
        methods: {
            read() {
                this.axios.get(`${process.env.VUE_APP_URL}/users`)
                    .then(response => {
                        this.users = response.data.data;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            destroy(id, index) {
                if(confirm('Вы действительно хотите удалить ?')) {
                    this.axios.delete(`${process.env.VUE_APP_URL}/users/${id}`)
                        .then(response => {
                            if(response.status === 204) {
                                this.users.splice(index, 1);
                            }
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }
            }
        }
    }
</script>

<style scoped>
    thead > tr th {
        border-top: unset !important;
    }
</style>