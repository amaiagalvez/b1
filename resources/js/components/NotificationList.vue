<template>
  <li class="c-header-nav-item dropdown">
    <a class="c-header-nav-link dropdown-toggle"
       :class="count ? 'text-primary font-weight-bold' : ''"
       data-toggle="dropdown"
       href="#" role="button" aria-haspopup="true"
       dusk="notifications"
       aria-expanded="false">
      <slot></slot>
      <span dusk="notifications-count">{{ count }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-right pt-0" aria-labelledby="navbarDropdown">

      <div class="dropdown-header text-center">Jakinarazpenak</div>

      <notification-list-item
          v-for="notification in notifications"
          :notification="notification"
          :key="notification.id">
      </notification-list-item>
    </div>
  </li>
</template>

<script>

import NotificationListItem from "./NotificationListItem";

export default {
  components: {NotificationListItem},
  data() {
    return {
      notifications: [],
      count: ''
    }
  },
  created() {
    if (this.check) {
      Echo.private(`users.${this.currentUser.id}`)
          .notification((notification) => {
            console.log('Yee');
            console.log(notification);
            this.count++;
            this.notifications.push({
              id: notification.id,
              data: {
                link: notification.link,
                message: notification.message
              }
            })
          });
    }

    axios.get('/jakinarazpenak')
        .then(res => {
          this.notifications = res.data;
          this.unreadNotifications();
        })
        .catch(err => {
          console.log(err.response.data)
        });

    EventBus.$on('notification-read', () => {
      if (this.count === 1) {
        return this.count = '';
      }
      this.count--;
    });

    EventBus.$on('notification-unread', () => {
      this.count++;
    });

  },
  methods: {
    unreadNotifications() {
      this.count = this.notifications.filter(notification => {
        return notification.read_at === null
      }).length || ''
    }
  }
}
</script>

<style scoped>

</style>
