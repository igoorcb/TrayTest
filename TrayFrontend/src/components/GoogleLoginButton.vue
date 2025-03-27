<template>
  <button class="google-btn" @click="loginWithGoogle">
    <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google" />
    Entrar com Google
  </button>
</template>

<script setup lang="ts">
import axios from 'axios'

const loginWithGoogle = async () => {
  try {
    const { data } = await axios.get('http://localhost:8000/api/auth/google/redirect')
    const popup = window.open(data.url, '_blank', 'width=500,height=600')
    if (!popup) {
      alert('Permita popups para continuar com o login Google.')
    }
  } catch (e) {
    alert('Erro ao iniciar login com Google.')
  }
}
</script>

<style scoped lang="scss">
.google-btn {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: white;
  border: 1px solid #ccc;
  padding: 10px 20px;
  font-size: 16px;
  border-radius: 4px;
  cursor: pointer;
  img {
    width: 20px;
    height: 20px;
  }
}
</style>
