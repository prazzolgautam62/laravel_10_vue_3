<template>
  <div class="d-flex justify-content-between align-items-center">
    <div class="text-muted">
      {{ pagination.from }} - {{ pagination.to }} of {{ pagination.total }}
    </div>
    <nav>
      <ul class="pagination" style="margin-top: 10px">
        <li
          class="page-item"
          :class="{
            disabled: pagination.current_page == 1,
          }"
        >
          <a
            class="page-link"
            :disabled="pagination.current_page == 1"
            href="#"
            @click="$emit('first')"
            >First</a
          >
        </li>
        <li
          class="page-item"
          :class="{ disabled: pagination.prev_page_url == null }"
        >
          <a
            class="page-link"
            :disabled="pagination.prev_page_url"
            href="#"
            @click="$emit('prev')"
            >Previous</a
          >
        </li>
        <li class="page-item disabled">
          <a class="page-link text-success">{{ pagination.current_page }}</a>
        </li>
        <li
          :class="
            pagination.next_page_url == null
              ? 'page-item disabled'
              : 'page-item'
          "
        >
          <a
            class="page-link"
            :disabled="pagination.next_page_url"
            href="#"
            @click="$emit('next')"
            >Next</a
          >
        </li>
        <li
          :class="
            pagination.last_page == pagination.current_page
              ? 'page-item disabled'
              : 'page-item'
          "
        >
          <a
            class="page-link"
            :disabled="pagination.last_page == pagination.current_page"
            href="#"
            @click="$emit('last')"
            >Last</a
          >
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
export default {
  name: "SimplePagination",
  props: {
    pagination: {
      type: Object,
      required: true,
    },
  },
};
</script>

<style>
</style>