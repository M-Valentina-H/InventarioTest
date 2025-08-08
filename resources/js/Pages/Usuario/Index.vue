<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps({
  usuarios: Object,
});
</script>

<template>
  <Head title="Usuarios" />
  <AuthenticatedLayout>
    <div class="max-w-6xl mx-auto py-8 px-4">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Usuarios</h1>
        <Link
          href="/usuarios/create"
          class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
        >
          Crear Usuario
        </Link>
      </div>

      <div class="bg-white shadow rounded overflow-x-auto">
        <table class="w-full border-collapse">
          <thead class="bg-gray-100">
            <tr>
              <th class="px-4 py-2 border">ID</th>
              <th class="px-4 py-2 border">Nombre</th>
              <th class="px-4 py-2 border">Email</th>
              <th class="px-4 py-2 border">Rol</th>
              <th class="px-4 py-2 border">Estado</th>
              <th class="px-4 py-2 border">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="user in usuarios.data" :key="user.id">
              <td class="px-4 py-2 border">{{ user.id }}</td>
              <td class="px-4 py-2 border">{{ user.name }}</td>
              <td class="px-4 py-2 border">{{ user.email }}</td>
              <td class="px-4 py-2 border">
                {{ user.rol?.nombre || "Sin rol" }}
              </td>
              <td class="px-4 py-2 border">
                <span
                  :class="
                    user.estado
                      ? 'bg-green-100 text-green-800'
                      : 'bg-red-100 text-red-800'
                  "
                  class="px-2 py-1 text-xs rounded-full"
                >
                  {{ user.estado ? "Activo" : "Inactivo" }}
                </span>
              </td>
              <td class="px-4 py-2 border space-x-2">
                <Link
                  :href="`/usuarios/${user.id}/edit`"
                  class="text-blue-600 hover:underline"
                >
                  Editar
                </Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
