# ProyectoSoft3

## Daily Meetings

### Simón Felipe Muñoz Osorio
| Fecha  | Ayer | Hoy | Dificultades
| ------------- | ------------- | ------------- | ------------- |
| 27/11/2021  | Se creó el controlador, el modelo y la migración por medio de php artisan migrate. | Se modificará el modelo Waiter y la migración para que tengan los atributos necesarios, y se crearán los métodos CRUD del controlador. |  |
| 3/12/2021  | Se modificó el modelo Waiter y la migración para que tengan los atributos necesarios, y se crearán las definiciones de los métodos CRUD del controlador. | Implementar los métodos CRUD del controlador y conectar la api gateway con la api de meseros. |  |
| 5/12/2021 | Se completaron las tareas pendients con respecto al backend de la historia de usuario "Parametrizar meseros". | Crear las vista para la parametrización de meseros. |  |
| 10/12/2021 | Se comenzó la creación de la vista en el frontend | Ajustar el formulario de registro de meseros, conectar la vista con la fachada y la fachada con el backend. Verificar que funcionan los endpoint del CRUD desde el front.  |  |
| 11/12/2021 | Se finalizó con la vista de parametrización de meseros y se probaron los métodos del CRUD para un usuario específico. | Crear la vista para el login, crear los endpoint en la api para post y get de un usuario y crear los métodos en el controlador para estos endpoint.  |  |
| 12/12/2021 | Se creó la vista de login. También se crearon los endpoint en el backend y se completó la lógica de usuarios en los controladores. | Efectuar el login, mostrar los links en el navbar de acuerdo al rol del usuario y generar la cookie de la sesión.  | No se estaban comparando bien los hashes de las contraseñas de los usuarios almacenadas en la BD. |

------------

### Cristian David Cruz Barrera
| Fecha  | Ayer | Hoy | Dificultades
| ------------- | ------------- | ------------- | ------------- |
| 27/11/2021  | Se realizó un prepareacion de la base respecto a la entidad Table.  | Se iniciará la interfaz gráfica de la vista de mesas Y se migrará el modelo completo de las tablas a la base de datos. | se tuvieron algunas dificultades con las migraciones |
| 28/11/2021  | Se prepararon las migraciones y se crearon los endpoints principales para la gestion de mesas, tambien se hico una preparación de la vista correspondiente.  | Se aplicarán funcionalidades adicionales a la vista como la validación de campos, la insercion, la actualización y la eliminación de registros | Se tuvo que hacer un ajuste en el comportamiento reactivo de la interfaz gráfica por medio del clonado de objetos |
| 2/12/2021  | Se completaron las validaciones básicas del formulario, se completaron las funcionalidades de CRUD en la vista de mesas y se agregaron algunas mejoras visuales como efectos de transición. | Se hará preparativos por medio de los controladores que seran usados para la consulta de datos personales de un mesero con sus respectivos turnos y mesas asignadas, Se hará uso de una query específica que consulta los turnos que hay actualmente relacionados para establecer la relación entre mesas y turnos | queda pendiente la creacion de los endpoints respecto a los turnos y meseros |
| 4/12/2021  | Se hizo una mejora en la fachada de backend ahora enfocada en una api getway, se agregaron validaciones en las respuestas por parte del servidor | Crear las tablas en la vista de consultas por parte del mesero | Había un error con el nombre de la migración de la tabla pivote que impedía consultas a través de ella. |
| 5/12/2021  | Se hizo el ajuste con la tabla pivote para que las consultas por parte del mesero se pudieran realizar | Agregar datos personales basicos a la vista de consultas por parte del mesero, consultas a partir del numero de documento pasado por props a la vista | |
| 8/12/2021  | Se hicieron mejoras gráficas en la vista de consultas del mesero | Crear carga de turnos en la vista de mesas para asignar las relaciones entre mesa y turno | |
| 12/12/2021  | Se hicieron mejoras adicionales en la consulta de los usuarios y la gestión de mesas | Incluir el nombre de usuario y el correo en la información basica en la consulta de meseros | |

------------


