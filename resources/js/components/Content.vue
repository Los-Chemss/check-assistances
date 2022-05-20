<template>
  <div class="container-fluid">
    <div class="row">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="card">
              <div class="card-header">
                <h1 v-if="branch" class="bg'">
                  <p>Division: {{ branch.division }}</p>
                  <!-- <br /> -->
                  <p>Location: {{ branch.location }}</p>
                </h1>
                <h1 v-else class="bg'danger">
                  <p>No branch selected. Please select one.</p>
                </h1>
                <!--   <h1
                  class="text-center rounded"

                >
                  {{ branch ? branch : "" }}

                    <p ></p>


                </h1> -->
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

          if ("entrada" in response.data) {
            movement = "entrada";
            messagge = "Bienvenido " + customer.name;
          }
          if ("salida" in response.data) {
            movement = "salida";
            messagge = "Gracias por asistir :) " + customer.name;
          }

          Swal.fire({
            type: "success",
            title: "Registro  de " + movement + " satisfactorio",
            text: messagge,
          });
        })
        .catch((error) => {
          console.table(error);
        });
    },
  },
};
</script>
<style scoped>
.card {
  width: 100%;
}
</style>
