<template>
  <div>
    <h3 class="text-center">{{ $t('edit_recipe') }}</h3>
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <form @submit.prevent="editRecipe">
          <div class="form-group">
            <label>{{ $t('id') }}</label>
            <input type="text" class="form-control" v-model="recipe.id" required>
          </div>
          <div class="form-group">
            <label>{{ $t('name') }}</label>
            <input type="text" class="form-control" v-model="recipe.name" required>
          </div>
          <div class="form-group">
            <label>{{ $t('description') }}</label>
            <input type="text" class="form-control" v-model="recipe.description" required>
          </div>

          <div class="form-group">
            <label>{{ $t('ingredient') }}</label>

            <select class="form-control" v-model="selected">
              <option v-for="option in options" v-bind:value="{ id: option.id, text: option.name }">
                {{ option.name }}
              </option>
            </select>
          </div>

          <div class="form-group">
            <label>{{ $t('quantity') }}</label>
            <input type="text" class="form-control" v-model="ingredientQuantity">
          </div>

          <div class="form-group">

            <table class="table">
              <thead>
                <tr>
                  <th colspan="4">
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
                  <td>{{ item.igredient_id }}</td>
                  <td>{{ item.name }}</td>
                  <td>{{ item.quantity }}</td>
                </tr>
              </tbody>
            </table>


          </div>

          <a href="#" class="button" @click="addIngredient">{{ $t('add') }}</a>
          <a href="#" class="button" @click="removeIngredient">{{ $t('remove') }}</a>
          <br />
          <br />
          <button type="submit" class="btn btn-primary">{{ $t('create') }}</button>
        </form>
      </div>
      <div class="col-md-2"></div>
    </div>
  </div>
</template>
 
<script>

export default {

  mounted()//NESSA FUNCAO DEVE SER PREENCHIDA A COMBO BUSCANDO DADOS DE API, BEM COMO A TABELA CASO A RECIPE JA TENHA INGREDIENTES
  {
    this.getIgredients();
  },
  data() {
    return {
      category: [],
      selected: 1,
      selectedCategory: null,
      recipe: {},
      options: [],
      recipeIngredients: [],
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
          igredient_id: this.selected.id,
          name: this.selected.text,
          quantity: this.ingredientQuantity
        };

        this.recipeIngredients.push(my_object)
        console.log(this.recipeIngredients)
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
    getIgredients() {
      this.axios.get('http://localhost:8000/api/ingredient')
        .then(function (response) {
          this.options = response.data
        }.bind(this))
        .catch(function (error) {
          console.log("error.response");
        });
    },
    editRecipe() {


      this.axios.patch(`http://localhost:8000/api/recipe/` + this.recipe.id, this.recipe)
        .then((res) => { this.$router.push({ name: 'list.recipe' }); });
    }

  }
}

</script>
