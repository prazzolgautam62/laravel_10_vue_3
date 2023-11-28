<template>
  <div class="modal-container d-flex">
    <!-- Modal -->
    <div class="modal fade show d-block" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <slot name="header"></slot>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
              @click="closeModal()"
            ></button>
          </div>

          <div class="modal-body">
            <slot name="body"></slot>
          </div>
          <div class="modal-footer">
            <slot name="footer"></slot>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },

  methods: {
    closeModal() {
      this.$emit("close");
    },
    onEscapeKeyPressed(event) {
      if (event.key == "Escape") {
        this.closeModal();
      }
    }
  },
  mounted() {
    document.addEventListener("keyup", this.onEscapeKeyPressed);
  },
  destroyed() {
    document.removeEventListener("keyup", this.onEscapeKeyPressed);
  }
};
</script>