<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const form = useForm({
  nombre: "",
  estado: true,
});

function submit() {
  form.post("/categorias");
}
</script>

<template>
  <Head title="Crear Categoría" />
  <AuthenticatedLayout>
    <div class="max-w-2xl mx-auto mt-10 bg-white shadow rounded p-6">
      <h1 class="text-2xl font-bold mb-4">Crear nueva categoría</h1>

      <form @submit.prevent="submit" class="space-y-6">
        <!-- Nombre -->
        <div>
          <label for="nombre" class="block text-sm font-medium text-gray-700"
            >Nombre de la categoría</label
          >
          <input
            type="text"
            id="nombre"
            v-model="form.nombre"
            class="mt-1 block w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500"
          />
          <span v-if="form.errors.nombre" class="text-red-600 text-sm">{{
            form.errors.nombre
          }}</span>
        </div>

        <!-- Estado -->
        <div>
          <label class="inline-flex items-center">
            <input
              type="checkbox"
              v-model="form.estado"
              class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
            />
            <span class="ml-2 text-gray-700">¿Activa?</span>
          </label>
          <div v-if="form.errors.estado" class="text-red-600 text-sm mt-1">
            {{ form.errors.estado }}
          </div>
        </div>

        <!-- Botones -->
        <div class="flex justify-between items-center">
          <a href="/categorias" class="text-blue-600 hover:underline"
            >← Volver al listado</a
          >

          <button
            type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 disabled:opacity-50"
            :disabled="form.processing"
          >
            Crear categoría
          </button>
        </div>
      </form>
    </div>
  </AuthenticatedLayout>
</template>
