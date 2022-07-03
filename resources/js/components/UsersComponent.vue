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
              @click="openModal('users', 'store')"
            >
              New User
            </button>
          </div>
          <div class="card-body">
            <h4 class="card-title">Users</h4>
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
                          criterio == 'email'
                            ? 'email'
                            : criterio == 'branch'
                            ? 'text'
                            : 'text'
                        "
                        v-model="buscar"
                        @keyup.enter="listUsers(1, buscar, criterio)"
                        class="form-control"
                        :placeholder="
                          criterio == 'email'
                            ? 'my@mail.com'
                            : criterio == 'name' || criterio == 'last_name'
                            ? 'Nombre o apellidos del cliente'
                            : criterio == 'branch'
                            ? 'Nombre de sucursal o direccion'
                            : 'Monthly'
                        "
                      />
                      <div class="input-group-append">
                        <button
                          type="submit"
                          @click="listUsers(1, buscar, criterio)"
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
                        <tr v-for="(user, index) in users" v-if="index < 1">
                          <th
                            v-for="(value, key, cIndex) in user"
                            v-if="key != 'customerId' || key != 'embershipId'"
                          >
                            {{ key }}
                          </th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="(user, index) in users"
                          v-if="index <= pagination.per_page"
                        >
                          <td
                            v-for="(value, key, cIndex) in user"
                            max-height="5px"
                            v-if="key != 'customerId' || key != 'embershipId'"
                          >
                            {{ value }}
                          </td>
                          <td>
                            <button
                              v-if="auth.email != user.email && user.id != 1"
                              type="button"
                              @click="openModal('users', 'update', user)"
                              class="btn btn-warning btn-sm"
                            >
                              <i class="icon-pencil"></i>
                            </button>
                            &nbsp;
                            <button
                              v-if="auth.email != user.email && user.id != 1"
                              type="button"
                              class="btn btn-danger btn-sm"
                              @click="deleteUser(user.id)"
                            >
                              <i class="icon-trash"></i>
                            </button>
                          </td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr></tr>
                        <tr v-for="(user, index) in users" v-if="index < 1">
                          <th
                            v-for="(value, key, cIndex) in user"
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
                    <label for="user_name">Nombre de usuario</label>
                    <input
                      type="text"
                      class="form-control"
                      id="user_name"
                      v-model="user.user_name"
                    />
                  </div>
                  <div class="form-group mb-5">
                    <label for="email">Correo electronico</label>
                    <input
                      type="email"
                      class="form-control"
                      id="email"
                      v-model="user.email"
                    />
                  </div>
                  <div class="form-group mb-5">
                    <label for="name">Nombre</label>
                    <input
                      type="text"
                      class="form-control"
                      id="name"
                      v-model="user.name"
                    />
                  </div>
                  <div class="form-group mb-5">
                    <label for="last_name">Apellidos</label>
                    <input
                      type="text"
                      class="form-control"
                      id="last_name"
                      v-model="user.last_name"
                    />
                  </div>
                  <div class="form-group mb-5">
                    <label for="password">Contraseña</label>
                    <input
                      type="text"
                      class="form-control"
                      id="password"
                      v-model="user.password"
                    />
                  </div>

                  <div class="form-group mb-5">
                    <label for="branch">Sucursal</label>
                    <select
                      class="form-control p-0"
                      id="branch"
                      v-model="selectedBranch"
                      @change="getBranch"
                    >
                      <option></option>
                      <option v-for="branch in branches" :value="branch">
                        {{ branch.division }} | {{ branch.location }}
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
                @click="saveUser"
              >
                Save
              </button>
              <button
                v-if="actionType == 2"
                type="button"
                class="btn btn-primary fas fa-save"
                @click="updateUser"
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
      users: [],
      branches: [],
      selectedBranch: null,
      user: {
        user_name: null,
        email: null,
        name: null,
        last_name: null,
        password: null,
        id: null,
        branch_id: null,
      },
      modal: "",
      modalTitle: "",
      actionType: 0,
      errors: null,
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
      user_id: null,
      showUsers: 10,
      criterions: ["username", "email", "name", "last_name", "branch"],
      authenticated: false,
      auth: {
        id: null,
        email: null,
      },
    };
  },

  created() {
    if (window.Laravel.user) {
      this.auth.email = window.Laravel.user.email;
      /*   this.name = window.Laravel.user.name;
      this.last_name = window.Laravel.user.last_name; */
      this.authenticated = true;
      this.branch = window.Laravel.user.branch;
    } else {
      this.authenticated = false;
    }
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
    // filter: this.listUsers(this.page, this.buscar, this.criterio),
  },

  methods: {
    listUsers(page, buscar, criterio) {
      let me = this;
      this.loading = true;
      console.log("getted");
      let url = "users?page=" + page + "&buscar=" + buscar + "&criterio=" + criterio;
      axios
        .get(url)
        .then((response) => {
          var respuesta = response.data;
          console.log(respuesta);
          me.users = respuesta.users.data;

          console.log(me.users);
          me.pagination = respuesta.pagination;
        })
        .catch((error) => {
          console.table(error);
        })
        .finally(() => (this.loading = false));
    },

    getBranch() {
      let me = this;
      axios
        .get("select-branches")
        .then((response) => {
          var respuesta = response.data;
          me.branches = respuesta;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    selectCriteria() {
      this.buscar = "";
    },

    saveUser() {
      let me = this;
      let request = {
        user_name: me.user.user_name,
        email: me.user.email,
        name: me.user.name,
        last_name: me.user.last_name,
        password: me.user.password,
        branch_id: me.selectedBranch.id,
        avatar: me.user.avatar,
      };
      axios
        .post("users", request)
        .then((response) => {
          let respuesta = response.data;
          console.log(response);
          let message = "Usuario creado con exito";
          Swal.fire({
            type: "success",
            title: "Registro  de usuario satisfactorio",
            text: message,
            timer: 5000,
          });
          me.listUsers(me.page, me.buscar, me.criterio);
        })
        .catch((error) => {
          console.table(error);
        });
      this.closeModal();
    },

    updateUser() {
      let me = this;
      let request = {
        user_name: me.user.user_name,
        email: me.user.email,
        name: me.user.name,
        last_name: me.user.last_name,
        password: me.user.password,
        branch_id: me.selectedBranch.id,
        avatar: me.user.avatar,
        id: me.user.id,
      };
      axios
        .put("users/" + request.id, request)
        .then((response) => {
          let respuesta = response.data;
          console.log(respuesta);
          Swal.fire({
            type: "success",
            title: "Usuario actualizado",
            text: "Usuario actualizado exitosamente",
            timer: 8000,
          });
          me.listUsers(me.page, me.buscar, me.criterio);
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
        this.selectedBranch = newVal;
      }
    },

    closeModal() {
      this.modal = 0;
      this.title = "";
      this.errors = {};
      this.listUsers(this.pagination.current_page, this.buscar, this.criterio);
    },

    async openModal(model, action, data = []) {
      switch (model) {
        case "users": {
          switch (action) {
            case "store": {
              this.modal = 1;
              this.modalTitle = "New user";
              this.actionType = 1;
              this.user.user_name;
              this.user.email;
              this.user.name;
              this.user.last_name;
              this.user.password;
              this.user.avatar;
              this.selectedBranch = "";
              break;
            }
            case "update": {
              console.log(data);
              let brn = null;
              this.branches.forEach((b) => {
                if (b.id === data.branch_id) {
                  brn = b;
                }
              });
              this.modal = 1;
              this.modalTitle = "Update user";
              this.actionType = 2;
              this.user_name = data.username;
              this.selectedBranch = brn;
              this.user.user_name = data.user_name;
              this.user.email = data.email;
              this.user.name = data.name;
              this.user.last_name = data.last_name;
              this.user.password = "";
              this.user.avatar = data.avatar;
              this.user.id = data.id;
              this.user_id = data.id;
              break;
            }
          }
        }
      }
    },

    deleteUser(user) {
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
            .delete("users/" + user)
            .then((response) => {
              console.log(response);
              Swal.fire({
                type: "success",
                title: "Registro  eliminado con éxito",
                text: "El usuario ha sido eliminado !",
                timer: 5000,
              });
              me.listUsers(me.page, me.buscar, me.criterio);
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

    //Paginator
    cambiarPagina(page, buscar, criterio) {
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.listUsers(page, buscar, criterio);
    },
  },

  mounted() {
    this.listUsers(1, this.buscar, this.criterio);
    this.getBranch();
  },
};
</script>
