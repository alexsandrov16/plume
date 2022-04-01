# Responsabilidades del programador

El trabajo que harás hará eco de tu personalidad, creencias, disciplina, ideas y nivel de complejidad mucho después de que haya sido escrito. Es crucial seguir estándares y prácticas que se alineen con la política de la empresa, ya que el código que escribe define a la empresa misma. Esta es una guía que escribí para garantizar una base de código y principios coherentes.

Este post fue publicado originalmente en mi blog personal . Las opiniones expresadas en este post son mías. Esto es algo que sigo firmemente y animo a otros programadores a que lo hagan cuando estoy en una posición de liderazgo.

## Documentación

¡Si no está documentado, no existe! Sin excepciones.

- Documento en el archivo Léame del repositorio GIT, ejemplo si es una API. Luego, documente las solicitudes, las respuestas, las autenticaciones, la limitación y proporcione pequeñas descripciones de las funciones.

- Luego también documente módulos completos del sistema, ejemplo; cómo funciona, qué tablas de base de datos utiliza, qué soporte debe hacerse para mantener o configurar el módulo, cómo solucionar problemas, etc.

- Mantenga siempre la documentación al día. Ayudará a sus compañeros de equipo si también trabajan en el proyecto y luchan contra la deuda técnica.

## Seguridad

La seguridad comienza con nosotros, los desarrolladores. Nadie lo obligará a agregar seguridad desde el principio, tiene que ser una elección. Claro que puede quedar atrapado en las revisiones de código, pero nadie será su copiloto para ayudarlo a tomar las decisiones correctas. De hecho, si codificar de forma segura la primera vez no es un absoluto en su forma de pensar, comience a adoptarlo ahora. Incluso si eso significa que perderá su fecha límite, no apresure la seguridad y pruébela a fondo. Cosas a tener en cuenta:

- Las API deben tener credenciales de seguridad, ya sea en los encabezados (la autenticación básica está bien) o un método personalizado de validación dentro de la solicitud. HTTPS es imprescindible.

- Almacenamiento de claves API, dónde se almacenan, quién puede acceder a ellas, qué tan rápido puedo reemplazar la clave API si se compromete.

- Las contraseñas DEBEN ser cifradas en la base de datos, no encriptadas ni dejadas en formato de texto sin formato.

- La información de identificación personal debe estar cifrada, como números de teléfono, nombres, direcciones de correo electrónico, números de identificación.

- La **autenticación** es el proceso de verificar quién eres. Ejemplo: cuando inicia sesión en una PC con un nombre de usuario y contraseña, se está autenticando. Autentica a los usuarios en cada solicitud. Para PHP, use el objeto $_SESSION (usa el sistema de archivos), para una API node.js independiente, use la base de datos o un caché como Redis como nivel de almacenamiento. Después de que un usuario inicie sesión, almacene en un registro una identificación de sesión recién generada, permita que el usuario luego, en todas las solicitudes posteriores, adjunte esto al cuerpo de la solicitud.

- La **autorización** es el proceso de verificar que tiene acceso a algo. Esto debería suceder después de la autenticación. Verifica si tiene permisos para acceder a un recurso (por ejemplo, directorio en un disco duro, página web de administración).

- Validación de datos. No confíe en ninguna entrada del usuario SIEMPRE haga la validación del lado del servidor. Se puede considerar correcto si tiene una API, no validar la entrada del usuario en cada paso SI la API es solo para uso interno. Si la API está expuesta a terceros, agregue siempre validación.

- Seguridad de datos. Ejemplo: al eliminar un registro, asegúrese de que pertenezca a ese cliente; de ​​lo contrario, un usuario inteligente puede escribir una identificación aleatoria para eliminar algunos datos que no le pertenecen. Luego, asegúrese de que todos los documentos S3 sean privados primero y luego hágalos públicos cuando sea necesario. Primero el modo menos privilegiado, luego relajar los permisos después. También elimine registros de S3 al eliminar registros de base de datos asociados

- Validez de los datos. No cree el campo de número de teléfono como un varchar y luego, en la parte frontal, permita cualquier tipo de texto y números. Los datos limpios son esenciales para que la base de datos y las aplicaciones funcionen correctamente. En la parte delantera, se debe realizar una verificación para asegurarse de que todos los números de teléfono estén en formato internacional, con el prefijo +, sin espacios y solo números. Esto proporcionará una consistencia de datos en la que todas las aplicaciones (actuales, futuras, de terceros) pueden "confiar". Basura dentro basura fuera.

## Fiabilidad

