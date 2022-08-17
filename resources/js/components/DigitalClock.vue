<template>
  <div class="clock-body p-4 m-4 rounded col-md-8 m-auto">
    <div id="clock" class="shadow-lg ">
      <p class="date">{{ clock.date }}</p>
      <p class="time">{{ clock.time }}</p>
      <!-- <p class="text">DIGITAL CLOCK with Vue.js</p> -->
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      clock: { time: "", date: "" },
    //   week: ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"],
      week: ["DOM", "LUN", "MAR", "MIE", "JUE", "VIE", "SAB"],
      timerID: setInterval(this.updateTime, 1000),
    };
  },
  created() {
    this.updateTime();
  },

  methods: {
    updateTime() {
      let me = this;
      var cd = new Date();
      me.clock.time =
        me.zeroPadding(cd.getHours(), 2) +
        ":" +
        me.zeroPadding(cd.getMinutes(), 2) +
        ":" +
        me.zeroPadding(cd.getSeconds(), 2);
      me.clock.date =
        me.zeroPadding(cd.getFullYear(), 4) +
        "-" +
        me.zeroPadding(cd.getMonth() + 1, 2) +
        "-" +
        me.zeroPadding(cd.getDate(), 2) +
        " " +
        me.week[cd.getDay()];
    },

    zeroPadding(num, digit) {
      var zero = "";
      for (var i = 0; i < digit; i++) {
        zero += "0";
      }
      return (zero + num).slice(-digit);
    },
  },
};
</script>
<style lang="scss" scoped>
@import url('https://fonts.cdnfonts.com/css/seven-segment');
.clock-body {
  height: 200px;
}
.clock-body {
/*   background: #0f3854;
  background: radial-gradient(ellipse at center, #0a2e38 0%, #000000 70%);
  background-size: 100%; */
}
p {
  margin: 0;
  padding: 0;
}
#clock {
//   font-family: "Share Tech Mono", monospace;
font-family: 'Seven Segment', sans-serif !important;
  color: #240303;
  text-align: center;
  position: relative;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  color: #daf6ff;
  text-shadow: 0 0 20px rgba(10, 175, 230, 1), 0 0 20px rgba(10, 175, 230, 0);
  .time {
    letter-spacing: 0.05em;
    font-size: 45px;
    // font-size: 80px;
    padding: 5px 0;
  }
  .date {
    letter-spacing: 0.1em;
    font-size: 24px;
  }
  .text {
    letter-spacing: 0.1em;
    font-size: 12px;
    padding: 20px 0 0;
  }
}
.center {
  margin: auto;
  width: 50%;
  border: 3px solid green;
  padding: 10px;
}
</style>
