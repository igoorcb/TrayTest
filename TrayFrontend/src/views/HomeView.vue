<template>
  <div class="home">
    <div class="card">
      <h1>Bem vindo a <span>Tray</span></h1>
      <GoogleLoginButton />
      <!-- <router-link to="/users" class="link">
        <button class="secondary">Ver lista de usuários</button>
      </router-link> -->
    </div>
  </div>
</template>

<script setup lang="ts">
import GoogleLoginButton from '@/components/GoogleLoginButton.vue'
</script>

<style scoped lang="scss">
.home {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background: linear-gradient(135deg, #f0f4ff, #e8edff);
}

.card {
  background: #fff;
  padding: 3rem 2rem;
  border-radius: 12px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  text-align: center;
  max-width: 400px;
  width: 100%;

  h1 {
    font-size: 1.8rem;
    margin-bottom: 2rem;
    color: #2d6cdf;

    span {
      color: #1a49b8;
    }
  }

  .link {
    margin-top: 1.5rem;
    display: block;

  .secondary {
    padding: 10px 20px;
    background-color: #fff;
    color: #2d6cdf;
    border: 2px solid #2d6cdf;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;

    &:hover {
      background-color: #2d6cdf;
      color: #fff;
    }
  }
}
}
</style>