Construya para obtener la máxima confiabilidad, piense en todos los resultados posibles, no solo en los exitosos. Debe tener plena confianza al acostarse por la noche que no lo despertarán a las 2 AM con un frenesí de correos electrónicos de error generados por el sistema. Si su código falla, debería recuperarse por sí mismo o, si esto no es posible, fallar rápidamente para que se lleve a cabo otra acción para remediar la situación.

- Auto-recuperación. Un ejemplo de autorrecuperación (lógica de reintento) es enviar solicitudes a colas (almacenamiento de base de datos). Si confía en un tercero, por ejemplo, para enviar un SMS/Correo electrónico/Push, siempre tenga una solución lista para cuando sus API lo estén. la llamada está caída. Esto significa Registrar (guardar en la base de datos) todos los datos antes de enviarlos, luego intentar enviarlos, si falla, incrementar un contador en ese registro que falló por el motivo y luego la hora en que falló la solicitud. Luego, tenga un verificador periódico, tal vez una vez por minuto, que tiene alguna lógica para volver a intentar enviar esa solicitud. Aquí una estrategia de retroceso exponencial funciona muy bien.

- De esta manera, si hay una falla aguas abajo, su sistema se recuperará porque ahora ha creado una cola. Solo tenga cuidado si usa colas sincrónicas, ya que significará que el Cliente A tendrá que esperar a que finalice la solicitud del Cliente B. Para remediar el problema síncrono, haga una consulta para dividir las solicitudes por cliente y luego envíe cada una de sus solicitudes de forma síncrona. Mejor aún, opte siempre por colas asíncronas si el proveedor externo las admite.

- Fallar rapido. Un ejemplo de falla rápida sería en la interfaz web frontal (portal). Si ocurriera un error, generalmente sería un error de tiempo de ejecución, por ejemplo: un usuario no tiene el permiso correcto, por lo que intenta acceder a un objeto de una sesión que no existe. Fail rápido, de lo contrario, el usuario verá un mensaje de error en la pantalla con una pantalla parcialmente cargada de datos, estos datos pueden ser confidenciales ya que no tiene los permisos adecuados para verlos por alguna razón.

## Manejo de errores

- El manejo de errores determina qué tan bien funcionarán sus procedimientos de confiabilidad. Todos los errores deben detectarse y actuar en consecuencia, planificar para lo peor. Esta acción puede ser simplemente iniciar sesión o notificar a una persona responsable para corregir el error. Aquí hay algunas cosas a tener en cuenta:

- Registra todo. Cuando ocurra un error, tome una instantánea del error, por ejemplo, al menos guarde el tiempo y cierta información de identificación para que pueda buscarlo.

- Mantenga siempre un patrón al escribir registros, esto le permitirá buscar palabras clave para limitar su búsqueda. No se limite a escribir cadenas como desee. Patrón de ejemplo: [Nivel de gravedad] – [Fecha y hora] – [Mensaje de error de una línea] – [Objeto JSON con más información]

- Se deben registrar todas las interacciones de los usuarios (esto es fácil con cloudwatch y API gateway lambdas). Además, en la parte delantera, no es necesario registrar cada carga/solicitud de página. Una buena estrategia es guardar las últimas 5 cargas/solicitudes de página en la sesión y luego, cuando se produzca un error, enviar todo ese seguimiento de la pila de "alto nivel" con el registro de errores e incluir también la sesión. Esto es muy útil ya que luego tiene los pasos del usuario para reproducir el error.

- Fiabilidad. Implemente un sistema de auto-recuperación (transnacional, patrón Saga) o un sistema de falla rápida, independientemente de la elección, registre todo lo que ambos hagan.

## Deuda técnica

Una vez escrito el código, es necesario mantenerlo. No solo su código sino también el marco en el que se basa, esto significa que si su código depende del marco A y el marco A tiene una actualización, entonces es su responsabilidad mantener el marco actualizado. De lo contrario, si continúa presionando esto, se encontrará (o sus compañeros de equipo/el próximo desarrollador) en una posición en la que el marco tiene 10 años y el desarrollo del marco se ha detenido en el quinto año. Convertir un marco inactivo o muy desactualizado a uno nuevo es una tarea importante, donde todo podría haberse evitado si usted y su equipo, por ejemplo, solo toman 1 semana cada año y luego actualizan todos los marcos a la última versiones.

La deuda técnica también se agrega cuando no hay nada documentado y una sola persona es responsable de ese código/función del sistema. Es responsabilidad del equipo asegurarse de que esto no suceda, debe retrasar los plazos y la gestión para luchar contra la deuda técnica.

## Código

