<template>
  <div>
    <h2 class="text-center">{{ $t('recipes_list') }}</h2>

    <router-link :to="{ name: 'create.recipe' }" class="btn btn-success">{{ $t('new') }}</router-link>

    <table class="table">
      <thead>
        <tr>
          <th>{{ $t('id') }}</th>
          <th>{{ $t('name') }}</th>
          <th>{{ $t('description') }}</th>
          <th>{{ $t('actions') }}</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="recipe in recipes">
          <td>{{ recipe.id }}</td>
          <td>{{ recipe.name }}</td>
          <td>{{ recipe.description }}</td>
          <td>
            <div class="btn-group" role="group">
              <router-link :to="{ name: 'edit.recipe', params: { id: recipe.id } }" class="btn btn-success">{{ $t('edit') }}
              </router-link>
              <button class="btn btn-danger" @click="deleteRecipe(recipe.id)">{{ $t('delete') }}</button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
 
<script>

export default {

  mounted()//NESSA FUNCAO DEVE SER PREENCHIDA A COMBO BUSCANDO DADOS DE API, BEM COMO A TABELA CASO A RECIPE JA TENHA INGREDIENTES
  {
    this.getRecipes();
  },
  data() {
    return {
      recipes: []
    }
  }
  ,
  methods: {
    getRecipes() {
      this.axios.get('http://localhost:8000/api/recipe')
        .then(function (response) {
          this.recipes = response.data
        }.bind(this))
        .catch(function (error) {
          console.log("error.response");
        });
    },
    deleteRecipe(id) {
      this.axios.delete('http://localhost:8000/api/recipe/' + id).then(response => {
        let i = this.recipes.map(data => data.id).indexOf(id);
        this.recipes.splice(i, 1)
      });
    }

  }
}
</script>
