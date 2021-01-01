<template>
  <div>
    <div
      class="d-md-flex justify-content-md-center align-items-md-center"
      style="margin-top: 50px"
    >
      <div style="background: rgba(0, 0, 0, 0.3)">
        <div style="margin: 10px">
          <h4 class="mb-0">
            <span class="text-main-1">recover</span> password
          </h4>
          <div class="nk-gap"></div>
          <form v-on:submit.prevent="Recover">
            <b-tooltip v-if="bMsg1" :show.sync="bMsg1" target="pass1">{{
              szMsg1
            }}</b-tooltip>
            <b-tooltip v-if="bMsg2" :show.sync="bMsg2" target="pass2">{{
              szMsg2
            }}</b-tooltip>
            <label>New Password</label
            ><input
              id="pass1"
              type="password"
              class="form-control"
              required
              v-model="pass"
            />
            <div class="nk-gap"></div>
            <label>Confirm new Password</label
            ><input
              id="pass2"
              type="password"
              class="form-control"
              required
              v-model="pass2"
            />
            <div class="nk-gap"></div>
            <button
              ref="form"
              class="btn btn-dark nk-btn nk-btn-rounded nk-btn-color-white nk-btn-block"
              type="submit"
              :disabled="pass == '' || pass2 == ''"
            >
              Button
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import trim from "locutus/php/strings/trim";
import { mapState } from "vuex";
import router from "../router";
import axios from "axios";

export default {
  name: "Recover",
  data() {
    return {
      pass: "",
      pass2: "",
      bMsg1: false,
      bMsg2: false,
      szMsg1: "",
      szMsg2: "",
      TimeOut1: null,
      TimeOut2: null,
      Time: 3000,
    };
  },
  methods: {
    Recover() {
      let p1 = trim(this.pass);
      let p2 = trim(this.pass2);
      if (p1 == "") {
        this.pass = "";
        this.DoMsg1("Campo Requerido");
        document.getElementById("pass1").focus();
        return;
      }
      if (p2 == "") {
        this.pass2 = "";
        this.DoMsg2("Campo Requerido");
        document.getElementById("pass2").focus();
        return;
      }
      if (p1 != p2) {
        this.pass2 = "";
        this.DoMsg2("Las contraseñas no coinciden");
        return;
      }
      axios
        .post(this.API + "/recover.php", {
          recover_user: this.session.recover_user,
          recover_token: this.session.recover_token,
          recover_pass: this.pass,
        })
        .then((res) => {
          if (res.data.error == false) {
            this.$notify.success(res.data.message);
          }
          router.push("/home");
        });
    },
    DoMsg1(m) {
      if (this.TimeOut1) {
        clearTimeout(this.TimeOut1);
      }
      this.szMsg1 = m;
      this.bMsg1 = true;
      this.TimeOut1 = setTimeout(() => {
        this.szMsg1 = "";
        this.bMsg1 = false;
      }, this.Time);
    },
    DoMsg2(m) {
      if (this.TimeOut2) {
        clearTimeout(this.TimeOut2);
      }
      this.szMsg2 = m;
      this.bMsg2 = true;
      this.TimeOut2 = setTimeout(() => {
        this.szMsg2 = "";
        this.bMsg2 = false;
      }, this.Time);
    },
  },
  computed: {
    ...mapState(["session"]),
  },
  mounted() {
    this.$parent.$on("SessionLoad", () => {
      if (typeof this.session.recover_token == "undefined") {
        router.push("/home");
        return;
      }
    });
  },
};
</script>