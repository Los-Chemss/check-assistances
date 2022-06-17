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
              @click="openModal('memberships', 'store')"
            >
              New Membership
            </button>
          </div>
          <div class="card-body">
            <h4 class="card-title">Memberships</h4>
            <div class="table-responsive">
              <div
                id="col_render_wrapper"
                class="dataTables_wrapper container-fluid dt-bootstrap4"
              >
                <div class="row">
                  <!--   <div class="col-sm-12 col-md-6">
                  <div class="input-group-prepend" id="col_render_length">
                      <label class="mr-2">Show</label>
                      <select
                        name="col_render_length  "
                        aria-controls="col_render"
                        class="form-control-sm input-group-text"
                        v-model="showMemberships"
                        @change="getRows()"
                      >
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                      </select>
                      <label class="ml-2">entries</label>
                    </div>
                  </div> -->
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
                          criterio == 'period'
                            ? 'date'
                            : criterio == 'price'
                            ? 'number'
                            : 'text'
                        "
                        v-model="buscar"
                        @keyup.enter="listMemberships(1, buscar, criterio)"
                        class="form-control"
                        :placeholder="
                          criterio == 'period'
                            ? '22/07/2022'
                            : criterio == 'price'
                            ? '0123'
                            : 'Benny Juarez'
                        "
                      />
                      <div class="input-group-append">
                        <button
                          type="submit"
                          @click="listMemberships(1, buscar, criterio)"
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
                        <tr v-for="(membership, index) in memberships" v-if="index < 1">
                          <th v-for="(value, key, cIndex) in membership">
                            {{ key }}
                          </th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="(membership, index) in memberships"
                          v-if="index <= pagination.per_page"
                        >
                          <td v-for="(value, key, cIndex) in membership" max-height="5px">
                            {{ value }}
                          </td>
                          <td>
                            <button
                              type="button"
                              @click="openModal('memberships', 'update', membership)"
                              class="btn btn-warning btn-sm"
                            >
                              <i class="icon-pencil"></i>
                            </button>
                            &nbsp;
                            <button
                              type="button"
                              class="btn btn-danger btn-sm"
                              @click="deleteMembership(membership.id)"
                            >
                              <i class="icon-trash"></i>
                            </button>
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
                        <tr v-for="(membership, index) in memberships" v-if="index < 1">
                          <th v-for="(value, key, cIndex) in membership">{{ key }}</th>
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
                    <label for="name">Nombre</label>
                    <input
                      type="text"
                      class="form-control"
                      id="name"
                      placeholder="trimestral"
                      v-model="name"
                    />
                    <!--    <span class="bar"></span> -->
                  </div>
                  <div class="form-group mb-5">
                    <label for="price">Precio</label>
                    <input
                      type="number"
                      class="form-control"
                      id="price"
                      v-model="price"
                    />
                    <!-- <span class="bar"></span> -->
                  </div>
                  <div class="form-group mb-5">
                    <label for="period">Periodo (Duracion en dias)</label>
                    <input
                      type="number"
                      class="form-control text-right"
                      id="period"
                      placeholder="90"
                      v-model="period"
                    />
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
                @click="saveMembership"
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
      memberships: [],
      user: {},
      modal: "",
      modalTitle: "",
      actionType: 0,
      errors: null,
      name: null,
      period: null,
      price: null,
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
      criterio: "name",
      buscar: "",
      showMemberships: 10,
      criterions: ["name", "price", "period"],
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

    // filter: this.getMemberships(this.page, this.buscar, this.criterio),
  },

  methods: {
    listMemberships(page, buscar, criterio) {
      console.log("getted");
      let me = this;
      let url =
        "memberships?page=" + page + "&buscar=" + buscar + "&criterio=" + criterio;
      axios
        .get(url)
        .then((response) => {
          var respuesta = response.data;
          console.log(respuesta);
          me.memberships = respuesta.memberships;
          me.pagination = respuesta.pagination;
        })
        .catch((error) => {
          console.table(error);
        });
    },

    /*     getMemberships() {
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
    }, */

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
      this.showMemberships = newVal;
    },

    saveMembership() {
      let me = this;
      let request = {
        name: me.name,
        price: me.price,
        period: me.period,
      };
      axios
        .post("memberships", request)
        .then((response) => {
          console.log(response);
          let message = "Se ha agregado un nuevo plan de membresia";
          Swal.fire({
            type: "success",
            title: "Registro  de membresia satisfactorio",
            text: message,
            timer: 8000,
          });
        })
        .catch((error) => {
          Swal.fire({
            type: "error",
            title: "No se pudo crear el registro",
            text: message,
            timer: 3000,
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
        case "memberships": {
          switch (action) {
            case "store": {
              this.modal = 1;
              this.modalTitle = "New membership";
              this.actionType = 1;
              this.name = "";
              this.price = "";
              this.period = "";
              break;
            }
            case "update": {
              console.log(data);
              this.modal = 1;
              this.modalTitle = "Update membership";
              this.actionType = 2;
              this.name = data.name;
              this.price = data.price;
              this.period = data.period;
              this.membership_id = data.id;
              break;
            }
          }
        }
      }
    },

    deleteMembership(membership) {
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
            .post("memberships/" + membership + "/delete")
            .then((response) => {
              console.log(response);
              Swal.fire({
                type: "success",
                title: "Registro eliminado",
                text: "Eliminado satisfactoria mente",
                timer: 8000,
              });
              me.listMemberships(me.page, me.buscar, me.criterio);
            })
            .catch((error) => {
              Swal.fire({
                type: "error",
                title: "No se pudo eliminar el registro",
                text: "El registro no pudo ser eliminado",
                timer: 8000,
              });
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
      me.listMemberships(page, buscar, criterio);
    },
  },

  mounted() {
    this.listMemberships(1, this.buscar, this.criterio);
  },
};
</script>
