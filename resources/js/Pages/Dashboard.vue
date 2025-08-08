<script setup>
import { Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

defineProps({
    datos: Object,
    usuario: Object
})
</script>

<template>

    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <div class="max-w-6xl mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">Bienvenido, {{ usuario.nombre }} 👋</h1>
            <p class="text-gray-600 mb-8">Rol: <strong>{{ usuario.rol }}</strong></p>

            <!-- Accesos rápidos -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-10">
                <a href="/categorias" class="bg-blue-50 hover:bg-blue-100 p-6 rounded shadow text-center transition">
                    <h3 class="text-lg font-semibold text-blue-700">Categorías</h3>
                    <p class="text-sm text-gray-600 mt-2">Gestiona las categorías</p>
                </a>

                <a href="/subcategorias"
                    class="bg-green-50 hover:bg-green-100 p-6 rounded shadow text-center transition">
                    <h3 class="text-lg font-semibold text-green-700">Subcategorías</h3>
                    <p class="text-sm text-gray-600 mt-2">Administra subcategorías</p>
                </a>

                <a href="/productos" class="bg-purple-50 hover:bg-purple-100 p-6 rounded shadow text-center transition">
                    <h3 class="text-lg font-semibold text-purple-700">Productos</h3>
                    <p class="text-sm text-gray-600 mt-2">Ver y agregar productos</p>
                </a>

                <a v-if="usuario.rol === 'Administrador'" href="/usuarios"
                    class="bg-red-50 hover:bg-red-100 p-6 rounded shadow text-center transition">
                    <h3 class="text-lg font-semibold text-red-700">Usuarios</h3>
                    <p class="text-sm text-gray-600 mt-2">Administrar usuarios</p>
                </a>
            </div>


            <!-- Contadores -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-10">
                <div class="bg-white p-6 rounded shadow text-center">
                    <h2 class="text-lg font-semibold text-gray-700">Productos</h2>
                    <p class="text-3xl font-bold text-blue-600">{{ datos.totalProductos }}</p>
                </div>

                <div class="bg-white p-6 rounded shadow text-center">
                    <h2 class="text-lg font-semibold text-gray-700">Categorías</h2>
                    <p class="text-3xl font-bold text-green-600">{{ datos.totalCategorias }}</p>
                </div>

                <div class="bg-white p-6 rounded shadow text-center">
                    <h2 class="text-lg font-semibold text-gray-700">Subcategorías</h2>
                    <p class="text-3xl font-bold text-purple-600">{{ datos.totalSubcategorias }}</p>
                </div>

                <div v-if="usuario.rol === 'Administrador'" class="bg-white p-6 rounded shadow text-center">
                    <h2 class="text-lg font-semibold text-gray-700">Usuarios</h2>
                    <p class="text-3xl font-bold text-red-600">{{ datos.totalUsuarios }}</p>
                </div>
            </div>

            <!-- Productos recientes -->
            <div class="bg-white rounded shadow p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Productos recientes</h2>
                <ul v-if="datos.productosRecientes.length > 0" class="divide-y divide-gray-200">
                    <li v-for="prod in datos.productosRecientes" :key="prod.id" class="py-2">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-medium text-gray-700">{{ prod.nombre }}</p>
                                <p class="text-sm text-gray-500">Creado: {{ new
                                    Date(prod.created_at).toLocaleDateString()
                                    }}</p>
                            </div>
                            <span :class="prod.estado ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                                class="px-3 py-1 text-sm font-medium rounded-full">
                                {{ prod.estado ? 'Activo' : 'Inactivo' }}
                            </span>
                        </div>
                    </li>
                </ul>
                <p v-else class="text-gray-500">No hay productos recientes.</p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
