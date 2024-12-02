

# Control Festo




## Indice


* [Descripción del proyecto](#Descripción-del-proyecto)

* [Características del proyecto](#Características-del-proyecto)

* [Instalacion](#Instalacion)

* [Uso](#Uso)

* [Tecnologías utilizadas](#tecnologías-utilizadas)
  
* [Estructura del proyecto](#Estructura-del-proyecto)

* [Desarrolladores del Proyecto](#desarrolladores)






## Descripcion del proyecto

Este proyecto tiene como objetivo organizar y gestionar un inventario de herramientas, asegurando su disponibilidad y uso adecuado. Incluye un sistema de registro detallado que permite clasificar y rastrear cada herramienta mediante un código único. Los usuarios pueden solicitar herramientas, cuya disponibilidad será gestionada por una persona encargada, verificando el estado de cada una antes de su entrega. Con este sistema, se busca optimizar la administración de herramientas, facilitar el acceso y mejorar la eficiencia en su uso.


![image](https://github.com/user-attachments/assets/c3148fdc-9c01-4c38-8e2c-a9f34018e930)
![image](https://github.com/user-attachments/assets/5f9b9f09-0269-4a63-949c-dab53e95c942)
![image](https://github.com/user-attachments/assets/56c8570e-66ca-434c-837d-37e9943b0b28)




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
- **Inicio de sesion:**
Permite que los usuarios que pertenecen a uno de los tres roles definidos accedan al sistema. Los usuarios pueden iniciar sesión usando su número de documento de identidad. Una vez ingresado este dato, se envía un código de verificación al correo electrónico del usuario para confirmar su identidad. Este proceso se gestiona con Mailtrap, que se encarga de enviar el código de forma segura y de probar el envío de correos. Esto garantiza que solo las personas autorizadas podrán ingresar al sistema de manera sencilla y protegida.
- **Roles disponibles:**
En el sistema, cada usuario tiene un rol específico (Cuentadante, Instructor o Monitor), el cual determina las acciones y opciones disponibles. Estas funciones están diseñadas para mejorar la organización y el manejo de herramientas en Festo, además de facilitar el trabajo en equipo entre los diferentes roles.


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





