x

# Control Festo




## Indice


* [Descripción del proyecto](#Descripción-del-proyecto)

* [Características del proyecto](#Características-del-proyecto)

* [Requisitos previos](#Requisitos-previos)

* [Instalacion](#Instalacion)

* [Uso](#Uso)

* [Tecnologías utilizadas](#tecnologías-utilizadas)
  
* [Estructura del proyecto](#Estructura-del-proyecto)

* [Desarrolladores del Proyecto](#desarrolladores)






## Descripcion del proyecto

Este proyecto tiene como objetivo organizar y gestionar un inventario de herramientas, asegurando su disponibilidad y uso adecuado. Incluye un sistema de registro detallado que permite clasificar y rastrear cada herramienta mediante un código único. Los usuarios pueden solicitar herramientas, cuya disponibilidad será gestionada por una persona encargada, verificando el estado de cada una antes de su entrega. Con este sistema, se busca optimizar la administración de herramientas, facilitar el acceso y mejorar la eficiencia en su uso.


![image](https://github.com/user-attachments/assets/23050308-2be1-4c5a-9bc9-f7e408687e89)
![image](https://github.com/user-attachments/assets/0d7b2ae2-ac07-470b-bbe3-9fbc6161fe40)
![image](https://github.com/user-attachments/assets/ce26afd1-a06d-4801-89fe-d25677f08dd5)




## Caracteristicas

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
Un editor de código fuente recomendado para el desarrollo.
- **XAMPP:**
Un paquete de software que incluye Apache, MySQL, PHP y Perl. Es útil para configurar un entorno de desarrollo en tu computadora.
- **Composer:**
 Un gestor de dependencias para PHP.
- **Git:**
 Un sistema de control de versiones.
- **Node.jsy npm:**
Necesarios para la gestión de dependencias y paquetes de frontend.
- **PostgreSQL:**
  Sistema de gestión de bases de datos que se usará en el proyecto. Asegúrate de tenerlo instalado y configurado.


## Instalación

Sigue estos pasos para configurar el proyecto localmente:
Antes de clonar el repositorio, es importante asegurarse de tener el entorno de desarrollo correctamente configurado. A continuación, se detalla el orden de las carpetas  y los pasos necesarios  para que el proyecto funcione adecuadamente:

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

4 **Configurar la base de datos** 

![image](https://github.com/user-attachments/assets/6ef86455-ccb5-4d87-862a-f5ebac7efc65)

5 **Ejecutar las migraciones**

![image](https://github.com/user-attachments/assets/7e69a608-58f1-4fb2-9077-24f0c8f62cb8)

6 **Iniciar el servidor de desarrollo**

![image](https://github.com/user-attachments/assets/51ec231e-7039-47f3-9927-d60ffd08f67a)




## Uso

Para acceder a las diferentes funcionalidades del sistema, sigue estos pasos:

**Inicio de sesion:**

Permite que los usuarios que pertenecen a uno de los tres roles definidos accedan al sistema. Los usuarios pueden iniciar sesión usando su número de documento de identidad. Una vez ingresado este dato, se envía un código de verificación al correo electrónico del usuario para confirmar su identidad. Este proceso se gestiona con Mailtrap, que se encarga de enviar el código de forma segura y de probar el envío de correos. Esto garantiza que solo las personas autorizadas podrán ingresar al sistema de manera sencilla y protegida.

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

## Estructura del proyecto

![image](https://github.com/user-attachments/assets/5dd687f5-c17e-4ab6-a0fb-0707f6cb3e82)

![image](https://github.com/user-attachments/assets/c809ac6f-6d98-49b2-8937-8adfd7a4abe5)




## Desarrolladores del proyecto
- Lesly Silva
- Angie Galindo





