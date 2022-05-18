<template>
  <div class="container-fluid">
    <div class="row">
      <div class="card">
        <div class="card-body">
          <div class="col">
            <div class="card">
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

  methods: {
    /*  clock() {
      function time() {
        var d = new Date();
        var s = d.getSeconds();
        var m = d.getMinutes();
        var h = d.getHours();
        span.textContent =
          ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
      }
      setInterval(time, 1000);
    }, */

    /*  getReloader(value) {
      this.reloadAt = value;
    },
 */
    assistance() {
      let me = this;
      axios
        .post("api/assistances", { code: me.code })
        .then((response) => {
          console.log(response);
          Swal.fire({
            type: "success",
            title: "Registro  de entrada | salida",
            text: "Bienvenido || Gcacias. Has asistido x horas",
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
