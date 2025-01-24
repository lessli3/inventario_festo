
# Control Festo




## Indice


* [Descripcion del proyecto](#Descripcion-del-proyecto)

* [Caracteristicas del proyecto](#Caracteristicas-del-proyecto)

* [Requisitos previos](#Requisitos-previos)

* [Instalacion](#Instalacion)

* [Uso](#Uso)

* [Tecnologias utilizadas](#tecnologias-utilizadas)

* [Versiones y Herramientas de Laravel](#Versiones-y-Herramientas-de-Laravel)
  
* [Estructura del proyecto](#Estructura-del-proyecto)

* [Desarrolladores del Proyecto](#desarrolladores-del-proyecto)






## Descripcion del proyecto

Este proyecto tiene como objetivo organizar y gestionar un inventario de herramientas, asegurando su disponibilidad y uso adecuado. Incluye un sistema de registro detallado que permite clasificar y rastrear cada herramienta mediante un código único. Los usuarios pueden solicitar herramientas, cuya disponibilidad será gestionada por una persona encargada, verificando el estado de cada una antes de su entrega. Con este sistema, se busca optimizar la administración de herramientas, facilitar el acceso y mejorar la eficiencia en su uso.


![image](https://github.com/user-attachments/assets/23050308-2be1-4c5a-9bc9-f7e408687e89)
![image](https://github.com/user-attachments/assets/0d7b2ae2-ac07-470b-bbe3-9fbc6161fe40)
![image](https://github.com/user-attachments/assets/ce26afd1-a06d-4801-89fe-d25677f08dd5)




## Caracteristicas del proyecto

- **Registro y Clasificación Detallada:** 
Cada herramienta está catalogada con un código único, tipo, características y estado, permitiendo un seguimiento exhaustivo.
- **Gestión de Disponibilidad en Tiempo Real:**
Muestra en tiempo real la disponibilidad de cada herramienta, facilitando la organización y evitando conflictos de solicitudes.
- **Solicitud y Reserva Eficiente:**
 Los usuarios pueden solicitar y reservar herramientas desde el sistema, agilizando el acceso.
- **Reportes de Uso y Estado**
Genera informes sobre el uso y estado de las herramientas, ayudando en la planificación y mantenimiento del inventario.
- **Interfaz Intuitiva**
Diseño fácil de usar que mejora la experiencia de los usuarios y facilita la navegación en el sistema.


## Requisitos previos

Antes de instalar el proyecto, asegúrate de tener instalados los siguientes programas y herramientas:

- **Visual Studio Code:** 
Un editor de código fuente ampliamente recomendado para el desarrollo. Es ligero, potente y compatible con múltiples extensiones que facilitan el trabajo.
- **XAMPP:**
Un paquete de software que incluye Apache, MySQL, PHP y Perl. Útil para configurar un entorno de desarrollo local en su computadora.
- **Laravel:**
  Un framework de PHP que facilita el desarrollo de aplicaciones web robustas y mantenibles. Se puede instalar a través de Composer.
- **Composer:**
 El gestor de dependencias oficial para PHP, necesario para instalar y manejar las dependencias del proyecto.
- **Git:**
 Un sistema de control de versiones que permite gestionar cambios en el código, colaborar con otros desarrolladores y manejar repositorios.
- **Node.jsy npm:**
Herramientas esenciales para la gestión de dependencias y paquetes de frontend, además de permitir el uso de utilidades como Laravel Mix para compilar activos.
- **PostgreSQL:**
  Sistema de gestión de bases de datos que será utilizado en este proyecto. Asegúrese de tenerlo instalado y correctamente configurado.


## Instalacion

Sigue estos pasos para configurar el proyecto localmente:
Antes de clonar el repositorio, es importante asegurarse de tener el entorno de desarrollo correctamente configurado.Es decir, asegurarse de que los siguientes programas y herramientas estén correctamente instalados y configurados en su sistema operativo:

- Visual Studio Code
  https://code.visualstudio.com/
- XAMPP
- Laravel
- Composer
- Git
- Node.jsy npm
- PostgreSQL

  
A continuación, se detalla el orden de las carpetas  y los pasos necesarios  para que el proyecto funcione adecuadamente:

 **Orden de las Carpetas:**
 
Asegúrate de ubicarte en la carpeta adecuada antes de clonar el repositorio y proceder con la instalación del proyecto. El proyecto debe estar ubicado en la siguiente ruta en tu equipo:

Este equipo > Disco local (C:) > xampp > htdocs > inventario_festo

![image](https://github.com/user-attachments/assets/29de2543-6e23-48d5-88b9-69723b3291fd)




1 **Clonar el repositorio**

![image](https://github.com/user-attachments/assets/741ecaf9-d68d-40a0-9c33-17b2ec3f60dd)

2 **Instalar las dependencias**

![image](https://github.com/user-attachments/assets/609418a4-0eb7-430b-9990-5f1088e8a02c)

3 **Configurar el archivo .env**

![image](https://github.com/user-attachments/assets/40702987-8be9-4132-bbfa-97232025fba0)

4 **Configurar la base de datos en el archivo .env** 

![image](https://github.com/user-attachments/assets/6ef86455-ccb5-4d87-862a-f5ebac7efc65)

5 **Ejecutar las migraciones**

![image](https://github.com/user-attachments/assets/7e69a608-58f1-4fb2-9077-24f0c8f62cb8)

6 **Iniciar el servidor de desarrollo**

![image](https://github.com/user-attachments/assets/51ec231e-7039-47f3-9927-d60ffd08f67a)




## Uso

Para acceder a las diferentes funcionalidades del sistema, sigue estos pasos:

**Inicio:**

El sistema permite que los usuarios con uno de los tres roles definidos inicien sesión usando su número de documento de identidad. Se envía un código de verificación al correo electrónico del usuario para confirmar su identidad, gestionado de forma segura por Mailtrap. Esto asegura que solo personas autorizadas puedan acceder al sistema.

![image](https://github.com/user-attachments/assets/7a158aa9-ee70-40a7-ae37-95194f213184)
![image](https://github.com/user-attachments/assets/3416230e-f882-4be5-902d-39f62e81db15)

 **Roles disponibles:**
 
En el sistema, cada usuario tiene un rol específico (Cuentadante, Instructor o Monitor), el cual determina las acciones y opciones disponibles. Estas funciones están diseñadas para mejorar la organización y el manejo de herramientas en Festo, además de facilitar el trabajo en equipo entre los diferentes roles.
- Rol de Cuentadante:

  Su funcion principal es gestionar la creacion y administracion de las herramientas disponibles en Festo

  
  ![image](https://github.com/user-attachments/assets/fbfedbae-56ca-4b2a-b98c-24ea39050636)
  ![image](https://github.com/user-attachments/assets/0d7b2ae2-ac07-470b-bbe3-9fbc6161fe40)
  ![image](https://github.com/user-attachments/assets/ce26afd1-a06d-4801-89fe-d25677f08dd5)



- Rol de Intructor:

  Su funcion principal es solicitar las herramientas que  se requeran.
  

  ![image](https://github.com/user-attachments/assets/e36b3ec3-d5cf-4ff6-beca-f5328f930887)
  ![image](https://github.com/user-attachments/assets/262ca66f-bd67-4c56-b9c9-23896dc76887)
  ![image](https://github.com/user-attachments/assets/69dc5007-838d-42cb-a481-5b32a40c5aef)



  
- Rol de Monitor

  Su funcion principal es revisar las solicitudes pendientes y entregar las herramientas que se han solicitado.

  
  ![image](https://github.com/user-attachments/assets/8f3c56de-cc79-4470-8caf-145d9dc04853)
  ![image](https://github.com/user-attachments/assets/bc4d2665-3496-48ad-a104-9caf824f9449)
  ![image](https://github.com/user-attachments/assets/5ee872b9-d88d-4c27-8000-c17ad07da752)




## Tecnologias utilizadas

- Laravel
- Livewire
- PostgreSQL
- Mailtrap
  
  
## Versiones y Herramientas de Laravel
Este proyecto está desarrollado utilizando Laravel 11 , la versión más reciente de este destacado framework de PHP. Laravel se caracteriza por su enfoque en la simplicidad y la eficiencia, ofreciendo una plataforma moderna para el desarrollo de aplicaciones web. Entre las principales herramientas y características implementadas en este proyecto se encuentran:

- **Artisan:**
La línea de comandos de Laravel que proporciona herramientas para generar código, realizar migraciones de base de datos y automatizar tareas de desarrollo.

- **Middleware:** 
Un sistema que gestiona solicitudes HTTP antes de que lleguen al controlador. Se utiliza para autenticar usuarios, autorizar acciones y aplicar filtros personalizados.

- **Sistema de Validación y Autenticación:** 
Laravel incluye un sistema robusto para validar datos y manejar la autenticación de usuarios de manera segura y eficiente.

- **Livewire:** 
Utilizado para construir interfaces de usuario dinámicas sin necesidad de escribir JavaScript. Algunas de sus características clave son:
  - Actualización Reactiva: Sincronización automática entre el frontend y backend.
Fácil Integración: Compatible con Blade y otras herramientas de Laravel, lo que permite desarrollar componentes dinámicos fácilmente.
  - Laravel Sail:
Una solución ligera basada en Docker para configurar un entorno de desarrollo completo. Facilita la creación de entornos consistentes sin complicaciones.



## Estructura del proyecto



| **Descripción**                                                                                                                                                          | **Imagen**                                                                                                                |
|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------|---------------------------------------------------------------------------------------------------------------------------|
| La carpeta `app` incluye la lógica principal de la aplicación, con subcarpetas como `Actions` para acciones específicas, `Fortify` para gestión de usuarios y contraseñas, `Http` para controladores HTTP, `Console` para comandos, y `Exceptions` para manejo de excepciones. | ![image](https://github.com/user-attachments/assets/5f23a252-1366-40b8-aa04-ebe6743c2ee4)                                 |
| Este directorio contiene los archivos fuente de la aplicación, organizados en componentes como `Livewire` para la interfaz de usuario, y archivos como `Carritolist.php`, `Herramientalist.php`, `Inventariolist.php` y `Solicitudeslist.php`, que generan listas específicas. | ![image](https://github.com/user-attachments/assets/5bee6c34-1a63-49fa-b52c-928b6bbb6feb)                                 |
| Middleware contiene scripts para gestionar la autenticación, seguridad y configuración de la aplicación. Mail incluye archivos para el envío de correos relacionados con solicitudes y verificación. Models parece almacenar modelos de datos para gestionar categorías, solicitudes, herramientas, inventario y usuarios. | ![image](https://github.com/user-attachments/assets/cdc81a5b-acc0-40e3-bec8-1f09052ceff4)                                 |
| Providers registra servicios como autenticación, eventos y rutas en Laravel; y View/Components, que almacena componentes reutilizables para la interfaz, como maquetaciones para usuarios autenticados e invitados. | ![image](https://github.com/user-attachments/assets/23d883bf-9934-4293-b8e4-dba12a632f21)                                 |
| Bootstrap para el arranque del framework, cache para mejorar el rendimiento, y config con archivos que gestionan la configuración de la aplicación, autenticación, base de datos y más. También se encuentran archivos clave como `.gitignore` para exclusiones de Git y `livewire-components.php` para la configuración de Livewire. | ![image](https://github.com/user-attachments/assets/c8926542-ff3d-42a0-ba82-18f3b01a17cb)                                 |
| La carpeta database gestiona la configuración de la base de datos, con factories para generar datos de prueba, como `UserFactory.php`, y migrations para describir cambios en la estructura de la base de datos, como la creación de tablas de usuarios y recuperación de contraseñas. | ![image](https://github.com/user-attachments/assets/81a7fb74-ce5f-4f43-bf1c-c621da00f138)                                 |
| Seeders para poblar la base de datos, `lang/en` para los archivos de idioma en inglés, y configuraciones como `auth.php`, `pagination.php`, `passwords.php` y `validation.php`. La carpeta `node_modules` gestiona dependencias de Node.js. | ![image](https://github.com/user-attachments/assets/dd9e2cae-2358-43f5-9969-6557db32b6fb)                                 |
| `public` contiene recursos estáticos accesibles desde el navegador. Dentro de esta carpeta, `css` incluye varios archivos CSS para el diseño, como los específicos para el panel de control y la página de inicio. La carpeta `imagenes` alberga imágenes relacionadas con el código y las herramientas, mientras que `img` contiene imágenes adicionales para distintas secciones, como la página de inicio y las tarjetas. | ![image](https://github.com/user-attachments/assets/88659af9-ec71-4ffc-8c8d-24c844dc6cc2)                                 |
| `resources` contiene recursos estáticos como CSS y JavaScript. `markdown` tiene documentos de políticas y términos. `views` alberga las vistas de la aplicación. `api` gestiona la API, mientras que `auth` maneja la autenticación. `components` incluye componentes Blade, como mensajes de acción. | ![image](https://github.com/user-attachments/assets/7903bf6c-448e-4be2-b6d1-ef060b391265)                                 |
| El proyecto incluye una serie de plantillas Blade reutilizables para componentes de interfaz de usuario. Estas abarcan secciones como `action-section` para acciones, `application-logo` y `application-mark` para la identidad visual, `authentication-card` para tarjetas de autenticación, `banner` para anuncios, `button` y `checkbox` para elementos interactivos, `confirm-modal` y `dialog-modal` para ventanas modales, y `form-section` e `input-error` para formularios y manejo de errores, entre otros. | ![image](https://github.com/user-attachments/assets/7feaf1d7-9de4-4060-86dd-ebb3238b2d45)                                 |
| Se organizan plantillas en dos carpetas principales: `emails` para correos electrónicos y `herramientas` para funcionalidades específicas. En el directorio raíz hay componentes Blade reutilizables y una plantilla de bienvenida, además de un archivo para invitaciones a equipos. | ![image](https://github.com/user-attachments/assets/33bbbdf5-61f7-4786-bd11-337d09f5f2d0)                                 |
| Organiza vistas y componentes en carpetas como `inventario` para módulos específicos, `diseños` para diseños base y navegación, y `livewire` para componentes interactivos. En la raíz se encuentran vistas principales, y también hay un archivo de texto posiblemente temporal o con extensión incorrecta. | ![image](https://github.com/user-attachments/assets/4765864f-3ecb-43c7-a34c-8720a581dcbe)                                 |
| Organiza vistas y archivos en carpetas como `pdf` para documentos, `posts` para publicaciones, `perfil` para gestionar usuarios, `solicitudes` para gestionar solicitudes, y `usuarios` para administrar perfiles. También incluye formularios, vistas principales y archivos como `solicitud.blade.php`. | ![image](https://github.com/user-attachments/assets/7aa2fc8c-fd7f-49f4-9fe7-e703b44f2436)                                 |
| Se presenta una estructura organizada con vistas (`.blade.php`) y rutas. Entre las vistas destacan `index.blade.php` (inicio), `Dashboard.blade.php` (panel de control) y otras para funcionalidades específicas como calendario, solicitudes y escáner. También hay archivos de texto (`.txt`) para menús, términos y bienvenida que podrían requerir ajustes en su formato. La carpeta de rutas gestiona la configuración de rutas de la aplicación. | ![image](https://github.com/user-attachments/assets/20e31805-fb42-4c44-915e-5cecf1b51f6d)                                 |
| Está organizado en carpetas clave: `console.php` para comandos de administración, `web.php` para rutas y lógica web, y `storage` para archivos persistentes. La carpeta `tests` incluye pruebas unitarias y funcionales, con subcarpeta `Feature` que verifica características como autenticación, gestión de perfiles, tokens de API y autenticación de dos factores. | ![image](https://github.com/user-attachments/assets/57cadd31-930e-4b46-9ae1-2cf29384ff72)                                 |
| Incluye carpetas y archivos clave como `Unit` para pruebas unitarias, `vendor` para dependencias de Composer y varios archivos de configuración (`.env`, `.gitignore`, `composer.json`, etc.). También incluye herramientas de desarrollo como `artisan` para comandos de Laravel, `phpunit.xml` para pruebas unitarias y configuraciones de CSS y JavaScript (`postcss.config.js`, `package.json`). | ![image](https://github.com/user-attachments/assets/d77ac0f1-918e-4948-b5c0-f23aa15cfa22)                                 |

        

![image](https://github.com/user-attachments/assets/5dd687f5-c17e-4ab6-a0fb-0707f6cb3e82)
![image](https://github.com/user-attachments/assets/c809ac6f-6d98-49b2-8937-8adfd7a4abe5)



## Desarrolladores del proyecto
- Lesly Silva
- Angie Galindo





