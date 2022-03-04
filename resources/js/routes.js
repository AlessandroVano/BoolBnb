// DIPENDENZE
import Vue from "vue";
import VueRouter from "vue-router";

// COMPONENTI PER ROTTA
import Home from "./pages/Home.vue";
import AdvancedSearch from "./pages/AdvancedSearch";
import BestApartments from "./pages/BestApartments";
import ApartmentDetails from "./pages/ApartmentDetails";
import NotFound from "./pages/NotFound.vue";

// ATTIVAZIONE ROUTER IN VUE
Vue.use(VueRouter);

// DEFINIZIONE ROTTE
const router = new VueRouter({
    mode: "history",
    linkExactActiveClass: "active",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home,
        },
        {
            path: "/advanced-search",
            name: "advanced-search",
            component: AdvancedSearch,
        },

        {
            path: "/bestapartments",
            name: "bestapartments",
            component: BestApartments,
        },
        {
            path: "/apartments/:slug",
            name: "apartment-details",
            component: ApartmentDetails,
        },
        {
            path: "*",
            name: "not-found",
            component: NotFound,
        }
    ],
});

 // EXPORT DELLE ROTTE PER ESSERE USATO CON import IN ALTRI FILE
 export default router;