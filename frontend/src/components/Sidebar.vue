<template>
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#!">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Test Work</div>
        </a>

        <hr class="sidebar-divider my-0">

        <li class="nav-item">
            <router-link :to="{ name: 'users.index'}" class="nav-link">
                <i class="fas fa-fw fa-users"></i>
                <span> Пользователи</span>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link :to="{ name: 'tasks.index'}" class="nav-link">
                <i class="fas fa-fw fa-tasks"></i>
                <span> Задачи</span>
            </router-link>
        </li>
    </ul>
</template>

<script>
    export default {
        data() {
            return {
                name: "Sidebar"
            }
        },
        // mounted() {
        //     this.url();
        // },
        // methods: {
        //     url() {
        //         console.log(this.$route);
        //     }
        // }
    }
</script>
