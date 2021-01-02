<template>
  <div>Chat Global</div>
</template>

<script>
import { mapState } from "vuex";

export default {
  name: "Chat",
  computed: {
    ...mapState(["session"]),
  },
  mounted() {
    if (!this.session.Logged) {
      this.$notify.error("Para entrar al chat debes estar Loggeado");
      this.$router.go(-1);
    }
  },
};
</script>
