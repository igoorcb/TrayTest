<template>
  <div class="user-list-container">
    <div class="user-list-box">
      <h2>Usuários cadastrados 📋 </h2>

      <div class="filters">
        <input
          v-model="name"
          @input="handleNameFilter"
          placeholder="Filtrar por nome (min 2 letras)"
        />
        <input
          v-model="cpf"
          @input="handleCpfFilter"
          placeholder="Filtrar por CPF (min 3 dígitos)"
          maxlength="11"
        />
        <button @click="listarTodos">Listar todos</button>
        <button @click="limparFiltros" class="clear">Limpar filtros</button>
      </div>

      <div class="user-cards" v-if="store.users.length">
        <div class="user-card" v-for="user in store.users" :key="user.id">
          <h3>{{ user.name }}</h3>
          <p><strong>CPF:</strong> {{ user.cpf }}</p>
          <p><strong>Email:</strong> {{ user.email }}</p>
        </div>
      </div>

      <p v-else class="empty">Nenhum usuário encontrado.</p>

      <div class="pagination" v-if="store.lastPage > 1">
        <button @click="store.prevPage" :disabled="store.filters.page === 1">← Anterior</button>
        <span>Página {{ store.filters.page }}</span>
        <button @click="store.nextPage" :disabled="store.filters.page === store.lastPage">Próxima →</button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
    import { ref } from 'vue'
    import { useUserStore } from '@/store/user'

    const store = useUserStore()
    const name = ref('')
    const cpf = ref('')

    const listarTodos = () => {
      name.value = ''
      cpf.value = ''
      store.resetFilters()
      store.fetchUsers()
    }

    const limparFiltros = () => {
      name.value = ''
      cpf.value = ''
      store.resetFilters()
      store.users = []
    }

    const handleNameFilter = () => {
      if (name.value.trim().length >= 2) {
        store.updateFilter('name', name.value.trim())
      } else if (!cpf.value.trim()) {
        store.users = [] 
      }
    }

    const handleCpfFilter = () => {
      if (cpf.value.trim().length >= 3) {
        store.updateFilter('cpf', cpf.value.trim())
      } else if (!name.value.trim()) {
        store.users = []
      }
    }
</script>


<style scoped lang="scss">
.user-list-container {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 3rem 1rem;
  min-height: 100vh;
  background-color: #f4f6f9;
}

.user-list-box {
  width: 100%;
  max-width: 1000px;
  background-color: #fff;
  padding: 2.5rem;
  border-radius: 12px;
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
  text-align: center;

  h2 {
    margin-bottom: 1.5rem;
    color: #2d6cdf;
    font-size: 1.8rem;
  }

  .filters {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-bottom: 2rem;

    input {
      padding: 10px 14px;
      font-size: 15px;
      border: 1px solid #ccc;
      border-radius: 6px;
      width: 250px;
    }

    button {
      background-color: #2d6cdf;
      color: white;
      padding: 10px 16px;
      font-size: 14px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;

      &:hover {
        background-color: #1b4eb5;
      }

      &:active {
        background-color: #143a8f;
      }

      &.clear {
        background-color: #888;
        
        &:hover {
          background-color: #666;
        }

        &:active {
          background-color: #444;
        }
      }
    }
  }

  .user-cards {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    justify-content: center;
  }

  .user-card {
    background-color: #f8faff;
    border: 1px solid #dbe2f1;
    padding: 1.2rem;
    border-radius: 10px;
    width: 300px;
    text-align: left;
    transition: 0.3s ease;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);

    h3 {
      margin-bottom: 0.5rem;
      font-size: 18px;
      color: #333;
    }

    p {
      margin: 4px 0;
      font-size: 14px;
      color: #555;
    }

    &:hover {
      background-color: #eef4ff;
      border-color: #2d6cdf;
    }
  }

  .pagination {
    margin-top: 2rem;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1.2rem;

    button {
      background-color: #2d6cdf;
      color: #fff;
      padding: 8px 14px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: 500;

      &:disabled {
        background-color: #ccc;
        cursor: not-allowed;
      }
    }

    span {
      font-weight: 500;
    }
  }

  .empty {
    color: #888;
    font-size: 15px;
    margin-top: 2rem;
  }
}
</style>
