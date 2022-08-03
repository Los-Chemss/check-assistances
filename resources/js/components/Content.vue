<template>
  <!--  <div class="container-fluid"> -->
  <div class="row">
    <div class="card clockCard">
      <div class="card-body">
        <div class="row">
          <div class="card" id="checkCard">
            <div class="row">
              <div class="col-md-12 ml4">
                <button
                  v-if="fullScreen === 0"
                  @click="openFullscreen()"
                  data-toggle="tooltip"
                  data-placement="bottom"
                  title="Abrir en pantalla completa"
                  data-original-title="Abrir en pantalla completa"
                  type="button"
                  class="btn btn-secondary float-right m-0"
                >
                  <i class="mdi mdi-fullscreen"></i>
                </button>
                <button
                  v-if="fullScreen === 1"
                  @click="closeFullscreen()"
                  data-toggle="tooltip"
                  data-placement="bottom"
                  title="Salir de pantalla completa"
                  data-original-title="Salir de pantalla completa"
                  type="button"
                  class="btn btn-secondary float-right m-0"
                >
                  <i class="mdi mdi-fullscreen-exit"></i>
                </button>
              </div>
              <!--    <div class="col-md-12 text-center m-auto border border-danger">
                <img
                  src="images/urbanlogo-1024x1024.png"
                  height="100px"
                  alt="logo"
                />
              </div> -->
            </div>

            <div class="card-header" id="aca">
              <h1 v-if="branch" class="division">
                <p class="division">Sucursal: {{ branch.division }}</p>
                <!-- <br /> -->
                <p class="location">Direccion: {{ branch.location }}</p>
              </h1>
              <h1 v-else class="bg'danger">
                <p>No branch selected. Please select one.</p>
              </h1>
            </div>
            <div class="card-body">
              <div class="col-md-12">
                <DigitalClock />
                <div class="col-md-8 m-auto mb-4 pb-4 mt-3 pt-4">
                  <h4 class="card-title text-center text-danger">
                    Ingresa tu codigo de socio
                  </h4>
                  <form class="mt-3">
                    <div class="input-group mb-3" name="checkForm">
                      <input
                        class="form-control text-center"
                        id="code"
                        type="number"
                        v-model="code"
                        placeholder="1921"
                        aria-label=""
                        aria-describedby="basic-addon1"
                        minlength="4"
                        maxlength="4"
                        v-on:keydown.enter.prevent="assistance"
                        autofocus
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
  <!--   </div> -->
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
      loading: false,
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

      fullScreen: 0,
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

  mounted() {
    document.getElementById("code").focus();
    // console.log(process.env);
  },

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
            target: document.getElementById("checkCard"),
          });
        })
        .catch((error) => {
          console.table(error);
          if (error.response.status === 404) {
            Swal.fire({
              type: "error",
              title: "Codigo invalido",
              text: "El codigo es invalido",
              timer: 4000,
              target: document.getElementById("checkCard"),
            });
          }
        })
        .finally(() => (me.code = ""));
    },

    openFullscreen() {
      let me = this;
      let elem = document.getElementById("checkCard");
      document.getElementById("code").focus();

      me.fullScreen = 1;
      if (elem.requestFullscreen) {
        elem.requestFullscreen();
      } else if (elem.webkitRequestFullscreen) {
        /* Safari */
        elem.webkitRequestFullscreen();
      } else if (elem.msRequestFullscreen) {
        /* IE11 */
        elem.msRequestFullscreen();
      }
    },

    closeFullscreen() {
      let me = this;
      document.getElementById("code").focus();
      me.fullScreen = 0;
      if (document.exitFullscreen) {
        document.exitFullscreen();
      } else if (document.webkitExitFullscreen) {
        /* Safari */
        document.webkitExitFullscreen();
      } else if (document.msExitFullscreen) {
        /* IE11 */
        document.msExitFullscreen();
      }
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

.card .dark {
  background-color: #daf6ff;
}

.card-body {
  //  opacity: 35%;
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
