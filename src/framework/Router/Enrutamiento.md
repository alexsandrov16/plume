

## Enrutar devoluciones de llamada

Cada método de enrutamiento descrito anteriormente acepta una rutina de devolución de llamada como argumento final. Este argumento puede ser una función anonima o una matriz tipo ```['clase', 'método']```.

```php
$rute->get('/',function(){
    //Tu código
});

$rute->get('/', [MyClass::class, 'show'])
```
















































## Creación de rutas en archivos JSON o PHP

En lugar de definir rutas en las clases de controlador, puede definirlas en un archivo JSON o PHP separado. La principal ventaja es que no requieren cualquier dependencia adicional. El principal inconveniente es que tienes que trabajar con múltiples archivos al comprobar el enrutamiento de alguna acción del controlador.

El siguiente ejemplo muestra cómo definir en YAML/XML/PHP una ruta llamada blog_listque asocia la /blogURL con el list()acción de los BlogController: 























































# Router
El proceso de enrutamiento consiste en hacer coincidir un URI con una acción. El módulo de enrutamiento es responsable de asignar las solicitudes entrantes del navegador a las acciones particulares del controlador. Básicamente, estamos tratando de enviar todas las solicitudes realizadas al servidor a un solo archivo, al ```index.php``` en el directorio raíz de la aplicación.

Esta característica se puede lograr agregando una configuración de servidor web según el servidor que elija.

**Apache** - .htaccess

Este es un ejemplo básico de un archivo htaccess. Básicamente, redirige todas las solicitudes a nuestro archivo index.php.

```
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.*)$ index.php/$1 [L]
```

Guardar como ```.htaccess``` en el mismo directorio que su "archivo raíz"

## Enrutamiento
El enrutador de **Plume** usa un solo archivo raíz, al que se redireccionan todas las solicitudes del servidor, luego toma estas solicitudes y las compara con las reglas que ha definido. A continuación, muestran los resultados al usuario.


## Clase de enrutador
La clase de enrutador es la interfaz con la que interactúa para realizar cualquier acción de enrutamiento en su aplicación. 

```php
$rute = new Plume\Kernel\Router\Rute;

$rute->get('/', function(){
    echo 'Hola Mundo!';
});

$rute->routing();
```

## Creando Rutas

Puede definir rutas de aplicaciones utilizando métodos proxy en la instancia de ```Plume\Kernel\Router\Rute```. **Plume** admite diferentes tipos de solicitudes, veámoslas.
### GET
Puede agregar una ruta que maneje solo solicitudes GET HTTP con el método ```get()```. Acepta dos argumentos:

- El patrón de ruta (con marcadores de posición con nombre opcionales o patrones basados ​​en PCRE)
- La devolución de llamada de la ruta 

```php
$rute->get('/home',function(){
    //Tu código
});
```

### POST
Puede agregar una ruta que maneje solo solicitudes POST HTTP con el método ```post()```. Acepta dos argumentos:

- El patrón de ruta (con marcadores de posición con nombre opcionales o patrones basados ​​en PCRE)
- La devolución de llamada de la ruta 

```php
$rute->post('/home',function(){
    //Tu código
});
```

### Varios métodos
Puede agregar una ruta que maneje varias solicitudes HTTP con el método ```map()```. Acepta tres argumentos:

- Matriz con los valores de los métodos permitidos
- El patrón de ruta (con marcadores de posición con nombre opcionales o patrones basados ​​en PCRE)
- La devolución de llamada de la ruta 

```php
$rute->map(['get', 'post'], '/home',function(){
    //Tu código
});
```

### Cualquier solicitud
Puede agregar una ruta que acepte cualquiera de las solicitudes HTTP con el método ```any()```. Acepta dos argumentos:

- El patrón de ruta (con marcadores de posición con nombre opcionales o patrones basados ​​en PCRE)
- La devolución de llamada de la ruta 

```php
$rute->any('/home',function(){
    //Tu código
});
```

## Devolución de llamada de la ruta
Cada método de enrutamiento descrito anteriormente acepta una rutina de devolución de llamada como argumento final.

### Clousure
Puede usar una función anónima, o Cierre, como el destino al que se asigna una ruta. Esta función será se ejecuta cuando el usuario visita ese URI. Esto es útil para ejecutar rápidamente tareas pequeñas, o incluso para mostrar una vista sencilla: 

### Controlador







## Parámetros de ruta

Parámetros requeridos

A veces necesitará capturar segmentos del URI dentro de su ruta. Por ejemplo, es posible que deba capturar la ID de un usuario de la URL. Puede hacerlo definiendo parámetros de ruta:

Route::get('/user/{id}', function ($id) {
    return 'User '.$id;
});

Puede definir tantos parámetros de ruta como requiera su ruta:

Route::get('/posts/{post}/comments/{comment}', function ($postId, $commentId) {
    //
});

Los parámetros de ruta siempre están encerrados dentro {}llaves y debe constar de caracteres alfabéticos. guiones bajos ( _) también son aceptables dentro de los nombres de parámetros de ruta. Los parámetros de ruta se inyectan en las devoluciones de llamada/controladores de ruta en función de su orden; los nombres de los argumentos de devolución de llamada/controlador de ruta no importan. 


























































### Ejecutando tus rutas

Después de configurar todas las rutas, deberá despachar las rutas. Esto se logra a través del método ```routing()```.

```php
$rute->routing();
```