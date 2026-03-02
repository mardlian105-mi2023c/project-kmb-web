import { createRouter, createWebHistory } from "vue-router";
import Dashboard from "./pages/Dashboard.vue";
import DeliveryForm from "./pages/DeliveryForm.vue";
import CustomerConfirm from "./pages/CustomerConfirm.vue";

const routes = [
  { path: "/", component: Dashboard },
  { path: "/create", component: DeliveryForm },
  { path: "/edit/:id", component: DeliveryForm },
  { path: "/confirm/:token", component: CustomerConfirm },
];

export default createRouter({
  history: createWebHistory(),
  routes,
});
