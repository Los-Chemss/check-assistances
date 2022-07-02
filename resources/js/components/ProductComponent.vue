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
              @click="openModal('products', 'store')"
            >
              New Product
            </button>
          </div>
          <div class="card-body">
            <h4 class="card-title">Products</h4>
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
                          criterio == 'purchase_price' || criterio === 'sale_price'
                            ? 'number'
                            : 'text'
                        "
                        v-model="buscar"
                        @keyup.enter="listProducts(1, buscar, criterio)"
                        class="form-control"
                        :placeholder="
                          criterio == 'name'
                            ? 'Product name'
                            : criterio == 'description'
                            ? 'Product description'
                            : '0.00'
                        "
                      />
                      <div class="input-group-append">
                        <button
                          type="submit"
                          @click="listProducts(1, buscar, criterio)"
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
                        <tr v-for="(product, index) in products" v-if="index < 1">
                          <th v-for="(value, key, cIndex) in product">
                            {{ key }}
                          </th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="(product, index) in products"
                          v-if="index <= pagination.per_page"
                        >
                          <td v-for="(value, key, cIndex) in product" max-height="5px">
                            {{ value }}
                          </td>
                          <td>
                            <button
                              type="button"
                              @click="openModal('products', 'update', product)"
                              class="btn btn-warning btn-sm"
                            >
                              <i class="icon-pencil"></i>
                            </button>
                            &nbsp;
                            <button
                              type="button"
                              class="btn btn-danger btn-sm"
                              @click="deleteProduct(product.id)"
                            >
                              <i class="icon-trash"></i>
                            </button>
                          </td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr></tr>
                        <tr v-for="(product, index) in products" v-if="index < 1">
                          <th
                            v-for="(value, key, cIndex) in product"
                            v-if="key != 'customerId' || key != 'embershipId'"
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
                    <label for="name">Nombre</label>
                    <input
                      type="text"
                      class="form-control"
                      id="name"
                      v-model="product.name"
                    />
                  </div>
                  <div class="form-group mb-5">
                    <label for="description">Descripcion</label>
                    <input
                      type="text"
                      class="form-control"
                      id="description"
                      v-model="product.description"
                    />
                  </div>
                  <div class="form-group mb-5">
                    <label for="purchase_price">Precio de compra</label>
                    <input
                      type="number"
                      class="form-control"
                      id="purchase_price"
                      v-model="product.purchase_price"
                    />
                  </div>
                  <div class="form-group mb-5">
                    <label for="sale_price">Precio de venta</label>
                    <input
                      type="number"
                      class="form-control"
                      id="sale_price"
                      v-model="product.sale_price"
                    />
                  </div>
                </form>
              </div>
            </div>
            <!-- form -->
            <div class="modal-footer">
              <button
                v-if="actionType == 1"
                type="button"
                class="btn btn-primary fas fa-save"
                @click="saveProduct"
              >
                Save
              </button>
              <button
                v-if="actionType == 2"
                type="button"
                class="btn btn-primary fas fa-save"
                @click="updateProduct"
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
      products: [],
      product: {
        name: null,
        description: null,
        sale_price: null,
        purchase_price: null,
        id: null,
      },
      //   memberships: [],
      customers: [],
      modal: "",
      modalTitle: "",
      actionType: 0,
      errors: null,
      //   name: null,
      //   expires_at: null,
      //   amount: 0,
      membership: null,
      //   selectedMembership: null,
      //   selectedCustomer: null,

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
      product_id: null,
      showProducts: 10,
      criterions: ["name", "description", "purchase_price", "sale_price"],
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
    // filter: this.listProducts(this.page, this.buscar, this.criterio),
  },

  methods: {
    listProducts(page, buscar, criterio) {
      console.log("getted");
      let me = this;
      this.loading=true
      let url = "products?page=" + page + "&buscar=" + buscar + "&criterio=" + criterio;
      axios
        .get(url)
        .then((response) => {
          var respuesta = response.data;
          //   console.log(respuesta);
          me.products = respuesta.products.data;
          me.pagination = respuesta.pagination;
        })
        .catch((error) => {
          console.table(error);
        }) .finally(() => (this.loading = false));;
    },

    getMemberships() {
      let me = this;
      axios
        .get("select-memberships")
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
        .get("customers-select")
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
      this.showProducts = newVal;
    },

    saveProduct() {
      let me = this;
      this.loading=true
      let request = {
        name: me.product.name,
        description: me.product.description,
        sale_price: me.product.sale_price,
        purchase_price: me.product.purchase_price,
      };
      axios
        .post("products", request)
        .then((response) => {
          let respuesta = response.data;
          console.log({ respuesta });
          let message = "Ha agregado un producto";
          Swal.fire({
            type: "success",
            title: "Registro  de producto satisfactorio",
            text: message,
            timer: 3000,
          });
        })
        .catch((error) => {
          console.table({ error });
          let errors = error.response.data.errors;
          let message = "";
          if (errors) {
            Object.entries(errors).forEach((err) => {
              let e = err[1] + "<br>";
              message = message + e;
            });
          }
          Swal.fire({
            type: "error",
            title: "No se pudo crear",
            html: message,
            timer: 3000,
          });
          console.log({ error });
        }) .finally(() => (this.loading = false));;
      this.closeModal();
    },

    updateProduct() {
      let me = this;
      this.loading=true
      let request = {
        name: me.product.name,
        description: me.product.description,
        sale_price: me.product.sale_price,
        purchase_price: me.product.purchase_price,
        id: me.product.id,
      };
      axios
        .put("products/" + request.id, request)
        .then((response) => {
          let respuesta = response.data;
          Swal.fire({
            type: "success",
            title: "Productos actualizado",
            text: "Productos actualizado exitosamente",
            timer: 8000,
          });
        })
        .catch((error) => {
          Swal.fire({
            type: "error",
            title: "No actualizado",
            text: "No se pudo guardar cambios :(",
            timer: 8000,
          });
          console.table(error);
        }) .finally(() => (this.loading = false));;
      this.closeModal();
    },

    closeModal() {
      this.modal = 0;
      this.product.name = "";
      this.product.description = "";
      this.product.purchase_price = "";
      this.product.sale_price = "";
      this.errors = {};
      this.listProducts(this.pagination.current_page, this.buscar, this.criterio);
    },

    async openModal(model, action, data = []) {
      console.log(data);
      switch (model) {
        case "products": {
          switch (action) {
            case "store": {
              this.modal = 1;
              this.modalTitle = "New product";
              this.actionType = 1;
              this.product.name = "";
              this.product.description = "";
              this.product.purchase_price = "";
              this.product.sale_price = "";
              break;
            }
            case "update": {
              this.modal = 1;
              this.modalTitle = "Update product";
              this.actionType = 2;
              this.product.name = data.name;
              this.product.description = data.description;
              this.product.purchase_price = data.purchase_price;
              this.product.sale_price = data.sale_price;
              this.product.id = data.id;
              break;
            }
          }
        }
      }
    },

    deleteProduct(product) {this.loading=true
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
            .delete("products/" + product)
            .then((response) => {
              console.log(response);
              Swal.fire({
                type: "success",
                title: "Registro  eliminado con éxito",
                text: "El producto ha sido eliminado !",
                timer: 5000,
              });
              //   console.log(response);
              me.listProducts(me.page, me.buscar, me.criterio);
            })
            .catch((error) => {
              Swal.fire({
                type: "error",
                title: "No pudo ser eliminado",
                text: "Verifique si hay datos que dependan de éste",
                timer: 5000,
              });
              console.log(error);
            }) .finally(() => (this.loading = false));;
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    },

    //Paginator
    cambiarPagina(page, buscar, criterio) {
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.listProducts(page, buscar, criterio);
    },
  },

  mounted() {
    this.listProducts(1, this.buscar, this.criterio);
  },
};
</script>
