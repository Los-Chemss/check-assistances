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
              @click="openModal('sales', 'store')"
            >
              New Sale
            </button>
          </div>
          <div class="card-body">
            <h4 class="card-title">Sales</h4>
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
                          criterio == 'quantity'
                            ? 'number'
                            : criterio == 'created_at'
                            ? 'date'
                            : 'text'
                        "
                        v-model="buscar"
                        @keyup.enter="listSales(1, buscar, criterio)"
                        class="form-control"
                        :placeholder="
                          criterio == 'created_at'
                            ? '22/07/2022'
                            : criterio == 'product'
                            ? 'Nombre del producto'
                            : criterio == 'quantity'
                            ? '0'
                            : '0.00'
                        "
                      />
                      <div class="input-group-append">
                        <button
                          type="submit"
                          @click="listSales(1, buscar, criterio)"
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
                        <tr v-for="(sale, index) in sales" v-if="index < 1">
                          <th v-for="(value, key, cIndex) in sale">
                            {{ key }}
                          </th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="(sale, index) in sales"
                          v-if="index <= pagination.per_page"
                        >
                          <td v-for="(value, key, cIndex) in sale" max-height="5px">
                            {{ value }}
                          </td>
                          <td>
                            <button
                              type="button"
                              @click="openModal('sales', 'update', sale)"
                              class="btn btn-warning btn-sm"
                            >
                              <i class="icon-pencil"></i>
                            </button>
                            &nbsp;
                            <button
                              type="button"
                              class="btn btn-danger btn-sm"
                              @click="deleteSale(sale.id)"
                            >
                              <i class="icon-trash"></i>
                            </button>
                          </td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr></tr>
                        <tr v-for="(sale, index) in sales" v-if="index < 1">
                          <th v-for="(value, key, cIndex) in sale">
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
                    <label for="quantity">Cantidad</label>
                    <input
                      type="number"
                      class="form-control"
                      id="quantity"
                      v-model="quantity"
                    />
                    <!--    <span class="bar"></span> -->
                  </div>

                  <div class="form-group mb-5">
                    <label for="membership">Product</label>
                    <select
                      class="form-control p-0"
                      id="membership"
                      v-model="selectedProduct"
                      @change="selectProduct"
                    >
                      <option></option>
                      <option v-for="product in products" :value="product">
                        {{ product.name }}
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
                @click="saveSale"
              >
                Save
              </button>
              <button
                v-if="actionType == 2"
                type="button"
                class="btn btn-primary fas fa-save"
                @click="updateSale"
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
  data() {
    return {
      loading: false,
      sales: [],
      user: {},
      memberships: [],
      products: [],
      modal: "",
      modalTitle: "",
      actionType: 0,
      errors: null,
      expires_at: null,
      amount: 0,
      membership: null,
      selectedMembership: null,
      selectedProduct: null,

      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0,
      },
      offset: 3,
      criterio: "product",
      buscar: "",
      sale_id: null,
      showSales: 10,
      criterions: ["quantity", "created_at", "product"],
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
    // filter: this.listSales(this.page, this.buscar, this.criterio),
  },

  methods: {
    listSales(page, buscar, criterio) {
        let me = this;
        this.loading=true
      console.log("getted");
      let url = "sales?page=" + page + "&buscar=" + buscar + "&criterio=" + criterio;
      axios
        .get(url)
        .then((response) => {
          var respuesta = response.data;
          //   console.log(respuesta);
          me.sales = respuesta.sales.data;
          me.pagination = respuesta.pagination;
        })
        .catch((error) => {
          console.table(error);
        }) .finally(() => (this.loading = false));;
    },

    getProducts() {
      let me = this;
      axios
        .get("products/select")
        .then((response) => {
          var respuesta = response.data;
          me.products = respuesta;
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
      this.showSales = newVal;
    },

    saveSale() {
      let me = this;
      let request = {
        quantity: me.quantity,
        product: me.selectedProduct,
      };
      axios
        .post("sales", request)
        .then((response) => {
          let respuesta = response.data;
          let message =
            "Ha pagado una membresia " +
            respuesta.membership.name +
            " con una duracion de " +
            respuesta.membership.name +
            " dias. Y expira el " +
            respuesta.sale.expires_at;
          Swal.fire({
            type: "success",
            title: "Registro  de pago satisfactorio",
            text: message,
            timer: 8000,
          });
           me.listSales(me.page, me.buscar, me.criterio);
        })
        .catch((error) => {
          console.table(error);
        })
      this.closeModal();
    },

    updateSale() {
      let me = this;
      let request = {
        quantity: me.quantity,
        product: me.selectedProduct,
        id: me.sale_id,
      };
      axios
        .put("sales/" + request.id, request)
        .then((response) => {
          let respuesta = response.data;
          Swal.fire({
            type: "success",
            title: "Pago actualizado",
            text: "Pago actualizado exitosamente",
            timer: 8000,
          });
           me.listSales(me.page, me.buscar, me.criterio);
        })
        .catch((error) => {
          Swal.fire({
            type: "error",
            title: "No actualizado",
            text: "No se pudo guardar cambios :(",
            timer: 8000,
          });
          console.table(error);
        })
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

    selectProduct(event) {
      let newVal = null;
      if ("criterion" in event) {
        newVal = event;
      } else {
        newVal = JSON.parse(
          JSON.stringify(event.target.options[event.target.options.selectedIndex])
        )._value;
      }
      this.selectedProduct = newVal;
    },

    closeModal() {
      this.modal = 0;
      this.title = "";
      this.errors = {};
      this.listSales(this.pagination.current_page, this.buscar, this.criterio);
    },

    async openModal(model, action, data = []) {
      switch (model) {
        case "sales": {
          switch (action) {
            case "store": {
              this.modal = 1;
              this.modalTitle = "New sale";
              this.actionType = 1;
              this.paid_at = "";
              this.selectedMembership = "";
              this.selectedProduct = "";
              break;
            }
            case "update": {
              let prod = null;
              this.products.forEach((c) => {
                if (c.id === data.productId) prod = c;
              });
              this.modal = 1;
              this.modalTitle = "Update sale";
              this.actionType = 2;
            //   this.paid_at = new Date(data["paid_at"]).toISOString().slice(0, 10);
            //   this.selectedMembership = mem;
            //   this.selectedProduct = prod;
              this.sale_id = data.id;
              break;
            }
          }
        }
      }
    },

    deleteSale(sale) {
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
            .delete("sales/" + sale)
            .then((response) => {
              Swal.fire({
                type: "success",
                title: "Registro  eliminado con éxito",
                text: "El pago ha sido eliminado !",
                timer: 5000,
              });
              //   console.log(response);
              me.listSales(me.page, me.buscar, me.criterio);
            })
            .catch((error) => {
              Swal.fire({
                type: "error",
                title: "No pudo ser eliminado",
                text: "Verifique si hay datos que dependan de éste",
                timer: 5000,
              });
              console.log(error);
            })
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
      mes.listSales(page, buscar, criterio);
    },
  },

  mounted() {
    this.listSales(1, this.buscar, this.criterio);
    this.getProducts();
  },
};
</script>
