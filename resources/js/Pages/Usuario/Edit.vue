<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'

const props = defineProps({
  usuario: Object,
  roles: Array
})

const form = useForm({
  name: props.usuario.name,
  email: props.usuario.email,
  password: '',
  rol_id: props.usuario.rol_id,
  estado: Boolean(props.usuario.estado)
})

function submit() {
  form.put(`/usuarios/${props.usuario.id}`)
}
</script>

<template>
  <Head title="Editar Usuario" />
  <AuthenticatedLayout>
    <div class="max-w-2xl mx-auto mt-10 bg-white shadow rounded p-6">
      <h1 class="text-2xl font-bold mb-4">Editar usuario</h1>

      <form @submit.prevent="submit" class="space-y-6">
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
          <input v-model="form.name" type="text" id="name" class="mt-1 block w-full border-gray-300 rounded" />
          <span v-if="form.errors.name" class="text-red-600 text-sm">{{ form.errors.name }}</span>
        </div>

        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input v-model="form.email" type="email" id="email" class="mt-1 block w-full border-gray-300 rounded" />
          <span v-if="form.errors.email" class="text-red-600 text-sm">{{ form.errors.email }}</span>
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Contraseña (opcional)</label>
          <input v-model="form.password" type="password" id="password" class="mt-1 block w-full border-gray-300 rounded" />
          <span v-if="form.errors.password" class="text-red-600 text-sm">{{ form.errors.password }}</span>
        </div>

        <div>
          <label for="rol_id" class="block text-sm font-medium text-gray-700">Rol</label>
          <select v-model="form.rol_id" id="rol_id" class="mt-1 block w-full border-gray-300 rounded">
            <option value="">Seleccione un rol</option>
            <option v-for="rol in roles" :key="rol.id" :value="rol.id">{{ rol.nombre }}</option>
          </select>
          <span v-if="form.errors.rol_id" class="text-red-600 text-sm">{{ form.errors.rol_id }}</span>
        </div>

        <div>
          <label class="inline-flex items-center">
            <input type="checkbox" v-model="form.estado" class="rounded border-gray-300 text-blue-600" />
            <span class="ml-2">Activo</span>
          </label>
        </div>

        <div class="flex justify-between">
          <a href="/usuarios" class="text-blue-600 hover:underline">← Volver</a>
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Actualizar
          </button>
        </div>
      </form>
    </div>
  </AuthenticatedLayout>
</template>
