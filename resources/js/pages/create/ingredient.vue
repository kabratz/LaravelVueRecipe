<template>
  <div v-if="user">
    <h3 class="text-center">{{ $t('ingredient') }}</h3>
    <div class="row">
      <div class="col-md-6">
        <form @submit.prevent="addIngredient">
          <!-- Name -->
          <div class="form-group">
            <label>{{ $t('name') }}</label>
            <input type="text" class="form-control" v-model="ingredient.name">
          </div>
          <!-- Description -->
          <div class="form-group">
            <label>{{ $t('description') }}</label>
            <textarea class="form-control" v-model="ingredient.description"></textarea>
          </div>
          <!-- Button -->
          <button type="submit" class="btn btn-primary">{{ $t('create') }}</button>
        </form>
      </div>
    </div>
  </div>
  <div v-else>
    {{ $t('you_are_not_logged_in') }}
  </div>
</template>
 
<script>
import { mapGetters } from 'vuex'
export default {
  computed: mapGetters({
    user: 'auth/user'
  }),
  data() {
    return {
      ingredient: {}
    }
  },
  methods: {
    addIngredient() {
      this.axios
        .post('http://localhost:8000/api/ingredient', this.ingredient)
        .then((res) => { window.location.href ='/list/ingredient'; });
    }
  }
}
</script>