- Tonto + Simple (KISS)
  - Escribir código complejo puede ser gratificante a nivel personal, pero no se recomienda en el desarrollo de equipos, a menos que todo el equipo esté en el mismo nivel. Si no lo son, para otros compañeros de equipo será difícil mantener y continuar con su trabajo. Así que siempre tenga en cuenta al próximo desarrollador.

  - En lugar de escribir más código si es más fácil de leer y entender, que escribir esa expresión regular de 1 línea que toma 2 años para entender correctamente.

  - Evite getters y setters a toda costa, oculta la complejidad. Usando métodos y funciones puede lograr la misma funcionalidad.

  - Teniendo en cuenta encontrar la mejor solución, no una solución, debe ser extensible en el futuro. No lo implemente todavía, solo deje espacio para que, si necesita extenderse, sea posible sin rediseñar completamente el sistema.

- Legible + Limpio
  - Nombrar variables y funciones debe explicarse por sí mismo

  - Nombre positivamente, ejemplo en lugar de nombrar una variable: isDisabled, en lugar de nombre isEnabled. Nuestros cerebros procesan el lenguaje positivo mucho mejor que el lenguaje negativo, por ejemplo: para isDisabled tendrás que pensar en la línea de: si algo isDisabled significa que no está habilitado, por lo que este fragmento de código no funcionará si isDisabled es verdadero. Donde podría haber sido mucho más fácil hacer la asociación si se nombrara como isEnabled.

  - Divide las funciones largas en subfunciones.

  - Solo escriba funciones para el código que se reutiliza. Si copió y pegó algo, probablemente debería haber escrito una función para ello.

  - Si escribe código, por ejemplo, en un método que tiene una funcionalidad similar y ese código solo se usa en ese método, entonces no es necesario dividirlo en funciones más pequeñas, ya que solo se usará en un lugar. A menos que ese método crezca, por ejemplo, a más de 300 líneas, entonces se puede dividir en funciones más pequeñas. No por el bien de la reutilización para las funciones más pequeñas, sino para aumentar la legibilidad de la función más grande en la que se usa.

  - Evite el código anidado, en lugar de salir antes de la función.

- Consistencia
  - La consistencia es lo que hace que los grandes proyectos sean manejables. Todo el equipo debe tratar de apegarse a la consistencia del proyecto. Debe parecer que un desarrollador por su cuenta codificó todo, no debería poder hacerlo, con solo mirar un fragmento de código y decir que el desarrollador A lo escribió.

  - Esfuércese por la consistencia, incluso si está mal. Por ejemplo, si nota que todas las tablas en la base de datos están en formato de serpiente (letras minúsculas separadas por guiones bajos), también debe mantener el mismo nombre, ya que los desarrolladores actuales ya asumen que todos siguen la misma estrategia.

- ABIERTO
  - Solo cuando sea necesario. KISS, no intente dividir un problema simple en 1000 clases e interfaces (explosión de clases), esto aumenta enormemente la complejidad, el mantenimiento y disminuye la legibilidad.

  - Considere también otros enfoques, la programación funcional. OOP no siempre es la única opción.

~No voy a explicar SOLID en detalle, búsquelo en Google y encuentre un buen artículo. A continuación se muestran los conceptos esenciales para tomar un camino (mi perspectiva)~

- Principios SOLID
  - **Principio de responsabilidad única**: una clase solo debe tener una funcionalidad/trabajo. Ejemplo, una clase de persona solo debe hacer funciones de persona, no debe tener nada que describa las mascotas y los automóviles de esa persona en esa clase, solo la funcionalidad relacionada con la persona, como la edad y el color de ojos. A continuación, puede crear otras clases para mascotas y vehículos.

  - **Principio abierto cerrado**: los objetos deben estar abiertos para la extensión y cerrados para la modificación. Este esencial significa que cada vez que cambien los requisitos, no debe volver atrás y cambiar el núcleo de la clase. Más bien extiéndalo, simplemente agregándole. El ejemplo será usar la clase de persona como clase base para una persona asiática y la clase de persona africana. De esta manera, si cambia la clase de persona base, también cambiará las clases de África y Asia, ya que amplían la clase de persona base.

  - **L iskov**: esto suele ocurrir cuando se trabaja con programación orientada a objetos, específicamente interfaces. Si una clase hereda de una interfaz o clase base, entonces se puede convertir a esa clase base o interfaz, por lo tanto, no importa si la persona es asiática o africana, estamos seguros en cualquier momento, ambos tienen funciones básicas de un persona. Esto se relaciona con la inyección de dependencia, estos dos puntos + el patrón de diseño de fábrica a menudo se usan juntos.

  - **Principio de segregación de interfaces**: si un cliente/usuario del código solo quiere una determinada funcionalidad, no le dé más que eso Por ejemplo, si solo están interesados ​​en las características en tiempo real de una persona, no es necesario proporcionarles la historia de toda la familia. Esto se hace aplicando solo las interfaces necesarias a una clase y luego creando objetos con solo ciertas interfaces, no todas. Este punto no es tan importante como los demás.

  - **Principio de inyección de dependencia**: esto es básicamente lo mismo que el punto 3. Si hizo todos los demás puntos correctamente, ahora podrá codificar contra interfaces, no contra clases. Esto significa que si tiene una interfaz de registro y 2 clases que heredan de ella, un registrador de archivos y un registrador de api. Ambos deben tener una función de registro, por lo que puede pasar un registrador de archivos o un registrador de API a su función principal de registro de errores que espera una interfaz de registro. Entonces, los argumentos de su función toman interfaces y no clases concretas.

