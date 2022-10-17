<template>
  <form action="" v-on:submit.prevent="add()">
    <label for="pais"> Pais </label>
    <input v-model="pais" class="input" type="text" name="pais" />
    <br />
    <label for="capital"> Capital </label>
    <input v-model="capital" class="input" type="text" name="capital" />
    <br />
    <button class="btn-primary">Agregar</button>
  </form>
  <br />
  <ul>
    <li v-for="(pais, index) in paises" :key="pais.name">
      {{ index + 1 }} - {{ pais.name }} - {{ pais.capital }}
    </li>
  </ul>

  <template v-if="Active">
    <h1 class="mt-5 text-lg font-bold">Hello World</h1>
  </template>

  <h1 v-show="Active" class="mt-5 text-lg font-bold">Hello World</h1>

  <button class="btn-primary" @click="color = 'red-500'">ROJO</button>
  <button class="btn-primary" @click="color = 'blue-500'">AZUL</button>
  <button class="btn-primary" @click="color = 'green-500'">VERDE</button>

  <p :class="'text-' + color">
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque doloribus
    itaque nesciunt nam, quis laboriosam saepe illo? Molestias laborum, nam
    alias, consectetur veritatis tempore distinctio nostrum temporibus deserunt
    ab provident!
  </p>

  <button class="btn-primary" @click="Active2 = !Active2">
    <span v-if="Active2">Desactivar</span>
    <span v-else>Activar</span>
  </button>

  <p v-if="Active2">
    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ratione mollitia
    commodi expedita sapiente temporibus corrupti sit et, ipsum, debitis, fuga
    perspiciatis maxime! Aliquam quia recusandae quae deserunt in debitis
    excepturi!
  </p>

  <button @click="counter++" class="btn-primary">haz hecho clicks {{ counter }} veces</button>
<br>
<br>

<div v-for="course in courses" :key="course.id">
<h1>
    {{course.name}}
</h1>
<span>the price of this course is: {{ course.price }}</span>
<br>
<button @click="$emit('crecerTexto', 2)" class="btn-secondary">Aunmentar tamaño</button>
</div>

</template>

<script>
export default {
  data() {
    return {
      pais: "",
      capital: "",
      Active: true,
      Active2: true,
      color: "black",
      counter: 0,

      paises: [
        {
          name: "Mexico",
          capital: "Guadalajara",
        },
        {
          name: "EUA",
          capital: "Washinton",
        },
      ],
    };
  },
  props: {
    courses: Object,
  },
  methods: {
    add() {
      this.paises.push({
        name: this.pais,
        capital: this.capital,
      });

      this.pais = "";
      this.capital = "";
    },
  },
};
</script>