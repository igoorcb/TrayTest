import { defineStore } from 'pinia'
import axios from 'axios'

export interface User {
  id: number
  name: string
  email: string
  cpf: string
  birthdate: string
}
interface UserFilters {
  name: string
  cpf: string
  sort_by: string
  sort_dir: string
  page: number
}

export const useUserStore = defineStore('user', {
  state: () => ({
    users: [] as User[],
    filters: {
      name: '',
      cpf: '',
      sort_by: 'id',
      sort_dir: 'desc',
      page: 1
    } as UserFilters,
    lastPage: 1
  }),

  actions: {
    async fetchUsers() {
      try {
        const { data } = await axios.get('http://localhost:8000/api/users', {
          params: this.filters
        })
        this.users = data.data
        this.lastPage = data.meta.last_page
      } catch (err) {
        console.error('Erro ao buscar usuários:', err)
      }
    },

    updateFilter(field: keyof UserFilters, value: string | number) {
      this.filters[field] = value as never
      this.filters.page = 1
      this.fetchUsers()
    },

    resetFilters() {
      this.filters.name = ''
      this.filters.cpf = ''
      this.filters.page = 1
    },

    nextPage() {
      if (this.filters.page < this.lastPage) {
        this.filters.page++
        this.fetchUsers()
      }
    },

    prevPage() {
      if (this.filters.page > 1) {
        this.filters.page--
        this.fetchUsers()
      }
    }
  }
})
