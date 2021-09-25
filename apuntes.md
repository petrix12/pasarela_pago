# Crea una pasarela de pagos con Laravel Cashier y Stripe
+ **URL Curso**: https://www.udemy.com/course/crea-una-pasarela-de-pagos-con-laravel-cashier-y-stripe
+ **URL Repositorio del curso**: https://github.com/coders-free/payment
+ **URL Repositorio General**: https://github.com/petrix12/pasarela_pago.git
+ **URL del proyecto en producción**: https://paymet.herokuapp.com

## Antes de iniciar:
1. Crear proyecto en la página de [GitHub](https://github.com) con el nombre: **pasarela_pago**.
    + **Description**: Proyecto para seguir el curso de Crea una pasarela de pagos con Laravel Cashier y Stripe, de Víctor Arana en Udemy
    + **Public**.
2. En la ubicación raíz del proyecto en la terminal de la máquina local:
    + $ git init
    + $ git add .
    + $ git commit -m "Commit 00: Antes de iniciar"
    + $ git branch -M main
    + $ git remote add origin https://github.com/petrix12/pasarela_pago.git
    + $ git push -u origin main

## Sección 1: Introducción

### Video 01. Introducción
+ **Contenido**: Explicación del proyecto a realizar.
+ **URL YouTube**: https://www.youtube.com/watch?v=NShQvNDuUwU&t=16s
1. Commit Video 01:
    + $ git add .
    + $ git commit -m "Commit 01: Introducción"
    + $ git push -u origin main

### Video 02. Programas necesarios
1. Programas requeridos:
    + [Git](https://git-scm.com/downloads)
    + [XAMPP](https://www.apachefriends.org/es/download.html)
    + [Composer](https://getcomposer.org)
    + [Visual Studio Code](https://code.visualstudio.com/download)
    + [Node Js](https://nodejs.org)
2. Otra opción podría ser Laragon ya que instala todos los programas mencionados anteriormente:
    + [Laragon](https://laragon.org/download/index.html)
        + Laragon Full (64-bit): Apache 2.4, Nginx, MySQL 5.7, PHP 7.4, Redis, Memcached, Node.js 14, npm, git, bitmana…
3. Instalar el instalador de Laravel:
    + $ composer global require laravel/installer
4. Extensiones requeridas en **Visual Studio Code**:
    + Laravel Blade Snippets
        + Winnie Lin
        + Laravel blade snippets and syntax highlight support
    + Laravel goto view
        + codingyu
        + Quick jump to view
    + Laravel Snippets
        + Winnie Lin
        + Laravel snippets for Visual Studio Code (Support Laravel 5 and above)
    + PHP Intelephense
        + Ben Mewburn
        + PHP code intelligence for Visual Studio Code
    + Tailwind CSS IntelliSense
        + Brad Cornes
        + Intelligent Tailwind CSS tooling for VS Code
5. Aumentar la memoria límite de PHP para evitar errores en la instalación de paquetes:
    + Abrir el archivo **C:\xampp\php\php.ini**.
    + Cambiar el valor:
      + De:
        ```ini
        memory_limit=512M
        ```
      + A:
        ```ini
        memory_limit=-1
        ```
6. Commit Video 02:
    + $ git add .
    + $ git commit -m "Commit 02: Programas necesarios"
    + $ git push -u origin main

### Video 03. Creación del proyecto
**URL Codersfree dominio local**: https://codersfree.com/blog/como-generar-un-dominio-local-en-windows-xampp
**URL Repositorio del curso**: https://github.com/coders-free/payment
1. Crear proyecto para la API RESTful:
    + $ laravel new paymet --jet
    + Which Jetstream stack do you prefer?
        [0] livewire
        [1] inertia
    + Respuesta: **0**
    + Will your application use teams? (yes/no) [no]: **no**
    + Ingresar a la carpeta del proyecto:
        + $ cd paymet
    + $ npm install
    + $ npm run dev
2. Crear base de datos **paymet**.
3. Ejecutar las migraciones:
    + $ php artisan migrate
4. Abrir el archivo: **C:\Windows\System32\drivers\etc\hosts** como administrador y en la parte final del archivo escribir.
	```
	127.0.0.1     paymet.test
	```
5. Guardar y cerrar.
6. Abri el archivo de texto plano de configuración de Apache **C:\xampp\apache\conf\extra\httpd-vhosts.conf**.
7. Ir al final del archivo y anexar lo siguiente:
	+ Si nunca has creado un virtual host agregar:
		```conf
		<VirtualHost *>
			DocumentRoot "C:\xampp\htdocs"
			ServerName localhost
		</VirtualHost>
		```
		+ **Nota**: Esta estructura se agrega una única vez.
	+ Luego agregar:
		```conf
		<VirtualHost *>
			DocumentRoot "C:\xampp\htdocs\cursos\26pasarela\public"
			ServerName paymet.test
			<Directory "C:\xampp\htdocs\cursos\26pasarela\public">
				Options All
				AllowOverride All
				Require all granted
			</Directory>
		</VirtualHost>
		```
8. Guardar y cerrar.
9. Reiniciar el servidor Apache.
    + **Nota 1**: ahora podemos ejecutar nuestro proyecto local en el navegador introduciendo la siguiente dirección: http://paymet.test
    + **Nota 2**: En caso de que no funcione el enlace, cambiar en el archivo **C:\xampp\apache\conf\extra\httpd-vhosts.conf** todos los segmentos de código **<VirtualHost \*>** por **<VirtualHost *:80>**.
10. Commit Video 03:
    + $ git add .
    + $ git commit -m "Commit 03: Creación del proyecto"
    + $ git push -u origin main

### Video 04. Reutilizar la plantilla Jetstream
+ **URL Documentación Jetstream**: https://jetstream.laravel.com/2.x/introduction.html
1. Adaptar la plantilla **resources\views\layouts\app.blade.php** a nuestro proyecto:
    ```php
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            ≡
            <title>{{ config('app.name', 'Laravel') }}</title>

            <!-- Icon -->
            <link  rel="icon"   href="favicon.ico" type="image/png" />
            ≡
        </head>
        <body class="font-sans antialiased">
            <x-jet-banner />

            <div class="min-h-screen bg-gray-100">
                @livewire('navigation-menu')

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>

            @stack('modals')

            @livewireScripts
        </body>
    </html>
    ```
2. Adaptar la vista **resources\views\navigation-menu.blade.php** a nuestro proyectos:
    ```php
    @php
        $nav_links = [
            [
                'name' => 'Principal',
                'route' => route('home'),
                'active' => request()->routeIs('home')
            ],
        ];
    @endphp

    <nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        ≡
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        @foreach ($nav_links as $nav_link)
                            <x-jet-nav-link href="{{ $nav_link['route'] }}" :active="$nav_link['active']">
                                {{ $nav_link['name'] }}
                            </x-jet-nav-link>
                        @endforeach
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <!-- Teams Dropdown -->
                    ≡

                    <!-- Settings Dropdown -->
                    <div class="ml-3 relative">
                        @auth
                            <x-jet-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                        </button>
                                    @else
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                                {{ Auth::user()->name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    @endif
                                </x-slot>

                                <x-slot name="content">
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Account') }}
                                    </div>

                                    <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Profile') }}
                                    </x-jet-dropdown-link>

                                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                        <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                            {{ __('API Tokens') }}
                                        </x-jet-dropdown-link>
                                    @endif

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-jet-dropdown-link href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-jet-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-jet-dropdown>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Inicio</a>
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Registro</a>
                        @endauth
                    </div>
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    ≡
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                @foreach ($nav_links as $nav_link)
                    <x-jet-responsive-nav-link href="{{ $nav_link['route'] }}" :active="$nav_link['active']">
                        {{ $nav_link['name'] }}
                    </x-jet-responsive-nav-link>
                @endforeach
            </div>

            <!-- Responsive Settings Options -->
            @auth
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="flex items-center px-4">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <div class="flex-shrink-0 mr-3">
                                <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </div>
                        @endif

                        <div>
                            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <!-- Account Management -->
                        <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                            {{ __('Profile') }}
                        </x-jet-responsive-nav-link>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                                {{ __('API Tokens') }}
                            </x-jet-responsive-nav-link>
                        @endif

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-jet-responsive-nav-link>
                        </form>

                        <!-- Team Management -->
                        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                            <div class="border-t border-gray-200"></div>

                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Team') }}
                            </div>

                            <!-- Team Settings -->
                            <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                                {{ __('Team Settings') }}
                            </x-jet-responsive-nav-link>

                            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                    {{ __('Create New Team') }}
                                </x-jet-responsive-nav-link>
                            @endcan

                            <div class="border-t border-gray-200"></div>

                            <!-- Team Switcher -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Switch Teams') }}
                            </div>

                            @foreach (Auth::user()->allTeams() as $team)
                                <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                            @endforeach
                        @endif
                    </div>
                </div>
            @else
                <div class="py-1 border-t border-gray-200">
                    <x-jet-responsive-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                        Inicio
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                        Registro
                    </x-jet-responsive-nav-link>               
                </div>
            @endauth
        </div>
    </nav>
    ```
3. Publicar las vistas de Jetstream:
    + $ php artisan vendor:publish --tag=jetstream-views
    + **Nota 1**: las vistas de Jetstream se publicarán en **resources\views\vendor\jetstream**.
    + **Nota 2**: en el componente **resources\views\vendor\jetstream\components\application-mark.blade.php** se puede cambiar el logito de la aplicación.
4. **Personalización**: El componente **resources\views\vendor\jetstream\components\application-mark.blade.php** se personalizó con la imagen del proyecto:
    ```php
    <img src="{{ asset('assets\images\logo.png') }}" alt="Logo de la empresa" width="40">
    ```
5. **Personalización**: El componente **resources\views\vendor\jetstream\components\authentication-card-logo.blade.php** se personalizó con la imagen del proyecto:
    ```php
    <a href="/">
        <img src="{{ asset('assets\images\logo.png') }}" alt="Logo de la empresa" width="48">
    </a>
    ```
6. **Personalización**: El componente **resources\views\vendor\jetstream\components\application-logo.blade.php** se personalizó con la imagen del proyecto:
    ```php
    <img src="{{ asset('assets\images\logo_completo.png') }}" alt="Logo de la empresa" width="120">
    ```
7. **Personalización**: Reemplazar el favicon de la aplicación por el del proyecto en **public\favicon.ico**
7. Adaptar las rutas raíz del archivo **routes\web.php** a nuestro proyecto:
    ```php
    Route::get('/', function () {
        return view('welcome');
    })->name('home');
    ```
8. Extender de la plantilla de Jetstream la vista **resources\views\welcome.blade.php**:
    ```php
    <x-app-layout>
    </x-app-layout>
    ```
9. Commit Video 04:
    + $ git add .
    + $ git commit -m "Commit 04: Reutilizar la plantilla Jetstream"
    + $ git push -u origin main

### Video 05. Llenar con datos falsos nuestra bbdd
1. Crear el modelo **Product** con magración, factory y controlador:
    + $ php artisan make:model Product -mfc
2. Generar el acceso directo a storage:
    + $ php artisan storage:link
3. Cambiar el valor de la siguiente variable de entorno en **.env**:
    ```
    APP_NAME=PayMet
    FILESYSTEM_DRIVER=public
    ```
4. Modificar el método **up** de la migración **database\migrations\2021_09_24_201344_create_products_table.php**:
    ```php
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->text('description');
            $table->string('price');
            $table->timestamps();
        });
    }
    ```
5. Modificar el método **definition** del factory **database\factories\ProductFactory.php**:
    ```php
    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'image' => 'products/' . $this->faker->image('public/storage/products', 640, 480, null, false),
            'description' => $this->faker->text(),
            'price' => $this->faker->randomElement([19, 49, 99])
        ];
    }
    ```
6. Crear el modelo **Article** con magración, factory y controlador:
    + $ php artisan make:model Article -mfc
7. Modificar el método **up** de la migración **database\migrations\2021_09_24_212439_create_articles_table.php**:
    ```php
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->text('extract');
            $table->longText('body');
            $table->timestamps();
        });
    }
    ```
8. Modificar el método **definition** del factory **database\factories\ArticleFactory.php**:
    ```php
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'image' => 'articles/' . $this->faker->image('public/storage/articles', 640, 480, null, false),
            'extract' => $this->faker->text(),
            'body' => $this->faker->text(2000)
        ];
    }
    ```
9. Modificar el método **run** del seeder **database\seeders\DatabaseSeeder.php**:
    ```php
    public function run()
    {
        Storage::deleteDirectory('products');
        Storage::deleteDirectory('articles');

        Storage::makeDirectory('products');
        Storage::makeDirectory('articles');

        Product::factory(50)->create();
        Article::factory(50)->create();
    }
    ```
    + Importar las definiciones de los modelos **Article** y **Product** y el facade **Storage**:
    ```php
    use App\Models\Article;
    use App\Models\Product;
    use Illuminate\Support\Facades\Storage;
    ```
10. Ejecutar nuevamente las migraciones junto a los seeders:
    + $ php artisan migrate:fresh --seed
11. Commit Video 05:
    + $ git add .
    + $ git commit -m "Commit 05: Llenar con datos falsos nuestra bbdd"
    + $ git push -u origin main

### Video 06. Creando nuestros propios estilos css
1. Crear archivo de estilo **resources\css\buttons.css**:
    ```css
    .btn {
        @apply font-bold py-2 px-4 rounded;
    }

    .btn-primary {
        @apply bg-blue-500 text-white;
    }

    .btn-primary:hover {
        @apply bg-blue-700;
    }

    .btn-danger {
        @apply bg-red-500 text-white;
    }

    .btn-danger:hover {
        @apply bg-red-700;
    }

    .btn-success {
        @apply bg-green-500 text-white;
    }

    .btn-success:hover {
        @apply bg-green-700;
    }

    .btn-secondary {
        @apply bg-gray-500 text-white;
    }

    .btn-secondary:hover {
        @apply bg-gray-700;
    }
    ```
2. Crear archivo de estilo **resources\css\cards.css**:
    ```css
    .card{
        @apply rounded overflow-hidden shadow-lg bg-white;
    }

    .card-body, .card-footer, .card-header{
        @apply px-6 py-4;
    }

    .card-footer, .card-header{
        @apply bg-gray-50;
    }

    .card-title{
        @apply font-bold text-xl mb-2;
    }

    .card-text{
        @apply text-gray-700 text-base;
    }
    ```
3. Crear archivo de estilo **resources\css\container.css**
    ```css
    .container{
        @apply max-w-7xl mx-auto px-4 sm:px-6 lg:px-8;
    }
    ```
4. Crear archivo de estilo **resources\css\forms.css**
    ```css
    .form-group{
        @apply mb-6;
    }

    .form-label{
        @apply block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2;
    }

    .form-control{
        @apply appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-400;
    }

    .form-select{
        @apply appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-400;
    }

    .is-invalid{
        @apply border-red-500 focus:border-red-500;
    }

    .form-text{
        @apply text-gray-600 text-xs italic;
    }

    .invalid-feedback{
        @apply text-red-500 text-xs italic;
    }
    ```
5. Importar los nuevos estilos **buttons**, **cards**, **container** y **forms** en **resources\css\app.css**:
    ```css
    @import 'tailwindcss/base';
    @import 'tailwindcss/components';
    @import 'tailwindcss/utilities';

    @import 'buttons.css';
    @import 'cards.css';
    @import 'container.css';
    @import 'forms.css';
    ```
6. Deshabilitar la clase **container** de **tailwind** en **tailwind.config.js**:
    ```js
    const defaultTheme = require('tailwindcss/defaultTheme');

    module.exports = {
        ≡
        corePlugins: {
            container: false,
        }
    };
    ```
7. Volver a compilar los estilos:
    + $ npm run dev
8. Commit Video 06:
    + $ git add .
    + $ git commit -m "Commit 06: Creando nuestros propios estilos css"
    + $ git push -u origin main

### Video 07. Mostrar productos y artículos
1. Redefinir la ruta raíz de la aplicación en el archivo de rutas **routes\web.php**:
    ```php
    Route::get('/', [ProductController::class, 'index'])->name('home');
    ```
    + Importar la definición del controlador **ProductController**:
    ```php
    use App\Http\Controllers\ProductController;
    ```
2. Crear el método **index** en el controlador **app\Http\Controllers\ProductController.php**:
    ```php
    public function index(){
        $products = Product::paginate(9);
        return view('welcome', compact('products'));
    }
    ```
    + Importar la definición del modelo **Product**:
    ```php
    use App\Models\Product;
    ```
3. Diseñar la vista **resources\views\welcome.blade.php**:
    ```php
    <x-app-layout>
        <div class="container py-10">
            <div class="grid grid-cols-3 gap-6">
                @foreach ($products as $product)
                    <div class="card">
                        <div class="px-4 py-2 bg-gray-900 flex justify-between items-center">
                            <p class="text-gray-200 font-bold text-xl">{{ $product->price }} USD</p>
                            <a href="" class="btn btn-secondary">Comprar</a>
                        </div>
                        <img class="h-56 w-full object-cover" src="{{Storage::url($product->image)}}" alt="Imagen del producto">
                        <div class="card-body">
                            <h1 class="text-gray-900 font-bold text-xl uppercase">{{ $product->title }}</h1>
                            <p class="text-gray-600 text-sm mt-1">{{ Str::limit($product->description, 150) }}</p>
                        </div>
                    </div>
                @endforeach
                <div class="mt-6">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </x-app-layout>
    ```
4. Crear rutas **get articles** en **routes\web.php**:
    ```php
    Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
    ```
    + Importar la definición del controlador **ArticleController**:
    ```php
    use App\Http\Controllers\ArticleController;
    ```
5. Definir el método **index** en el controlador **app\Http\Controllers\ArticleController.php**:
    ```php
    public function index(){
        $articles = Article::paginate(4);
        return view('articles.index', compact('articles'));
    }
    ```
    + Importar la definición del modelo **Article**:
    ```php
    use App\Models\Article;
    ```
6. Crear la vista **resources\views\articles\index.blade.php**:
    ```php
    <x-app-layout>
        <div class="max-w-5xl mx-auto px-4 lg:px-8 py-12">
            @foreach ($articles as $article)
                <article class="card mb-6">

                    <img class="h-72 w-full object-cover object-center" src="{{Storage::url($article->image)}}" alt="Imagen del artículo">

                    <div class="card-body">
                        <h1 class="font-bold text-xl mb-2">
                            <a href="{{route('articles.show', $article)}}">{{$article->title}}</a>
                        </h1>

                        <div class="text-gray-700">
                            {{$article->extract}}
                        </div>
                    </div>
                </article>
            @endforeach
            {{$articles->links()}}
        </div>
    </x-app-layout>
    ```
7. Incluir la vista Article en resources\views\navigation-menu.blade.php:
    ```php
    @php
        $nav_links = [
            [
                'name' => 'Principal',
                'route' => route('home'),
                'active' => request()->routeIs('home')
            ],
            [
                'name' => 'Artículos',
                'route' => route('articles.index'),
                'active' => request()->routeIs('articles.*')
            ],
        ];
    @endphp
    ≡
    ```
8. Definir el método **show** en el controlador **app\Http\Controllers\ArticleController.php**:
    ```php
    public function show(Article $article){
        return view('articles.show', compact($article));
    }
    ```
9. Crear la vista **resources\views\articles\show.blade.php**:
    ```php
    <x-app-layout>
        <div class="max-w-5xl mx-auto px-4 lg:px-8 py-12">
            <h1 class="text-4xl font-bold text-gray-600">{{$article->title}}</h1>

            <div class="text-lg text-gray-500 mb-2">
                {{$article->extract}}
            </div>

            <figure>
                <img class="h-80 w-full object-cover object-center" src="{{Storage::url($article->image)}}" alt="Imagen del artículo">
            </figure>

            <div class="text-gray-500 mt-4">
                {{$article->body}}
            </div>
        </div>
    </x-app-layout>
    ```
10. Commit Video 07:
    + $ git add .
    + $ git commit -m "Commit 07: Mostrar productos y artículos"
    + $ git push -u origin main

## Sección 2: Preparar el proyecto para recibir pagos

### Video 08. Crear una cuenta en Stripe
1. Crear cuenta en Stripe:
    + https://dashboard.stripe.com/register
    + **Nota**: escoger Estados Unidos como país, ya que no aparacen para escoger casi ningún país de latinoamerica.
2. Commit Video 08:
    + $ git add .
    + $ git commit -m "Commit 08: Crear una cuenta en Stripe"
    + $ git push -u origin main

### Video 09. Instalar Laravel Cashier
+ **URL Documentación Laravel Cashier**: https://laravel.com/docs/8.x/billing
1. Instalar Laravel Cashier:
    + $ composer require laravel/cashier
    + $ php artisan migrate
2. Agregar el trait **Billable** al modelo **app\Models\User.php**:
    ```php
    ≡
    use Laravel\Cashier\Billable;

    class User extends Authenticatable
    {
        use HasApiTokens;
        use HasFactory;
        use HasProfilePhoto;
        use Notifiable;
        use TwoFactorAuthenticatable;
        use Billable;
        ≡
    }
    ```
3. Agregar las credenciales de la cuenta de Stripe en **.env**:
    ```env
    ≡
    STRIPE_KEY=your-stripe-key
    STRIPE_SECRET=your-stripe-secret
    ```
    + **Obtener credenciales para el proyecto en desarrollo**: 
        + Hacer login en la página de [Stripe](https://stripe.com/es-us).
        + Ir a **Desarrolladores**.
        + Ir a **Claves de API**.
            + La **Clave publicable** corresponde a **STRIPE_KEY**.
            + La **Clave secreta** corresponde a **STRIPE_SECRET**.
    + **Obtener credenciales para el proyecto en producción**:
        + Activar cuenta en Stripe para que se generen nuevos tokens.
    + **Para espcificar la moneda de cobro**:
        + Agregar la siguiente variable de entorno en **.env**:
        ```env
        ≡
        CASHIER_CURRENCY=eur
        ```
        + **Nota**: por defecto es el dólar.
4. Commit Video 09:
    + $ git add .
    + $ git commit -m "Commit 09: Instalar Laravel Cashier"
    + $ git push -u origin main

### Video 10. Crear clientes en Stripe
1. Modificar el método **create** del controlador **app\Actions\Fortify\CreateNewUser.php**:
    ```php
    public function create(array $input)
    {
        ≡
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        // Registrar al usuario en la plataforma de Stripe
        $user->createAsStripeCustomer();

        return $user;
    }
    ```
2. Commit Video 10:
    + $ git add .
    + $ git commit -m "Commit 10: Crear clientes en Stripe"
    + $ git push -u origin main

## Sección 3: Métodos de pago

### Video 11. Agregar métodos de pago
### Video 12. Agregar un spinner
### Video 13. Mostrar el listado de métodos de pago agregados
### Video 14. Eliminar método de pago
### Video 15. Elegir método de pago predeterminado



***
≡
    ```php
    ***
    ```



## Repositorios de interes:
+ https://github.com/coders-free/payment

## Para limpiar configuración y reestablecer el cache:
+ $ php artisan config:clear   
+ $ php artisan config:cache 

## En caso de no permitir compilar algo:
+ $ php artisan clear-compiled
+ $ composer dumpautoload

## Deploy del proyecto en Heroku
1. Crear en la raíz del proyecto el archivo **Procfile** (sin extensión) para elegir un servidor apache en Heroku y también indicarle la ubicación del archivo incial index.php:
    ```
    web: vendor/bin/heroku-php-apache2 public/
    ```
2. Ingresar a [Heroku](https://dashboard.heroku.com/apps) e ir a **Dashboard**.
3. Crear un nuevo proyecto en **New > Create new app**
    + Nombre: paymet
4. Ir a Deploy y dar clic en GitHub.
5. Clic en el botón Connect to GitHub e ingresar las credenciales.
6. Seleccionar el repositorio **pasarela_pago** y presionar el botón **Connect**.
7. Para tener siempre la ultima actualización de nuestro proyecto se recomienda presionar el botón **Enable Automatic Deploys**.
8. Presionar el botón Deploy Branch.
9. Descargar e instalar [Heroku CLI](https://devcenter.heroku.com/articles/heroku-cli).
10. En la terminal en la raíz del proyecto en local e iniciar sesión en Heroku:
    + $ heroku login
11. Víncular con la aplicación de Heroku **paymet**:
    + $ git remote add heroku git.heroku.com/paymet.git
        + (git remote set-url Origin git.heroku.com/paymet.git)
    + $ heroku git:remote -a paymet
12. Registrar variables de entorno de la aplicación desde la terminal:
    + $ heroku config:add APP_NAME=PayMet
    + $ heroku config:add APP_ENV=production
    + $ heroku config:add APP_KEY=base64:gUVmds1U2u5m126RsiswRYif8dydHe31tUf143J2X58=
    + $ heroku config:add APP_DEBUG=false
    + $ heroku config:add APP_URL=https://paymet.herokuapp.com/
13. Crear base de datos Postgre SQL desde la terminal:
    + $ heroku addons:create heroku-postgresql:hobby-dev
    + $ heroku pg:credentials:url
    + **Nota**: la salida de la última línea de comando nos servirá para configurar las variables de entorno de la base de datos:
    ```
    Connection information for default credential.
    Connection info string:
    "dbname=*** host=*** port=*** user=*** password=*** sslmode=require"
    Connection URL:
    postgres://mmtmzssdyxkfyt:9336263e704b06d0a1ba7c979c426e7d8eb77f3958e4114cea9a21973ba08d84@ec2-35-168-145-180.compute-1.amazonaws.com:5432/dbhkpp3vfen6vd
    ```
14. Registrar variables de entorno de la base de datos desde la terminal:
    + $ heroku config:add DB_CONNECTION=pgsql
    + $ heroku config:add DB_HOST=ec2-18-235-4-83.compute-1.amazonaws.com
    + $ heroku config:add DB_PORT=5432
    + $ heroku config:add DB_DATABASE=db6unq9m90dvkv
    + $ heroku config:add DB_USERNAME=vcsyvufmsdpbhn
    + $ heroku config:add DB_PASSWORD=******
15. Ejecutar migraciones:
    + $ heroku run bash
    + ~ $ php artisan migrate --seed
        + Do you really wish to run this command? (yes/no) [no]: **yes**
    + ~ $ exit
16. Salir de Heroku:
    + $ heroku logout
17. Desconectar con repositorio Heroku:
    + $ git remote rm heroku