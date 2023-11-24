<template>
  <div class="container">
    <div class="d-flex justify-content-end">
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
        <select class="form-control" id="exampleFormControlSelect1" v-model="params.sort_direction">
          <option value="asc">Asc</option>
          <option value="desc">Desc</option>
        </select>
      </div>
    </div>
    <Table :users="users" :from="pagination.from" />
    <Pagination
      :pagination="pagination"
      @first="getUsers(pagination.first_page_url)"
      @prev="getUsers(pagination.prev_page_url)"
      @next="getUsers(pagination.next_page_url)"
      @last="getUsers(pagination.last_page_url)"
    />
  </div>
</template>
<script>
import { _getUsers } from "./../services/user";
import Pagination from "../utilities/Pagination.vue";
import Table from "../components/Table.vue";
export default {
  data() {
    return {
      params: {
        search_query: "",
        sort_by: "id",
        sort_direction: "asc"
      },
      users: [],
      pagination: {}
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
    }
  },
  components: {
    Pagination,
    Table
  },
  created() {
    this.getUsers();
  }
};
</script>