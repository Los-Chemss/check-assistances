<template>
  <!--  <div class="container-fluid"> -->
  <div
    class="row"
    style="background-image: url('/images/birthday.png') center z-index:99999 "
  >
    <div class="card">
      <div class="card-body">
        <div class="row">
          <!--    style="
              background-image: url('images/fondogym.jpg');
             no-repeat center center; background-size: cover;
            " -->
          <div
            class="card"
            id="checkCard"
          >
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
            </div>

            <div
              class="card-header"
              id="aca"
            >
              <h1
                v-if="branch"
                class="division"
              >
                <p class="division">Sucursal: {{ branch.division }}</p>
                <!-- <br /> -->
                <p class="location">Direccion: {{ branch.location }}</p>
              </h1>
              <h1
                v-else
                class="bg'danger"
              >
                <p>No branch selected. Please select one.</p>
              </h1>
            </div>
            <div class="row mt-4">
              <div
                class="col-md-12 text-center m-auto"
                style="display: flex; justify-content: center; align-items: center"
              >
                <div class="rounded-circle shadow-lg p-4 logo-circle">
                  <img
                    src="images/urbanlogo-1024x1024.png"
                    height="200px"
                    alt="logo"
                    class=""
                  />
                </div>
              </div>
            </div>
            <!-- -->
            <div class="card-body">
              <div class="col-md-12">
                <DigitalClock />
                <!-- <Confeti /> -->
                <div class="col-md-8 m-auto mb-4 pb-4 mt-3 pt-4">
                  <h4 class="card-title text-center text-danger">
                    Ingresa tu codigo de socio
                  </h4>
                  <form class="mt-3">
                    <div
                      class="input-group mb-3"
                      name="checkForm"
                    >
                      <input
                        id="code"
                        ref="code"
                        v-model="code"
                        :disabled="loading ? true : false"
                        class="form-control text-center"
                        type="number"
                        placeholder="1921"
                        aria-label=""
                        aria-describedby="basic-addon1"
                        minlength="4"
                        maxlength="4"
                        v-on:keydown.enter.prevent="assistance"
                        required
                        style="
                          border: none;
                          opacity: 70%;
                          font-size: 24px;
                          font-weight: bold;
                          letter-spacing: 8px;
                        "
                      />
                      <div class="input-group-append">
                        <button
                          class="btn btn-info"
                          type="button"
                          @click="assistance"
                        >
                          <i class="icon-login"></i>
                        </button>
                      </div>
                    </div>
                  </form>

                  <!--  <button @click="startConfetti()" class="btn btn-danger">Start</button>

                  <button @click="stopConfetti()" class="btn btn-info">Stop</button>

                  <button @click="toggleConfetti()" class="btn btn-warning">
                    Toggle
                  </button> -->
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
// import { Confeti } from "../../../public/templates/confeti/confetti-falling-animation/confetti.js";
export default {
  components: {
    DigitalClock,
  },
  data() {
    return {
      appEnv: process.env.MIX_APP_ENV,
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

      expired: null,
      expiresClose: null,
      runn: 0,
      //confetty vars
      maxParticleCount: 150, //set max confetti count
      particleSpeed: 2, //set the particle animation speed
      //   startConfetti, //call to start confetti animation
      //   stopConfetti, //call to stop adding confetti
      //   toggleConfetti, //call to start or stop the confetti animation depending on whether it's already running
      //   removeConfetti, //call to stop the confetti animation and remove all confetti immediately

      colors: [
        "DodgerBlue",
        "OliveDrab",
        "Gold",
        "Pink",
        "SlateBlue",
        "LightBlue",
        "Violet",
        "PaleGreen",
        "SteelBlue",
        "SandyBrown",
        "Chocolate",
        "Crimson",
      ],
      streamingConfetti: false,
      animationTimer: null,
      particles: [],
      waveAngle: 0,
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
    this.$nextTick(() => {
      document.getElementById("code").focus();
    });
  },
  beforeMount() {
    this.$nextTick(() => {
      document.getElementById("code").focus();
    });
  },

  methods: {
    assistance() {
      let me = this;
      me.loading = true;
      me.run = 1;
      //   var w = new me.showConfeti();
      me.startConfetti();
      axios
        .post("assistances", { branch: me.branch.id, code: me.code })
        .then((response) => {
          console.log(response);
          let movement = null;
          let message = null;
          let customer = response.data.customer;
          console.log(customer);

          console.log("membership" in customer ? "TRUE" : "FALSE");
          console.log("payments" in customer.membership ? "TRUE" : "FALSE");
          let expires_at = () => {
            if ("membership" in customer) {
              if ("payments" in customer.membership) {
                console.log("Has pays");
              } else {
                console.log("NO SSHas pays");
              }
            } else {
              console.log("No membership");
            }
          };

          me.expired =
            Date.now() > me.cusDate(customer.membership.payments[0].expires_at)
              ? true
              : false;
          me.expiresClose = me.expiresAtWeek(
            customer.membership.payments[0].expires_at
          )
            ? true
            : false;

          let expirationStatus = me.expired
            ? "<h1 class='text-danger'>Ha expirado </h1>"
            : me.expiresClose
            ? "<h1 class='text-warning'>Esta por expirar </h1>"
            : "";

          let info =
            (customer.membership
              ? "Membresia: " +
                "<b class='text-success'>" +
                customer.membership.name +
                "</b>"
              : "") +
            (customer.membership.payments && customer.membership.payments[0]
              ? "<br> Expira el : " +
                "<b class='text-success'>" +
                me.formatDate(customer.membership.payments[0].expires_at) +
                "</b>"
              : "") +
            "<br>" +
            expirationStatus;

          me.code = "";
          if ("entrada" in response.data) {
            movement = "entrada";
            message =
              "Bienvenido <b class='text-success'> " +
              customer.name +
              " " +
              customer.lastname +
              "</b><br>" +
              info;
          }
          if ("salida" in response.data) {
            movement = "salida";
            message = "Gracias por asistir :) " + customer.name + info;
          }
          // alert(me.appEnv);
          let imgPath =
            me.appEnv === "local"
              ? "/storage/" + customer.image
              : "/storage/app/public/" + customer.image;

          let imgSrc =
            customer.image != null
              ? imgPath
              : "https://placekitten.com/150/150";
          console.log(customer.image);
          console.log(imgSrc);
          let mamadolores = !(me.expired || me.expiresClose)
            ? '<img src="/images/iconogym2.png"/ ' +
              'style="box-shadow:0 1rem 3rem rgba(68, 122, 17, 0.967), 0 1rem 3rem rgba(0, 0, 0, 0.19);' +
              ' border-radius:50%; rgba(10, 175, 230, 1), 0 0 20px rgba(10, 175, 230, 0);">'
            : "";

          let birthBackdrop = `url("../../images/birthday.png")  left top  no-repeat`;
          let backdrop = birthBackdrop; /* me.expired
            ? "#ba0c0c8c"
            : me.expiresClose
            ? "#c29b089c"
            : "#010601e3"; */

          let now = new Date();
          let birth = new Date(customer.birthday);
          let nowDay = now.getDay();
          let nowMonth = now.getMonth();

          let birthDay = birth.getDay();
          let birthMonth = birth.getMonth();

          /* console.log({ day: now.getDay() });
          console.log({ month: now.getMonth() });
          console.log({ day: birth.getDay() });
          console.log({ month: birth.getMonth() }); */
          //   return;

          Swal.fire({
            type: me.expired ? "error" : me.expiresClose ? "info" : "",
            customClass: { popup: "swal-bg" },
            backdrop:
              nowDay === birthDay && nowMonth === birthMonth
                ? backdrop + birthBackdrop
                : backdrop,
            target: document.getElementById("checkCard"),
            html:
              "<div style=' target=' _blank ' > " +
              //   mamadolores +
              " </div>" +
              '<h1 style="color:white;"><b> Registro  de ' +
              movement +
              " satisfactorio</b></h1>" +
              ' <div class="text-center pt-2"> <img src="' +
              imgSrc +
              '"class="img-fluid" style="width:150px; height:150px; box-shadow:0 1rem 3rem rgba(68, 122, 17, 0.967), 0 1rem 3rem rgba(0, 0, 0, 0.19);' +
              ' border-radius:50%" alt="customer-image"/> <br>  <h1 style="margin-top:10px;">' +
              message +
              " </h1></div>",
            // timer: 5000,
          });
          me.loading = false;
        })

        .catch((error) => {
          console.table(error);
          if (error.response.status === 404) {
            Swal.fire({
              type: "error",
              // background: "#070707",
              // color: "white",
              backdrop: "#ba0c0c8c",
              title: "Codigo invalido",
              text: "El codigo es invalido",
              // timer: 4000,
              target: document.getElementById("checkCard"),
            });
          }
          document.getElementById("code").focus();
        })
        .finally(
          async () => (
            (me.code = ""),
            (me.expired = null),
            (me.expiresClose = null),
            (me.loading = false),
            await document.getElementById("code").focus(),
            (me.run = 0)
          )
        );
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

    formatDate(date) {
      let d = new Date(date);
      let month = (d.getMonth() + 1).toString();
      let day = d.getDate().toString();
      let year = d.getFullYear();
      if (month.length < 2) {
        month = "0" + month;
      }
      if (day.length < 2) {
        day = "0" + day;
      }
      return [year, month, day].join("-");
    },
    expiresAtWeek(value) {
      let d1 = new Date();
      let d2 = new Date(value);
      let d3 = d1;
      let d4 = new Date(d3.setDate(d3.getDate() + 7));
      return d4.getTime() > d2.getTime() ? 1 : 0;
    },
    cusDate(value) {
      if (value) {
        return new Date(value);
      }
    },

    /*  openConfeti() {
      this.showConfeti();
    },
    closeConfeti() {
      null;
    }, */
    //cONFETI SCRIPT
    // showConfeti() {

    //   (function () {

    startConfetti() {
      console.log("Start");
      this.startConfettiInner();
    },
    stopConfetti() {
      console.log("Start");
      return this.stopConfettiInner;
    },
    toggleConfetti() {
      return this.toggleConfettiInner;
    },
    removeConfetti() {
      return this.removeConfettiInner;
    },
    /*
        stopConfetti = stopConfettiInner;
        toggleConfetti = toggleConfettiInner;
        removeConfetti = removeConfettiInner;
 */
    /* function */
    resetParticle(particle, width, height) {
      let colors = this.colors;
      particle.color = colors[(Math.random() * colors.length) | 0];
      particle.x = Math.random() * width;
      particle.y = Math.random() * height - height;
      particle.diameter = Math.random() * 10 + 5;
      particle.tilt = Math.random() * 10 - 10;
      particle.tiltAngleIncrement = Math.random() * 0.07 + 0.05;
      particle.tiltAngle = 0;
      return particle;
    },

    startConfettiInner() {
      console.log("Start inner");
      let me = this;
      let particles = me.particles;
      var width = window.innerWidth;
      var height = window.innerHeight;
      window.requestAnimFrame = function () {
        return (
          window.requestAnimationFrame ||
          window.webkitRequestAnimationFrame ||
          window.mozRequestAnimationFrame ||
          window.oRequestAnimationFrame ||
          window.msRequestAnimationFrame ||
          function (callback) {
            return window.setTimeout(callback, 16.6666667);
          }
        );
      };
      var canvas = document.getElementById("confetti-canvas");
      if (canvas === null) {
        canvas = document.createElement("canvas");
        canvas.setAttribute("id", "confetti-canvas");
        canvas.setAttribute(
          "style",
          "display:block;z-index:999999;pointer-events:none"
        );
        document.body.appendChild(canvas);
        canvas.width = width;
        canvas.height = height;
        window.addEventListener(
          "resize",
          function () {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
          },
          true
        );
      }
      var context = canvas.getContext("2d");
      while (particles.length < me.maxParticleCount)
        particles.push(me.resetParticle({}, width, height));
      me.streamingConfetti = true;
      if (me.animationTimer === null) {
        (function runAnimation() {
          context.clearRect(0, 0, window.innerWidth, window.innerHeight);
          if (particles.length === 0) me.animationTimer = null;
          else {
            me.updateParticles();
            me.drawParticles(context);
            me.animationTimer = requestAnimFrame(runAnimation);
          }
        })();
      }
    },

    stopConfettiInner() {
      this.streamingConfetti = false;
    },

    removeConfettiInner() {
      this.stopConfetti();
      this.particles = [];
    },

    toggleConfettiInner() {
      if (this.streamingConfetti) stopConfettiInner();
      else this.startConfettiInner();
    },

    drawParticles(context) {
      let particles = this.particles;
      var particle;
      var x;
      for (var i = 0; i < particles.length; i++) {
        particle = particles[i];
        context.beginPath();
        context.lineWidth = particle.diameter;
        context.strokeStyle = particle.color;
        x = particle.x + particle.tilt;
        context.moveTo(x + particle.diameter / 2, particle.y);
        context.lineTo(x, particle.y + particle.tilt + particle.diameter / 2);
        context.stroke();
      }
    },

    updateParticles() {
      let particles = this.particles;
      var width = window.innerWidth;
      var height = window.innerHeight;
      var particle;
      this.waveAngle += 0.01;
      for (var i = 0; i < particles.length; i++) {
        particle = particles[i];
        if (!this.streamingConfetti && particle.y < -15)
          particle.y = height + 100;
        else {
          particle.tiltAngle += particle.tiltAngleIncrement;
          particle.x += Math.sin(this.waveAngle);
          particle.y +=
            (Math.cos(this.waveAngle) +
              particle.diameter +
              this.particleSpeed) *
            0.5;
          particle.tilt = Math.sin(particle.tiltAngle) * 15;
        }
        if (
          particle.x > width + 20 ||
          particle.x < -20 ||
          particle.y > height
        ) {
          if (
            this.streamingConfetti &&
            particles.length <= this.maxParticleCount
          )
            this.resetParticle(particle, width, height);
          else {
            particles.splice(i, 1);
            i--;
          }
        }
      }
    },
  },
  //   },
};
</script>
<style lang="scss">
body {
  background-image: linear-gradient(to top, #a8edea 0%, #fed6e3 100%);
  min-height: 100vh;
  overflow: hidden;
}

.container {
  margin: 150px auto;
  text-align: center;
}

.swal-bg {
  // color: #000000;
  background: #000000;
  /* background: radial-gradient(ellipse at center, #18380a 0%, #000000 120%); */
  background-size: 100%;
  width: 80%;
  height: 80%;
}
.swal-bg-red {
  color: #000000;
  background: red;
  background-size: 100%;
  width: 80%;
  height: 80%;
}

.swal-bg-yellow {
  color: #000000;
  background: rgb(255 172 0);
  background-size: 100%;
  width: 80%;
  height: 80%;
}
.swal-bg .swal2-content {
  color: white;
  /* text-shadow: 2px 2px 5px white; */
}

/* .swal2-icon.swal2-info {
  border-color: #000000;
  color: #bf1212;
} */

.swal2-icon.swal2-info {
  border-color: #bf8a12;
  color: #bf8a12;
}

.swal2-container.swal2-shown-warning {
  background-color: rgb(169 123 26 / 40%);
}
.swal2-container.swal2-shown-danger {
  background-color: rgb(185 10 10 / 40%);
}

/* .swal2-icon.swal2-error {
  // border-color: #5d4d4d;
} */

.swal2-icon.swal2-error {
  // background-color: #0c0c0c;
}
</style>
<style lang="scss" scoped>
/* body .card {
  background-color: #bf1515 !important;
} */
.card {
  width: 100%;
  margin-bottom: 0;
  background-color: transparent !important;

  background-attachment: fixed;
  background: radial-gradient(
    ellipse at center,
    rgb(10 56 46 / 98%) 0%,
    rgb(0 0 0 / 92%) 70%
  );
  /*   background-image: url("data:html, %3Cdiv%3EHello%3C/div%3E");
  background-image: url(/templates/confeti/Confeti.html);
  background-size: 100%; */
  //   background: radial-gradient(ellipse at center, #0a2e3895 0%, #00000080 70%);

  //   background: #0f3854;
  //   background-image: url("storage/images/fondogym.jpg");
  //   background-image: url('images/fondogym.jpg');
  //   background-image: url("images/fondogym.jpg");
  //   background-repeat: no-repeat;

  //   background-size: 100%;

  //@at-root
}
/* .form-control{
    background-color: transparent !important;
    border:none;
} */

.swal-modal {
  background-color: rgba(4, 23, 8, 0.62);
  border: 3px solid white;
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
.logo-circle {
  background-attachment: fixed;
  background: radial-gradient(
    ellipse at center,
    rgb(255 255 255) 58%,
    rgb(10 56 46 / 21%) 68%
  );
  width: 250px;
  height: 250px;
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>
