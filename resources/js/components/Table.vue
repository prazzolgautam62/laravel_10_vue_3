<template>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Created At</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(user,index) in users" :key="'user'+index">
        <th scope="row">{{from + index}}</th>
        <td>{{user.name}}</td>
        <td>{{user.email}}</td>
        <td>{{new Date(user.created_at)}}</td>
        <td>
         <button type="button" class="btn btn-primary" @click="editUser(user)">Edit</button>&nbsp;
         <button type="button" class="btn btn-danger" @click="deleteUser(user)">Delete</button>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  name: "Table",
  props: {
    users: {
      type: Array,
      required: true
    },
    from: {
      required: true
    }
  },
  methods:{
    editUser(user){
      this.$emit("edit",user);
    },
    deleteUser(user){
      this.$emit("delete",user);
    }
  }
};
</script>