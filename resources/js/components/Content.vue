<template>
  <!--  <div class="container-fluid"> -->
  <div class="row" style="background: url('/templates/confeti/Confeti.html')">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <!--    style="
              background-image: url('images/fondogym.jpg');
             no-repeat center center; background-size: cover;
            " -->
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
                    <div class="input-group mb-3" name="checkForm">
                      <input
                        :disabled="loading ? true : false"
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
                        style="
                          border: none;
                          opacity: 70%;
                          font-size: 24px;
                          font-weight: bold;
                          letter-spacing: 8px;
                        "
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
// import Confeti from "./extra/Confeti.html";
export default {
  components: {
    DigitalClock,
    // Confeti,
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

  async mounted() {
    await document.getElementById("code").focus();
    // console.log(process.env);
  },

  methods: {
    assistance() {
      let me = this;
      me.loading = true;
      me.run = 1;
      var w = new me.showConfeti();
      axios
        .post("assistances", { branch: me.branch.id, code: me.code })
        .then((response) => {
          console.log(response);
          let movement = null;
          let message = null;
          let customer = response.data.customer;
          console.log(customer);
          me.expired =
            Date.now() > me.cusDate(customer.membership.payments[0].expires_at)
              ? true
              : false;
          me.expiresClose = me.expiresAtWeek(customer.membership.payments[0].expires_at)
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
            customer.image != null ? imgPath : "https://placekitten.com/150/150";
          console.log(customer.image);
          console.log(imgSrc);
          let mamadolores = !(me.expired || me.expiresClose)
            ? '<img src="/images/iconogym2.png"/ ' +
              'style="box-shadow:0 1rem 3rem rgba(68, 122, 17, 0.967), 0 1rem 3rem rgba(0, 0, 0, 0.19);' +
              ' border-radius:50%; rgba(10, 175, 230, 1), 0 0 20px rgba(10, 175, 230, 0);">'
            : "";

          let birthBackdrop = `url("https://placekitten.com/150/150")  left top  no-repeat`;
          let backdrop = me.expired
            ? "#ba0c0c8c"
            : me.expiresClose
            ? "#c29b089c"
            : "#010601e3";

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
          this.showConfeti(1);
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
              mamadolores +
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
            timer: 5000,
          });
          me.loading = false;
          document.getElementById("code").focus();
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
            // this.showConfeti(0)

            /* setTimeout(w._createClass.bind(w), 0),
            setTimeout(w._createClass.bind(w), 3000) */
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
    showConfeti(show) {
      let _createClass = null;
      let Progress = null;
      let Confetti = null;
      if (!show) {
        this.canvas = null;
        console.log("try to stop confeti");
        return;
      } else {
        _createClass = (function () {
          function defineProperties(target, props) {
            for (var i = 0; i < props.length; i++) {
              var descriptor = props[i];
              descriptor.enumerable = descriptor.enumerable || false;
              descriptor.configurable = true;
              if ("value" in descriptor) descriptor.writable = true;
              Object.defineProperty(target, descriptor.key, descriptor);
            }
          }
          return function (Constructor, protoProps, staticProps) {
            if (protoProps) defineProperties(Constructor.prototype, protoProps);
            if (staticProps) defineProperties(Constructor, staticProps);
            return Constructor;
          };
        })();

        function _classCallCheck(instance, Constructor) {
          if (!(instance instanceof Constructor)) {
            throw new TypeError("Cannot call a class as a function");
          }
        }

        Progress = (function () {
          function Progress() {
            var param =
              arguments.length <= 0 || arguments[0] === undefined ? {} : arguments[0];

            _classCallCheck(this, Progress);

            this.timestamp = null;
            this.duration = param.duration || Progress.CONST.DURATION;
            this.progress = 0;
            this.delta = 0;
            this.progress = 0;
            this.isLoop = !!param.isLoop;
            this.reset();
          }

          Progress.prototype.reset = function reset() {
            this.timestamp = null;
          };

          Progress.prototype.start = function start(now) {
            this.timestamp = now;
          };

          Progress.prototype.tick = function tick(now) {
            if (this.timestamp) {
              this.delta = now - this.timestamp;
              this.progress = Math.min(this.delta / this.duration, 1);

              if (this.progress >= 1 && this.isLoop) {
                console.log(this.progress);
                this.start(now);
              }

              return this.progress;
            } else {
              return 0;
            }
          };

          _createClass(Progress, null, [
            {
              key: "CONST",
              get: function get() {
                return {
                  DURATION: 1000,
                };
              },
            },
          ]);

          return Progress;
        })();

        Confetti = (function () {
          function Confetti(param) {
            _classCallCheck(this, Confetti);
            console.log(param);

            this.parent = param.elm || document.body;
            this.canvas = document.createElement("canvas");
            this.ctx = this.canvas.getContext("2d");
            this.width = param.width || this.parent.offsetWidth;
            this.height = param.height || this.parent.offsetHeight;
            this.length = param.length || Confetti.CONST.PAPER_LENGTH;
            this.yRange = param.yRange || this.height * 2;
            this.progress = new Progress({
              duration: param.duration,
              isLoop: true,
            });
            this.rotationRange =
              typeof param.rotationLength === "number" ? param.rotationRange : 10;
            this.speedRange =
              typeof param.speedRange === "number" ? param.speedRange : 10;
            this.sprites = [];

            this.canvas.style.cssText = [
              "display: block",
              "position: absolute",
              "top: 0",
              "left: 0",
              "pointer-events: none",
              "z-index:10000",
            ].join(";");

            this.render = this.render.bind(this);
            this.build();
            this.parent.append(this.canvas);
            this.progress.start(performance.now());
            requestAnimationFrame(this.render);
          }

          Confetti.prototype.build = function build() {
            for (var i = 0; i < this.length; ++i) {
              var canvas = document.createElement("canvas"),
                ctx = canvas.getContext("2d");

              canvas.width = Confetti.CONST.SPRITE_WIDTH;
              canvas.height = Confetti.CONST.SPRITE_HEIGHT;

              canvas.position = {
                initX: Math.random() * this.width,
                initY: -canvas.height - Math.random() * this.yRange,
              };

              canvas.rotation =
                this.rotationRange / 2 - Math.random() * this.rotationRange;
              canvas.speed = this.speedRange / 2 + Math.random() * (this.speedRange / 2);

              ctx.save();
              ctx.fillStyle =
                Confetti.CONST.COLORS[(Math.random() * Confetti.CONST.COLORS.length) | 0];
              ctx.fillRect(0, 0, canvas.width, canvas.height);
              ctx.restore();

              this.sprites.push(canvas);
            }
          };

          Confetti.prototype.render = function render(now) {
            var progress = this.progress.tick(now);

            this.canvas.width = this.width;
            this.canvas.height = this.height;

            for (var i = 0; i < this.length; ++i) {
              this.ctx.save();
              this.ctx.translate(
                this.sprites[i].position.initX +
                  this.sprites[i].rotation * Confetti.CONST.ROTATION_RATE * progress,
                this.sprites[i].position.initY + progress * (this.height + this.yRange)
              );
              this.ctx.rotate(this.sprites[i].rotation);
              this.ctx.drawImage(
                this.sprites[i],
                (-Confetti.CONST.SPRITE_WIDTH *
                  Math.abs(Math.sin(progress * Math.PI * 2 * this.sprites[i].speed))) /
                  2,
                -Confetti.CONST.SPRITE_HEIGHT / 2,
                Confetti.CONST.SPRITE_WIDTH *
                  Math.abs(Math.sin(progress * Math.PI * 2 * this.sprites[i].speed)),
                Confetti.CONST.SPRITE_HEIGHT
              );
              this.ctx.restore();
            }

            requestAnimationFrame(this.render);
          };

          _createClass(Confetti, null, [
            {
              key: "CONST",
              get: function get() {
                return {
                  SPRITE_WIDTH: 9,
                  SPRITE_HEIGHT: 16,
                  PAPER_LENGTH: 100,
                  DURATION: 8000,
                  ROTATION_RATE: 50,
                  COLORS: [
                    "#EF5350",
                    "#EC407A",
                    "#AB47BC",
                    "#7E57C2",
                    "#5C6BC0",
                    "#42A5F5",
                    "#29B6F6",
                    "#26C6DA",
                    "#26A69A",
                    "#66BB6A",
                    "#9CCC65",
                    "#D4E157",
                    "#FFEE58",
                    "#FFCA28",
                    "#FFA726",
                    "#FF7043",
                    "#8D6E63",
                    "#BDBDBD",
                    "#78909C",
                  ],
                };
              },
            },
          ]);
          return Confetti;
        })();

        (function () {
          var DURATION = 8000,
            LENGTH = 120;

          new Confetti({
            width: window.innerWidth,
            height: window.innerHeight,
            length: LENGTH,
            duration: DURATION,
          });

          setTimeout(function () {
            new Confetti({
              width: window.innerWidth,
              height: window.innerHeight,
              length: LENGTH,
              duration: DURATION,
            });
          }, DURATION / 2);
        })();
      }
    },
  },
};
</script>
<style lang="scss">
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
