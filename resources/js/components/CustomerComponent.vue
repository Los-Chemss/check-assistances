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
          <div class="card-header border-bottom shadow-sm pt-4 mt-4 pb-2 mb-22">
            <button
              type="button"
              class="btn btn-primary btn-lg fas fa-edit"
              @click="openModal('customers', 'store')"
            >
              New Customer
            </button>
          </div>
          <div class="card-body">
            <h4 class="card-title">Customers</h4>
            <div class="table-responsive">
              <div
                id="col_render_wrapper"
                class="dataTables_wrapper container-fluid dt-bootstrap4"
              >
                <div class="row">
                  <div class="col-sm-12 col-md-6">
                    <div class="input-group-prepend" id="col_render_length">
                      <label class="mr-2">Show</label>
                      <select
                        name="col_render_length  "
                        aria-controls="col_render"
                        class="form-control-sm input-group-text"
                        v-model="showCustomers"
                        @change="getRows()"
                      >
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                      </select>
                      <label class="ml-2">entries</label>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <div class="input-group mb-3 dataTables_filter">
                      <div class="input-group-prepend">
                        <!--  <span class="input-group-text">$</span> -->

                        <select class="input-group-text" v-model="criterio">
                          <optgroup
                            v-for="(customer, index) in customers"
                            v-if="index < 1"
                          >
                            <option v-for="(value, key, cIndex) in customer" :value="key">
                              {{ key }}
                            </option>
                          </optgroup>
                          <!--  <option value="descripcion">Descripción</option> -->
                        </select>
                      </div>
                      <input
                        type="text"
                        v-model="buscar"
                        @keyup.enter="getCustomers(1, buscar, criterio)"
                        class="form-control"
                        placeholder="Texto a buscar"
                      />
                      <div class="input-group-append">
                        <button
                          type="submit"
                          @click="getCustomers(1, buscar, criterio)"
                          class="btn-sm btn-primary input-group-text"
                        >
                          <i class="fa fa-search"></i>
                        </button>
                      </div>
                    </div>
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
                        <tr v-for="(customer, index) in customers" v-if="index < 1">
                          <th v-for="(value, key, cIndex) in customer">
                            {{ key }}
                          </th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="(customer, index) in customers"
                          v-if="index <= pagination.per_page"
                        >
                          <td v-for="(value, key, cIndex) in customer" max-height="5px">
                            {{ value }}
                          </td>
                          <td>
                            <button
                              type="button"
                              @click="openModal('customers', 'update', customer)"
                              class="btn btn-warning btn-sm"
                            >
                              <i class="icon-pencil"></i>
                            </button>
                            &nbsp;
                            <!--   <template v-if="categoria.condicion">
                              <button
                                type="button"
                                class="btn btn-danger btn-sm"
                                @click="desactivarCategoria(categoria.id)"
                              >
                                <i class="icon-trash"></i>
                              </button>
                            </template>
                            <template v-else>
                              <button
                                type="button"
                                class="btn btn-info btn-sm"
                                @click="activarCategoria(categoria.id)"
                              >
                                <i class="icon-check"></i>
                              </button>
                            </template> -->
                          </td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr></tr>
                        <tr v-for="(customer, index) in customers" v-if="index < 1">
                          <th v-for="(value, key, cIndex) in customer">{{ key }}</th>
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
                      Showing 1 to 10 of 57 entries
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
                <form class="">
                  <div class="form-group mb-5">
                    <label for="name">name</label>
                    <input type="text" class="form-control" id="name" v-model="name" />
                    <!--    <span class="bar"></span> -->
                  </div>
                  <div class="form-group mb-5">
                    <label for="code">code</label>
                    <input type="text" class="form-control" id="code" v-model="code" />
                    <!-- <span class="bar"></span> -->
                  </div>
                  <div class="form-group mb-5">
                    <label for="income">income</label>
                    <input
                      type="date"
                      class="form-control text-right"
                      id="income"
                      v-model="income"
                    />
                    <!-- <span class="bar"></span> -->
                  </div>
                  <div class="form-group mb-5">
                    <select
                      class="form-control p-0"
                      id="input6"
                      v-model="selectedMembership"
                      @change="selectMembership"
                    >
                      <option></option>
                      <option v-for="membership in memberships" :value="membership.id">
                        {{ membership.name }}
                      </option>
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
      loading: false,
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

      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0,
      },
      offset: 3,
      criterio: "nombre",
      buscar: "",

      showCustomers: 10,
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

    filter: this.getCustomers(this.page, this.buscar, this.criterio),
  },

  methods: {
    getCustomers(page, buscar, criterio) {
      console.log("getted");
      let me = this;
      let url =
        "customers/data?page=" + page + "&buscar=" + buscar + "&criterio=" + criterio;
      axios
        .get(url)
        .then((response) => {
          var respuesta = response.data;
          console.log(respuesta.memberships);
          me.customers = respuesta.customers.data;
          me.pagination = respuesta.pagination;
          me.memberships = respuesta.memberships;
        })
        .catch((error) => {
          console.table(error);
        });
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
      this.showCustomers = newVal;
    },

    saveCustomer() {
      let me = this;
      let request = {
        name: me.name,
        code: me.name,
        income: me.income,
        membership: me.membership,
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
            case "update": {
              this.modal = 1;
              this.modalTitle = "Update customer";
              this.actionType = 1;
              this.name = data.name;
              this.code = data.code;
              this.income = data.income;
              this.membership = data.membership;
              break;
            }
          }
        }
      }
    },

    //Paginator
    cambiarPagina(page, buscar, criterio) {
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.getCustomers(page, buscar, criterio);
    },
  },

  mounted() {
    this.getCustomers();
  },
};
</script>
