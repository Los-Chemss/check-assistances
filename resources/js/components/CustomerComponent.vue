<template>
  <div class="card">
    <div class="card-header">
      <button
        type="button"
        class="btn btn-primary btn-lg fas fa-edit"
        @click="openModal('customers', 'store')"
      >
        New Customer
      </button>
    </div>
    <div class="card-body">
      <h4 class="card-title">Editable with Datatable</h4>
      <h6 class="card-subtitle">Just click on word which you want to change and enter</h6>
      <table
        class="table table-striped table-bordered table-responsive"
        id="editable-datatable"
      >
        <thead>
          <tr v-for="(customer, index) in customers" v-if="index < 1">
            <th v-for="(value, key, cIndex) in customer">{{ key }}</th>
          </tr>
        </thead>
        <tbody>
          <tr class="gradeX" v-for="(customer, index) in customers" v-if="index">
            <td v-for="(value, key, cIndex) in customer">{{ value }}</td>
          </tr>
        </tbody>
        <tfoot>
          <tr v-for="(customer, index) in customers" v-if="index < 1">
            <th v-for="(value, key, cIndex) in customer">{{ key }}</th>
          </tr>
        </tfoot>
      </table>
    </div>
    <!-- open modal -->
    <template v-if="actionType == 1">
      <div
        class="modal fade"
        tabindex="-1"
        :class="{ mostrar: modal }"
        role="dialog"
        aria-labelledby="myModalLabel"
        style="display: none; overflow-y: auto"
        aria-hidden="true"
      >
        <div
          class="modal-dialog modal-primary modal-lg"
          style="padding-top: 55px"
          role="document"
        >
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" v-text="modalTitle"></h4>

              <button
                type="button"
                class="close"
                data-dismiss="modal"
                @click="closeModal()"
                aria-label="Close"
              >
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="flex flex-wrap -m-2">
                <!-- name	code	income	created_at	updated_at	company_id	membership_id	membership -->
                <!--   <div class="card">
                  <div class="card-body"> -->
                <form class="floating-labels mt-4">
                  <div class="form-group mb-5">
                    <input type="text" class="form-control" id="name" v-model="name" />
                    <span class="bar"></span>
                    <label for="name">name</label>
                  </div>
                  <div class="form-group mb-5">
                    <input type="text" class="form-control" id="code" v-model="code" />
                    <span class="bar"></span>
                    <label for="code">code</label>
                  </div>
                  <div class="form-group mb-5">
                    <input
                      type="date"
                      class="form-control text-right"
                      id="income"
                      v-model="income"
                    />
                    <label for="income" class="text-right">income</label>
                    <span class="bar"></span>
                  </div>
                  <div class="form-group mb-5">
                    <select
                      class="form-control p-0"
                      id="input6"
                      v-model="selectedMembership"
                      @change="selMembership"
                    >
                      <option></option>
                      <option v-for="membership in memberships" :value="membership.id">
                        {{ membership.name }}
                      </option>
                      <!--  <option>Female</option> -->
                    </select>
                    <span class="bar"></span>
                    <label for="input6">Membership</label>
                  </div>
                </form>
                <!--   </div>
                </div> -->
              </div>
            </div>
            <!-- form -->
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-primary fas fa-save"
                @click="saveCustomer"
              >
                Save
              </button>
              <button
                @click="closeModal()"
                type="button"
                class="btn btn-danger"
                data-dismiss="modal"
              >
                Close
              </button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </template>
  </div>
</template>
<script>
export default {
  data() {
    return {
      customers: [],
      user: {},
      memberships: [],
      modal: "",
      modalTitle: "",
      actionType: 0,
      errors: null,
      name: null,
      code: null,
      income: null,
      membership: null,
      selectedMembership: null,
    };
  },
  mounted() {
    this.getCustomers();
  },
  methods: {
    getCustomers() {
      let me = this;
      axios
        .get("customers/data")
        .then((response) => {
          //   console.log(response);
          me.customers = response.data[0];
          me.memberships = response.data[1];
          console.log(me.customers);
        })
        .catch((error) => {
          console.table(error);
        });
    },

    saveCustomer() {
      let me = this;
      let request = {
        name: me.name,
        code: me.name,
        income: me.income,
        membership: me.membership
      };

      //   console.log({ request });

      axios
        .post("customers/store", request)
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.table(error);
        });
    },

    selMembership(event) {
      console.log(event);
      let newVal = null;

      event.target.options[event.target.options.selectedIndex]
        ? (this.selectedMembership =
            event.target.options[event.target.options.selectedIndex])
        : console.log("Invalid option");
      return;

      console.log(event.target);
      console.log(event.target.options[event.target.options.selectedIndex]);
      //   return;
      if ("criterion" in event) {
        newVal = event;
      } else {
        newVal = JSON.parse(
          JSON.stringify(event.target.options[event.target.options.selectedIndex])
        )._value;
      }
      console.log(newVal);
      this.selectedMembership = event;
    },

    closeModal() {
      this.modal = 0;
      this.title = "";
      this.errors = {};
      //   this.userFiles();//reload component
    },

    openModal(model, action, data = []) {
      switch (model) {
        case "customers": {
          switch (action) {
            case "store": {
              this.modal = 1;
              this.modalTitle = "New customer";
              this.actionType = 1;
              /*  this.title = data.title;
              this.description = data.description;
              this.expiry_date = data.expiry_date;
              this.issued_date = data.issued_date; */
              break;
            }
          }
        }
      }
    },
  },
};
</script>
