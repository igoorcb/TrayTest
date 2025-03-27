<template>
  <div class="not-found">
    <h1>404</h1>
    <p>Página não encontrada 😢</p>
    <router-link to="/">Voltar para o início</router-link>
  </div>
</template>

<style scoped lang="scss">
.not-found {
  text-align: center;
  margin-top: 5rem;

  h1 {
    font-size: 6rem;
    color: #2d6cdf;
  }

  p {
    font-size: 1.5rem;
    margin-bottom: 2rem;
  }

  a {
    color: #2d6cdf;
    font-weight: bold;
    text-decoration: none;
  }
}
</style>
