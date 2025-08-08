<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="border-b border-gray-200 bg-gradient-to-r from-blue-800 to-blue-900 shadow-md">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-20 justify-between items-center">
                        
                        <!-- Logo + Links -->
                        <div class="flex items-center space-x-10">
                            <!-- Logo -->
                            <Link :href="route('dashboard')" class="flex items-center space-x-2">
                                <ApplicationLogo class="block h-10 w-auto fill-current text-white" />
                                <span class="text-white font-bold text-lg">Inventario</span>
                            </Link>

                            <!-- Navigation Links -->
                            <div class="hidden sm:flex space-x-6">
                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')" class="text-white hover:text-yellow-300 transition">
                                    Dashboard
                                </NavLink>
                                <NavLink :href="route('productos.index')" :active="route().current('productos.index')" class="text-white hover:text-yellow-300 transition">
                                    Productos
                                </NavLink>
                                <NavLink :href="route('categorias.index')" :active="route().current('categorias.index')" class="text-white hover:text-yellow-300 transition">
                                    Categorías
                                </NavLink>
                                <NavLink :href="route('subcategorias.index')" :active="route().current('subcategorias.index')" class="text-white hover:text-yellow-300 transition">
                                    Subcategorías
                                </NavLink>
                                <NavLink v-if="$page.props.auth.user.rol_id === 1" :href="route('usuarios.index')" :active="route().current('usuarios.index')" class="text-white hover:text-yellow-300 transition">
                                    Usuarios
                                </NavLink>
                            </div>
                        </div>

                        <!-- Usuario -->
                        <div class="hidden sm:flex items-center space-x-4">
                            <span class="text-white font-medium">
                                {{ $page.props.auth.user.name }}
                            </span>
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <button type="button" class="flex items-center space-x-1 bg-white text-gray-700 px-3 py-2 rounded-md shadow hover:bg-gray-100 transition">
                                        <span>Cuenta</span>
                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </template>

                                <template #content>
                                    <DropdownLink :href="route('profile.edit')">
                                        Perfil
                                    </DropdownLink>
                                    <DropdownLink :href="route('logout')" method="post" as="button">
                                        Cerrar sesión
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                        </div>

                        <!-- Botón móvil -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center rounded-md p-2 text-white hover:bg-blue-700 focus:outline-none"
                            >
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{ hidden: showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{ hidden: !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Menú móvil -->
                <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="sm:hidden bg-blue-900">
                    <div class="space-y-1 pb-3 pt-2">
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')" class="text-white">
                            Dashboard
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('productos.index')" :active="route().current('productos.index')" class="text-white">
                            Productos
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('categorias.index')" :active="route().current('categorias.index')" class="text-white">
                            Categorías
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('subcategorias.index')" :active="route().current('subcategorias.index')" class="text-white">
                            Subcategorías
                        </ResponsiveNavLink>
                        <ResponsiveNavLink v-if="$page.props.auth.user.rol_id === 1" :href="route('usuarios.index')" :active="route().current('usuarios.index')" class="text-white">
                            Usuarios
                        </ResponsiveNavLink>
                    </div>

                    <!-- Datos de usuario -->
                    <div class="border-t border-blue-700 pb-1 pt-4 px-4">
                        <div class="text-base font-medium text-white">
                            {{ $page.props.auth.user.name }}
                        </div>
                        <div class="text-sm text-blue-300">
                            {{ $page.props.auth.user.email }}
                        </div>
                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')" class="text-white">
                                Perfil
                            </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button" class="text-white">
                                Cerrar sesión
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Contenido -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
