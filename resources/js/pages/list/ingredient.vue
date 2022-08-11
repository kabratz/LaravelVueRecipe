<template>
  <div>
    <h2 class="text-center">{{ $t('ingredients_list') }}</h2>

    <router-link :to="{ name: 'create.ingredient' }" class="btn btn-success">{{ $t('new') }}</router-link>

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
        <tr v-for="ingredient in ingredients">
          <td>{{ ingredient.id }}</td>
          <td>{{ ingredient.name }}</td>
          <td>{{ ingredient.description }}</td>
          <td>
            <div class="btn-group" role="group">
              <router-link :to="{ name: 'edit.ingredient', params: { id: ingredient.id } }" class="btn btn-success">{{
                  $t('edit')
              }}</router-link>
              <button class="btn btn-danger" @click="deleteIngredient(ingredient.id)">{{ $t('delete') }}</button>
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
    this.getIngredients();
  },
  data() {
    return {
      ingredients: []
    }
  }
  ,
  methods: {
    getIngredients() {
      this.axios.get('http://localhost:8000/api/ingredient')
        .then(function (response) {
          this.ingredients = response.data
        }.bind(this))
        .catch(function (error) {
          console.log("error.response");
        });
    },
    deleteIngredient(id) {
      this.axios.delete('http://localhost:8000/api/ingredient/' + id).then(response => {
        let i = this.ingredients.map(data => data.id).indexOf(id);
        this.ingredients.splice(i, 1)
      });
    }

  }
}
</script>
