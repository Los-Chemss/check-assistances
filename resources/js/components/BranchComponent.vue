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
          <div class="card-header border-bottom shadow-sm mt-2 mb-4">
            <div class="row">
              <div class="col-sm-12 col-md-8">
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
                          {{ criteria.val }}
                        </option>
                      </optgroup>
                    </select>
                  </div>

                  <!-- <div v-if="criterio.key === 'between_dates'"> -->
                  <input
                    v-if="criterio.key === 'between_dates'"
                    type="date"
                    v-model="betweenDates['from']"
                    class="form-control"
                    placeholder="22/07/2022"
                    @keyup.enter="listBranches(1, betweenDates, criterio)"
                  />
                  <input
                    v-if="criterio.key === 'between_dates'"
                    type="date"
                    v-model="betweenDates['to']"
                    class="form-control"
                    placeholder="22/07/2022"
                    @keyup.enter="listBranches(1, betweenDates, criterio)"
                  />
                  <input
                    v-else
                    type="text"
                    v-model="buscar"
                    @keyup.enter="listBranches(1, buscar, criterio)"
                    class="form-control"
                    :placeholder="
                      criterio == 'period'
                        ? '22/07/2022'
                        : criterio == 'price'
                        ? '0123'
                        : 'Benny Juarez'
                    "
                  />
                  <!-- </div> -->

                  <div class="input-group-append">
                    <button
                      v-if="criterio.key === 'between_dates'"
                      type="submit"
                      @click="listBranches(1, betweenDates, criterio)"
                      class="btn-sm btn-primary input-group-text"
                    >
                      <i class="fa fa-search"></i>
                    </button>
                    <button
                      v-else
                      type="submit"
                      @click="listBranches(1, buscar, criterio)"
                      class="btn-sm btn-primary input-group-text"
                    >
                      <i class="fa fa-search"></i>
                    </button>
                  </div>
                  <!--  <div class="input-group-append">
                      </div> -->
                </div>
              </div>
              <div class="col-sm-6 col-md-4">
                <button
                  type="button"
                  class="btn btn-primary btn-lg fas fa-edit"
                  @click="openModal('branches', 'store')"
                  style="float: right"
                >
                  Nueva sucursal
                </button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <!-- <h4 class="card-title">Memberships</h4> -->
            <div class="table-responsive">
              <div
                id="col_render_wrapper"
                class="dataTables_wrapper container-fluid dt-bootstrap4"
              >
                <!--  -->
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
                        <tr v-for="(branch, index) in branches" v-if="index < 1">
                          <th v-for="(value, key, cIndex) in branch">
                            {{
                              key == "division"
                                ? "Sucursal"
                                : key === "location"
                                ? "Direccion"
                                : key === "payments_count"
                                ? "Pagos"
                                : key === "payments_sum"
                                ? "Suma de pagos"
                                : key === "sales_count"
                                ? "Ventas"
                                : key === "sales_sum"
                                ? "Suma de ventas"
                                : key === "purchases_count"
                                ? "Gastos"
                                : key === "purchases_sum"
                                ? "Suma de gastos"
                                : key === "id"
                                ? "Id"
                                : ""
                            }}

                            <tr
                              v-if="['payments', 'sales', 'purchases'].includes(key)"
                              style="display: flex"
                            >
                              <th style="justify-content: left; border: 0px">Cantidad</th>
                              <th style="justify-content: right; border: 0px">Suma</th>
                            </tr>
                          </th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="(branch, index) in branches"
                          v-if="index <= pagination.per_page"
                        >
                          <td v-for="(value, key, cIndex) in branch" max-height="5px">
                            {{
                              [
                                "payments_count",
                                "payments_sum",
                                "sales_count",
                                "sales_sum",
                                "purchases_count",
                                "purchases_sum",
                              ].includes(key)
                                ? value.toLocaleString("es-MX")
                                : value
                            }}
                          </td>
                          <td>
                            <button
                              type="button"
                              @click="openModal('branches', 'update', branch)"
                              class="btn btn-warning btn-sm"
                            >
                              <i class="icon-pencil"></i>
                            </button>
                            &nbsp;
                            <button
                              type="button"
                              class="btn btn-danger btn-sm"
                              @click="deleteBranch(branch.id)"
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
                        <tr v-for="(branch, index) in branches" v-if="index < 1">
                          <th v-for="(value, key, cIndex) in branch">
                            {{
                              key == "division"
                                ? "Sucursal"
                                : key === "location"
                                ? "Direccion"
                                : key === "payments_count"
                                ? "Pagos"
                                : key === "payments_sum"
                                ? "Suma de pagos"
                                : key === "sales_count"
                                ? "Ventas"
                                : key === "sales_sum"
                                ? "Suma de ventas"
                                : key === "purchases_count"
                                ? "Gastos"
                                : key === "purchases_sum"
                                ? "Suma de gastos"
                                : key === "id"
                                ? "Id"
                                : ""
                            }}
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
                    <label for="name">Nombre</label>
                    <input
                      type="text"
                      class="form-control"
                      id="name"
                      placeholder="trimestral"
                      v-model="branch.name"
                    />
                    <!--    <span class="bar"></span> -->
                  </div>
                  <div class="form-group mb-5">
                    <label for="price">Precio</label>
                    <input
                      type="number"
                      class="form-control"
                      id="price"
                      v-model="branch.price"
                    />
                    <!-- <span class="bar"></span> -->
                  </div>
                  <div class="form-group mb-5">
                    <label for="period">Periodo (Duracion en dias)</label>
                    <input
                      type="number"
                      class="form-control"
                      id="period"
                      placeholder="90"
                      v-model="branch.period"
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
                v-if="actionType === 1"
                type="button"
                class="btn btn-primary fas fa-save"
                @click="saveMembership"
              >
                Guardar
              </button>
              <button
                v-if="actionType === 2"
                type="button"
                class="btn btn-primary fas fa-save"
                @click="updateMembership"
              >
                Actualizar
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
      branches: [],
      user: {},
      modal: "",
      modalTitle: "",
      actionType: 0,
      errors: null,
      branch: {
        division: null,
        location: null,
        company_id: null,
        id: null,
      },
      //   branch: null,
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
      criterio: { key: "division", val: "Sucursal" },
      buscar: "",
      betweenDates: { from: null, to: null },
      showMemberships: 10,
      criterions: [
        { key: "division", val: "Sucursal" },
        { key: "location", val: "Direccion" },
        { key: "between_dates", val: "Entre que fechas (Desde -> Hasta)" },
      ],
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
    listBranches(page, buscar, criterio) {
      console.log({ buscar });
      console.log(buscar);
      //   console.log(this.betweenDates);
      /*    if (this.betweenDates["from"] != null || this.betweenDates["to"] != null) {
        buscar[this.betweenDates];
      }
      console.log(buscar); */
      let me = this;
      //   me.loading = true;
      let url =
        "branches?page=" +
        page +
        "&buscar=" +
        JSON.stringify(buscar) +
        "&criterio=" +
        criterio.key;
      axios
        .get(url)
        .then((response) => {
          console.log(response);
          //   return;
          var respuesta = response.data;
          console.log(respuesta);
          me.branches = respuesta.branches;
          me.pagination = respuesta.pagination;
        })
        .catch((error) => {
          console.table(error);
        })
        .finally(() => (me.loading = false));
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
      this.showMemberships = newVal;
    },

    saveMembership() {
      let me = this;
      let request = {
        name: me.branch.name,
        price: me.branch.price,
        period: me.branch.period,
      };
      axios
        .post("branches", request)
        .then((response) => {
          let message =
            response.data != undefined
              ? response.data
              : "Se ha agregado un nuevo plan de sucursal";
          Swal.fire({
            type: "success",
            title: "Registro  de sucursal satisfactorio",
            text: message,
            timer: 5000,
          });
          me.listBranches(me.page, me.buscar, me.criterio);
        })
        .catch((error) => {
          console.log(error);
          let message = me.swalErrorMessage(error.response.data.errors);
          Swal.fire({
            type: "error",
            title: "No se pudo crear el registro",
            html: message,
            timer: 8000,
          });
        });
      this.closeModal();
    },

    updateMembership() {
      let me = this;
      let request = {
        name: me.branch.name,
        price: me.branch.price,
        period: me.branch.period,
        id: me.branch.id,
      };
      axios
        .post("branches/" + me.branch.id, request)
        .then((response) => {
          console.log(response);
          let message = "Se ha actualizado un  plan de sucursal";
          Swal.fire({
            type: "success",
            title: "Actualizacion  de sucursal satisfactorio",
            text: message,
            timer: 5000,
          });
          me.listBranches(me.page, me.buscar, me.criterio);
        })
        .catch((error) => {
          let message = me.swalErrorMessage(error.response.data.errors);
          Swal.fire({
            type: "error",
            title: "No se pudo actualizar el registro",
            html: message,
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
      console.log(newVal);
      this.selectedMembership = newVal;
    },

    closeModal() {
      this.modal = 0;
      this.title = "";
      this.errors = {};
      this.listBranches(1, this.buscar, this.criterio);
      //   this.userFiles();//reload component
    },

    openModal(model, action, data = []) {
      switch (model) {
        case "branches": {
          switch (action) {
            case "store": {
              this.modal = 1;
              this.modalTitle = "Crear sucursal";
              this.actionType = 1;
              this.name = "";
              this.price = "";
              this.period = "";
              break;
            }
            case "update": {
              console.log(data);
              console.log(this.branch);
              this.modal = 1;
              this.modalTitle = "Actualizar sucursal";
              this.actionType = 2;
              this.branch.name = data.name;
              this.branch.price = data.price;
              this.branch.period = data.period;
              this.branch.id = data.id;
              break;
            }
          }
        }
      }
    },

    deleteBranch(branch) {
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
            .post("branches/" + branch + "/delete")
            .then((response) => {
              console.log(response);
              Swal.fire({
                type: "success",
                title: "Registro eliminado",
                text: "Eliminado satisfactoria mente",
                timer: 8000,
              });
              me.listBranches(me.page, me.buscar, me.criterio);
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
      me.listBranches(page, buscar, criterio);
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
    this.listBranches(1, this.buscar, this.criterio);
  },
};
</script>
