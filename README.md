
# **Sistema de Gestión de Notas - Institución Educativa 'El Remolino'**

## **Descripción del Proyecto**

Este proyecto es una aplicación web diseñada para gestionar las notas de los estudiantes de la Institución Educativa 'El Remolino'. Permite a los docentes registrar calificaciones, generar reportes detallados por estudiante y grado, así como visualizar estadísticas clave del rendimiento académico. Los administradores pueden supervisar y gestionar la información, mientras que los estudiantes pueden consultar sus notas de manera individual.

## **Características Principales**

- **Registro de Notas**: Los docentes pueden registrar y actualizar las calificaciones de los estudiantes para cada asignatura y periodo académico.
- **Reportes Personalizados**: Generación de reportes por estudiante, con la opción de exportar e imprimir en formato PDF.
- **Estadísticas**: Análisis y visualización de estadísticas del rendimiento académico, incluyendo promedios por estudiante y por grado.
- **Autenticación de Usuarios**: Sistema de autenticación basado en Firebase, con roles diferenciados para Administrador, Docente y Estudiante.
- **Interfaz Amigable**: La interfaz está diseñada con Materialize.css para una experiencia de usuario fluida y adaptable a diferentes dispositivos.

## **Tecnologías Utilizadas**

- **Frontend**:
  - HTML5, CSS3
  - [Materialize.css](https://materializecss.com/)
  - JavaScript
  
- **Backend**:
  - PHP (con PDO)
  - MySQL (para la gestión de la base de datos)

- **Otras Tecnologías**:
  - Exportación a PDF para los reportes
  - Responsividad para acceso en dispositivos móviles

## **Requisitos del Sistema**

Para ejecutar el proyecto localmente, asegúrate de tener instalados los siguientes requisitos:

- **Servidor Web**: Apache o Nginx
- **PHP**: Versión 7.4 o superior
- **MySQL**: Versión 5.7 o superior


## **Instalación y Configuración**

### **1. Clonar el Repositorio**

Clona este repositorio en tu máquina local.

```bash
git clone https://github.com/tu-usuario/gestion-notas.git
cd gestion-notas
```

### **2. Configurar la Base de Datos**

1. Crea una base de datos MySQL llamada `gestion_notas` o como prefieras.
2. Importa el archivo SQL con la estructura y datos iniciales:
   
   ```bash
   mysql -u root -p gestion_notas < database/gestion_notas.sql
   ```

3. Edita el archivo `config.php` para configurar los detalles de la conexión a la base de datos.

```php
// config.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_notas";
```

### **4. Configurar Apache o Nginx**

Configura un host virtual para que apunte al directorio del proyecto.

```apache
<VirtualHost *:80>
    ServerName gestion-notas.local
    DocumentRoot /ruta/a/gestion-notas
    <Directory /ruta/a/gestion-notas>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

No olvides añadir `gestion-notas.local` en tu archivo `hosts`.

### **5. Iniciar el Servidor**

Si estás utilizando un servidor local como XAMPP o WAMP, asegúrate de iniciar Apache y MySQL.

### **6. Acceder a la Aplicación**

Una vez configurado todo, puedes acceder a la aplicación desde tu navegador en la siguiente URL:

```
http://localhost/app-webinser o
http://127.0.0.0/app-webinser
```

### **7. Crear un Usuario Administrador**

Para acceder al panel de administrador por primera vez, ingresa a `admin_dashboard.php` y usa las credenciales predeterminadas que se pueden crear al hacer un seed en la base de datos o configurarlas directamente en la tabla de usuarios en MySQL.

## **Estructura del Proyecto**
En el momento el proyecto carece de una estructura estandarizada por ser un producto minimament funcional
para lograr cumplir el requisito. Se proyecta organizarlo de la siguiente manera para poder utilizar un framewor
de mayor robustez como es Laravel.

```bash
gestion-notas/
├── app/
│   ├── dashboard/
│   │   ├── admin_dashboard.php
│   │   ├── teacher_dashboard.php
│   └── modules/
│       ├── reportes.php
│       ├── estadisticas.php
├── assets/
│   ├── css/
│   └── js/
├── config.php
├── index.php
├── README.md
└── database/
    └── gestion_notas.sql
```

- **app/**: Contiene las vistas principales de la aplicación.
- **assets/**: Archivos de estilo y scripts.
- **database/**: Archivo SQL para la creación de la base de datos.
- **config.php**: Archivo de configuración para la base de datos.

## **Uso del Sistema**

### **Roles de Usuario**

- **Administrador**: Puede gestionar usuarios, ver reportes, agregar y modificar notas.
- **Docente**: Puede registrar las notas de los estudiantes y ver los reportes de su grupo.
- **Estudiante**: Solo puede consultar sus notas.

### **Módulos de la Aplicación**

1. **Gestión de Usuarios**: Permite a los administradores creaar, modificar y eliminar usuarios del sistema.
2. **Gestión de Estudiantes**: Permite a Administradores crear, modificar y eliminar estudiantes del sistema.
2. **Gestión de Docentes**: Permite a Administradores crear, modificar y eliminar Docentes del sistema.
2. **Gestión de Asignaturas**: Permite a Administradores crear, modificar y eliminar Asignaturas del sistema.
2. **Gestión de Notas**: Permite a los Administradores y docentes ingresar y actualizar las calificaciones de los estudiantes.
2. **Reportes**: Los docentes y administradores pueden generar reportes por estudiante y por grado, con la opción de exportar a PDF.
3. **Estadísticas**: Se visualizan estadísticas clave sobre el rendimiento académico de los estudiantes, mostrando los promedios y las asignaturas con más dificultades.

## **Contribuciones**

Si deseas contribuir a este proyecto, por favor realiza un fork del repositorio y abre un pull request con tus mejoras.

## **Licencia**

Este proyecto está licenciado bajo la Licencia MIT. Para más detalles, consulta el archivo [LICENSE](LICENSE).
