<template>
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
          <th scope="row">{{from + index}}</th>
          <td>{{user.name}}</td>
          <td>{{user.email}}</td>
          <td>{{new Date(user.created_at)}}</td>
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
      required: true,
    },
    from:{
        required:true
    }
  },
};
</script>