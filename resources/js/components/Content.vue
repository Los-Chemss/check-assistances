<template>
  <div class="container-fluid">
    <div class="row">
      <div class="card">
        <div class="card-body">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <div class="col-md-12 pl-4 pr-4">
                  <select
                    class="select2 form-control custom-select"
                    id="select2-search-hide"
                    style="width: 100%"
                    v-model="selectedBranch"
                    @change="selectBranch"
                  >
                    <option v-for="branch in branches" :value="branch">
                      <p>
                        {{ branch.division }}
                      </p>
                      <br />
                    </option>
                  </select>
                </div>
                <div class="col-md-12 pl-4 pr-4">
                  <h1
                    class="text-center border-bottom text-success"
                    for=""
                    v-text="
                      selectedBranch && selectedBranch['company']
                        ? selectedBranch['company'].name
                        : null
                    "
                  ></h1>
                </div>
              </div>
              <div class="card-body">
                <h1 class="text-cented text-danger">12:17:18</h1>

                <h4 class="card-title">Put your code for register input or output</h4>

                <form class="mt-3">
                  <div class="input-group mb-3">
                    <input
                      type="text"
                      v-model="code"
                      class="form-control"
                      placeholder="1921"
                      aria-label=""
                      aria-describedby="basic-addon1"
                      required
                      minlength="4"
                      maxlength="4"
                      v-on:keydown.enter.prevent="assistance"
                    />
                    <div class="input-group-append">
                      <button class="btn btn-info" type="button" @click="assistance">
                        Go!
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
</template>
<script>
// https://codepen.io/gau/pen/LjQwGp
export default {
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
      selectedBranch: null,
    };
  },

  created() {
    if (window.Laravel.user) {
      this.email = window.Laravel.user.email;
      this.name = window.Laravel.user.name;
      this.last_name = window.Laravel.user.last_name;
      this.authenticated = true;
    } else {
      this.authenticated = false;
    }
  },

  mounted() {
    this.getBranches();
  },

  methods: {
    getBranches() {
      let me = this;

      axios
        .get("api/branches")
        .then((response) => {
          console.log(response);
          me.branches = response.data;
        })
        .catch((error) => {
          console.table(error);
        });
    },

    selectBranch(event) {
      const branch = JSON.parse(
        JSON.stringify(event.target.options[event.target.options.selectedIndex])
      )._value;

      console.log(branch);
      this.selectedBranch = branch;
    },
    assistance() {
      let me = this;
      axios
        .post("api/assistances", { branch: me.selectedBranch.id, code: me.code })
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
