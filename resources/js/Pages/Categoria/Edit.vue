<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
  categoria: Object,
});

const form = useForm({
  nombre: props.categoria.nombre,
  estado: Boolean(props.categoria.estado),
});

function submit() {
  form.put(`/categorias/${props.categoria.id}`);
}
</script>

<template>
  <Head title="Editar Categoría" />
  <AuthenticatedLayout>
    <div class="max-w-2xl mx-auto mt-10 bg-white shadow rounded p-6">
      <h1 class="text-2xl font-bold mb-4">Editar categoría</h1>

      <form @submit.prevent="submit" class="space-y-6">
        <div>
          <label for="nombre" class="block text-sm font-medium text-gray-700"
            >Nombre</label
          >
          <input
            type="text"
            id="nombre"
            v-model="form.nombre"
            class="mt-1 block w-full border-gray-300 rounded shadow-sm"
          />
          <span v-if="form.errors.nombre" class="text-red-600 text-sm">{{
            form.errors.nombre
          }}</span>
        </div>

        <div>
          <label class="inline-flex items-center">
            <input
              type="checkbox"
              v-model="form.estado"
              class="rounded border-gray-300 text-blue-600"
            />
            <span class="ml-2">¿Activa?</span>
          </label>
          <span v-if="form.errors.estado" class="text-red-600 text-sm block">{{
            form.errors.estado
          }}</span>
        </div>

        <div class="flex justify-between items-center">
          <a href="/categorias" class="text-blue-600 hover:underline"
            >← Volver</a
          >
          <button
            type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
          >
            Actualizar
          </button>
        </div>
      </form>
    </div>
  </AuthenticatedLayout>
</template>
