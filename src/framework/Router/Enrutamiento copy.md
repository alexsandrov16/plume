# Enrutamiento

Enrutar es el proceso de tomar un extremo de un URI ([RFC-3986](https://datatracker.ietf.org/doc/html/rfc3986#section-3.3)) y descomponerlo en parámetros para determinar que módulo ó controlador y que acción de ese controlador deberían recibir la petición. Tanto los valores del módulo como del controlador, la acción y demás parámetros, son empaquetados en un objeto ```Plume\Kernel\Router\Route``` que es procesado por ```Plume\Kernel\Router\Dispatcher```. El enrutamiento sucede sólo una vez; cuando la petición es recibida inicialmente y antes de que el primer controlador sea despachado. El enrutamiento en **Plume** está diseñado para funcionar con una simple regla de la directiva mod_rewrite de Apache. 

```
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.*)$ index.php/$1 [L]
```

## ¿Cómo crear rutas?

Por lo general, existe una relación de uno a uno entre una URL y su correspondiente controlador de clase/método. Los segmentos en un URI normalmente siguen este patrón:

```
example.com/class/method/param/
```


Puede definir rutas de aplicaciones instanciando la clase ```Plume\Kernel\Router\Rute```.

```php
$rute = new Plume\Kernel\Router\Rute;

$rute->get('/',function()
{
    echo "Hola mundo!";
});

$rute->routing();
```

## Verbos HTTP de enrutamiento

Es posible usar verbos HTTP (método de solicitud) para definir sus reglas de enrutamiento. Esto es particularmente útil cuando se construyen aplicaciones RESTFUL. Puede usar cualquier verbo HTTP estándar (GET, POST, PUT, DELETE, etc.). Cada verbo tiene su propio método que puedes usar: 

> De momento solo estan disponibles los métodos ```get``` y ```post```.

```php
$rute->get('/',function(){
    //Tu código
});

$rute->post('/',function(){
    //Tu código
});
```

Puede proporcionar varios verbos con los que debe coincidir una ruta pasándolos como una matriz al método ```map```: 

```php
$rute->map(['get','post'],'/',function(){
    //Tu código
});
```

O incluso puede registrar una ruta que responda a todos los verbos HTTP usando el método ```any```: 

```php
$rute->any('/',function(){
    //Tu código
});
```

## Enrutar devoluciones de llamada

Cada método de enrutamiento descrito anteriormente acepta una rutina de devolución de llamada como argumento final. Este argumento puede ser una función anonima o una matriz tipo ```['clase', 'método']```.

```php
$rute->get('/',function(){
    //Tu código
});

$rute->get('/', [MyClass::class, 'show'])
```

















Parámetros de ruta

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

La clase de enrutador es la interfaz con la que interactúa para realizar cualquier acción de enrutamiento en su aplicación. Leaf core se integra directamente con la clase de enrutador, lo que significa que no hay necesidad de usar esta clase directamente; sin embargo, si está usando un enrutador de hoja fuera de la hoja, deberá usar la clase de enrutador en sí.

use Leaf\Router;

Router::get("/", "PagesController@index");

Router::run();

#
Usando un enrutador diferente en Leaf

Aunque Leaf integra el enrutador de hoja directamente, puede importar y usar cualquier enrutador que desee.

    Instala lo que quieras 

composer require imaginary/router

    Importarlo y usarlo en su proyecto 

// initialise imaginary router
$imr = new Imaginary\Router();

$imr->get("/", function() {
  // you can still use leaf modules
  response()->json(["title" => "hello"]);
});

#
Creando Rutas

IMPORTANTE

A partir de este punto, supondremos que está utilizando un enrutador Leaf dentro de una aplicación hoja, como tal, usaremos la sintaxis de la aplicación:

app()->get('/', function() {...});

Sin embargo, si está utilizando un enrutador de hoja fuera de la hoja, simplemente cambie app()/ $appa la clase de enrutador:

Router::get('/', function() {...});

Puede definir rutas de aplicaciones utilizando métodos de proxy en la instancia de Leaf\App. Leaf admite diferentes tipos de solicitudes, veámoslas.
#
OBTENER

Puede agregar una ruta que maneje solo solicitudes GET HTTP con el método get() del enrutador Leaf. Acepta dos argumentos:

    El patrón de ruta (con marcadores de posición con nombre opcionales o patrones basados ​​en PCRE)
    La devolución de llamada de la ruta 

app()->get('/home', function() {
  // your code
});

#
PUBLICAR

Puede agregar una ruta que maneje solo solicitudes POST HTTP con el método post () del enrutador Leaf. Acepta dos argumentos:

    El patrón de ruta (con marcadores de posición con nombre opcionales o patrones basados ​​en PCRE)
    La devolución de llamada de la ruta 

app()->post('/users/add', function() use($request) {
  $user = $request->get('user');
  // create a new user
});

Uso de parámetros de publicación Ver Solicitud de más información sobre el manejo de parámetros
#
solicitudes PUT

Puede agregar una ruta que maneje solo solicitudes PUT HTTP con el método put() del enrutador Leaf. Acepta dos argumentos:

    El patrón de ruta (con marcadores de posición con nombre opcionales o patrones basados ​​en PCRE)
    La devolución de llamada de la ruta 

app()->put('/book/edit/{id}', function($id) {
  // your code
});

#
ELIMINAR solicitudes

Puede agregar una ruta que maneje solo solicitudes DELETE HTTP con el método delete() del enrutador Leaf. Acepta dos argumentos:

    El patrón de ruta (con marcadores de posición con nombre opcionales o patrones basados ​​en PCRE)
    La devolución de llamada de la ruta 

app()->delete('/quotes/{id}', function($id) {
  // delete quote
});

#
solicitudes de OPCIONES

Puede agregar una ruta que maneje solo solicitudes HTTP de OPCIONES con el método options() del enrutador Leaf. Acepta dos argumentos:

    El patrón de ruta (con marcadores de posición con nombre opcionales o patrones basados ​​en PCRE)
    La devolución de llamada de la ruta 

app()->options('/quotes/{id}', function($id) {
  // return headers
});

#
solicitudes de PARCHE

Puede agregar una ruta que maneje solo solicitudes PATCH HTTP con el método patch() del enrutador Leaf. Acepta dos argumentos:

    El patrón de ruta (con marcadores de posición con nombre opcionales o patrones basados ​​en PCRE)
    La devolución de llamada de la ruta 

app()->patch('/post/{id}', function($id) {
  // your code
});

#
TODAS las solicitudes

Puede agregar una ruta que maneje todas las solicitudes HTTP con el método all() del enrutador Leaf. Acepta dos argumentos:

    El patrón de ruta (con marcadores de posición con nombre opcionales o patrones basados ​​en PCRE)
    La devolución de llamada de la ruta 

app()->all('/post/{id}', function($id) {
  // your code
});

#
Ver

viewya no es compatible, ya que Leaf Blade ya no está predeterminado en Leaf. Tendrás que mostrar manualmente tus vistas usando get
#
rutas de recursos

Esta sección asume que ha leído trabajar con controladores . En una aplicación MVC, los controladores juegan un papel importante ya que son el puente entre su vista y su modelo.

Una ruta de recursos simplemente crea todas las rutas necesarias para manejar con éxito una característica en particular. Esto suena un poco sombrío, veamos un ejemplo.

app()->resource("/posts", "PostsController");

app()->run();

El código anterior es equivalente a esto:

app()->match("GET|HEAD", "/posts", "$controller@index");
app()->post("/posts", "$controller@store");
app()->match("GET|HEAD", "/posts/create", "$controller@create");
app()->match("POST|DELETE", "/posts/{id}/delete", "$controller@destroy");
app()->match("POST|PUT|PATCH", "/posts/{id}/edit", "$controller@update");
app()->match("GET|HEAD", "/posts/{id}/edit", "$controller@edit");
app()->match("GET|HEAD", "/posts/{id}", "$controller@show");

app()->run();

Las rutas de recursos son manejadas por un controlador de recursos .
#
Ruta "Enganchando"

Puede agregar una ruta que maneje un par de métodos HTTP con el método match() del enrutador Leaf. Acepta tres argumentos:

    Los métodos HTTP separados por |
    El patrón de ruta (con marcadores de posición con nombre opcionales o patrones basados ​​en PCRE)
    La devolución de llamada de la ruta 

app()->match('GET|POST', '/people', function() {
  // your code
});

#
Ejecutando tus rutas

Después de configurar todas las rutas, deberá despachar las rutas. Esto se logra a través del método run() de Leaf.

app()->run();

#
Opciones de ruta

Este es el cambio más grande que el enrutador Leaf ha visto en el período de un año. Las opciones de ruta simplemente le permiten configurar los grupos de caminos y las rutas individuales pasando parámetros adicionales. En el sentido real, todas las funciones nuevas se generaron como resultado de esta única función. Vamos a ver cómo funciona.

Los manejadores de ruta hoja suelen ser funciones invocables como esta:

app()->get("/home", function() {
  echo "User Home";
});

O, a veces, controladores, como este:

app()->get("/home", "HomeController@index");

Esto significa que no había espacio para encadenar elementos adicionales a la ruta, esto se soluciona con las opciones de ruta.

app()->get("/home", ["name" => "home", function() {
    echo "User Home";
}]);

Cuando una matriz se pasa a una ruta hoja como controlador, la hoja tomará todos key => valuecomo opciones para esa ruta, el primer valor no clave functiono controlleren la matriz se toma como controlador.

app()->get("/form", ["name" => "userForm", "FormsController@index"]);

Como se mencionó anteriormente, esta función también está disponible en grupos:

app()->group("/user", ["namespace" => "\\", function () {
    // ...
}]);

Esto no significa que siempre deba pasar una matriz, si no necesita las otras opciones, puede pasar su función o controlador directamente como siempre lo ha hecho.
#
Poniendo nombre a tus rutas

Desde v2.5.0 de Leaf, puede dar nombres de ruta con los que puede llamarlos en lugar de usar la ruta (Inspirado en vue-router).

app()->get("/home", ["name" => "home", function() {
  echo "User Home";
}]);

#
Empujando a una ruta

Esto es simplemente redirigir a una ruta y se puede hacer usando push. pushtambién le permite hacer referencia a la ruta por su nombre en lugar de su ruta.

app()->push("/home");

Cuando se pasa una matriz a push, Leaf buscará un nombre de ruta que coincida con la cadena en la matriz y redirigirá a esa ruta:

// home was defined above
app()->push(["home"]);
