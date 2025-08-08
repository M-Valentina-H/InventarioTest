<script setup>
import { router, usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const page = usePage();
const user = page.props.auth.user;

defineProps({ categorias: Array });

function eliminar(id) {
  if (confirm("¿Eliminar esta categoría?")) {
    router.delete(`/categorias/${id}`);
  }
}
</script>

<template>
  <AuthenticatedLayout>
    <div class="max-w-6xl mx-auto px-4 py-8">
      <h1 class="text-3xl font-bold mb-6 text-gray-800">Categorías</h1>

      <!-- Botón crear solo para admin -->
      <div class="mb-4" v-if="user.rol_id === 1">
        <a href="/categorias/create" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
          + Nueva categoría
        </a>
      </div>

      <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-100">
            <tr>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Nombre</th>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Estado</th>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Acciones</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            <tr v-for="cat in categorias" :key="cat.id" class="hover:bg-gray-50 transition">
              <td class="px-6 py-4">{{ cat.nombre }}</td>
              <td class="px-6 py-4">
                <span :class="cat.estado
                  ? 'bg-green-100 text-green-800'
                  : 'bg-red-100 text-red-800'
                  " class="px-3 py-1 text-sm font-medium rounded-full">
                  {{ cat.estado ? "Activa" : "Inactiva" }}
                </span>
              </td>
              <td class="px-6 py-4 space-x-2">
                <!-- Acciones solo para admin -->
                <template v-if="user.rol_id === 1">
                  <a :href="`/categorias/${cat.id}/edit`" class="text-blue-600 hover:underline text-sm">
                    Editar
                  </a>
                  <button @click="eliminar(cat.id)" class="text-red-600 hover:underline text-sm">
                    Eliminar
                  </button>
                </template>
              </td>
            </tr>
          </tbody>
        </table>

        <div v-if="categorias.length === 0" class="p-6 text-gray-600">
          No hay categorías registradas.
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
