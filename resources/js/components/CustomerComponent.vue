<template></template>
<script>
export default {
  data() {
    return {
      customers: [],
    };
  },
  mounted() {},
  methods: {
    getCustomers() {
      let me = this;

      axios
        .get("api/customers")
        .then((response) => {
          me.customers = response.data;
          console.log(me.customers);
        })
        .catch((error) => {
          console.table(error);
        });
    },
  },
};
</script>
