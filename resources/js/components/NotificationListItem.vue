<template>
  <div class="d-flex align-items-center">
    <a
        class="dropdown-item not-text-decoration"
        :class="isRead ? '' : 'bg-light'"
        :dusk="notification.id"
        :href="notification.data.link">
            <span
                :class="isRead ? '' : 'font-weight-bold'">{{ notification.data.message }}</span>
    </a>

    <button v-if="isRead"
            @click.stop="markAsUnread"
            :dusk="`mark-as-unread-${notification.id}`"
            class="btn btn-link theme-color border-0">
      <i class="far fa-circle"></i>
      <span class="col-6 position-absolute bg-dark text-white ml-2 py-1 px-2 rounded">Markatu Ez Irakurrita </span>
    </button>
    <button v-else
            @click.stop="markAsRead"
            :dusk="`mark-as-read-${notification.id}`"
            class="btn btn-link theme-color border-0">
      <i class="fas fa-circle"></i>
      <span class="col-6 position-absolute bg-dark text-white ml-2 py-1 px-2 rounded">Markatu Irakurrita </span>
    </button>
  </div>
</template>

<script>

export default {
  props: {
    notification: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      isRead: !!this.notification.read_at
    }
  },
  methods: {
    markAsRead() {
      axios.post(`/jakinarazpenak/${this.notification.id}`)
          .then(res => {
            this.isRead = true;
            EventBus.$emit('notification-read');
          })
          .catch(err => {
            console.log(err.response.data)
          });
    },

    markAsUnread() {
      axios.post(`/jakinarazpenak/${this.notification.id}`)
          .then(res => {
            this.isRead = false;
            EventBus.$emit('notification-unread');
          })
          .catch(err => {
            console.log(err.response.data)
          });
    }
  }
}
</script>

<style lang="scss" scoped>
button > span {
  display: none;
}

button i {
  &:hover {
    & + span {
      display: inline;
    }
  }
}
</style>
