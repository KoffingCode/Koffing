# ProyectoSoft3

## Daily Meetings

### Simón Felipe Muñoz Osorio
| Fecha  | Ayer | Hoy | Dificultades
| ------------- | ------------- | ------------- | ------------- |
| 27/11/2021  | Se creó el controlador, el modelo y la migración por medio de php artisan migrate.  | Se modificará el modelo Waiter y la migración para que tengan los atributos necesarios, y se crearán los métodos CRUD del controlador. |  |
| 3/12/2021  | Se modificó el modelo Waiter y la migración para que tengan los atributos necesarios, y se crearán las definiciones de los métodos CRUD del controlador.  | Implementar los métodos CRUD del controlador y conectar la api gateway con la api de meseros |  |

------------

### Cristian David Cruz Barrera
| Fecha  | Ayer | Hoy | Dificultades
| ------------- | ------------- | ------------- | ------------- |
| 27/11/2021  | Se realizó un prepareacion de la base respecto a la entidad Table.  | Se iniciará la interfaz gráfica de la vista de mesas Y se migrará el modelo completo de las tablas a la base de datos. | se tuvieron algunas dificultades con las migraciones |
| 28/11/2021  | Se prepararon las migraciones y se crearon los endpoints principales para la gestion de mesas, tambien se hico una preparación de la vista correspondiente.  | Se aplicarán funcionalidades adicionales a la vista como la validación de campos, la insercion, la actualización y la eliminación de registros | Se tuvo que hacer un ajuste en el comportamiento reactivo de la interfaz gráfica por medio del clonado de objetos |
| 2/12/2021  | Se completaron las validaciones básicas del formulario, se completaron las funcionalidades de CRUD en la vista de mesas y se agregaron algunas mejoras visuales como efectos de transición. | Se hará preparativos por medio de los controladores que seran usados para la consulta de datos personales de un mesero con sus respectivos turnos y mesas asignadas, Se hará uso de una query específica que consulta los turnos que hay actualmente relacionados para establecer la relación entre mesas y turnos | queda pendiente la creacion de los endpoints respecto a los turnos y meseros |
| 4/12/2021  | Se hizo una mejora en la fachada de backend ahora enfocada en una api getway, se agregaron validaciones en las respuestas por parte del servidor | Crear las tablas en la vista de consultas por parte del mesero | Había un error con el nombre de la migración de la tabla pivote que impedía consultas a través de ella. |
| 5/12/2021  | Se hizo el ajuste con la tabla pivote para que las consultas por parte del mesero se pudieran realizar | Agregar datos personales basicos a la vista de consultas por parte del mesero, consultas a partir del numero de documento pasado por props a la vista | |

------------


