<template>
  <div v-if="user">
    <h3 class="text-center">{{ $t('recipe') }}</h3>
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <form @submit.prevent="addRecipe">
          <!-- Name -->
          <div class="form-group">
            <label>{{ $t('name') }}</label>
            <input type="text" class="form-control" v-model="recipe.name" required>
          </div>
          <!-- Description -->
          <div class="form-group">
            <label>{{ $t('description') }}</label>
            <textarea class="form-control" v-model="recipe.description" required></textarea>
          </div>
          <br>
          <div class="dropdown-divider" />
          <!-- Ingredient -->
          <div class="row my-3">
            <div class="col-md-10">
              <!-- Select Ingredient -->
              <div class="form-group">
                <label>{{ $t('ingredient') }}</label>
                <select class="form-select" v-model="selected">
                  <option v-for="option in options" v-bind:value="{ id: option.id, text: option.name }">
                    {{ option.name }}
                  </option>
                </select>
              </div>
              <!-- Quantity Ingredient -->
              <div class="form-group">
                <label>{{ $t('quantity') }}</label>
                <input type="text" class="form-control" v-model="ingredientQuantity">
              </div>
            </div>
            <!-- Buttons action ingredient -->
            <div class="col-md-2 d-md-flex flex-md-wrap align-content-md-around justify-content-md-center my-3">
              <a href="#" class="btn btn-success" @click="addIngredient">{{ $t('add') }}</a>
              <a href="#" class="btn btn-danger" @click="removeIngredient">{{ $t('remove') }}</a>
            </div>
          </div>

          <!-- Table Ingredients on recipe -->
          <div class="form-group">
            <table class="table">
              <thead>
                <tr>
                  <th colspan="4" class="text-center">
                    {{ $t('ingredients') }}
                  </th>
                </tr>
                <tr>
                  <th>{{ $t('order') }}</th>
                  <th>{{ $t('id') }}</th>
                  <th>{{ $t('description') }}</th>
                  <th>{{ $t('quantity') }}</th>
                </tr>
              </thead>

              <tbody>
                <tr v-for="item in recipeIngredients">
                  <td>{{ item.order }}</td>
                  <td>{{ item.ingredient_id }}</td>
                  <td>{{ item.name }}</td>
                  <td>{{ item.kg_quantity }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- Button Submit -->
          <button type="submit" class="btn btn-primary">{{ $t('create') }}</button>
        </form>
      </div>
      <div class="col-md-2"></div>
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
  mounted() {
    this.getIngredients();
  },
  data() {
    return {
      category: [],
      selected: 1,
      selectedCategory: null,
      recipe: {},
      options: [],
      recipeIngredients: [],
      recipeIngredientsDeleted: [],
      ingredientQuantity: ""
    }
  }
  ,
  methods: {
    addIngredient() {
      if (this.selected.id && this.ingredientQuantity > 0) {
        // `this` inside methods points to the current active instance
        var my_object = {
          order: this.recipeIngredients.length + 1,
          ingredient_id: this.selected.id,
          name: this.selected.text,
          kg_quantity: this.ingredientQuantity
        };

        this.recipeIngredients.push(my_object)
      }
      if (!this.selected.id) {
        alert('Ingrediente Inválido');

      }
      if (this.ingredientQuantity <= 0) {
        alert('Quantidade Inválida');
      }
    },
    removeIngredient() {
      this.recipeIngredients.pop()
    },
    getIngredients() {
      this.axios.get('http://localhost:8000/api/ingredient')
        .then(function (response) {
          this.options = response.data
        }.bind(this))
        .catch(function (error) {
          console.log("error.response");
        });
    },
    addRecipe() {
      this.axios
        .post('http://localhost:8000/api/recipe', [this.recipe, this.recipeIngredients])
        .then(function (response) {
            window.location.href ='/list/recipe';

        })
        .catch(err => console.log(err))
        .finally(() => this.loading = false)
    }

  }
}
</script>
