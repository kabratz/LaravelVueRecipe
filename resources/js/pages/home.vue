<template>
  <div class="row">
    <div class="col-lg-10 m-auto">
      <card :title="$t('home')">
        <!-- Authenticated -->
        <div v-if="user">
          <router-link :to="{ name: 'list.ingredient' }" class="dropdown-item ps-3">
            <fa icon="plus-circle" fixed-width />
            {{ $t('ingredient') }}
          </router-link>

          <div class="dropdown-divider" />
          <router-link :to="{ name: 'list.recipe' }" class="dropdown-item ps-3">
            <fa icon="book" fixed-width />
            {{ $t('recipe') }}
          </router-link>

        </div>
        <div v-else>
          {{ $t('you_are_not_logged_in') }}
        </div>
      </card>
    </div>
  </div>

</template>

<script>
import { mapGetters } from 'vuex'
// import axios from 'axios'
export default {
  middleware: 'auth',

  computed: mapGetters({
    user: 'auth/user'
  }),
  metaInfo() {
    return { title: this.$t('home') }
  }
}
</script>
