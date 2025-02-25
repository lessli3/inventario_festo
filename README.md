
# Control Festo




## Indice


* [Descripcion del proyecto](#Descripcion-del-proyecto)

* [Caracteristicas del proyecto](#Caracteristicas-del-proyecto)

* [Requisitos previos](#Requisitos-previos)

* [Instalacion](#Instalacion)

* [Uso](#Uso)

* [Tecnologias utilizadas](#tecnologias-utilizadas)

* [Versiones  Implementadas](#Versiones-Implementadas)
  
* [Estructura del proyecto](#Estructura-del-proyecto)

* [Canal de YouTube del Proyecto](#Canal-de-YouTube-del-Proyecto)

* [Desarrolladores del Proyecto](#desarrolladores-del-proyecto)






## Descripcion del proyecto

Este proyecto tiene como objetivo organizar y gestionar un inventario de herramientas, asegurando su disponibilidad y uso adecuado. Incluye un sistema de registro detallado que permite clasificar y rastrear cada herramienta mediante un código único. Los usuarios pueden solicitar herramientas, cuya disponibilidad será gestionada por una persona encargada, verificando el estado de cada una antes de su entrega. Con este sistema, se busca optimizar la administración de herramientas, facilitar el acceso y mejorar la eficiencia en su uso.


![image](https://github.com/user-attachments/assets/192565a9-77b2-494e-80ee-f19db31cb9a9)
![image](https://github.com/user-attachments/assets/73a5648c-7cd0-4022-9455-29f872141e85)
![image](https://github.com/user-attachments/assets/be3d84db-7172-4f39-9b59-c63dac84687f)





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
Antes de clonar el repositorio, es importante asegurarse de tener el entorno de desarrollo correctamente configurado.Es decir, asegurarse de que los siguientes programas y herramientas estén correctamente instalados y configurados en su sistema operativo,Además, asegúrate de que estén añadidos al PATH del sistema para que puedan ser reconocidos y utilizados sin problemas.
Aquí te dejo los enlaces para que puedas instalarlos sin ningún inconveniente. 

- Visual Studio Code:
  https://code.visualstudio.com/
- XAMPP:
   https://www.apachefriends.org/es/index.html
- Laravel:
  https://laravel.com/docs/11.x/installation
- Composer:
  https://getcomposer.org/download/
- Git:
  https://git-scm.com/downloads
- Node.jsy npm:
  https://nodejs.org/en/download
- PostgreSQL:
  https://www.pgadmin.org/download/

  
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

![image](https://github.com/user-attachments/assets/4b17b5dd-687a-4893-9de7-4da1c06e25f2)
![image](https://github.com/user-attachments/assets/39731900-b80a-4444-a9c5-105dbb141b75)


 **Roles disponibles:**
 
En el sistema, cada usuario tiene un rol específico (Cuentadante, Instructor o Monitor), el cual determina las acciones y opciones disponibles. Estas funciones están diseñadas para mejorar la organización y el manejo de herramientas en Festo, además de facilitar el trabajo en equipo entre los diferentes roles.
- Rol de Cuentadante:

  Su funcion principal es gestionar la creacion y administracion de las herramientas disponibles en Festo

  
![image](https://github.com/user-attachments/assets/91174caa-7774-4a68-a971-16395f4f7f8c)
![image](https://github.com/user-attachments/assets/f997be2b-90a4-499d-9d89-fc1830faedeb)
![image](https://github.com/user-attachments/assets/14f4210c-650c-4722-bb59-335c8f76cbf2)




- Rol de Intructor:

  Su funcion principal es solicitar las herramientas que  se requeran.
  

![image](https://github.com/user-attachments/assets/1f087464-697d-4e5e-afc6-1c21979dbea6)
![image](https://github.com/user-attachments/assets/c950e199-7ea4-403f-989d-d2316be269d8)
![image](https://github.com/user-attachments/assets/7cebd100-b1e6-48fd-afa5-9460658a0766)




  
- Rol de Monitor

  Su funcion principal es revisar las solicitudes pendientes y entregar las herramientas que se han solicitado.

  
![image](https://github.com/user-attachments/assets/7bb6a0fb-1fe4-40a3-878a-e61ec9ebf79e)
![image](https://github.com/user-attachments/assets/067f479b-4fb0-4b12-a0df-1363e69007c8)
![image](https://github.com/user-attachments/assets/074ec9a1-63ee-4242-b6c4-aa18edf55b9d)





## Tecnologias utilizadas

- Laravel
- Livewire
- PostgreSQL
- XAMPP
- PHP
- Git
- Composer
- Node.jsy
  
  
## Versiones Implementadas
 Entre las principales herramientas y características implementadas en este proyecto se encuentran:

- **Visual Studio Code:** 1.96.4
- **XAMPP:** Version 3.3.0
- **PHP:** Version 8.0
- **Laravel:** Version 9.52.17
- **Composer:** Version 2.7.9
- **Git:** Version 2.46.0
- **Node.js:** Version 20.18.1
- **npm** Version 10.9.2
- **PostgreSQL** Version 16 




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


## Canal de YouTube del Proyecto

Este proyecto tiene un canal de YouTube donde se subieron videos para que los usuarios entiendan mejor cómo funciona todo y tengan más herramientas para trabajar con él. La idea es que quien siga con el proyecto pueda usar o actualizar el canal sin problema. A continuación, te dejo la información necesaria para acceder a la cuenta:

- **Correo Electronico:** controlfesto@gmail.com
- **Contraseña:** controlsena&fest0
- **URL para acceso al canal de youtube:** https://www.youtube.com/@controlfesto24
  

## Desarrolladores del proyecto
- Lesly Lievano
- Angie Galindo





