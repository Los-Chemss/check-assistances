<template>
  <div v-if="loading" style="heigth: 100%">
    <div class="card shadow p-1 rounded">
      <div class="card-body d-flex justify-content-around">
        <div class="spinner-grow text-success center" role="status">
          <span class="sr-only" style="">Loading...</span>
        </div>
      </div>
    </div>
  </div>
  <div v-else>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <div
                id="col_render_wrapper"
                class="dataTables_wrapper container-fluid dt-bootstrap4"
              >
                <div class="row">
                  <div class="col-sm-12 col-md-6">
                    <div class="input-group mb-3 dataTables_filter">
                      <div class="input-group-prepend">
                        <select
                          class="input-group-text"
                          v-model="criterio"
                          @change="selectCriteria"
                        >
                          <optgroup>
                            <option v-for="criteria in criterions" :value="criteria">
                              {{ criteria }}
                            </option>
                          </optgroup>
                        </select>
                      </div>
                      <input
                        :type="
                          criterio == 'paid_at' || criterio == 'expires_at'
                            ? 'date'
                            : criterio == 'code'
                            ? 'number'
                            : criterio == 'branch'
                            ? 'text'
                            : 'text'
                        "
                        v-model="buscar"
                        @keyup.enter="listPayments(1, buscar, criterio)"
                        class="form-control"
                        :placeholder="
                          criterio == 'paid_at' || criterio == 'expires_at'
                            ? '22/07/2022'
                            : criterio == 'customer'
                            ? 'Nombre o apellidos del cliente'
                            : criterio == 'branch'
                            ? 'Nombre de sucursal o direccion'
                            : 'Monthly'
                        "
                      />
                      <div class="input-group-append">
                        <button
                          type="submit"
                          @click="listPayments(1, buscar, criterio)"
                          class="btn-sm btn-primary input-group-text"
                        >
                          <i class="fa fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 text-right">
                    <button
                      type="button"
                      class="btn btn-primary btn-lg fas fa-edit"
                      @click="openModal('payments', 'store')"
                    >
                      New Payment
                    </button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <table
                      id="col_render"
                      class="table table-bordered table-striped table-sm"
                      style="width: 100%"
                      role="grid"
                      aria-describedby="col_render_info"
                    >
                      <thead>
                        <tr v-for="(payment, index) in payments" v-if="index < 1">
                          <th
                            v-for="(value, key, cIndex) in payment"
                            v-if="
                              !(
                                key === 'customer' ||
                                key === 'customerId' ||
                                key === 'membershipId'
                              )
                            "
                          >
                            {{ key }}
                          </th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="(payment, index) in payments"
                          v-if="index <= pagination.per_page"
                        >
                          <td
                            v-for="(value, key, cIndex) in payment"
                            max-height="5px"
                            v-if="
                              !(
                                key === 'customer' ||
                                key === 'customerId' ||
                                key === 'membershipId'
                              )
                            "
                          >
                            {{ value }}
                          </td>
                          <td>
                            <button
                              type="button"
                              @click="openModal('payments', 'update', payment)"
                              class="btn btn-warning btn-sm"
                            >
                              <i class="icon-pencil"></i>
                            </button>
                            &nbsp;
                            <button
                              type="button"
                              class="btn btn-danger btn-sm"
                              @click="deletePayment(payment.id)"
                            >
                              <i class="icon-trash"></i>
                            </button>
                          </td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr></tr>
                        <tr v-for="(payment, index) in payments" v-if="index < 1">
                          <th
                            v-for="(value, key, cIndex) in payment"
                            v-if="
                              !(
                                key === 'customer' ||
                                key === 'customerId' ||
                                key === 'membershipId'
                              )
                            "
                          >
                            {{ key }}
                          </th>
                          <th></th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 col-md-5">
                    <div
                      class="dataTables_info"
                      id="col_render_info"
                      role="status"
                      aria-live="polite"
                    >
                      Showing {{ pagination.current_page }} to
                      {{ pagination.per_page }} of {{ pagination.total }} entries
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-7">
                    <div
                      class="dataTables_paginate paging_simple_numbers"
                      id="col_render_paginate"
                    >
                      <nav>
                        <ul class="pagination">
                          <li class="page-item" v-if="pagination.current_page > 1">
                            <a
                              class="page-link"
                              href="#"
                              @click.prevent="
                                cambiarPagina(
                                  pagination.current_page - 1,
                                  buscar,
                                  criterio
                                )
                              "
                              >Ant</a
                            >
                          </li>
                          <li
                            class="page-item"
                            v-for="page in pagesNumber"
                            :key="page"
                            :class="[page == isActived ? 'active' : '']"
                          >
                            <a
                              class="page-link"
                              href="#"
                              @click.prevent="cambiarPagina(page, buscar, criterio)"
                              v-text="page"
                            ></a>
                          </li>
                          <li
                            class="page-item"
                            v-if="pagination.current_page < pagination.last_page"
                          >
                            <a
                              class="page-link"
                              href="#"
                              @click.prevent="
                                cambiarPagina(
                                  pagination.current_page + 1,
                                  buscar,
                                  criterio
                                )
                              "
                              >Sig</a
                            >
                          </li>
                        </ul>
                      </nav>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <template v-if="actionType == 1 || actionType == 2">
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
                <form class="">
                  <div class="form-group mb-5">
                    <label for="paid_at">Paid at</label>
                    <input
                      type="date"
                      class="form-control"
                      id="paid_at"
                      v-model="paid_at"
                    />
                    <!--    <span class="bar"></span> -->
                  </div>
                  <div class="form-group mb-5">
                    <label for="membership">Membership</label>
                    <select
                      class="form-control p-0"
                      id="membership"
                      v-model="selectedMembership"
                      @change="selectMembership"
                    >
                      <option></option>
                      <option v-for="membership in memberships" :value="membership">
                        {{ membership.name }} | ${{ membership.price }}
                      </option>
                    </select>
                  </div>
                </form>
                <!--   </div>
                </div> -->
              </div>
            </div>
            <!-- form -->
            <div class="modal-footer">
              <button
                v-if="actionType == 1"
                type="button"
                class="btn btn-primary fas fa-save"
                @click="savePayment"
              >
                Save
              </button>
              <button
                v-if="actionType == 2"
                type="button"
                class="btn btn-primary fas fa-save"
                @click="updatePayment"
              >
                Update
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
  props: ["customerInfo"],
  data() {
    return {
      loading: false,
      payments: [],
      user: {},
      memberships: [],
      customers: [],
      modal: "",
      modalTitle: "",
      actionType: 0,
      errors: null,
      paid_at: null,
      expires_at: null,
      amount: 0,
      membership: null,
      selectedMembership: null,

      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0,
      },
      offset: 3,
      criterio: "paid_at",
      buscar: "",
      payment_id: null,
      showPayments: 10,
      criterions: ["paid_at", "expires_at", "membership", "branch"],
    };
  },

  computed: {
    isActived: function () {
      return this.pagination.current_page;
    },
    //Calcula los elementos de la paginación
    pagesNumber: function () {
      if (!this.pagination.to) {
        return [];
      }
      var from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }

      var to = from + this.offset * 2;
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }
      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    },
    // filter: this.listPayments(this.page, this.buscar, this.criterio),
  },

  methods: {
    listPayments(page, buscar, criterio) {
      let me = this;
      console.log({ info: me.customerInfo.id });
      me.loading = true;
      let url =
        "customers/" +
        me.customerInfo.id +
        "/payments?page=" +
        page +
        "&buscar=" +
        buscar +
        "&criterio=" +
        criterio;
      axios
        .get(url)
        .then((response) => {
          var respuesta = response.data;
          //   console.log(respuesta);
          me.payments = respuesta.payments.data;
          me.pagination = respuesta.pagination;
        })
        .catch((error) => {
          console.table(error);
        })
        .finally(() => (me.loading = false));
    },

    getMemberships() {
      let me = this;
      axios
        .get("memberships/select")
        .then((response) => {
          //   console.log(response);
          var respuesta = response.data;
          me.memberships = respuesta;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getCustomers() {
      let me = this;
      axios
        .get("customers/select")
        .then((response) => {
          //   console.log(response);
          var respuesta = response.data;
          me.customers = respuesta;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    selectCriteria() {
      this.buscar = "";
    },

    getRows(event) {
      let newVal = null;
      if ("criterion" in event) {
        newVal = event;
      } else {
        newVal = JSON.parse(
          JSON.stringify(event.target.options[event.target.options.selectedIndex])
        )._value;
      }
      this.showPayments = newVal;
    },

    savePayment() {
      let me = this;
      let request = {
        paid_at: me.paid_at,
        membership: me.selectedMembership.id,
        customer: me.customerInfo.id,
      };
      axios
        .post("payments/create", request)
        .then((response) => {
          console.log(response);
          //   return;
          let respuesta = response.data;
          let message = "";
          /*   "Ha pagado una membresia " +
            respuesta.membership.name +
            " con una duracion de " +
            respuesta.membership.name +
            " dias. Y expira el " +
            respuesta.payment.expires_at; */
          Swal.fire({
            type: "success",
            title: "Registro  de pago satisfactorio",
            text: message,
            timer: 3000,
          });
          me.listPayments(me.page, me.buscar, me.criterio);
        })
        .catch((error) => {
          let message = me.swalErrorMessage(error.response.data.errors);
          Swal.fire({
            type: "error",
            title: "No se pudo registrar el pago",
            text: message,
            timer: 8000,
          });
          console.table(error);
        });
      this.closeModal();
    },

    updatePayment() {
      let me = this;
      let request = {
        paid_at: me.paid_at,
        membership: me.selectedMembership.id,
        customer: me.customerInfo.id,
        id: me.payment_id,
      };
      axios
        .post("payments/update/" + me.payment_id, request)
        .then((response) => {
          let respuesta = response.data;
          Swal.fire({
            type: "success",
            title: "Pago actualizado",
            text: "Pago actualizado exitosamente",
            timer: 8000,
          });
          me.listPayments(me.page, me.buscar, me.criterio);
        })
        .catch((error) => {
          Swal.fire({
            type: "error",
            title: "No actualizado",
            text: "No se pudo guardar cambios :(",
            timer: 8000,
          });
          console.table(error);
        });
      this.closeModal();
    },

    selectMembership(event) {
      let newVal = null;
      if ("criterion" in event) {
        newVal = event;
      } else {
        newVal = JSON.parse(
          JSON.stringify(event.target.options[event.target.options.selectedIndex])
        )._value;
      }
      this.selectedMembership = newVal;
    },

    closeModal() {
      this.modal = 0;
      this.title = "";
      this.errors = {};
      this.listPayments(this.pagination.current_page, this.buscar, this.criterio);
    },

    async openModal(model, action, data = []) {
      switch (model) {
        case "payments": {
          switch (action) {
            case "store": {
              this.modal = 1;
              this.modalTitle = "New payment";
              this.actionType = 1;
              this.paid_at = "";
              this.selectedMembership = "";
              break;
            }
            case "update": {
              let mem = null;
              this.memberships.forEach((m) => {
                if (m.id === data.membershipId) {
                  mem = m;
                }
              });
              this.modal = 1;
              this.modalTitle = "Update payment";
              this.actionType = 2;
              this.paid_at = new Date(data["paid_at"]).toISOString().slice(0, 10);
              this.selectedMembership = mem;
              this.payment_id = data.id;
              break;
            }
          }
        }
      }
    },

    deletePayment(payment) {
      Swal.fire({
        title: "Esta seguro que desea eliminar este objeto?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar!",
        cancelButtonText: "Cancelar",
        confirmButtonClass: "btn btn-success",
        cancelButtonClass: "btn btn-danger",
        buttonsStyling: false,
        reverseButtons: true,
      }).then((result) => {
        if (result.value) {
          let me = this;
          axios
            .post("payments/delete/" + payment)
            .then((response) => {
              Swal.fire({
                type: "success",
                title: "Registro  eliminado con éxito",
                text: "El pago ha sido eliminado !",
                timer: 5000,
              });
              me.listPayments(me.page, me.buscar, me.criterio);
            })
            .catch((error) => {
              Swal.fire({
                type: "error",
                title: "No pudo ser eliminado",
                text: "Verifique si hay datos que dependan de éste",
                timer: 5000,
              });
              console.log(error);
            });
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    },

    formatDateToInput(date) {
      var d = new Date(date),
        month = "" + (d.getMonth() + 1),
        day = "" + d.getDate(),
        year = d.getFullYear();

      if (month.length < 2) month = "0" + month;
      if (day.length < 2) day = "0" + day;

      return [day, month, year].join("/");
    },

    //Paginator
    cambiarPagina(page, buscar, criterio) {
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.listPayments(page, buscar, criterio);
    },

    swalErrorMessage(errors) {
      let message = "";
      if (errors != null) {
        Object.entries(errors).forEach((err) => {
          let e = "<li>" + err[1] + "</li>" + "<br>";
          message = message + e;
        });
      }
      return message;
    },
  },

  mounted() {
    this.listPayments(1, this.buscar, this.criterio);
    this.getMemberships();
    this.getCustomers();
  },
};
</script>