- Patrones de diseño
  - No fuerce la aplicación de los mismos. Muchas veces puede salirse con la suya simplemente usando OOP normal o programación funcional.

  - Manténgalo simple si decide implementarlo, los patrones de diseño introducen complejidad, si no se entienden correctamente.

  - Intente mantener los patrones básicos más utilizados y, si no conoce los siguientes, lea sobre ellos:
        + Singleton (ideal para su clase DB principal)
        + Patrón de fábrica (excelente para código que tiene una estructura similar pero las partes internas cambian para cada implementación)

- Abstracción
  - Una vez más no sobre abstracto. Aunque puede OOP o aplicar SOLID, no tiene que hacerlo, ya que introduce más complejidad y reduce la legibilidad.

- Comentarios
  - Los comentarios no deben ser demasiado detallados, escriba solo lo que sea necesario para transmitir su punto de vista.
  - Al escribir comentarios, manténgase únicamente en lo esencial. Como el código cambia y muchas veces los comentarios simplemente se pasan por alto, entonces el código y los comentarios no concuerdan. Así que solo escriba comentarios esenciales que "resistirán la prueba del tiempo".
  - Los comentarios de una sola línea explican lo que hace una sola línea de código.
  - Los comentarios de varias líneas se utilizan para explicar una función o cómo funciona el proceso/concepto de muchas líneas de código.

## MVP

**M**ínimo **V**iable **P**osible . Solo haga lo que está en los requisitos, no comience con la funcionalidad futura. De lo contrario, hará un trabajo innecesario y perderá el tiempo para crear algo que apenas se usa. A medida que se usa el sistema, probablemente recibirá retroalimentación y eso determinará las solicitudes de cambio a la próxima versión de ese sistema. Por lo tanto, siempre cumpla con los requisitos básicos y, a medida que aumenta el uso, se pueden agregar características y hacer que el sistema sea más robusto.

> Sea "perezoso" en el sentido de trabajar inteligentemente con su tiempo.

## Revisiones de código

El equipo de desarrollo es un colectivo, una propiedad compartida. No hay yo en el equipo, si sus compañeros de equipo escriben un código incorrecto, se culpará a todo el equipo en su conjunto. La responsabilidad recae en el equipo no en la persona. Por lo tanto, para lograr esta unidad, se deben utilizar revisiones de código. Antes de fusionar el nuevo código, al menos 2 desarrolladores también deben leer, comprender y asegurarse de que todos los principios se utilicen y sigan correctamente.

Mejorar una implementación. No lo critiques. Recuerde que los desarrolladores también son personas, considere su situación actual. Da reseñas de la misma forma en que te gustaría recibirlas.

## Cordura

Tenga en cuenta su vida personal. Los desarrolladores junior están ansiosos y motivados, lo cual es excelente, pero a menudo ejecutan el sprint desde el principio y eso está bien durante un mes más o menos, después de eso, debe cambiar al modo maratón para lograr el largo plazo. A continuación se presentan algunas cosas a tener en cuenta.

- Apéguese a las rutinas diarias, aumenta la productividad.
- No olvides hacer ejercicio.
- Mantener hábitos saludables de alimentación y sueño.
- No descuides las relaciones
- Cuando se sienta frustrado, levántese y tome un vaso de agua, solo tome un descanso. Hablar contigo mismo (conviértete en el pato) o con otro desarrollador siempre ayuda. No estás solo y otros desarrolladores probablemente pasen por los mismos problemas.
- Nunca use la palabra SOLO, si lo hace, multiplique su fecha límite por 2.
- Algunas personas son creadores, otros son reparadores. Decide lo que eres y si no estás donde quieres estar, todavía estás a tiempo de trabajar en ello y llegar allí.
- Aprende a decir no y negociar. Se humilde
- Admite/hazte cargo de tus errores, todos los cometemos
