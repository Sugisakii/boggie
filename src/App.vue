<template>
	<div>
		<div id="nav">
			<header class="nk-header nk-header-opaque">
				<div class="nk-contacts-top">
					<div class="container">
						<div class="nk-contacts-left">
							<ul class="nk-social-links">
								<li>
									<a
										class="nk-social-facebook"
										href="javascript:void(0)"
										><span class="fab fa-facebook"></span
									></a>
								</li>
								<li>
									<a
										class="nk-social-steam"
										href="javascript:void(0)"
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
											<a
												class="nk-cart-remove-item"
												href="javascript:void(0)"
												><span
													class="fas fa-times"
												></span></a
											><a href="javascript:void(0)"
												>No tienes Solicitudes de
												Amistad</a
											>
										</div>
										<div class="nk-gap-2"></div>
										<div class="text-center">
											<a
												class="nk-btn nk-btn-rounded nk-btn-color-main-1 nk-btn-hover-color-white"
												href="#"
												>Ver&nbsp;<strong
													>todas las
													Solicitudes</strong
												></a
											>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<nav
					class="navbar navbar-light navbar-expand-md nk-navbar nk-navbar-top nk-navbar-sticky nk-navbar-autohide"
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
								<li>
									<router-link to="/home">Inicio</router-link>
								</li>
								<li>
									<router-link to="/servidores"
										>Servidores</router-link
									>
								</li>
								<li>
									<router-link to="/noticias"
										>Noticias</router-link
									>
								</li>
								<li>
									<router-link to="/top"
										>Top Global</router-link
									>
								</li>
								<li>
									<router-link to="/chat"
										>Chat Global</router-link
									>
								</li>
								<li>
									<router-link to="/tienda"
										>tienda</router-link
									>
								</li>
							</ul>
							<ul class="nk-nav nk-nav-right nk-nav-icons">
								<li class="single-icon d-lg-none">
									<a
										class="no-link-effect"
										href="#"
										data-nav-toggle="#nk-nav-mobile"
										><span class="nk-icon-burger"
											><span class="nk-t-1"></span
											><span class="nk-t-2"></span
											><span class="nk-t-3"></span></span
									></a>
								</li>
							</ul>
						</div>
					</div>
				</nav>
			</header>
			<div
				id="nk-nav-mobile"
				class="nk-navbar nk-navbar-side nk-navbar-right-side nk-navbar-overlay-content d-lg-none"
			>
				<div class="nano">
					<div class="nano-content">
						<a class="nk-nav-logo" href="/index.html">Link</a>
						<div class="nk-navbar-mobile-content">
							<ul class="nk-nav"></ul>
						</div>
					</div>
				</div>
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
import store from "./store";
export default {
	name: "App",
	components: {
		Login,
	},
	data() {
		return {
			Logged: false,
		};
	},
	methods: { ...mapMutations["SetSession"] },
	mounted() {
		axios.post(this.API + "/start.php").then((response) => {
			console.log(response);
			store.commit("SetSession", response.data);
		});
	},
};
</script>
 