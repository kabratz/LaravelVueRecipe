<template>
  <div>
    <h3 class="text-center">{{ $t('ingredient') }}</h3>
    <div class="row">
      <div class="col-md-6">
        <form @submit.prevent="addIngredient">
          <div class="form-group">
            <label>{{ $t('name') }}</label>
            <input type="text" class="form-control" v-model="ingredient.name">
          </div>
          <div class="form-group">
            <label>{{ $t('description') }}</label>
            <input type="text" class="form-control" v-model="ingredient.description">
          </div>
          <button type="submit" class="btn btn-primary">{{ $t('create') }}</button>
        </form>
      </div>
    </div>
  </div>
</template>
 
<script>
export default {
  data() {
    return {
      ingredient: {}
    }
  },
  methods: {
    addIngredient() {
      this.axios
        .post('http://localhost:8000/api/ingredient', this.ingredient)
        .then((res) => { this.$router.push({ name: 'list.ingredient' }); });
    }
  }
}
</script>
