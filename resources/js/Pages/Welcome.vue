<script setup>
import { Link } from '@inertiajs/vue3'
defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
})
</script>

<template>
  <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100 text-center px-4">
    <h1 class="text-4xl font-bold mb-4 text-blue-800">Bienvenido a SkinaTech</h1>
    <p class="text-lg mb-6 text-gray-700">
      Sistema de gestión de inventario de dispositivos electrónicos.
    </p>

    <div class="flex gap-4">
      <Link
        v-if="canLogin"
        href="/login"
        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded"
      >
        Iniciar sesión
      </Link>

      <Link
        v-if="canRegister"
        href="/register"
        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded"
      >
        Registrarse
      </Link>
    </div>
  </div>
</template>
