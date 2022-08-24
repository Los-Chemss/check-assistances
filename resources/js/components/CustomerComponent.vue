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
    <template v-if="template === 0">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header border-bottom shadow-sm pt-4 mt-4 pb-2 mb-22">
              <div class="row">
                <h4 class="card-title">Clientes</h4>
                <br />
                <br />
              </div>
              <div class="row">
                <div class="col-md-8">
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
                    <input
                      :type="
                        criterio.key == 'income'
                          ? 'date'
                          : criterio.key == 'code'
                          ? 'number'
                          : criterio.key == 'branch'
                          ? 'text'
                          : 'text'
                      "
                      v-model="buscar"
                      @keyup.enter="listCustomers(1, buscar, criterio)"
                      class="form-control"
                      :placeholder="
                        criterio.key == 'income'
                          ? '22/07/2022'
                          : criterio.key == 'code'
                          ? '0123'
                          : criterio.key == 'branch'
                          ? 'Nombre de sucursal o direccion'
                          : 'Nombre o apellidos del cliente'
                      "
                    />
                    <div class="input-group-append">
                      <button
                        type="submit"
                        @click="listCustomers(1, buscar, criterio)"
                        class="btn-sm btn-primary input-group-text"
                      >
                        <i class="fa fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <button
                    style="float: right"
                    type="button"
                    class="btn btn-primary btn-lg fas fa-edit"
                    @click="openModal('customers', 'store')"
                  >
                    Nuevo cliente
                  </button>
                </div>
                <br />
                <br />
                <div class="row">
                  <div class="col-md-12">
                    <table>
                      <tr>
                        <td>
                          <div class="circle tgreen"></div>
                        </td>
                        <td>Activo</td>
                      </tr>
                      <tr>
                        <td>
                          <div class="circle tyellow"></div>
                        </td>
                        <td>Expira pronto (7 dias o menos)</td>
                      </tr>
                      <tr>
                        <td>
                          <div class="circle tred"></div>
                        </td>
                        <td>Expirado</td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <div
                  id="col_render_wrapper"
                  class="dataTables_wrapper container-fluid dt-bootstrap4"
                >
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
                            <th></th>
                            <th
                              v-for="(value, key, cIndex) in customer"
                              v-if="
                                !(
                                  key === 'address' ||
                                  key === 'province' ||
                                  key === 'post_code' ||
                                  key === 'phone' ||
                                  key === 'membershipId'
                                )
                              "
                            >
                              {{
                                key === "name"
                                  ? "Nombre"
                                  : key === "lastname"
                                  ? "Apellidos"
                                  : key === "code"
                                  ? "Codigo"
                                  : key === "income"
                                  ? "Ingreso"
                                  : key === "membership"
                                  ? "Membresia"
                                  : key === "last paid"
                                  ? "Ultimo pago"
                                  : key === "expires at"
                                  ? "Expira en"
                                  : key === "branch"
                                  ? "Sucursal"
                                  : key === "postcode"
                                  ? "Codigo postal"
                                  : key === "id"
                                  ? "ID"
                                  : ""
                              }}
                            </th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr
                            v-for="(customer, index) in customers"
                            v-if="index <= pagination.per_page"
                          >
                            <!--   :class="
                              Date.now() > cusDate(customer['expires at']) ||
                              !customer['expires at']
                                ? 'red-triangle'
                                : expiresAtWeek(customer['expires at'])
                                ? 'yellow-triangle'
                                : 'green-triangle'
                            "
                            :style="
                              Date.now() > cusDate(customer['expires at']) ||
                              !customer['expires at']
                                ? ''
                                : expiresAtWeek(customer['expires at'])
                                ? ''
                                : 'background-color:green'
                            " -->
                            <td class="circle-column">
                              <div
                                :class="
                                  Date.now() > cusDate(customer['expires at']) ||
                                  !customer['expires at']
                                    ? 'circle tred'
                                    : expiresAtWeek(customer['expires at'])
                                    ? 'circle tyellow'
                                    : 'circle tgreen'
                                "
                              ></div>
                            </td>
                            <td
                              v-for="(value, key, cIndex) in customer"
                              max-height="5px"
                              v-if="
                                !(
                                  key === 'address' ||
                                  key === 'province' ||
                                  key === 'post_code' ||
                                  key === 'phone' ||
                                  key === 'membershipId'
                                )
                              "
                            >
                              {{
                                key == "last paid" || key == "expires at"
                                  ? formatDateToInput(value)
                                  : value
                              }}
                              <!--   </div> -->
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
                              <button
                                type="button"
                                class="btn btn-danger btn-sm"
                                @click="deleteCustomer(customer.id)"
                              >
                                <i class="icon-trash"></i>
                              </button>
                              &nbsp;
                              <button
                                type="button"
                                class="btn btn-info btn-sm"
                                @click="showCustomer(customer.id)"
                              >
                                <i class="icon-eye"></i>
                              </button>
                            </td>
                          </tr>
                        </tbody>
                        <tfoot>
                          <tr></tr>
                          <tr v-for="(customer, index) in customers" v-if="index < 1">
                            <th></th>
                            <th
                              v-for="(value, key, cIndex) in customer"
                              v-if="
                                !(
                                  key === 'address' ||
                                  key === 'province' ||
                                  key === 'post_code' ||
                                  key === 'phone' ||
                                  key === 'membershipId'
                                )
                              "
                            >
                              {{
                                key === "name"
                                  ? "Nombre"
                                  : key === "lastname"
                                  ? "Apellidos"
                                  : key === "code"
                                  ? "Codigo"
                                  : key === "income"
                                  ? "Ingreso"
                                  : key === "membership"
                                  ? "Membresia"
                                  : key === "last paid"
                                  ? "Ultimo pago"
                                  : key === "expires at"
                                  ? "Expira en"
                                  : key === "branch"
                                  ? "Sucursal"
                                  : key === "postcode"
                                  ? "Codigo postal"
                                  : key === "id"
                                  ? "ID"
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
                        Mostrando {{ pagination.current_page }} a
                        {{ pagination.per_page }} de {{ pagination.total }} refistros
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
                  <!-- <h1>{{ actionType }}</h1> -->
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
                    <!--  <form class="p-2 m-2"> -->
                    <div class="row">
                      <div class="form-group col-md-12">
                        <div class="p-2 w-full">
                          <div class="relative">
                            <label
                              for="attachment"
                              class="leading-7 text-sm text-gray-600"
                              >Imagen del cliente </label
                            ><br />
                            <ul class="nav nav-tabs mb-3">
                              <li class="nav-item">
                                <a
                                  href="#dropZone"
                                  data-toggle="tab"
                                  aria-expanded="false"
                                  class="nav-link active"
                                >
                                  <i class="mdi mdi-upload d-lg-none d-block mr-1"></i>
                                  <span class="d-none d-lg-block">Cargar archivo</span>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a
                                  href="#camera"
                                  data-toggle="tab"
                                  aria-expanded="true"
                                  class="nav-link"
                                >
                                  <i class="mdi mdi-camera d-lg-none d-block mr-1"></i>
                                  <span class="d-none d-lg-block">Abrir camara</span>
                                </a>
                              </li>
                            </ul>
                            <div class="tab-content">
                              <div class="tab-pane active" id="dropZone">
                                <vue-dropzone
                                  ref="myVueDropzone"
                                  id="dropzone"
                                  :options="dropzoneOptions"
                                  @vdropzone-complete="afterUploadComplete"
                                  @vdropzone-sending-multiple="sendMessage"
                                  class="text-center"
                                ></vue-dropzone>
                              </div>
                              <div class="tab-pane" id="camera">
                                <camera @takedPhoto="takedPhoto" />
                              </div>
                            </div>
                            <!--  -->
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="name">Nombre</label>
                        <input
                          type="text"
                          class="form-control"
                          id="name"
                          placeholder="Homero J."
                          v-model="customer.name"
                        />
                        <!--    <span class="bar"></span> -->
                      </div>
                      <div class="form-group col-md-6">
                        <label for="lastname">Apellidos</label>
                        <input
                          placeholder="Simpson"
                          type="text"
                          class="form-control"
                          id="lastname"
                          v-model="customer.lastname"
                        />
                      </div>
                      <!--   <div class="form-group col-md-4">
                        <label for="code">code</label>
                        <input
                          type="text"
                          class="form-control"
                          id="code"
                          v-model="customer.code"
                        />
                      </div> -->
                    </div>
                    <div class="row">
                      <div class="form-group col-md-4">
                        <label for="address">Direccion</label>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Grove St #800 ST Fierro CA"
                          id="address"
                          v-model="customer.address"
                        />
                      </div>
                      <div class="form-group col-md-4">
                        <label for="province">Estado</label>
                        <input
                          type="text"
                          placeholder="California"
                          class="form-control"
                          id="province"
                          v-model="customer.province"
                        />
                      </div>
                      <div class="form-group col-md-4">
                        <label for="postcode">Código postal</label>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="99900"
                          id="postcode"
                          v-model="customer.postcode"
                        />
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group col-md-4">
                        <label for="phone">Numero de telefono</label>
                        <input
                          type="text"
                          placeholder="+5233445555"
                          class="form-control"
                          id="phone"
                          v-model="customer.phone"
                        />
                      </div>
                      <div class="form-group col-md-4">
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
                      </div>

                      <div class="form-group col-md-4">
                        <label for="income">income</label>
                        <input
                          type="date"
                          class="form-control text-right"
                          id="income"
                          v-model="customer.income"
                        />
                      </div>
                    </div>
                  </div>
                </div>
                <!-- form -->

                <div class="modal-footer">
                  <button
                    v-if="actionType === 1"
                    type="button"
                    @click="saveCustomer"
                    class="btn btn-primary fas fa-save"
                  >
                    Guardar
                  </button>
                  <button
                    v-if="actionType === 2"
                    type="button"
                    @click="updateCustomer"
                    class="btn btn-primary fas fa-save"
                  >
                    Actualizar
                  </button>

                  <button
                    @click="closeModal()"
                    type="button"
                    class="btn btn-danger"
                    data-dismiss="modal"
                  >
                    Cancelar
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
    <template v-if="template === 1">
      <button type="btn " class="btn-success" @click="backToList">
        <i class="far fa-arrow-alt-circle-left"></i> Volver a la lista
      </button>
      <div class="row">
        <!-- Column -->
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <!-- <h3 class="card-title">Detalles</h3>
              <h6 class="card-subtitle">{{ customerInfo.name }}</h6> -->
              <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 vcenter">
                  <div class="white-box text-center">
                    <img
                      :src="
                        customerInfo.image != null
                          ? '/storage/' + customerInfo.image
                          : 'https://placekitten.com/150/150'
                      "
                      class="img-fluid rounded-circle shadow-lg p-2"
                      alt="customer-image"
                      style="width: 200px; height: 200px"
                    />
                    <!-- <label for="">{{ customerInfo.image }}</label> -->
                  </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-6">
                  <!-- <h4 class="box-title mt-5">Product description</h4> -->
                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th width="390">Nombre</th>
                          <td>{{ customerInfo.name }}</td>
                        </tr>
                        <tr>
                          <th width="390">Apellidos</th>
                          <td>{{ customerInfo.lastname }}</td>
                        </tr>
                        <tr>
                          <th width="390">Codigo</th>
                          <td>{{ customerInfo.code }}</td>
                        </tr>
                        <tr>
                          <th width="390">Fecha de ingreso</th>
                          <td>{{ customerInfo.income }}</td>
                        </tr>
                        <tr>
                          <th width="390">Direccion</th>
                          <td>{{ customerInfo.province }}</td>
                        </tr>
                        <tr>
                          <th width="390">Estado</th>
                          <td>{{ customerInfo.address }}</td>
                        </tr>
                        <tr>
                          <th width="390">Codigo postal</th>
                          <td>{{ customerInfo.postcode }}</td>
                        </tr>
                        <tr>
                          <th width="390">Membresia</th>
                          <td>
                            {{ customerInfo.membership.name }} |
                            {{ customerInfo.membership.price }}
                          </td>
                        </tr>
                        <tr>
                          <th width="390">Valor del cliente</th>
                          <td>
                            <b> $ {{ customerInfo.value.toLocaleString("es-MX") }} </b>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="card">
                    <div class="card-body">
                      <ul class="nav nav-tabs mb-3">
                        <li class="nav-item">
                          <a
                            href="#home"
                            data-toggle="tab"
                            aria-expanded="false"
                            class="nav-link active"
                          >
                            <i class="mdi mdi-cash-multiple d-lg-none d-block mr-1"></i>
                            <span class="d-none d-lg-block">Pagos</span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a
                            href="#profile"
                            data-toggle="tab"
                            aria-expanded="true"
                            class="nav-link"
                          >
                            <i class="mdi mdi-login-variant d-lg-none d-block mr-1"></i>
                            <span class="d-none d-lg-block">Asistencias</span>
                          </a>
                        </li>
                      </ul>

                      <div class="tab-content">
                        <div class="tab-pane active" id="home">
                          <PaymentsComponent :customerInfo="customerInfo" />
                        </div>
                        <div class="tab-pane" id="profile">
                          <AsistancesComponent :customerInfo="customerInfo" />
                        </div>
                      </div>
                    </div>
                    <!-- end card-body-->
                  </div>
                  <!-- accordions -->
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Column -->
      </div>
    </template>
  </div>
</template>
<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
import Camera from "./extra/Camera.vue";

import PaymentsComponent from "./ofCustomer/PaymentsComponent.vue";
import AsistancesComponent from "./ofCustomer/AssistancesComponent.vue";
export default {
  data() {
    return {
      loading: false,
      dropzoneOptions: {
        url: "/customers/upload-file",
        accept: function (file, done) {
          console.log("uploaded");
          done();
        },
        init: function () {
          this.on("addedfile", function () {
            if (this.files[1] != null) {
              this.removeFile(this.files[0]);
            }
          });
        },
        thumbnailWidth: 150,
        parallelUploads: 1,
        maxFiles: 1,

        uploadMultiple: true,
        autoProcessQueue: false,
        /* resizeWidth: 300,
        resizeHeight: 300, */
        acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg,.pdf,.doc,.docx",
        addRemoveLinks: true,
        dictRemoveFile: "Remover archivo",
        headers: {
          "X-CSRF-TOKEN": document.querySelector("meta[name=csrf-token]").content,
        },
      },
      customers: [],
      user: {},
      template: 0,
      memberships: [],
      modal: "",
      modalTitle: "",
      actionType: 0,
      errors: null,
      customer: {
        name: null,
        lastname: null,
        address: null,
        province: null,
        postcode: null,
        phone: null,
        code: null,
        income: null,
        membership: null,
        id: null,
      },

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

      showCustomers: 10,
      criterions: [
        { key: "name", val: "Nombre" },
        { key: "code", val: "Codigo" },
        { key: "income", val: "Ingreso" },
        { key: "branch", val: "Sucursal" },
      ],
      customerInfo: {
        name: null,
        image: null,
        lastname: null,
        code: null,
        income: null,
        address: null,
        province: null,
        postcode: null,
        phone: null,
        membership: null,
        id: null,
      },
      customerId: 0,
      submitted: false,
      recordMethod: "store",
      currentPhoto: null,
    };
  },
  components: {
    PaymentsComponent,
    AsistancesComponent,
    vueDropzone: vue2Dropzone,
    camera: Camera,
  },

  methods: {
    afterUploadComplete: async function (response) {
      console.log({ response });
      if (response.status == "success") {
        this.sendSuccess = true;
        this.$refs.myVueDropzone.removeAllFiles();
        console.log("upload successful");
      } else {
        console.log("upload failed");
        Swal.fire({
          type: "error",
          title: "❌ El archivo no se subió correctamente  ❌",
          timer: 2000,
          showConfirmButton: false,
        });
      }
    },

    shootMessage: async function () {
      this.submitted = true;
      this.errors = {};
      console.log(Object.keys(this.errors));
      if (Object.keys(this.errors).length) {
        console.log(this.errors);
        return;
      }
      this.$refs.myVueDropzone.processQueue();
    },

    sendMessage: async function (files, xhr, formData) {
      formData.append("id", this.customerId);
      //   formData.append("record_method", this.recordMethod);
    },

    listCustomers(page, buscar, criterio) {
      let me = this;
      me.loading = true;
      me.template = 0;
      let url =
        "customers?page=" + page + "&buscar=" + buscar + "&criterio=" + criterio.key;
      axios
        .get(url)
        .then((response) => {
          console.log(response);
          var respuesta = response.data;
          me.customers = respuesta.customers;
          me.pagination = respuesta.pagination;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => (me.loading = false));
      /*   console.log(
        // { CloseDate: new Date(this.cusCloseDate("2022-08-20")) },
        { 2: new Date("2022-08-20") }
      ); */
    },

    cusDate(value) {
      if (value) {
        return new Date(value);
      }
    },

    expiresAtWeek(value) {
      let d1 = new Date();
      let d2 = new Date(value);
      //   console.log({ d1: this.formatDateToInput(d1) }, { d2: this.formatDateToInput(d2) });
      let d3 = d1;
      let d4 = new Date(d3.setDate(d3.getDate() + 7));
      /*

      console.log({ d1: this.formatDateToInput(d1) }, { d2: this.formatDateToInput(d2) });
      console.log(d4.getTime() > d2.getTime() ? "true" : "false"); */
      return d4.getTime() > d2.getTime() ? 1 : 0;

      //   var same = d1.getTime() === d2.getTime();
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
    selectCriteria() {
      this.buscar = "";
    },
    /*  */
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

    takedPhoto(value) {
      this.$refs.myVueDropzone.removeAllFiles();
      this.currentPhoto = value;
    },

    saveCustomer() {
      let me = this;
      let request = {
        name: me.customer.name,
        lastname: me.customer.lastname,
        code: me.customer.code,
        income: me.customer.income,
        address: me.customer.address,
        province: me.customer.province,
        postcode: me.customer.postcode,
        phone: me.customer.phone,
        membership: me.selectedMembership.id,
      };
      if (me.currentPhoto != null) {
        request.image = me.currentPhoto;
      }

      axios
        .post("customers/create", request)
        .then((response) => {
          console.log(response);
          this.customerId = response.data.id;
          this.recordMethod = "store";
          console.log({ cusId: me.customerId });
          me.shootMessage();
          Swal.fire({
            type: "success",
            title: "Cliente creado",
            text: "Cliente creado exitosamente",
            timer: 3000,
          });
          me.closeModal();
          me.listCustomers(me.page, me.buscar, me.criterio);
        })
        .catch((error) => {
          console.table(error);
          let message = me.swalErrorMessage(error.response.data.errors);
          Swal.fire({
            type: "error",
            title: "No se pudo crear",
            html: message,
            timer: 3000,
          });
        });
    },

    updateCustomer() {
      let me = this;
      let request = {
        name: me.customer.name,
        lastname: me.customer.lastname,
        code: me.customer.code,
        income: me.customer.income,
        address: me.customer.address,
        province: me.customer.province,
        postcode: me.customer.postcode,
        phone: me.customer.phone,
        membership_id: me.selectedMembership.id,
        id: me.customer.id,
        // image: me.currentPhoto,
      };
      if (me.currentPhoto != null) {
        request["image"] = me.currentPhoto;
      }
      axios
        .post("customers/update/" + me.customer.id, request)
        .then((response) => {
          this.customerId = me.customer.id;
          this.recordMethod = "update";
          console.log({ cusId: me.customerId });
          me.shootMessage();

          Swal.fire({
            type: "success",
            title: "Cliente actualizado",
            text: "Cliente actualizado con exito",
            timer: 3000,
          });
          me.listCustomers(me.page, me.buscar, me.criterio);
          console.log(response);
          me.closeModal();
        })
        .catch((error) => {
          console.table(error);
          let message = me.swalErrorMessage(error.response.data.errors);
          Swal.fire({
            type: "error",
            title: "No se pudo actualizar",
            html: message,
            timer: 3000,
          });
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
      this.dropzone = null;
      this.submitted = false;
    },

    openModal(model, action, data = []) {
      switch (model) {
        case "customers": {
          switch (action) {
            case "store": {
              this.modal = 1;
              this.modalTitle = "Crear nuevo cliente";
              this.actionType = 1;
              this.customer.name = "";
              this.customer.lastname = "";
              this.customer.code = "";
              this.customer.income = "";
              this.customer.address = "";
              this.customer.province = "";
              this.customer.postcode = "";
              this.customer.phone = "";
              this.selectedMembership = "";
              break;
            }
            case "update": {
              console.log(data);
              let mem = null;
              this.memberships.forEach((m) => {
                console.log(m);
                if (m.id === data.membershipId) {
                  mem = m;
                }
              });
              this.modal = 1;
              this.modalTitle = "Actualizar cliente";
              this.actionType = 2;
              this.customer.name = data.name;
              this.customer.lastname = data.lastname;
              this.customer.address = data.address;
              this.customer.province = data.province;
              this.customer.postcode = data.postcode;
              this.customer.phone = data.phone;
              this.customer.code = data.code;
              this.customer.income = new Date(data.income).toISOString().slice(0, 10);
              this.customer.membership_id = mem.id;
              this.selectedMembership = mem;
              this.customer.id = data.id;
              break;
            }
          }
        }
      }
    },

    showCustomer(customer) {
      //   console.log(customer);
      let me = this;
      me.loading = true;
      me.template = 1;
      axios
        .get("customers/" + customer)
        .then((response) => {
          console.log(response);
          let cus = response.data[0];
          console.log(cus);
          me.customerInfo.name = cus.name;
          me.customerInfo.lastname = cus.lastname;
          me.customerInfo.code = cus.code;
          me.customerInfo.income = cus.income;
          me.customerInfo.address = cus.address;
          me.customerInfo.province = cus.province;
          me.customerInfo.postcode = cus.postcode;
          me.customerInfo.phone = cus.phone;
          me.customerInfo.membership = cus.membership;
          me.customerInfo.value = response.data[1];
          me.customerInfo.id = cus.id;
          me.customerInfo.image = cus.image;
          console.log(me.customerInfo);
        })
        .catch((error) => {
          console.table(error);
        })
        .finally(() => (me.loading = false));
    },

    deleteCustomer(customer) {
      let me = this;
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
      })
        .then((result) => {
          if (result.value) {
            axios
              .post("customers/delete/" + customer)
              .then((response) => {
                // console.log(response);
                Swal.fire({
                  type: "success",
                  title: "Cliente eliminado",
                  text: "eliminado correcta mente",
                  timer: 3000,
                });
                me.listCustomers(me.page, me.buscar, me.criterio);
              })
              .catch((error) => {
                console.log(error);
                let message = me.swalErrorMessage(error.response.data.errors);
                Swal.fire({
                  type: "error",
                  title: "Cliente no eliminado",
                  text: "Tal vez hay datos que dependen de este, y se perderian",
                  html: message,
                  timer: 3000,
                });
              });
            //
          } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
          ) {
          }
        })
        .catch(function (error) {
          console.log(error);
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
      me.listCustomers(page, buscar, criterio);
    },

    backToList() {
      let me = this;
      me.template = 0;
      me.listCustomers(1, this.buscar, this.criterio);
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
    // filter: this.listCustomers(this.page, this.buscar, this.criterio),
  },

  mounted() {
    this.listCustomers(1, this.buscar, this.criterio);
    this.getMemberships();
  },
};
</script>
<style scoped lang="scss">
.dz-max-files-reached {
  background-color: red;
}

.circle {
  width: 20px;
  height: 20px;
  -moz-border-radius: 50%;
  -webkit-border-radius: 50%;
  border-radius: 50%;
}

.tgreen {
  background: #398bf7;
}
.tred {
  background: #ff1a1a;
}
.tyellow {
  background: #ffcc00;
}

.circle-column {
  vertical-align: middle;
  text-align: center;
}

.vcenter {
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>
