<script setup>
import { router, usePage } from '@inertiajs/vue3'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const page = usePage();
const user = page.props.auth.user;

defineProps({ productos: Array })

function eliminar(id) {
  if (confirm('¿Eliminar este producto?')) {
    router.delete(`/productos/${id}`)
  }
}
</script>

<template>
  <AuthenticatedLayout>
    <div class="max-w-6xl mx-auto px-4 py-8">
      <h1 class="text-3xl font-bold mb-6 text-gray-800">Productos</h1>

      <!-- Botón Crear solo si es admin -->
      <div class="mb-4" v-if="user.rol_id === 1">
        <a href="/productos/create" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
          + Nuevo producto
        </a>
      </div>

      <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-100">
            <tr>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Nombre</th>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Subcategorías</th>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Estado</th>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Acciones</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            <tr v-for="prod in productos" :key="prod.id" class="hover:bg-gray-50 transition">
              <td class="px-6 py-4">{{ prod.nombre }}</td>
              <td class="px-6 py-4">
                <ul class="list-disc list-inside space-y-1 text-sm text-gray-700">
                  <li v-for="sub in prod.sub_categorias" :key="sub.id">
                    {{ sub.nombre }}
                  </li>
                </ul>
              </td>
              <td class="px-6 py-4">
                <span
                  :class="prod.estado ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                  class="px-3 py-1 text-sm font-medium rounded-full"
                >
                  {{ prod.estado ? 'Activo' : 'Inactivo' }}
                </span>
              </td>
              <td class="px-6 py-4 space-x-2">
                <!-- Editar y Eliminar solo si es admin -->
                <template v-if="user.rol_id === 1">
                  <a :href="`/productos/${prod.id}/edit`" class="text-blue-600 hover:underline text-sm">
                    Editar
                  </a>
                  <button @click="eliminar(prod.id)" class="text-red-600 hover:underline text-sm">
                    Eliminar
                  </button>
                </template>
              </td>
            </tr>
          </tbody>
        </table>

        <div v-if="productos.length === 0" class="p-6 text-gray-600">
          No hay productos registrados.
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
