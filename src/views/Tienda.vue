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

export default {
  components: {
    Topseller,
    Shop,
  },
  name: "Tienda",
};
</script>
