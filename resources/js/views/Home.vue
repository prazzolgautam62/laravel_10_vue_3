<template>
  <div class="container">
    <div class="d-flex justify-content-between">
      <div class="mt-auto">
        <button type="button" class="btn btn-primary" @click="addUser">Add New User</button>
      </div>
      <div class="d-flex">
        <div class="form-group" style="margin-right:5px;">
          <label for="exampleInputEmail1">Search</label>
          <input
            type="text"
            class="form-control"
            placeholder="Search..."
            v-model="params.search_query"
          />
        </div>
        <div class="form-group" style="margin-right:5px;">
          <label for="exampleFormControlSelect1">Sort By</label>
          <select class="form-control" id="exampleFormControlSelect1" v-model="params.sort_by">
            <option value="id">Id</option>
            <option value="name">Name</option>
            <option value="email">Email</option>
          </select>
        </div>
        <div class="form-group">
          <label for="exampleFormControlSelect1">Direction</label>
          <select
            class="form-control"
            id="exampleFormControlSelect1"
            v-model="params.sort_direction"
          >
            <option value="asc">Asc</option>
            <option value="desc">Desc</option>
          </select>
        </div>
      </div>
    </div>
    <Table :users="users" :from="pagination.from" @edit="editUser" @delete="deleteUser" />
    <Pagination
      :pagination="pagination"
      @first="getUsers(pagination.first_page_url)"
      @prev="getUsers(pagination.prev_page_url)"
      @next="getUsers(pagination.next_page_url)"
      @last="getUsers(pagination.last_page_url)"
    />
    <Modal v-if="show_modal" @close="closeModal">
      <template v-slot:header>
        <h5 class="modal-title" id="exampleModalLabel">{{editMode ? 'Edit User' : 'Add User'}}</h5>
      </template>
      <template v-slot:body>
        <form @submit.prevent="submitForm">
          <div class="form-group">
            <label for="exampleInputName">Name</label>
            <input
              type="text"
              v-model="form_params.name"
              class="form-control"
              id="exampleInputName"
              aria-describedby="nameHelp"
              placeholder="Enter name"
              required
            />
          </div>
          <br />
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input
              type="email"
              v-model="form_params.email"
              class="form-control"
              id="exampleInputEmail1"
              aria-describedby="emailHelp"
              placeholder="Enter email"
              required
            />
          </div>
          <br />
          <button type="submit" class="btn btn-primary">{{editMode ? 'Update' : 'Save'}}</button>
        </form>
      </template>
      <template v-slot:footer>
        <button type="button" class="btn btn-secondary" @click="closeModal">Close</button>
      </template>
    </Modal>
  </div>
</template>
<script>
import {
  _getUsers,
  _createUser,
  _updateUser,
  _deleteUser
} from "./../services/user";
import Pagination from "../utilities/Pagination.vue";
import Table from "../components/Table.vue";
import Modal from "../utilities/Modal.vue";
export default {
  data() {
    return {
      params: {
        search_query: "",
        sort_by: "id",
        sort_direction: "asc"
      },
      form_params: {
        name: "",
        email: ""
      },
      users: [],
      pagination: {},
      show_modal: false,
      editMode: false,
      user_id: null
    };
  },
  watch: {
    "params.search_query"() {
      if (
        this.params.search_query.length > 2 ||
        this.params.search_query.length == 0
      )
        this.getUsers();
    },
    "params.sort_by"() {
      this.getUsers();
    },
    "params.sort_direction"() {
      this.getUsers();
    }
  },
  methods: {
    async getUsers(url = "") {
      try {
        const response = await _getUsers(url, this.params);
        let { data, ...pagination } = response.data;
        this.users = data;
        this.pagination = pagination;
      } catch (error) {
        console.log(error);
      }
    },
    addUser() {
      this.show_modal = true;
    },
    editUser(user) {
      this.show_modal = true;
      this.editMode = true;
      this.user_id = user.id;
      this.form_params.name = user.name;
      this.form_params.email = user.email;
    },
    async deleteUser(user) {
      if (!confirm("Are you sure you want to delete the user ?")) return;
      const deleteResponse = await _deleteUser(user.id);
      this.$toast.warning(deleteResponse.message);
      this.getUsers();
    },
    closeModal() {
      this.form_params.name = "";
      this.form_params.email = "";
      this.show_modal = false;
      this.editMode = false;
      this.user_id = null;
    },
    async submitForm() {
      try {
        if (this.editMode)
          var response = await _updateUser(this.user_id, this.form_params);
        else var response = await _createUser(this.form_params);
        this.$toast.success(response.message);
        this.closeModal();
        this.getUsers();
      } catch (error) {
        console.log(error);
      }
    }
  },
  components: {
    Pagination,
    Table,
    Modal
  },
  created() {
    this.getUsers();
  }
};
</script>