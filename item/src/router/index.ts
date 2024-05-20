import { createRouter, createWebHistory } from "vue-router";
/**
 * router/index.ts
 *
 * Automatic routes for `./src/pages/*.vue`
 */
import Items from "./../pages/index.vue";
import AddItem from "./../pages/AddItem.vue";
import EditItem from "./../pages/EditItem.vue";

const routes = [
  { path: "/", component: Items },
  { path: "/add", component: AddItem },
  { path: "/edit/:id", component: EditItem, props: true }, // Pass ID as prop
];

// Composables

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
});

export default router;
