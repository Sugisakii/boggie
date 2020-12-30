<template>
  <div>
    <div
      id="modalLogin"
      class="nk-modal modal fade"
      tabindex="-1"
      role="dialog"
      aria-hidden="true"
      data-backdrop="static"
    >
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <wait r="Login"></wait>
          <div class="modal-body">
            <button
              class="btn btn-primary close"
              type="button"
              data-dismiss="modal"
              aria-label="Close"
              ref="closebutton"
            >
              <span class="fas fa-times"></span>
            </button>
            <div v-if="mode == 1">
              <h4 class="mb-0"><span class="text-main-1">sign</span> in</h4>
              <div class="nk-gap-1"></div>
              <form class="nk-form text-white" v-on:submit.prevent="Login">
                <div class="form-row">
                  <div class="col">
                    <label><strong>Use email and password:</strong></label
                    ><input
                      type="text"
                      class="form-control"
                      placeholder="Username"
                      required
                      autocomplete="on"
                      v-model="user"
                    />
                    <div class="nk-gap"></div>
                    <input
                      type="password"
                      class="form-control"
                      placeholder="Password"
                      required
                      v-model="pass"
                    />
                    <div class="nk-gap"></div>
                    <button
                      class="btn btn-primary nk-btn nk-btn-rounded nk-btn-color-white nk-btn-block"
                      type="submit"
                    >
                      SIGN IN
                    </button>
                    <div class="nk-gap"></div>
                    <small
                      ><a href="javascript:void(0)" v-on:click="SetMode(2)"
                        >Forgot your password?</a
                      ></small
                    ><small
                      ><a
                        class="float-right"
                        href="javascript:void(0)"
                        v-on:click="SetMode(3)"
                        ><span style="text-decoration: underline"
                          >Not a member? Sign up</span
                        ></a
                      ></small
                    >
                  </div>
                </div>
              </form>
            </div>
            <div v-if="mode == 2">
              <button
                class="btn btn-primary d-inline"
                type="button"
                style="
                  background-color: rgba(0, 0, 0, 0);
                  padding: 0;
                  margin-right: 5px;
                  border: 0px none rgba(255, 255, 255, 0);
                  opacity: 0.5;
                  font-size: 20px;
                "
                v-on:click="Reset"
              >
                <span
                  class="fas fa-chevron-circle-left"
                  style="color: rgba(255, 255, 255, 0.5)"
                ></span>
              </button>
              <h4 class="d-inline mb-0">
                <span class="text-main-1">forgot</span> password
              </h4>
              <form v-on:submit.prevent="ForgotPassword">
                <div class="form-row">
                  <div class="col">
                    <label><strong>Username or Email:</strong></label
                    ><input
                      type="text"
                      class="form-control"
                      placeholder="Username or Email"
                      required
                      v-model="user"
                    />
                    <div class="nk-gap"></div>
                    <button
                      class="btn btn-primary nk-btn nk-btn-rounded nk-btn-color-white nk-btn-block"
                      type="submit"
                    >
                      Recover
                    </button>
                  </div>
                </div>
              </form>
            </div>
            <div v-if="mode == 3">
              <button
                class="btn btn-primary d-inline"
                type="button"
                style="
                  background-color: rgba(0, 0, 0, 0);
                  padding: 0;
                  margin-right: 5px;
                  border: 0px none rgba(255, 255, 255, 0);
                  opacity: 0.5;
                  font-size: 20px;
                "
                v-on:click="Reset"
              >
                <span
                  class="fas fa-chevron-circle-left"
                  style="color: rgba(255, 255, 255, 0.5)"
                ></span>
              </button>
              <h4 class="d-inline mb-0">
                <span class="text-main-1">sign</span> up
              </h4>
              <form v-on:submit.prevent="SignUp">
                <div class="form-row">
                  <div class="col">
                    <label><strong>Username:</strong></label
                    ><input
                      type="text"
                      class="form-control"
                      required
                      v-model="user"
                    />
                    <div class="nk-gap"></div>
                    <label><strong>Email:</strong></label
                    ><input
                      type="email"
                      class="form-control"
                      required
                      v-model="email"
                    />
                    <div class="nk-gap"></div>
                    <label><strong>Password:</strong></label
                    ><input
                      type="password"
                      class="form-control"
                      required
                      v-model="pass"
                    />
                    <div class="nk-gap"></div>
                    <label>Confirm Password:<br /></label
                    ><input
                      type="password"
                      class="form-control"
                      required
                      v-model="pass2"
                    />
                    <div class="nk-gap"></div>
                    <button
                      class="btn btn-primary nk-btn nk-btn-rounded nk-btn-color-white nk-btn-block"
                      type="submit"
                    >
                      register
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";

import wait from "./wait";
import { mapState } from "vuex";
import store from "../store";
export default {
  components: {
    wait,
  },
  name: "Login",
  methods: {
    Login() {
      //alert("Login");
      /*
      this.$wait.start("Login");
      setTimeout(() => {
        this.$wait.end("Login");
        this.$notify.success("Mensaje En viado");
      }, 1000);*/
      this.$wait.start("Login");
      axios
        .post(this.API + "/login.php", {
          user: this.user,
          pass: this.pass,
        })
        .then((res) => {
          this.$wait.end("Login");
          if (res.data.error) {
            return;
          }
          this.$refs["closebutton"].click();
          store.commit("SetSession", res.data);
        });
    },
    Reset() {
      this.mode = 1;
      this.user = "";
      this.pass = "";
      this.pass2 = "";
      this.email = "";
    },
    SetMode(mode) {
      this.Reset();
      this.mode = mode;
    },
    ForgotPassword() {},
    SignIn() {},
  },
  data() {
    return {
      mode: 1,
      user: "",
      pass: "",
      pass2: "",
      email: "",
    };
  },
  mounted() {
    this.$parent.$on("resetloginform", this.Reset);
  },
  computed: {
    ...mapState["session"],
  },
};
</script>

