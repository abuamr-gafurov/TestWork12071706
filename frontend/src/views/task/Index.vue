<template>
    <Sidebar></Sidebar>
    <App>
        <template v-slot:title>
            {{ title }}
        </template>
        <template v-slot:button>
            <router-link to="/tasks/create" class="btn btn-sm btn-primary shadow-sm">Добавить</router-link>
        </template>

        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ФИО</th>
                                <th>Название</th>
                                <th>Описание</th>
                                <th>Завершено</th>
                                <th>Создано</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(task, index) in tasks" :key="task.id">
                                <th>{{ task.id }}</th>
                                <td>{{ task.user?.name }}</td>
                                <td>{{ task.title }}</td>
                                <td>{{ task.description }}</td>
                                <td>{{ task.completed_at }}</td>
                                <td>{{ task.created_at }}</td>
                                <td class="text-right">
                                    <router-link :to="{name: 'tasks.edit', params: {id: task.id}}" class="mr-2">
                                        <i class="fa fa-edit" title="Редактировать"></i>
                                    </router-link>

                                    <a href="#" @click="destroy(task.id, index)">
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
                title: "Задачи",
                tasks: []
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
                this.axios.get(`${process.env.VUE_APP_URL}/tasks`)
                    .then(response => {
                        this.tasks = response.data.data;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            destroy(id, index) {
                if(confirm('Вы действительно хотите удалить ?')) {
                    this.axios.delete(`${process.env.VUE_APP_URL}/tasks/${id}`)
                        .then(response => {
                            if (response.status === 204) {
                                this.tasks.splice(index, 1);
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

<style scoped>

</style>