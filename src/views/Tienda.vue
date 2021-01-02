<template>
  <div class="container">
    Tienda
    <Topseller></Topseller>
    <div class="nk-gap-1"></div>
    <Shop></Shop>
  </div>
</template>
<script>
import Topseller from "../components/Topseller";
import Shop from "../components/Shop";
import { mapState } from "vuex";

export default {
  components: {
    Topseller,
    Shop,
  },
  computed: {
    ...mapState(["session"]),
  },
  name: "Tienda",
  mounted() {
    if (!this.session.Logged) {
      this.$router.push("/home");
      this.$notify.error(
        "No puedes acceder a esta seccion si no estas loggeado"
      );
    }
  },
};
</script>
