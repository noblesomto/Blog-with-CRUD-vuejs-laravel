import {createRouter, createWebHistory } from "vue-router";
import Home from "../components/frontend/Home.vue";
import BlogPage from "../components/frontend/BlogPage.vue";
import About from "../components/frontend/About.vue";
import Register from "../components/frontend/Register.vue";
import Login from "../components/frontend/Login.vue";
import Dashboard from "../components/dashboard/Dashboard.vue";
import NewPost from "../components/dashboard/blog/NewPost.vue";
import AllPost from "../components/dashboard/blog/AllPost.vue";
import EditPost from "../components/dashboard/blog/EditPost.vue";

const routes = [
    {
        path: "/",
        name: "home",
        component: Home,
    },
    {
        path: "/post-details/:blog_id",
        name: "post-details",
        component: BlogPage,
    },
    {
        path: "/about",
        name: "about",
        component: About,
    },
    {
        path: "/register",
        name: "register",
        component: Register,
    },
    {
        path: "/login",
        name: "login",
        component: Login,
    },
    {
        path: "/dashboard",
        name: "dashboard",
        component: Dashboard,
    },
    {
        path: "/new-post",
        name: "new-post",
        component: NewPost,
    },
    {
        path: "/all-post",
        name: "all-post",
        component: AllPost,
    },
    {
        path: "/edit-post/:blog_id",
        name: "edit-post",
        component: EditPost,
    },
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
});

export default router;