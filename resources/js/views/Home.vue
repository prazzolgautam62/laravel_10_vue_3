<template>
  <div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Created At</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(user,index) in users" :key="'user'+index">
          <th scope="row">{{index+1}}</th>
          <td>{{user.name}}</td>
          <td>{{user.email}}</td>
          <td>{{new Date(user.created_at)}}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
import { _getUsers } from "./../services/user";
export default {
  data() {
    return {
      users: []
    };
  },
  methods: {
    async getUsers() {
      try {
        const response = await _getUsers();
        this.users = response.data;
      } catch (error) {
        console.log(error);
      }
    }
  },
  created() {
    this.getUsers();
  }
};
</script>