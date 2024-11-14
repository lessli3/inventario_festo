

# Inventario Festo

### Descripcion

Este proyecto tiene como objetivo organizar y gestionar un inventario de herramientas, asegurando su disponibilidad y uso adecuado. Incluye un sistema de registro detallado que permite clasificar y rastrear cada herramienta mediante un código único. Los usuarios pueden solicitar herramientas, cuya disponibilidad será gestionada por una persona encargada, verificando el estado de cada una antes de su entrega. Con este sistema, se busca optimizar la administración de herramientas, facilitar el acceso y mejorar la eficiencia en su uso.


![image](https://github.com/user-attachments/assets/c3148fdc-9c01-4c38-8e2c-a9f34018e930)
![image](https://github.com/user-attachments/assets/5f9b9f09-0269-4a63-949c-dab53e95c942)
![image](https://github.com/user-attachments/assets/56c8570e-66ca-434c-837d-37e9943b0b28)




### Caracteristicas

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



## Creacion

Este proyecto de inventario de herramientas está desarrollado en Laravel, utilizando Livewire para crear una interfaz interactiva y dinámica. Laravel proporciona una base robusta para la gestión de datos y la seguridad, mientras que Livewire facilita la actualización en tiempo real de la interfaz sin necesidad de recargar la página. La combinación de estas tecnologías permite una experiencia de usuario fluida, optimizando tanto la administración del inventario como la eficiencia en el acceso y reserva de herramientas.

![image](https://github.com/user-attachments/assets/2030530b-8bff-4fcb-9e97-06831cc3c832)
![image](https://github.com/user-attachments/assets/cd6a956c-1911-43e7-ae76-512d8bdbbc9b)
![image](https://github.com/user-attachments/assets/0e33f577-dcac-4e66-82a4-39c352c4b9c3)




## Funcionalidad del proyecto

### Home
En la sección principal de la página, encontraremos un apartado dedicado a Festo. En este espacio, se presenta una descripción detallada de qué es Festo, qué tipo de recursos y herramientas se pueden encontrar en él, y cuál es su propósito y funcionalidad dentro del sistema. Esta sección está diseñada para proporcionar una visión completa y clara, permitiendo a los usuarios comprender mejor la importancia de Festo y cómo pueden aprovechar sus características y beneficios. El enfoque principal de esta parte de la página es destacar las funcionalidades clave y su relevancia para los usuarios que interactúan con el sistema.

![image](https://github.com/user-attachments/assets/1bc5915f-b7d8-4dff-a38a-8fe6e8c8a721)
![image](https://github.com/user-attachments/assets/bc4028f4-615e-4039-bcde-e8c93b14c47b)


### Inicio sesion

En este apartado, se encuentra la funcionalidad de inicio de sesión, la cual permite que los usuarios que pertenecen a uno de los cuatro roles definidos accedan al sistema. Los usuarios pueden iniciar sesión usando su número de documento de identidad. Una vez ingresado este dato, se envía un código de verificación al correo electrónico del usuario para confirmar su identidad. Este proceso se gestiona con Mailtrap, que se encarga de enviar el código de forma segura y de probar el envío de correos. Esto garantiza que solo las personas autorizadas podrán ingresar al sistema de manera sencilla y protegida.

![image](https://github.com/user-attachments/assets/622ef83f-3be5-4d12-a3fe-903d47e1569a)
![image](https://github.com/user-attachments/assets/5398494f-9a82-4bbb-8ffc-e82fe3baa246)
![image](https://github.com/user-attachments/assets/23e8de38-30a7-4af9-ac3e-916f7d34ec24)

### Rol de Cuentadante



En el rol de cuentadante , la función principal es gestionar la creación y administración de las herramientas disponibles en Festo. Este rol cuenta con acceso a diferentes secciones:

- **Inicio:** Muestra un resumen de las herramientas creadas y un diagrama de barras que permite visualizar la cantidad de unidades disponibles para cada herramienta.
- **Herramientas:** Permite la creación de nuevas herramientas y la gestión del inventario. En esta parte, las herramientas se pueden ver organizadas por diferentes categorías.
- **Monitores:** Aquí se asigna un monitor encargado de entregar las herramientas que se solicitan, asegurando un control adecuado en el proceso de préstamo.
- **Perfil:** Ofrece la posibilidad de ver los datos del usuario que ha iniciado sesión, mostrando información relevante sobre la cuenta.
- **Cerrar sesión:** Esta opción permite finalizar la sesión actual, lo que da la posibilidad de ingresar con un rol diferente si es necesario.
  
Estas secciones ayudan a que el cuentadante pueda administrar de manera eficiente las herramientas y el inventario, así como gestionar los usuarios y las solicitudes de manera sencilla y segura.
