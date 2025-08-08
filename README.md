<p align="center"></p> <p align="center"> <b>Inventario SkinaTech</b> — Prueba técnica para desarrollador FullStack<br> <i>Desarrollado con Laravel, Vue 3 e Inertia.js</i> </p> <p align="center"> <img src="https://img.shields.io/badge/Laravel-12.22.1-red.svg" alt="Laravel"> <img src="https://img.shields.io/badge/PHP-8.3.16-blue.svg" alt="PHP"> <img src="https://img.shields.io/badge/NPM-10.9.2-orange.svg" alt="NPM"> <img src="https://img.shields.io/badge/Vue-3.x-brightgreen.svg" alt="Vue"> </p>

<h3>Inventario.</h3>
<p>Este proyecto es una solución web desarrollada como parte de la prueba técnica para el proceso de selección de programador FullStack. La aplicación permite gestionar un inventario de productos clasificados por categorías y subcategorías, con un sistema de autenticación y control de usuarios basado en roles.</p>

<h3>Funcionalidades principales.</h3>
<ul><li>Autenticación con Laravel Breeze + Vue.js</li>
<li>Roles de usuario: Administrador (CRUD completo) y Básico (solo lectura)</li>
<li>CRUD de:
Categorías (activación/inactivación en cascada)
Subcategorías (activación/inactivación en cascada, conteo automático de productos)
Productos (pueden pertenecer a múltiples subcategorías)
Usuarios (solo accesible por el administrador)</li>
<li>Dashboard con resumen de inventario y productos recientes</li>
<li>Restricciones por rol tanto en vistas como en rutas</li>
</ul>    

<h3>Acceso a usuarios de prueba.</h3>
<ul><b>Administrador:</b>
<li>Usuario: admin@skina.com</li>
<li>Contraseña: admin123</li>
</ul>
<ul><b>Usuario básico:</b>
<li>Usuario: estandar@skina.com</li>
<li>Contraseña: usuario123</li>
</ul>
