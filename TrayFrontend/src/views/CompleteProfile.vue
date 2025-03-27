<template>
  <div class="form-container">
    <h2>Complete seu cadastro</h2>

    <form @submit.prevent="submitProfile">
      <input v-model="form.name" type="text" placeholder="Nome completo" :class="{ 'input-error': cpfError }" />
      <small v-if="nameError" class="error-text">O Nome é obrigatório</small>

      <input v-model="form.cpf" type="text" placeholder="CPF" maxlength="11" :class="{ 'input-error': cpfError }" />
      <small v-if="cpfError" class="error-text">O CPF é obrigatório e deve conter 11 dígitos.</small>

      <input v-model="form.birthdate" type="date" placeholder="Data de nascimento"
        :class="{ 'input-error': birthdateError }" />
      <small v-if="birthdateError" class="error-text">A data de nascimento é obrigatória.</small>

      <button type="submit" :disabled="loading">
        {{ loading ? 'Salvando...' : 'Salvar' }}
      </button>

      <Spinner v-if="loading" />
    </form>

    <p v-if="message" :class="isError ? 'error-message' : 'success-message'">
      {{ message }}
    </p>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import axios from 'axios'
import Spinner from '@/components/Spinner.vue'

const route = useRoute()
const router = useRouter()

const form = ref({
  email: '',
  name: '',
  cpf: '',
  birthdate: ''
})

const message = ref('')
const isError = ref(false)
const loading = ref(false)
const cpfError = ref(false)
const nameError = ref(false)
const birthdateError = ref(false)

onMounted(() => {
  const email = route.query.email as string
  if (email) {
    form.value.email = email
  }
})

const isFormValid = () => {
  nameError.value = form.value.name.trim().length < 2
  cpfError.value = form.value.cpf.trim().length !== 11
  birthdateError.value = !form.value.birthdate

  return !nameError.value && !cpfError.value && !birthdateError.value
}

const submitProfile = async () => {
  message.value = ''
  isError.value = false

  if (!isFormValid()) {
    message.value = 'Por favor, corrija os erros acima.'
    isError.value = true
    return
  }

  loading.value = true
  try {
    const response = await axios.post('http://localhost:8000/api/complete-profile', form.value)
    message.value = response.data.message
    isError.value = false
    setTimeout(() => router.push('/users'), 1000)
  } catch (error: any) {
    message.value = error?.response?.data?.message || 'Erro ao salvar cadastro'
    isError.value = true
  } finally {
    loading.value = false
  }
}
</script>

<style scoped lang="scss">
.form-container {
  max-width: 420px;
  margin: 4rem auto;
  padding: 2rem;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);

  h2 {
    text-align: center;
    margin-bottom: 1.5rem;
    color: #2d6cdf;
  }

  form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }

  input,
  button {
    padding: 12px;
    font-size: 16px;
    border-radius: 6px;
    border: 1px solid #ccc;
  }

  input:focus {
    outline: none;
    border-color: #2d6cdf;
  }

  .input-error {
    border-color: #e74c3c !important;
  }

  .error-text {
    font-size: 13px;
    color: #e74c3c;
    margin-top: -10px;
    margin-bottom: 5px;
  }

  button {
    background: #2d6cdf;
    color: white;
    border: none;
    cursor: pointer;
    transition: 0.3s;

    &:disabled {
      background: #9bb8ec;
      cursor: not-allowed;
    }

    &:hover:not(:disabled) {
      background: #1b4db4;
    }
  }

  .success-message {
    margin-top: 1.5rem;
    background: #e0ffe0;
    padding: 12px;
    border: 1px solid #51d651;
    color: #2a7b2a;
    border-radius: 6px;
    text-align: center;
  }

  .error-message {
    margin-top: 1.5rem;
    background: #ffe0e0;
    padding: 12px;
    border: 1px solid #e74c3c;
    color: #a33030;
    border-radius: 6px;
    text-align: center;
  }
}
</style>
