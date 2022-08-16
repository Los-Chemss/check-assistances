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
          <!--  <div class="card-header border-bottom shadow-sm pt-4 mt-4 pb-2 mb-22">
            <button
              type="button"
              class="btn btn-primary btn-lg fas fa-edit"
              @click="openModal('assistances', 'store')"
            >
              New Assistance
            </button>
          </div> -->
          <div class="card-body">
            <!-- <h4 class="card-title">Assistances</h4> -->
            <div class="table-responsive">
              <div
                id="col_render_wrapper"
                class="dataTables_wrapper container-fluid dt-bootstrap4"
              >
                <div class="row">
                  <div class="col-sm-12 col-md-6">
                    <div class="input-group mb-3 dataTables_filter">
                      <div class="input-group-prepend">
                        <!--  <span class="input-group-text">$</span> -->
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
                          criterio == 'income'
                            ? 'date'
                            : criterio == 'code'
                            ? 'number'
                            : 'text'
                        "
                        v-model="buscar"
                        @keyup.enter="getAssistances(1, buscar, criterio)"
                        class="form-control"
                        :placeholder="
                          criterio == 'income'
                            ? '22/07/2022'
                            : criterio == 'code'
                            ? '0123'
                            : 'Benny Juarez'
                        "
                      />
                      <div class="input-group-append">
                        <button
                          type="submit"
                          @click="getAssistances(1, buscar, criterio)"
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
                        <tr v-for="(assistance, index) in assistances" v-if="index < 1">
                          <th
                            v-for="(value, key, cIndex) in assistance"
                            v-if="!(key === 'nombre')"
                          >
                            {{ key }}
                          </th>
                          <!--  <th></th> -->
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="(assistance, index) in assistances"
                          v-if="index <= pagination.per_page"
                        >
                          <td
                            v-for="(value, key, cIndex) in assistance"
                            max-height="5px"
                            v-if="!(key === 'nombre')"
                          >
                            {{ value }}
                          </td>
                          <!-- <td>
                            <button
                              type="button"
                              @click="openModal('assistances', 'update', assistance)"
                              class="btn btn-warning btn-sm"
                            >
                              <i class="icon-pencil"></i>
                            </button>
                            &nbsp;
                            <button
                              type="button"
                              class="btn btn-danger btn-sm"
                              @click="deleteAssistance(assistance.id)"
                            >
                              <i class="icon-trash"></i>
                            </button>
                          </td> -->
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr></tr>
                        <tr v-for="(assistance, index) in assistances" v-if="index < 1">
                          <th
                            v-for="(value, key, cIndex) in assistance"
                            v-if="!(key === 'nombre')"
                          >
                            {{ key }}
                          </th>
                          <!--  <th></th> -->
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
                      Mostrando{{ pagination.current_page }} a
                      {{ pagination.per_page }} de {{ pagination.total }} registros
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
                    <label for="membership">Membership</label>
                    <select
                      class="form-control p-0"
                      id="membership"
                      v-model="selectedMembership"
                      @change="selectMembership"
                    >
                      <option></option>
                      <option v-for="membership in memberships" :value="membership">
                        {{ membership.name }}
                      </option>
                    </select>
                    <!--  <label
                      for=""
                      class="border border-danger rounded"
                      v-if="actionType === 2"
                      >{{ selectedMembership }}</label
                    > -->
                    <!-- <span class="bar"></span> -->
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
                @click="saveAssistance"
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
  props: ["customerInfo"],
  data() {
    return {
      loading: false,
      assistances: [],
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
      criterio: "income",
      buscar: "",

      showAssistances: 10,
      criterions: ["income"],
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
    // filter: this.getAssistances(this.page, this.buscar, this.criterio),
  },

  methods: {
    getAssistances(page, buscar, criterio) {
      console.log("getted");
      let me = this;
      let url =
        "customers/" +
        me.customerInfo.id +
        "/assistances?page=" +
        page +
        "&buscar=" +
        buscar +
        "&criterio=" +
        criterio;
      axios
        .get(url)
        .then((response) => {
          console.log(response.data);

          var respuesta = response.data;
          me.assistances = respuesta.asistances;
          me.pagination = respuesta.pagination;
        })
        .catch((error) => {
          console.table(error);
        });
    },

    getMemberships() {
      let me = this;
      axios
        .get("memberships")
        .then((response) => {
          console.log(response);
          var respuesta = response.data;
          me.memberships = respuesta;
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
      this.showAssistances = newVal;
    },

    saveAssistance() {
      let me = this;
      let request = {
        name: me.name,
        code: me.name,
        income: me.income,
        membership: me.membership,
      };
      axios
        .post("assistances/store", request)
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
      console.log(newVal);
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
        case "assistances": {
          switch (action) {
            case "store": {
              this.modal = 1;
              this.modalTitle = "New assistance";
              this.actionType = 1;
              this.name = "";
              this.code = "";
              this.income = "";
              this.selectedMembership = "";
              break;
            }
            case "update": {
              console.log(data);
              let mem = null;
              this.memberships.forEach((m) => {
                if (m.name === data.membership) mem = m;
              });

              // console.log(this.formatDateToInput(new Date(data.income)));
              //   console.log(new Date(data.income).toISOString().slice(0, 10));
              this.modal = 1;
              this.modalTitle = "Update assistance";
              this.actionType = 2;
              this.name = data.name;
              this.code = data.code;
              this.income = new Date(data.income).toISOString().slice(0, 10);
              this.selectedMembership = mem;
              break;
            }
          }
        }
      }
    },

    deleteAssistance(assistance) {
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
            .post("assistances/" + assistance)
            .then((response) => {
              console.log(response);
              me.getAssistances(me.page, me.buscar, me.criterio);
            })
            .catch((error) => {
              console.log(error);
            });
          //
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
      me.getAssistances(page, buscar, criterio);
    },
  },

  mounted() {
    this.getMemberships();
    this.getAssistances(1, this.buscar, this.criterio);
  },
};
</script>
