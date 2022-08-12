<template>
  <div v-if="user">
    <h3 class="text-center">{{ $t('edit_ingredient') }}</h3>
    <div class="row">
      <div class="col-md-6">
        <form @submit.prevent="editIngredient">
          <!-- Name -->
          <div class="form-group">
            <label>{{ $t('name') }}</label>
            <input type="text" class="form-control" v-model="ingredient.name">
          </div>
          <!-- Description -->
          <div class="form-group">
            <label>{{ $t('description') }}</label>
            <textarea class="form-control" v-model="ingredient.description"> </textarea>
          </div>
          <!-- Button -->
          <button type="submit" class="btn btn-primary">{{ $t('edit') }}</button>
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
  created() {
    /* get data by id */
    this.axios.get(`http://localhost:8000/api/ingredient/${this.$route.params.id}`)
      .then((res) => { this.ingredient = res.data; });
  },
  methods: {
    editIngredient() {
      this.axios.patch(`http://localhost:8000/api/ingredient/` + this.ingredient.id, this.ingredient)
        .then((res) => { window.location.href ='/list/ingredient'; });
    }
  }
}
</script>
