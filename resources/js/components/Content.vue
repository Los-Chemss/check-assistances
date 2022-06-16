<template>
  <div class="container-fluid">
    <div class="row">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="card">
              <div class="card-header" id="aca">
                <h1 v-if="branch" class="division">
                  <p class="division">Division: {{ branch.division }}</p>
                  <!-- <br /> -->
                  <p class="location">Location: {{ branch.location }}</p>
                </h1>
                <h1 v-else class="bg'danger">
                  <p>No branch selected. Please select one.</p>
                </h1>
                <div class="col-md-8 m-auto"></div>
              </div>
              <div class="card-body">
                <div class="row">
                  <DigitalClock />
                  <div class="col-md-8 m-auto mb-4 shadow-sm pb-4 mt-3 pt-4">
                    <h4 class="card-title text-center text-danger">
                      Put your code for register input or output
                    </h4>
                    <form class="mt-3">
                      <div class="input-group mb-3">
                        <input
                          class="form-control text-center"
                          type="number"
                          v-model="code"
                          placeholder="1921"
                          aria-label=""
                          aria-describedby="basic-addon1"
                          minlength="4"
                          maxlength="4"
                          v-on:keydown.enter.prevent="assistance"
                          required
                        />
                        <div class="input-group-append">
                          <button class="btn btn-info" type="button" @click="assistance">
                            <i class="icon-login"></i>
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
      </div>
    </div>
  </div>
</template>
<script>
// https://codepen.io/gau/pen/LjQwGp
import DigitalClock from "./DigitalClock.vue";
export default {
  components: {
    DigitalClock,
  },
  data() {
    return {
      email: "",
      name: "",
      last_name: "",
      requiredBeAuth: false,
      loading: true,
      user: {},
      summary: [],
      Factors: [],
      scores: null,
      FactorsWithScores: [],
      maritialStatusChanged: null,
      scennariosCopies: [],
      factorsWithSubfactors: [],
      reloadAt: null,
      authenticated: false,
      code: null,

      time: "",
      date: "",
      branches: [],
      branch: null,
      selectedBranch: null,
    };
  },

  created() {
    if (window.Laravel.user) {
      this.email = window.Laravel.user.email;
      this.name = window.Laravel.user.name;
      this.last_name = window.Laravel.user.last_name;
      this.authenticated = true;
      this.branch = window.Laravel.user.branch;
    } else {
      this.authenticated = false;
    }
  },

  mounted() {},

  methods: {
    assistance() {
      let me = this;
      axios
        .post("api/assistances", { branch: me.branch.id, code: me.code })
        .then((response) => {
          console.log(response);
          let movement = null;
          let messagge = null;
          let customer = response.data.customer;
          console.log(customer);
          let info =
            (customer.membership ? "Membership: " + customer.membership.name : "") +
            (customer.membership.payments && customer.membership.payments[0]
              ? "\n Expires at: " + customer.membership.payments[0].expires_at
              : "");

          me.code = "";
          if ("entrada" in response.data) {
            movement = "entrada";
            messagge = "Bienvenido " + customer.name + "\n" + info;
          }
          if ("salida" in response.data) {
            movement = "salida";
            messagge = "Gracias por asistir :) " + customer.name + info;
          }

          Swal.fire({
            type: "success",
            title: "Registro  de " + movement + " satisfactorio",
            text: messagge,
            timer: 4000,
          });
        })
        .catch((error) => {
          console.log(error);
          if (error.response.status === 404) {
            Swal.fire({
              type: "error",
              title: "Codigo invalido",
              text: "El codigo es invalido",
              timer: 4000,
            });
          }
        });
    },
  },
};
</script>
<style lang="scss" scoped>
.card {
  width: 100%;
}

.card {
  background: #0f3854;
  background: radial-gradient(ellipse at center, #0a2e38 0%, #000000 70%);
  background-size: 100%;
}

.card-header {
  font-family: "Share Tech Mono", monospace;
  color: #240303;
  text-align: center;
  position: relative;
  left: 50%;
  top: 10%;
  transform: translate(-50%, -50%);
  color: #daf6ff;
  text-shadow: 0 0 20px rgba(10, 175, 230, 1), 0 0 20px rgba(10, 175, 230, 0);
  .division {
    letter-spacing: 0.05em;
    font-size: 45px;
    // font-size: 80px;
    padding: 5px 0;
  }
  .location {
    letter-spacing: 0.1em;
    font-size: 24px;
  }
  .text {
    letter-spacing: 0.1em;
    font-size: 12px;
    padding: 20px 0 0;
  }
}
</style>
