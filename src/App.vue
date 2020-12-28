<template>
  <div>
    <div id="nav">
      <header class="nk-header nk-header-opaque">
        <div class="nk-contacts-top">
          <div class="container">
            <div class="nk-contacts-left">
              <ul class="nk-social-links">
                <li>
                  <a class="nk-social-facebook" href="javascript:void(0)"
                    ><span class="fab fa-facebook"></span
                  ></a>
                </li>
                <li>
                  <a class="nk-social-steam" href="javascript:void(0)"
                    ><span class="fab fa-steam"></span
                  ></a>
                </li>
              </ul>
            </div>
            <div class="nk-contacts-right">
              <ul class="nk-contacts-icons">
                <li v-if="!Logged">
                  <a
                    href="javascript:void(0)"
                    data-toggle="modal"
                    data-target="#modalLogin"
                    v-on:click="$emit('resetloginform')"
                    ><span class="fa fa-user"></span
                  ></a>
                </li>
                <li>
                  <span class="nk-cart-toggle"
                    ><span class="nk-badge">1</span
                    ><span class="fa fa-users"></span
                  ></span>
                  <div class="nk-cart-dropdown">
                    <div class="text-center">
                      <a class="nk-cart-remove-item" href="javascript:void(0)"
                        ><span class="fas fa-times"></span></a
                      ><a href="javascript:void(0)"
                        >No tienes Solicitudes de Amistad</a
                      >
                    </div>
                    <div class="nk-gap-2"></div>
                    <div class="text-center">
                      <a
                        class="nk-btn nk-btn-rounded nk-btn-color-main-1 nk-btn-hover-color-white"
                        href="#"
                        >Ver&nbsp;<strong>todas las Solicitudes</strong></a
                      >
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <nav
          class="navbar-light navbar-expand-md nk-navbar nk-navbar-top nk-navbar-sticky nk-navbar-autohide"
        >
          <div class="container-fluid">
            <div class="nk-nav-table">
              <a class="nk-nav-logo" href="javascript:void(0)"
                ><img
                  src="./assets/img/logo.png"
                  alt="Real Society"
                  width="199"
              /></a>
              <ul
                class="nk-nav nk-nav-right d-none d-lg-table-cell"
                data-nav-mobile="#nk-nav-mobile"
              >
                <li v-for="(item, index) in MenuItems" :key="index">
                  <router-link :to="item.to">{{ item.name }}</router-link>
                </li>
              </ul>
              <ul class="nk-nav nk-nav-right nk-nav-icons">
                <li class="single-icon d-lg-none">
                  <a
                    href="javascript:void(0)"
                    class="no-link-effect"
                    v-b-toggle.nk-nav-mobile
                  >
                    <span class="nk-icon-burger"
                      ><span class="nk-t-1"></span><span class="nk-t-2"></span
                      ><span class="nk-t-3"></span
                    ></span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <div>
        <b-sidebar
          id="nk-nav-mobile"
          backdrop
          backdrop-variant="dark"
          :sidebar-class="[
            'nk-navbar',
            'nk-navbar-side',
            'nk-navbar-right-side',
            'nk-navbar-overlay-content',
            'd-lg-none',
          ]"
          bg-variant="dark"
          text-variant="light"
          :body-class="['nano']"
          right
        >
          <div class="nano-content">
            <a href="javascript:void(0)" class="nk-nav-logo"
              ><img src="./assets/img/logo.png" alt="Real Society" width="199"
            /></a>
            <div class="nk-navbar-mobile-content">
              <div class="nk-nav">
                <li v-for="(item, index) in MenuItems" :key="index">
                  <router-link :to="item.to">{{ item.name }}</router-link>
                </li>
              </div>
            </div>
          </div>
        </b-sidebar>
      </div>
    </div>
    <div><Login v-if="!Logged"></Login></div>
    <router-view />
  </div>
</template>
<style>
@import url("https://fonts.googleapis.com/css?family=Montserrat");
</style>
<style scoped>
.router-link-exact-active {
  border-bottom-color: red;
  border-bottom-width: 1px;
  border-bottom-style: solid;
}
</style>
<script>
import axios from "axios";
import Login from "./components/Login";
import { mapMutations } from "vuex";
export default {
  name: "App",
  components: {
    Login,
  },
  data() {
    return {
      Logged: false,
      MenuItems: [],
    };
  },
  methods: { ...mapMutations["SetSession"] },
  mounted() {
    axios.post(this.API + "/start.php").then((response) => {
      console.log(response);
      this.MenuItems = [
        {
          to: "/servidores",
          name: "Servidores",
        },
        {
          to: "/noticias",
          name: "Noticias",
        },
        {
          to: "/top",
          name: "Top Global",
        },

        {
          to: "/chat",
          name: "Chat Global",
        },
        {
          to: "/tienda",
          name: "tienda",
        },
      ];
    });
  },
};
</script>
 