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
1. Crear proyecto para la **Pasarela de Pago**:
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
1. Crear el controlador **BillingController**:
    + $ php artisan make:controller BillingController
2. Crear ruta get 
    ```php
    Route::get('billing', [BillingController::class, 'index'])->middleware('auth')->name('billing.index');
    ```
    + Importar la definición del controlador **BillingController**:
    ```php
    use App\Http\Controllers\BillingController;
    ```
3. Definir el método **index** del controlador **app\Http\Controllers\BillingController.php**:
    ```php
    public function index(){
        return view('billing.index');
    }
    ```
4. Crear la vista **resources\views\billing\index.blade.php**:
    ```php
    <x-app-layout>
        <div class="py-12">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                @livewire('payment-method-create')
            </div>
        </div>
    </x-app-layout>
    ```
5. Incluir el menú **Facturación** en **resources\views\navigation-menu.blade.php**:
    ```php
    ≡
    <nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                ≡
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <!-- Teams Dropdown -->
                    ≡
                    <!-- Settings Dropdown -->
                    <div class="ml-3 relative">
                        @auth
                            <x-jet-dropdown align="right" width="48">
                                ≡
                                <x-slot name="content">
                                    <!-- Account Management -->
                                    ≡
                                    <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Profile') }}
                                    </x-jet-dropdown-link>

                                    <x-jet-dropdown-link href="{{ route('billing.index') }}">
                                        Facturación
                                    </x-jet-dropdown-link>
                                    ≡
                                    <!-- Authentication -->
                                    ≡
                                </x-slot>
                            </x-jet-dropdown>
                        @else
                            ≡
                        @endauth
                    </div>
                </div>
                <!-- Hamburger -->
                ≡
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            ≡
            <!-- Responsive Settings Options -->
            @auth
                <div class="pt-4 pb-1 border-t border-gray-200">
                    ≡
                    <div class="mt-3 space-y-1">
                        <!-- Account Management -->
                        <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                            {{ __('Profile') }}
                        </x-jet-responsive-nav-link>

                        <x-jet-responsive-nav-link href="{{ route('billing.index') }}" :active="request()->routeIs('billing.index')">
                            Facturación
                        </x-jet-responsive-nav-link>
                        ≡
                        <!-- Authentication -->
                        ≡
                        <!-- Team Management -->
                        ≡
                    </div>
                </div>
            @else
                <div class="py-1 border-t border-gray-200">
                    ≡            
                </div>
            @endauth
        </div>
    </nav>
    ```
6. Crear componente de livewire **PaymentMethodCreate**:
    + $ php artisan make:livewire PaymentMethodCreate
7. Redefinir el controlador **app\Http\Livewire\PaymentMethodCreate.php**:
    ```php
    <?php

    namespace App\Http\Livewire;

    use Livewire\Component;

    class PaymentMethodCreate extends Component
    {
        protected $listeners = ['paymentMethodCreate' => 'paymentMethodCreate'];

        public function render()
        {
            return view('livewire.payment-method-create', [
                'intent' => auth()->user()->createSetupIntent()
            ]);
        }

        public function paymentMethodCreate($paymentMethod){
            auth()->user()->addPaymentMethod($paymentMethod);
        }
    }
    ```
8. Diseñar vista **resources\views\livewire\payment-method-create.blade.php**:
    ```php
    <div>   
        <article class="card">
            <form action="" id="card-form">
                <div class="card-body">

                    <h1 class="text-gray-700 text-lg font-bold mb-4">Agregar método de pago</h1>
                    
                    <div class="flex">
                        <p class="text-gray-700">Información de tarjeta</p>
                        <div class="flex-1 ml-6">
                            <div class="form-group">
                                <input class="form-control" id="card-holder-name" type="text"
                                    placeholder="Nombre del titular de la tarjeta" required>
                            </div>

                            <!-- Stripe Elements Placeholder -->
                            <div>
                                <div class="form-control" id="card-element"></div>

                                <span class="invalid-feedback" id="cardErrors"></span>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-gray-50 flex justify-end">
                    <button class="btn btn-primary" id="card-button" data-secret="{{ $intent->client_secret }}">
                        Agregar método de pago
                    </button>
                </div>
            </form>
        </article>

        @slot('js')
            <script>
                function stripe(){
                    const stripe = Stripe(" {{ env('STRIPE_KEY') }} ");
                    const elements = stripe.elements();
                    const cardElement = elements.create('card');
                    cardElement.mount('#card-element');
                    //Generar token
                    const cardHolderName = document.getElementById('card-holder-name');
                    const cardButton = document.getElementById('card-button');
                    const cardForm = document.getElementById('card-form');
                    const clientSecret = cardButton.dataset.secret;
                    cardForm.addEventListener('submit', async (e) => {
                        e.preventDefault();
                        const {
                            setupIntent,
                            error
                        } = await stripe.confirmCardSetup(
                            clientSecret, {
                                payment_method: {
                                    card: cardElement,
                                    billing_details: {
                                        name: cardHolderName.value
                                    }
                                }
                            }
                        );
                        if (error) {
                            
                            document.getElementById('cardErrors').textContent = error.message;
                        } else {
                            
                            Livewire.emit('paymentMethodCreate', setupIntent.payment_method);
                        }
                    });
                }
            </script>
        @endslot
    </div>
    ```
    + [Código tomado de la documentación](https://laravel.com/docs/8.x/billing): Payment Methods For Subscriptions
9. Incluir la librería de **Stripe** y los slot **css** y **js** en la plantilla principal **resources\views\layouts\app.blade.php**:
    ```php
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            ≡
            <!-- Stripe -->
            <script src="https://js.stripe.com/v3/"></script>

            @isset($css)
                {{ $css }}
            @endisset
        </head>
        <body class="font-sans antialiased">
            ≡
            @isset($js)
                {{ $js }}
            @endisset
        </body>
    </html>
    ```
10. Commit Video 11:
    + $ git add .
    + $ git commit -m "Commit 11: Agregar métodos de pago"
    + $ git push -u origin main

### Video 12. Agregar un spinner
+ **URL Tailwind Componente spinner**: https://tailwindcomponents.com/component/spinner
1. Crear archivo de estilos resources\css\spinner.css:
    ```css
    .loader {
        border-top-color: #3498db;
        -webkit-animation: spinner 1.5s linear infinite;
        animation: spinner 1.5s linear infinite;
    }

    @-webkit-keyframes spinner {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spinner {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    ```
2. Importar el nuevo estilo en **resources\css\app.css**:
    ```php
    @import 'tailwindcss/base';
    @import 'tailwindcss/components';
    @import 'tailwindcss/utilities';

    @import "buttons.css";
    @import "cards.css";
    @import "container.css";
    @import "forms.css";
    @import "spinner.css";
    ```
3. Compilar nuevamente para agregar los nuevos estilos css:
    + $ npm run dev
4. Crear componente blade **resources\views\components\spinner.blade.php**:
    ```php
    @props(['size' => '64'])
    <div class="loader ease-linear rounded-full border-8 border-t-8 border-gray-200 h-{{ $size }} w-{{ $size }}"></div>
    ```
5. Modificar vista **resources\views\livewire\payment-method-create.blade.php**:
    ```php
    <div>
        <article class="card relative">
            <div wire:loading.flex class="absolute w-full h-full bg-gray-100 bg-opacity-25 z-30 items-center justify-center">
                <x-spinner size="20" />
            </div>

            <form action="" id="card-form">
                ≡
            </form>
        </article>

        @slot('js')
            <script>
                document.addEventListener('livewire:load', function(){
                    stripe();
                })
                Livewire.on('resetStripe', function(){
                    document.getElementById('card-form').reset();
                    stripe();
                });
            </script>
            <script>
                function stripe(){
                    const stripe = Stripe(" {{ env('STRIPE_KEY') }} ");
                    const elements = stripe.elements();
                    const cardElement = elements.create('card');
                    cardElement.mount('#card-element');
                    //Generar token
                    const cardHolderName = document.getElementById('card-holder-name');
                    const cardButton = document.getElementById('card-button');
                    const cardForm = document.getElementById('card-form');
                    const clientSecret = cardButton.dataset.secret;
                    cardForm.addEventListener('submit', async (e) => {
                        e.preventDefault();
                        const {
                            setupIntent,
                            error
                        } = await stripe.confirmCardSetup(
                            clientSecret, {
                                payment_method: {
                                    card: cardElement,
                                    billing_details: {
                                        name: cardHolderName.value
                                    }
                                }
                            }
                        );
                        if (error) {
                            
                            document.getElementById('cardErrors').textContent = error.message;
                        } else {
                            
                            Livewire.emit('paymentMethodCreate', setupIntent.payment_method);
                        }
                    });
                }
            </script>
        @endslot
    </div>
    ```
6. Modificar el método **render** del controlador **app\Http\Livewire\PaymentMethodCreate.php**:
    ```php
    public function render()
    {
        $this->emit('resetStripe');
        
        return view('livewire.payment-method-create', [
            'intent' => auth()->user()->createSetupIntent()
        ]);
    }
    ```
7. Commit Video 12:
    + $ git add .
    + $ git commit -m "Commit 12: Agregar un spinner"
    + $ git push -u origin main

### Video 13. Mostrar el listado de métodos de pago agregados
1. Crear componente livewire **PaymentMethodList**:
    + $ php artisan make:livewire PaymentMethodList
2. Redefinir el método **render** del controlador **app\Http\Livewire\PaymentMethodList.php**:
    ```php
    public function render()
    {
        // Recupera la lista de los métodos de pagos
        $paymentMethods =auth()->user()->paymentMethods();

        return view('livewire.payment-method-list', compact('paymentMethods'));
    }
    ```
3. Diseñar la vista **resources\views\livewire\payment-method-list.blade.php**:
    ```php
    <div>
        <section class="card">
            <div class="px-6 py-4 bg-gray-50">
                <h1 class="text-gray-700 text-lg font-bold">Métodos de pago agregado</h1>
            </div>
            <div class="card-body divide-y divide-gray-200">
                @foreach ($paymentMethods as $paymentMethod)
                    <article class="text-sm text-gray-700 py-2 flex justify-between items-center">
                        <h1><span class="font-bold">{{ $paymentMethod->billing_details->name }}</span> XXXX-{{ $paymentMethod->card->last4 }}</h1>
                        <p>Expira: {{ $paymentMethod->card->exp_month }}/{{ $paymentMethod->card->exp_year }}</p>
                    </article>
                @endforeach
            </div>
        </section>
    </div>
    ```
4. Commit Video 13:
    + $ git add .
    + $ git commit -m "Commit 13: Mostrar el listado de métodos de pago agregados"
    + $ git push -u origin main

### Video 14. Eliminar método de pago
1. Descargar la librería de **fontawesome css** y pegarla en **public\vendor\fontawesome**.
2. Incluir la librería en el proyecto principal en **resources\views\layouts\app.blade.php**:
    ```php
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            ≡

            <!-- Styles -->
            <link rel="stylesheet" href="{{ mix('css/app.css') }}">

            <!-- fontawesome -->
            <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/all.min.css') }}">
            ≡
        </head>
        <body class="font-sans antialiased">
            ≡
        </body>
    </html>
    ```
    + **Nota**: desde ahora podemos usar todos los iconos de **fontawesome**.
3. Modificar la vista **resources\views\livewire\payment-method-list.blade.php**:
    ```php
    <div>
        <section class="card relative">
            <div wire:loading.flex class="absolute w-full h-full bg-gray-100 bg-opacity-25 z-30 items-center justify-center">
                <x-spinner size="20" />
            </div>

            <div class="px-6 py-4 bg-gray-50">
                <h1 class="text-gray-700 text-lg font-bold">Métodos de pago agregado</h1>
            </div>

            <div class="card-body divide-y divide-gray-200">
                @foreach ($paymentMethods as $paymentMethod)
                    <article class="text-sm text-gray-700 py-2 flex justify-between items-center">
                        <div>
                            <h1><span class="font-bold">{{ $paymentMethod->billing_details->name }}</span> XXXX-{{ $paymentMethod->card->last4 }}</h1>
                            <p>Expira: {{ $paymentMethod->card->exp_month }}/{{ $paymentMethod->card->exp_year }}</p>
                        </div>
                        <div>
                            {{-- <i class="fas fa-star cursor-pointer p-3 hover:text-gray-700" wire:click="defaultPaymentMethod('{{$paymentMethod->id}}')"></i> --}}
                            <i class="fas fa-trash cursor-pointer p-3 hover:text-gray-700" wire:click="deletePaymentMethod('{{$paymentMethod->id}}')"></i>                      
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    </div>
    ```
4. Modificar el controlador **app\Http\Livewire\PaymentMethodList.php**:
    ```php
    ≡
    class PaymentMethodList extends Component
    {
        protected $listeners = ['render'];

        public function render()
        {
            ≡
        }    
        
        public function deletePaymentMethod($paymentMethodId){
            $paymentMethod = auth()->user()->findPaymentMethod($paymentMethodId);
            $paymentMethod->delete();
        }
    }
    ```
5. Modificar el controlador **app\Http\Livewire\PaymentMethodCreate.php**:
    ```php
    ≡
    class PaymentMethodCreate extends Component
    {
        ≡
        public function paymentMethodCreate($paymentMethod){
            ≡
            $this->emitTo('payment-method-list', 'render');
        }
    }
    ```
6. Commit Video 14:
    + $ git add .
    + $ git commit -m "Commit 14: Eliminar método de pago"
    + $ git push -u origin main

### Video 15. Elegir método de pago predeterminado
+ **URL con tarjetas de prueba**: https://stripe.com/docs/testing
1. Modificar la vista **resources\views\livewire\payment-method-list.blade.php**:
    ```php
    <div>
        <section class="card relative">
            <div wire:loading.flex class="absolute w-full h-full bg-gray-100 bg-opacity-25 z-30 items-center justify-center">
                <x-spinner size="20" />
            </div>

            <div class="px-6 py-4 bg-gray-50">
                <h1 class="text-gray-700 text-lg font-bold">Métodos de pago agregado</h1>
            </div>

            <div class="card-body divide-y divide-gray-200">
                @forelse ($paymentMethods as $paymentMethod)
                    <article class="text-sm text-gray-700 py-2 flex justify-between items-center">
                        <div>
                            <h1><span class="font-bold">{{$paymentMethod->billing_details->name}}</span> XXXX-{{$paymentMethod->card->last4}}
                                @if ($paymentMethod->id == auth()->user()->defaultPaymentMethod()->id)
                                    (default)
                                @endif
                            </h1>
                            <p>Expira: {{ $paymentMethod->card->exp_month }}/{{ $paymentMethod->card->exp_year }}</p>
                        </div>
                        <div class="grid grid-cols-2 border border-gray-200 rounded text-gray-500 divide-x divide-gray-200">                       
                            @unless ($paymentMethod->id == auth()->user()->defaultPaymentMethod()->id)
                                <i class="fas fa-star cursor-pointer p-3 hover:text-gray-700" wire:click="defaultPaymentMethod('{{$paymentMethod->id}}')"></i>
                                <i class="fas fa-trash cursor-pointer p-3 hover:text-gray-700" wire:click="deletePaymentMethod('{{$paymentMethod->id}}')"></i>                      
                            @endunless
                        </div>
                    </article>
                @empty
                    <article class="p-2">
                        <h1 class="text-sm text-gray-700">No cuenta con ningún método de pago</h1>
                    </article>
                @endforelse
            </div>
        </section>
    </div>
    ```
2. Agragar el método **defaultPaymentMethod** en el controlador **app\Http\Livewire\PaymentMethodList.php**:
    ```php
    public function defaultPaymentMethod($paymentMethodId){
        auth()->user()->updateDefaultPaymentMethod($paymentMethodId);
    }
    ```
3. Modificar el método **paymentMethodCreate** del controlador **app\Http\Livewire\PaymentMethodCreate.php**:
    ```php
    public function paymentMethodCreate($paymentMethod){
        if (auth()->user()->hasPaymentMethod()) {
            auth()->user()->addPaymentMethod($paymentMethod);
        }else{
            auth()->user()->updateDefaultPaymentMethod($paymentMethod);
        }
        
        $this->emitTo('payment-method-list', 'render');
    }
    ```
4. Commit Video 15:
    + $ git add .
    + $ git commit -m "Commit 15: Elegir método de pago predeterminado"
    + $ git push -u origin main

## Sección 4: Suscripciones

### Video 16. Crear suscripciones en Stripe
1. Ingresar a nuestra cuenta en [Stripe](https://stripe.com/es-us)
2. Ir a **Productos** y luego hacer clic en **+ Añadir producto**:
    + Información del producto:
        + Datos del producto:
            + Nombre: Servicios Sefar Universal
        + Información sobre precios:
            + Modelo de tarifas: Tarifas estándar
            + Precio: 9.99 USD
                + Recurrente
            + Periodo de facturación: Cada mes
            + Precionar: **+ Añadir otro precio**
            + Modelo de tarifas: Tarifas estándar
            + Precio: 19.99 USD
                + Recurrente
            + Periodo de facturación: Cada 3 meses
            + Precionar: **+ Añadir otro precio**
            + Modelo de tarifas: Tarifas estándar
            + Precio: 89.99 USD
                + Recurrente
            + Periodo de facturación: Cada año
        + Precionar: **Guardar producto**
3. Commit Video 16:
    + $ git add .
    + $ git commit -m "Commit 16: Crear suscripciones en Stripe"
    + $ git push -u origin main

### Video 17. Incluir suscripciones en nuestra plataforma
1. Crear componente de livewire **Subscriptions**:
    + $ php artisan make:livewire Subscriptions
2. Incluir el componente en la vista **resources\views\billing\index.blade.php**:
    ```php
    <x-app-layout>
        <div class="pb-12">
            @livewire('subscriptions')
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                @livewire('payment-method-create')

                <div class="my-8">
                    @livewire('payment-method-list')
                </div>
            </div>
        </div>
    </x-app-layout>
    ```
3. Crear componente de blade **resources\views\components\button-subscription.blade.php**:
    ```php
    @props(['name', 'price'])

    <div class="w-full">
        <button class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full">Subcribirse</button>
    </div>
    ```
4. Diseñar la vista **resources\views\livewire\subscriptions.blade.php**:
    ```php
    <div class="w-full mx-auto px-5 py-10 text-gray-600 mb-10">
        <div class="text-center max-w-xl mx-auto">
            <h1 class="text-5xl md:text-6xl font-bold mb-5">Pricing</h1>
            <h3 class="text-xl font-medium mb-10">Lorem ipsum dolor sit amet consectetur adipisicing elit repellat dignissimos laboriosam odit accusamus porro</h3>
        </div>
        <div class="max-w-4xl mx-auto md:flex">
            {{-- Plan mensual --}}
            <div class="w-full md:w-1/3 md:max-w-none bg-white px-8 md:px-10 py-8 md:py-10 mb-3 mx-auto md:my-6 rounded-md shadow-lg shadow-gray-600 md:flex md:flex-col">
                <div class="w-full flex-grow">
                    <h2 class="text-center font-bold uppercase mb-4">PLAN MENSUAL</h2>
                    <h3 class="text-center font-bold text-4xl mb-5">$9.99</h3>
                    <ul class="text-sm px-5 mb-8">
                        <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Lorem ipsum</li>
                        <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Dolor sit amet</li>
                    </ul>
                </div>
                <x-button-subscription name="Servicios Sefar Universal" price="price_1Je6v9CF1N694F8geZ0KffEI" />
            </div>

            {{-- Plan trimestral --}}
            <div class="w-full md:w-1/3 md:max-w-none bg-white px-8 md:px-10 py-8 md:py-10 mb-3 mx-auto md:-mx-3 md:mb-0 rounded-md shadow-lg shadow-gray-600 md:relative md:z-50 md:flex md:flex-col">
                <div class="w-full flex-grow">
                    <h2 class="text-center font-bold uppercase mb-4">PLAN TRIMESTRAL</h2>
                    <h3 class="text-center font-bold text-4xl md:text-5xl mb-5">$19.99</h3>
                    <ul class="text-sm px-5 mb-8">
                        <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Lorem ipsum</li>
                        <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Dolor sit amet</li>
                        <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Consectetur</li>
                        <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Adipisicing</li>
                        <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Elit repellat</li>
                    </ul>
                </div>
                <x-button-subscription name="Servicios Sefar Universal" price="price_1Je6v9CF1N694F8gA4SNnBw6" />
            </div>

            {{-- Plan anual --}}
            <div class="w-full md:w-1/3 md:max-w-none bg-white px-8 md:px-10 py-8 md:py-10 mb-3 mx-auto md:my-6 rounded-md shadow-lg shadow-gray-600 md:flex md:flex-col">
                <div class="w-full flex-grow">
                    <h2 class="text-center font-bold uppercase mb-4">PLAN ANUAL</h2>
                    <h3 class="text-center font-bold text-4xl mb-5">$89.99</h3>
                    <ul class="text-sm px-5 mb-8">
                        <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Lorem ipsum</li>
                        <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Dolor sit amet</li>
                        <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Consectetur</li>
                        <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Adipisicing</li>
                        <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Much more...</li>
                    </ul>
                </div>
                <x-button-subscription name="Servicios Sefar Universal" price="price_1Je6v9CF1N694F8gyvdJbORd" />
            </div>
        </div>
    </div>
    ```
    + **Nota 1**: Para el diseño de esta vista se tomó código de esta página: https://tailwindcomponents.com/component/pricing-table-wireframes-1
    + **Nota 2**: Los valores que se envían como parámetros cuando se invoca al componente blade **button-subscription** provienen del producto **Servicios Sefar Universal** creado en la página de Stripe.
5. Commit Video 17:
    + $ git add .
    + $ git commit -m "Commit 17: Incluir suscripciones en nuestra plataforma"
    + $ git push -u origin main

### Video 18. Iniciar suscripcion
1. Modificar el componente **resources\views\components\button-subscription.blade.php**:
    ```php
    @props(['name', 'price'])

    <div class="w-full">
        @if (auth()->user()->subscribed($name))
            @if (auth()->user()->subscribedToPrice($price, $name))
                <button 
                    class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                    Cancelar
                </button>   
            @else
                <button 
                    class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                    Cambiar de plan
                </button>
            @endif   
        @else
            <button wire:click="newSubscription('{{ $name }}', '{{ $price }}')"
                wire:loading.remove
                wire:target="newSubscription('{{ $name }}', '{{ $price }}')"
                class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full flex items-center justify-center">
                Subcribirse
            </button>

            <button wire:loading.flex
                wire:target="newSubscription('{{ $name }}', '{{ $price }}')"
                class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                <x-spinner size=6 class="mr-2" />
                Subcribirse
            </button>
        @endif
    </div>
    ```
2. Modificar el componente **resources\views\components\spinner.blade.php**:
    ```php
    @props(['size' => '64'])
    <div {{ $attributes->merge([
        "class" => "loader ease-linear rounded-full border-8 border-t-8 border-gray-200 h-$size w-$size"
    ]) }}></div>
    ```
3. Crear el método **newSubscription** en el controlador **app\Http\Livewire\Subscriptions.php**:
    ```php
    public function newSubscription($name, $price){
        auth()->user()->newSubscription($name, $price)->create();
    }
    ```
4. Commit Video 18:
    + $ git add .
    + $ git commit -m "Commit 18: Iniciar suscripcion"
    + $ git push -u origin main

### Video 19. Cambiar de plan
1. Modificar el componente blade **resources\views\components\button-subscription.blade.php**:
    ```php
    @props(['name', 'price'])

    <div class="w-full">
        @if (auth()->user()->subscribed($name))
            @if (auth()->user()->subscribedToPrice($price, $name))
                <button 
                    class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                    Cancelar
                </button>   
            @else
                <button wire:click="changingPlans('{{ $name }}', '{{ $price }}')"
                    wire:loading.remove
                    wire:target="changingPlans('{{ $name }}', '{{ $price }}')"
                    class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                    Cambiar de plan
                </button>

                <button wire:loading.flex
                    wire:target="changingPlans('{{ $name }}', '{{ $price }}')"
                    class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                    <x-spinner size=6 class="mr-2" />
                    Cambiar de plan
                </button>
            @endif   
        @else
            <button wire:click="newSubscription('{{ $name }}', '{{ $price }}')"
                wire:loading.remove
                wire:target="newSubscription('{{ $name }}', '{{ $price }}')"
                class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full flex items-center justify-center">
                Subcribirse
            </button>

            <button wire:loading.flex
                wire:target="newSubscription('{{ $name }}', '{{ $price }}')"
                class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                <x-spinner size=6 class="mr-2" />
                Subcribirse
            </button>
        @endif
    </div>
    ```
2. Crear el método **changingPlans** en el controlador **app\Http\Livewire\Subscriptions.php**:
    ```php
    public function changingPlans($name, $price){
        auth()->user()->subscription($name)->swap($price);
    }
    ```
3. Commit Video 19:
    + $ git add .
    + $ git commit -m "Commit 19: Cambiar de plan"
    + $ git push -u origin main

### Video 20. Cancelar y reanudar suscripción
1. Modificar la vista **resources\views\components\button-subscription.blade.php**:
    ```php
    @props(['name', 'price'])

    <div class="w-full">
        @if (auth()->user()->subscribed($name))
            @if (auth()->user()->subscribedToPrice($price, $name))
                @if (auth()->user()->subscription($name)->onGracePeriod())
                    <button wire:click="resuminSubscription('{{ $name }}')"
                        wire:loading.remove
                        wire:target="resuminSubscription('{{ $name }}')"
                        class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                        Reanudar plan
                    </button>

                    <button wire:loading.flex
                        wire:target="resuminSubscription('{{ $name }}')"
                        class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                        <x-spinner size=6 class="mr-2" />
                        Reanudar plan
                    </button>               
                @else
                    <button wire:click="cancellingSubscription('{{ $name }}')"
                        wire:loading.remove
                        wire:target="cancellingSubscription('{{ $name }}')"
                        class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                        Cancelar
                    </button>

                    <button wire:loading.flex
                        wire:target="cancellingSubscription('{{ $name }}')"
                        class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                        <x-spinner size=6 class="mr-2" />
                        Cancelar
                    </button>
                @endif
            @else
                <button wire:click="changingPlans('{{ $name }}', '{{ $price }}')"
                    wire:loading.remove
                    wire:target="changingPlans('{{ $name }}', '{{ $price }}')"
                    class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                    Cambiar de plan
                </button>

                <button wire:loading.flex
                    wire:target="changingPlans('{{ $name }}', '{{ $price }}')"
                    class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                    <x-spinner size=6 class="mr-2" />
                    Cambiar de plan
                </button>
            @endif   
        @else
            <button wire:click="newSubscription('{{ $name }}', '{{ $price }}')"
                wire:loading.remove
                wire:target="newSubscription('{{ $name }}', '{{ $price }}')"
                class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full flex items-center justify-center">
                Subcribirse
            </button>

            <button wire:loading.flex
                wire:target="newSubscription('{{ $name }}', '{{ $price }}')"
                class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                <x-spinner size=6 class="mr-2" />
                Subcribirse
            </button>
        @endif
    </div>
    ```
2. Crear el método **cancellingSubscription** en el controlador **app\Http\Livewire\Subscriptions.php**:
    ```php
    public function cancellingSubscription($name){
        auth()->user()->subscription($name)->cancel();
    }
    ```
3. Crear el método **resuminSubscription** en el controlador **app\Http\Livewire\Subscriptions.php**:
    ```php
    public function resuminSubscription($name){
        auth()->user()->subscription($name)->resume();
    }
    ```
4. Commit Video 20:
    + $ git add .
    + $ git commit -m "Commit 20: Cancelar y reanudar suscripción"
    + $ git push -u origin main

### Video 21. Solicitar método de pago
1. Modificar vista **resources\views\components\button-subscription.blade.php**:
    ```php
    @props(['name', 'price'])

    <div class="w-full">
        @if (auth()->user()->hasDefaultPaymentMethod())
            @if (auth()->user()->subscribed($name))
                @if (auth()->user()->subscribedToPrice($price, $name))
                    @if (auth()->user()->subscription($name)->onGracePeriod())
                        <button wire:click="resuminSubscription('{{ $name }}')"
                            wire:loading.remove
                            wire:target="resuminSubscription('{{ $name }}')"
                            class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                            Reanudar plan
                        </button>

                        <button wire:loading.flex
                            wire:target="resuminSubscription('{{ $name }}')"
                            class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                            <x-spinner size=6 class="mr-2" />
                            Reanudar plan
                        </button>               
                    @else
                        <button wire:click="cancellingSubscription('{{ $name }}')"
                            wire:loading.remove
                            wire:target="cancellingSubscription('{{ $name }}')"
                            class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                            Cancelar
                        </button>

                        <button wire:loading.flex
                            wire:target="cancellingSubscription('{{ $name }}')"
                            class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                            <x-spinner size=6 class="mr-2" />
                            Cancelar
                        </button>
                    @endif
                @else
                    <button wire:click="changingPlans('{{ $name }}', '{{ $price }}')"
                        wire:loading.remove
                        wire:target="changingPlans('{{ $name }}', '{{ $price }}')"
                        class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                        Cambiar de plan
                    </button>

                    <button wire:loading.flex
                        wire:target="changingPlans('{{ $name }}', '{{ $price }}')"
                        class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                        <x-spinner size=6 class="mr-2" />
                        Cambiar de plan
                    </button>
                @endif   
            @else
                <button wire:click="newSubscription('{{ $name }}', '{{ $price }}')"
                    wire:loading.remove
                    wire:target="newSubscription('{{ $name }}', '{{ $price }}')"
                    class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full flex items-center justify-center">
                    Subcribirse
                </button>

                <button wire:loading.flex
                    wire:target="newSubscription('{{ $name }}', '{{ $price }}')"
                    class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                    <x-spinner size=6 class="mr-2" />
                    Subcribirse
                </button>
            @endif
        @else
            <button
                class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                Agregar método de pago
            </button>
        @endif
    </div>
    ```
2. Modificar el método **paymentMethodCreate** del controlador **app\Http\Livewire\PaymentMethodCreate.php**:
    ```php
    public function paymentMethodCreate($paymentMethod){
        ≡
        $this->emitTo('subscriptions', 'render');
    }
    ```
3. Modificar el controlador **app\Http\Livewire\Subscriptions.php** para la escucha del método **render**:
    ```php
    ≡
    class Subscriptions extends Component
    {
        protected $listeners = ['render'];
        ≡
    }
    ```
4. Commit Video 21:
    + $ git add .
    + $ git commit -m "Commit 21: Solicitar método de pago"
    + $ git push -u origin main

### Video 22. Proteger rutas
1. Crear middleware **EnsureUserIsSubscribed**:
    + $ php artisan make:middleware EnsureUserIsSubscribed
2. Redifinir el método **handle** del middleware **app\Http\Middleware\EnsureUserIsSubscribed.php**:
    ```php
    public function handle(Request $request, Closure $next)
    {       
        if ($request->user() && ! $request->user()->subscribed('Servicios Sefar Universal')) {
            // This user is not a paying customer...
            return redirect('billing');
        }

        return $next($request);
    }
    ```
    + **Nota**: código copiado de https://laravel.com/docs/8.x/billing
3. Registrar el middleware en el kernel **app\Http\Kernel.php**:
    ```php
    ≡
    class Kernel extends HttpKernel
    {
        ≡
        protected $routeMiddleware = [
            ≡
            'subscription' => \App\Http\Middleware\EnsureUserIsSubscribed::class,
        ];
    }
    ```
4. Agregar middleware a la ruta **articles.show** en el archivo **routes\web.php**:
    ```php
    Route::get('articles/{article}', [ArticleController::class, 'show'])->middleware('subscription', 'auth')->name('articles.show');
    ```
5. Commit Video 22:
    + $ git add .
    + $ git commit -m "Commit 22: Proteger rutas"
    + $ git push -u origin main

## Sección 5: Facturas

### Video 23. Mostrar facturas
1. Crear componente livewire **Invoices**:
    + $ php artisan make:livewire Invoices
2. Modificar la vista **resources\views\billing\index.blade.php** para agregar el componente **Invoices**:
    ```php
    <x-app-layout>
        <div class="pb-12">
            @livewire('subscriptions')
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                @livewire('payment-method-create')

                <div class="my-8">
                    @livewire('payment-method-list')
                </div>

                @livewire('invoices')
            </div>
        </div>
    </x-app-layout>
    ```
3. Diseñar la vista del nuevo componente **resources\views\livewire\invoices.blade.php**:
    ```php
    <div class="card relative">
        <div wire:loading.flex class="absolute w-full h-full bg-gray-100 bg-opacity-25 z-30 items-center justify-center">
            <x-spinner size="20" />
        </div>

        <div class="card-body">
            <table class="w-full">
                <thead>
                    <tr class="text-left">
                        <th class="w-1/2 px-4 py-2">Fecha</th>
                        <th class="w-1/4 px-4 py-2">Dólares</th>
                        <th class="w-1/4 px-4 py-2"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($invoices as $invoice)
                        <tr>
                            <td class="px-4 py-3">{{ $invoice->date()->toFormattedDateString() }}</td>
                            <td class="px-4 py-3">{{ $invoice->total() }}</td>
                            <td class="px-4 py-3 text-right">
                                <a class="btn btn-primary" href="/user/invoice/{{ $invoice->id }}">Descargar</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-3 text-gray-700">
                                No tiene facturas registradas
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>        
        </div>
    </div>
    ```
4. Redefinir el controlador del nuevo componente **app\Http\Livewire\Invoices.php**:
    ```php
    <?php

    namespace App\Http\Livewire;

    use Livewire\Component;

    class Invoices extends Component
    {
        protected $listeners = ['render'];

        public function render()
        {
            $invoices = auth()->user()->invoices();

            return view('livewire.invoices', compact('invoices'));
        }
    }
    ```
5. Modificar el método **newSubscription** del controlador **app\Http\Livewire\Subscriptions.php**:
    ```php
    public function newSubscription($name, $price){
        auth()->user()->newSubscription($name, $price)->create();
        $this->emitTo('invoices', 'render');
    }
    ```
6. Modificar el método **changingPlans** del controlador **app\Http\Livewire\Subscriptions.php**:
    ```php
    public function changingPlans($name, $price){
        auth()->user()->subscription($name)->swap($price);
        $this->emitTo('invoices', 'render');
    }
    ```
7. Commit Video 23:
    + $ git add .
    + $ git commit -m "Commit 23: Mostrar facturas"
    + $ git push -u origin main

### Video 24. Descargar facturas
1. Agregar ruta para descargar facturas en **routes\web.php**:
    ```php
    Route::get('/user/invoice/{invoice}', function (Request $request, $invoiceId) {
        return $request->user()->downloadInvoice($invoiceId, [
            'vendor' => 'Sefar Universal',
            'product' => 'Servicio de Nacionalidad',
        ]);
    });
    ```
    + Importar la definición de la clase **Request**:
    ```php
    use Illuminate\Http\Request;
    ```
2. Commit Video 23:
    + $ git add .
    + $ git commit -m "Commit 23: Mostrar facturas"
    + $ git push -u origin main

## Sección 6: Métodos de pagos únicos

### Video 25. Vista de venta de productos
1. Crear ruta para comprar un producto en **routes\web.php**:
    ```php
    Route::get('products/{product}/pay', [ProductController::class, 'pay'])->middleware('auth')->name('products.pay');
    ```  
2. Crear el método **pay** en el controlador **app\Http\Controllers\ProductController.php**:
    ```php
    public function pay(Product $product){
        return view('products.pay', compact('product'));
    }
    ```
3. Modificar la vista **resources\views\welcome.blade.php**:
    ```php
    <x-app-layout>
        <div class="container py-10">
            <div class="grid grid-cols-3 gap-6">
                @foreach ($products as $product)
                    <div class="card">
                        <div class="px-4 py-2 bg-gray-900 flex justify-between items-center">
                            <p class="text-gray-200 font-bold text-xl">{{ $product->price }} USD</p>
                            <a href="{{ route('products.pay', $product) }}" class="btn btn-secondary">Comprar</a>
                        </div>
                        ≡
                    </div>
                @endforeach
                ≡
            </div>
        </div>
    </x-app-layout>
    ```
4. Crear vista **resources\views\products\pay.blade.php**:
    ```php
    <x-app-layout>
        <div class="container py-12 grid grid-cols-12 gap-6">
            <div class="col-span-7">
                <article class="card">
                    <div class="card-body">
                        <div class="flex">
                            <img class="w-48 h-28 object-cover" src="{{Storage::url($product->image)}}" alt="">
                            <div class="ml-4 flex justify-between items-center self-start flex-1">
                                <h1 class="text-gray-500 font-bold text-lg uppercase">{{$product->title}}</h1>
                                <p class="font-bold text-gray-500">{{$product->price}} USD</p>
                            </div>
                        </div>
                    
                        <hr class="my-4">

                        <p class="text-sm text-gray-500">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi incidunt doloribus vel omnis minus blanditiis accusamus? Sed, tempora, autem quam quisquam
                        <a class="text-blue-500 font-bold" href="">Terminos y condiciones</a></p>
                    </div>
                </article>
            </div>

            <div class="col-span-5">
            </div>
        </div>
    </x-app-layout>
    ```
5. Commit Video 25:
    + $ git add .
    + $ git commit -m "Commit 25: Vista de venta de productos"
    + $ git push -u origin main

### Video 26. Crear método de pago único
1. Crear componente de livewire **ProductPay**:
    + $ php artisan make:livewire ProductPay
2. Incluir componente **product-pay** en la vista **resources\views\products\pay.blade.php**:
    ```php
    <x-app-layout>
        <div class="container py-12 grid grid-cols-12 gap-6">
            <div class="col-span-7">
                ≡
            </div>

            <div class="col-span-5">
                @livewire('product-pay', ['product' => $product])
            </div>
        </div>
    </x-app-layout>
    ```
3. Redefinir el controlador del componente **app\Http\Livewire\ProductPay.php**:
    ```php
    <?php

    namespace App\Http\Livewire;

    use App\Models\Product;
    use Livewire\Component;

    class ProductPay extends Component
    {
        public $product;

        protected $listeners = ['paymentMethodCreate'];

        public function mount(Product $product){
            $this->product = $product;
        }

        public function render()
        {
            return view('livewire.product-pay');
        }

        public function paymentMethodCreate($paymentMethod){
            auth()->user()->charge($this->product->price * 100, $paymentMethod);
            $this->emit('resetStripe');
        }
    }
    ```
4. Diseñar la vista del componente **resources\views\livewire\product-pay.blade.php**:
    ```php
    <div>
        <div class="card relative">
            <div wire:loading.flex class="absolute w-full h-full bg-gray-100 bg-opacity-25 z-30 items-center justify-center">
                <x-spinner size="20" />
            </div>

            <div class="card-body">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-lg font-bold text-gray-700">Método de pago</h1>
                    <img class="h-8" src="https://leadershipmemphis.org/wp-content/uploads/2020/08/780370.png" alt="Métodos de pago">
                </div>
                <form id="card-form">
                    <div class="form-group">
                        <label class="form-label">Nombre de la tarjeta</label>
                        <input class="form-control" id="card-holder-name" type="text" placeholder="Ingrese el nombre del títular de la tarjeta" required>
                    </div>
        
                    <!-- Stripe Elements Placeholder -->
                    <div class="form-group">
                        <label class="form-label">Número de tarjeta</label>
                        <div class="form-control" id="card-element"></div>

                        <span class="invalid-feedback" id="card-error"></span>
                    </div>
                    
                    <button class="btn btn-primary" id="card-button">
                        Procesar pago
                    </button>
                </form>           
            </div>
        </div>

        @slot('js')
            <script>
                document.addEventListener('livewire:load', function(){
                    stripe();
                })

                Livewire.on('resetStripe', function(){
                    document.getElementById('card-form').reset();
                    stripe();

                    alert('La compra se realizó con éxito');
                })
            </script>

            <script>
                function stripe(){
                    const stripe = Stripe("{{ env('STRIPE_KEY') }}");
                
                    const elements = stripe.elements();
                    const cardElement = elements.create('card');
                
                    cardElement.mount('#card-element');

                    // Método de pago
                    const cardHolderName = document.getElementById('card-holder-name');
                    const cardButton = document.getElementById('card-button');
                    const cardForm = document.getElementById('card-form');

                    cardForm.addEventListener('submit', async (e) => {
                        e.preventDefault();
                        const { paymentMethod, error } = await stripe.createPaymentMethod(
                            'card', cardElement, {
                                billing_details: { name: cardHolderName.value }
                            }
                        );

                        if (error) {
                            // Display "error.message" to the user...
                            document.getElementById('card-error').textContent = error.message;
                        } else {
                            // The card has been verified successfully...
                            Livewire.emit('paymentMethodCreate', paymentMethod.id);
                        }
                    });
                }
            </script>
        @endslot
    </div>
    ```
5. Commit Video 26:
    + $ git add .
    + $ git commit -m "Commit 26: Crear método de pago único"
    + $ git push -u origin main

## Sección 7: Manejo de pagos fallidos

### Video 27. Manejo de pagos fallidos de cargos unicos
+ **URL para probar tarjetas**: https://stripe.com/docs/testing#cards-responses
1. Modificar el controlador **app\Http\Livewire\ProductPay.php**:
    ```php
    <?php

    namespace App\Http\Livewire;

    use App\Models\Product;
    use Exception;
    use Livewire\Component;

    class ProductPay extends Component
    {
        public $product;

        protected $listeners = ['paymentMethodCreate'];

        public function mount(Product $product){
            $this->product = $product;
        }

        public function render()
        {
            return view('livewire.product-pay');
        }

        public function paymentMethodCreate($paymentMethod){
            try{
                auth()->user()->charge($this->product->price * 100, $paymentMethod);
                $this->emit('resetStripe');
            }catch (Exception $e){
                $this->emit('errorPayment');
            }
        }
    }
    ```
2. Modificar la vista **resources\views\livewire\product-pay.blade.php**:
    ```php
    <div>
        <div class="card relative">
            <div wire:loading.flex class="absolute w-full h-full bg-gray-100 bg-opacity-25 z-30 items-center justify-center">
                <x-spinner size="20" />
            </div>

            <div class="card-body">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-lg font-bold text-gray-700">Método de pago</h1>
                    <img class="h-8" src="https://leadershipmemphis.org/wp-content/uploads/2020/08/780370.png" alt="Métodos de pago">
                </div>
                <form id="card-form">
                    <div class="form-group">
                        <label class="form-label">Nombre de la tarjeta</label>
                        <input class="form-control" id="card-holder-name" type="text" placeholder="Ingrese el nombre del títular de la tarjeta" required>
                    </div>
        
                    <!-- Stripe Elements Placeholder -->
                    <div class="form-group">
                        <label class="form-label">Número de tarjeta</label>
                        <div class="form-control" id="card-element"></div>

                        <span class="invalid-feedback" id="card-error"></span>
                    </div>
                    
                    <button class="btn btn-primary" id="card-button">
                        Procesar pago
                    </button>
                </form>           
            </div>
        </div>

        @slot('js')
            <script>
                document.addEventListener('livewire:load', function(){
                    stripe();
                })

                Livewire.on('resetStripe', function(){
                    document.getElementById('card-form').reset();
                    stripe();

                    alert('La compra se realizó con éxito');
                })

                Livewire.on('errorPayment', function(){
                    document.getElementById('card-form').reset();
                    stripe();

                    alert('Hubo un error en la compra, intentelo de nuevo');
                });
            </script>

            <script>
                function stripe(){
                    const stripe = Stripe("{{ env('STRIPE_KEY') }}");
                
                    const elements = stripe.elements();
                    const cardElement = elements.create('card');
                
                    cardElement.mount('#card-element');

                    // Método de pago
                    const cardHolderName = document.getElementById('card-holder-name');
                    const cardButton = document.getElementById('card-button');
                    const cardForm = document.getElementById('card-form');

                    cardForm.addEventListener('submit', async (e) => {
                        e.preventDefault();
                        const { paymentMethod, error } = await stripe.createPaymentMethod(
                            'card', cardElement, {
                                billing_details: { name: cardHolderName.value }
                            }
                        );

                        if (error) {
                            // Display "error.message" to the user...
                            document.getElementById('card-error').textContent = error.message;
                        } else {
                            // The card has been verified successfully...
                            Livewire.emit('paymentMethodCreate', paymentMethod.id);
                        }
                    });
                }
            </script>
        @endslot
    </div>
    ```
3. Commit Video 27:
    + $ git add .
    + $ git commit -m "Commit 27: Manejo de pagos fallidos de cargos unicos"
    + $ git push -u origin main

### Video 28. Manejo de pagos fallidos suscripciones
1. Redefinir el controlador **app\Http\Livewire\Subscriptions.php**:
    ```php
    ≡
    use Laravel\Cashier\Exceptions\IncompletePayment;

    class Subscriptions extends Component
    {
        ≡
        public function newSubscription($name, $price){
            try {
                auth()->user()->newSubscription($name, $price)->create();
                $this->emitTo('invoices', 'render');
            } catch (IncompletePayment $exception) {
                return redirect()->route(
                    'cashier.payment',
                    [$exception->payment->id, 'redirect' => route('billing.index')]
                );
            }
        }
        ≡
    }
    ```
2. Commit Video 28:
    + $ git add .
    + $ git commit -m "Commit 28: Manejo de pagos fallidos suscripciones"
    + $ git push -u origin main

## Sección 8: Webhook y prueba de suscripciones

### Video 29. Crear un punto de conexión
1. Ir a la página de [Stripe](https://stripe.com/es-us) e iniciar sesión.
2. Ir al panel de control (**Dashboard**).
3. Ir a **Desarrolladores**.
4. Ir a **Webhooks**.
5. Dar clic en **Añadir un punto de conexión**.
    + URL del punto de conexión: https://paymet.herokuapp.com/stripe/webhook
    + Descripción: Comunicación entre Stripe y la aplicación nuestra.
    + Evento a escuchar: customer.subscription.created
    + **Nota**: Este tipo de conexión no se puede hacer con la aplicación de prueba en local.
6. Dar clic en **Añadir punto de conexión**.
7. Volver a nuestra aplicación en desarrollo.
8. Quitar protección **CSRF** en el middleware **app\Http\Middleware\VerifyCsrfToken.php**:
    ```php
    <?php

    namespace App\Http\Middleware;

    use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

    class VerifyCsrfToken extends Middleware
    {
        /**
        * The URIs that should be excluded from CSRF verification.
        *
        * @var array
        */
        protected $except = [
            'stripe/*',
        ];
    }
    ```
9. Crear controlador **WeebhookController**:
    + $ php artisan make:controller WeebhookController
10. Programar el controlador **app\Http\Controllers\WeebhookController.php**:
    ```php
    <?php

    namespace App\Http\Controllers;

    use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

    class WebhookController extends CashierController
    {
        /**
        * Handle invoice payment succeeded.
        *
        * @param  array  $payload
        * @return \Symfony\Component\HttpFoundation\Response
        */
        public function customerSubscriptionCreated($payload)
        {
            // Enviar correo eléctronico
        }
    }
    ```
11. Agregar ruta en el archivo de rutas **routes\web.php**:
    ```php
    Route::post('/stripe/webhook', [WebhookController::class, 'handleWebhook']);
    ```
    + Importar la definición del controlador **WebhookController**:
    ```php
    use App\Http\Controllers\WebhookController;
    ```
12. Commit Video 29:
    + $ git add .
    + $ git commit -m "Commit 29: Crear un punto de conexión"
    + $ git push -u origin main

### Video 30. Periodo de prueba
1. Modificar el método **newSubscription** del controlador **app\Http\Livewire\Subscriptions.php** para permitir días de prueba a nuestro subscriptores:
    ```php
    public function newSubscription($name, $price){
        try {
            auth()->user()->newSubscription($name, $price)
                ->trialDays(7)
                ->create();
            $this->emitTo('invoices', 'render');
        } catch (IncompletePayment $exception) {
            return redirect()->route(
                'cashier.payment',
                [$exception->payment->id, 'redirect' => route('billing.index')]
            );
        }
    }
    ```
2. Commit Video 30:
    + $ git add .
    + $ git commit -m "Commit 30: Periodo de prueba"
    + $ git push -u origin main

## Sección 9: Cupones de descuento

### Video 31. Reestructurar el codigo
1. Modificar la vista **resources\views\billing\index.blade.php**:
    ```php
    <x-app-layout>
        <div class="pb-12">
            {{-- @livewire('subscriptions') --}}

            <div class="w-full mx-auto px-5 py-10 text-gray-600 mb-10">
                <div class="text-center max-w-xl mx-auto">
                    <h1 class="text-5xl md:text-6xl font-bold mb-5">Pricing</h1>
                    <h3 class="text-xl font-medium mb-10">Lorem ipsum dolor sit amet consectetur adipisicing elit repellat dignissimos laboriosam odit accusamus porro</h3>
                </div>
                <div class="max-w-4xl mx-auto md:flex">
                    {{-- Plan mensual --}}
                    <div class="w-full md:w-1/3 md:max-w-none bg-white px-8 md:px-10 py-8 md:py-10 mb-3 mx-auto md:my-6 rounded-md shadow-lg shadow-gray-600 md:flex md:flex-col">
                        <div class="w-full flex-grow">
                            <h2 class="text-center font-bold uppercase mb-4">PLAN MENSUAL</h2>
                            <h3 class="text-center font-bold text-4xl mb-5">$9.99</h3>
                            <ul class="text-sm px-5 mb-8">
                                <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Lorem ipsum</li>
                                <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Dolor sit amet</li>
                            </ul>
                        </div>
                        @livewire('subscriptions', ['price' => 'price_1Je6v9CF1N694F8geZ0KffEI'], key('price_1Je6v9CF1N694F8geZ0KffEI'))
                        {{-- <x-button-subscription name="Servicios Sefar Universal" price="price_1Je6v9CF1N694F8geZ0KffEI" /> --}}
                    </div>
            
                    {{-- Plan trimestral --}}
                    <div class="w-full md:w-1/3 md:max-w-none bg-white px-8 md:px-10 py-8 md:py-10 mb-3 mx-auto md:-mx-3 md:mb-0 rounded-md shadow-lg shadow-gray-600 md:relative md:z-50 md:flex md:flex-col">
                        <div class="w-full flex-grow">
                            <h2 class="text-center font-bold uppercase mb-4">PLAN TRIMESTRAL</h2>
                            <h3 class="text-center font-bold text-4xl md:text-5xl mb-5">$19.99</h3>
                            <ul class="text-sm px-5 mb-8">
                                <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Lorem ipsum</li>
                                <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Dolor sit amet</li>
                                <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Consectetur</li>
                                <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Adipisicing</li>
                                <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Elit repellat</li>
                            </ul>
                        </div>
                        @livewire('subscriptions', ['price' => 'price_1Je6v9CF1N694F8gA4SNnBw6'], key('price_1Je6v9CF1N694F8gA4SNnBw6'))
                        {{-- <x-button-subscription name="Servicios Sefar Universal" price="price_1Je6v9CF1N694F8gA4SNnBw6" /> --}}
                    </div>
            
                    {{-- Plan anual --}}
                    <div class="w-full md:w-1/3 md:max-w-none bg-white px-8 md:px-10 py-8 md:py-10 mb-3 mx-auto md:my-6 rounded-md shadow-lg shadow-gray-600 md:flex md:flex-col">
                        <div class="w-full flex-grow">
                            <h2 class="text-center font-bold uppercase mb-4">PLAN ANUAL</h2>
                            <h3 class="text-center font-bold text-4xl mb-5">$89.99</h3>
                            <ul class="text-sm px-5 mb-8">
                                <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Lorem ipsum</li>
                                <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Dolor sit amet</li>
                                <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Consectetur</li>
                                <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Adipisicing</li>
                                <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Much more...</li>
                            </ul>
                        </div>
                        @livewire('subscriptions', ['price' => 'price_1Je6v9CF1N694F8gyvdJbORd'], key('price_1Je6v9CF1N694F8gyvdJbORd'))
                        {{-- <x-button-subscription name="Servicios Sefar Universal" price="price_1Je6v9CF1N694F8gyvdJbORd" /> --}}
                    </div>
                </div>
            </div>

            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                @livewire('payment-method-create')

                <div class="my-8">
                    @livewire('payment-method-list')
                </div>

                @livewire('invoices')
            </div>
        </div>
    </x-app-layout>
    ```
2. Modificar el componente **resources\views\livewire\subscriptions.blade.php**:
    ```php
    <div class="w-full">
        @if (auth()->user()->hasDefaultPaymentMethod())
            @if (auth()->user()->subscribed($name))
                @if (auth()->user()->subscribedToPrice($price, $name))
                    @if (auth()->user()->subscription($name)->onGracePeriod())
                        <div>
                            <button wire:click="resuminSubscription"
                                wire:loading.attr="disabled"
                                wire:target="resuminSubscription"
                                class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                                <x-spinner wire:loading wire:target="resuminSubscription" size=6 class="mr-2" />
                                Reanudar plan
                            </button>
                        </div>          
                    @else
                        <article>
                            <button wire:click="cancellingSubscription"
                                wire:loading.attr="disabled"
                                wire:target="cancellingSubscription"
                                class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                                <x-spinner wire:loading wire:target="cancellingSubscription" size=6 class="mr-2" />
                                Cancelar
                            </button>
                        </article>
                    @endif
                @else
                    <button wire:click="changingPlans"
                        wire:loading.attr="disabled"
                        wire:target="changingPlans"
                        class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                        <x-spinner wire:loading wire:target="changingPlans" size=6 class="mr-2" />
                        Cambiar de plan
                    </button>
                @endif   
            @else
                <a wire:click="newSubscription"
                    wire:loading.attr="disabled"
                    wire:target="newSubscription"
                    class="cursor-pointer font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full flex items-center justify-center">
                    <x-spinner wire:loading wire:target="newSubscription" size=6 class="mr-2" />
                    Subcribirse
                </a>
            @endif
        @else
            <button
                class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                Agregar método de pago
            </button>
        @endif
    </div>
    ```
3. Modificar el controlador **app\Http\Livewire\Subscriptions.php**:
    ```php
    <?php

    namespace App\Http\Livewire;

    use Livewire\Component;
    use Laravel\Cashier\Exceptions\IncompletePayment;

    class Subscriptions extends Component
    {
        public $price;

        public $name = 'Servicios Sefar Universal';

        protected $listeners = ['render'];

        public function mount($price){
            $this->price = $price;
        }

        public function render()
        {
            return view('livewire.subscriptions');
        }

        public function newSubscription(){
            try {
                auth()->user()->newSubscription($this->name, $this->price)
                    ->trialDays(7)
                    ->create();
                $this->emitTo('invoices', 'render');
                $this->emitTo('subscriptions', 'render');
            } catch (IncompletePayment $exception) {
                return redirect()->route(
                    'cashier.payment',
                    [$exception->payment->id, 'redirect' => route('billing.index')]
                );
            }
        }

        public function changingPlans(){
            auth()->user()->subscription($this->name)->swap($this->price);
            $this->emitTo('invoices', 'render');
            $this->emitTo('subscriptions', 'render');
        }

        public function cancellingSubscription(){
            auth()->user()->subscription($this->name)->cancel();
        }

        public function resuminSubscription(){
            auth()->user()->subscription($this->name)->resume();
            $this->emitTo('subscriptions', 'render');
        }
    }
    ```
4. Commit Video 31:
    + $ git add .
    + $ git commit -m "Commit 31: Reestructurar el código"
    + $ git push -u origin main

### Video 32. Aplicar descuento
1. Ir a la página de [Stripe](https://stripe.com/es-us) e iniciar sesión.
2. Ir al panel de control (**Dashboard**).
3. Ir a **Productos**.
4. Ir a **Cupones**.
5. Dar clic en **Crear un cupón de prueba**.
    + Nombre: 50% de descuento
    + ID: SEFAR
    + Porcentaje de descuento: 50 %
    + Duración: Varios meses
    + Cantidad de meses: 3
6. Dar clic en **Crear cupón**.
7. Regresar a la aplicación en desarrollo.
8. Modificar el método **newSubscription** del controlador **app\Http\Livewire\Subscriptions.php**:
    ```php
    ***
    ```
9. Modificar la vista **resources\views\livewire\subscriptions.blade.php**:
    ```php
    ***
    ```
    + Definir la propiedad **coupon** en la clase **Subscriptions**:
    ```php
    public $coupon;
    ```
10. Commit Video 32:
    + $ git add .
    + $ git commit -m "Commit 32: Aplicar descuento"
    + $ git push -u origin main

## Sección 10: Despedida del curso

### Video 33. Despedida del curso
1. Activar cuenta **Stripe** (Para Europa y México):
    + Ir a la página de [Stripe](https://stripe.com/es-us) e iniciar sesión.
    + Ir a **Productos**.
    + Dar clic en **Activar cuenta**.
    + Completar todo lo que se le solicite.
2. Para los paises que no aparecen en la lista:
    + Opción 1: Crear una empresa en EEUU y seleccionar como país EEUU.
        + Para esto seguir el siguiente video de YouTube:
            + **[Cómo Usar STRIPE en Latinoamérica (2021) - LEGALMENTE](https://www.youtube.com/watch?v=lKybWqos3VI)**.
            + Esta opción tiene un costo de $200 a $500.
    + Opción 2: Este método puede ocasionar la cancelación de la cuenta de Stripe, por tal motivo se recomienda iniciar con esta opción y luego pasarse a la primera.
        + Para realizar esta opción seguir el siguiente video de YouTube:
            + **[Stripe GRATIS en Cualquier País (NUEVO MÉTODO) 2021](https://www.youtube.com/watch?v=YEgKDnnrHyY)**.
3. Commit Video 33:
    + $ git add .
    + $ git commit -m "Commit 33: Despedida del curso"
    + $ git push -u origin main

***

## Personalización del proyecto:
1. Modificar la vista **resources\views\navigation-menu.blade.php**:
    ```php
    @php
        $nav_links = [
            [
                'name' => 'Principal',
                'route' => route('dashboard'),
                'active' => request()->routeIs('dashboard')
            ],
            [
                'name' => 'Productos',
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
2. Modificar la vista **resources\views\vendor\jetstream\components\welcome.blade.php**:
    ```php
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
        <div>
            <x-jet-application-logo class="block h-12 w-auto" />
        </div>

        <div class="mt-8 text-2xl">
            Bienvenidos a la aplicación de productos de Sefar Universal!
        </div>

        <div class="mt-6 text-gray-500">
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quibusdam quaerat nulla consequatur, 
            ipsam voluptatem reiciendis et, sunt, impedit quod debitis perspiciatis consectetur excepturi 
            velit iste doloribus. Sunt earum sapiente mollitia?
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt voluptatem fugiat numquam, 
            labore aliquam mollitia molestiae exercitationem animi, ipsum voluptate id magnam quidem 
            ratione porro vero dolorum distinctio adipisci incidunt.
        </div>
    </div>

    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
        <div class="p-6">
            <div class="flex items-center">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="#">Documentación</a></div>
            </div>

            <div class="ml-12">
                <div class="mt-2 text-sm text-gray-500">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis commodi officia asperiores 
                    nihil et quo laborum eveniet atque mollitia! Nobis possimus distinctio enim fuga, 
                    laboriosam sint maiores blanditiis expedita voluptates?
                </div>

                <a href="https://laravel.com/docs">
                    <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                            <div>Explore la documentación</div>

                            <div class="ml-1 text-indigo-500">
                                <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
            <div class="flex items-center">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400"><path d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="#">Términos y condiciones</a></div>
            </div>

            <div class="ml-12">
                <div class="mt-2 text-sm text-gray-500">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestias deserunt minima 
                    dolore aperiam dolorem odit adipisci nam sequi, laborum consequatur ut reiciendis ab 
                    vitae animi nisi! Cupiditate, a. Quasi, iure?
                </div>

                <a href="https://laracasts.com">
                    <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                            <div>Revise los términos y condiciones</div>

                            <div class="ml-1 text-indigo-500">
                                <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="p-6 border-t border-gray-200">
            <div class="flex items-center">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="#">Garantías del servicio</a></div>
            </div>

            <div class="ml-12">
                <div class="mt-2 text-sm text-gray-500">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui optio doloribus natus 
                    porro velit culpa aut excepturi, laudantium animi dolores, et dolorem beatae dolore 
                    nostrum dolor minima quaerat. Sequi, quia?
                </div>
            </div>
        </div>

        <div class="p-6 border-t border-gray-200 md:border-l">
            <div class="flex items-center">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Autenticación</div>
            </div>

            <div class="ml-12">
                <div class="mt-2 text-sm text-gray-500">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia aperiam animi repellendus 
                    incidunt, ducimus ad quam placeat aspernatur eum repudiandae nisi esse maxime atque quibusdam, 
                    explicabo assumenda officia, quo consectetur!
                </div>
            </div>
        </div>
    </div>
    ```
3. Modificar la vista **resources\views\welcome.blade.php**:
    ```php
    <x-app-layout>
        <div class="container py-10">
            <div class="grid grid-cols-3 gap-6">
                @foreach ($products as $product)
                    <div class="card">
                        <div class="px-4 py-2 bg-gray-200 flex justify-between items-center">
                            <p class="text-gray-500 font-bold text-xl">{{ $product->price }} USD</p>
                            <a href="{{ route('products.pay', $product) }}" class="btn btn-primary">Comprar</a>
                        </div>
                        <img class="h-56 w-full object-cover" src="{{ asset($product->image) }}" alt="{{ asset($product->image) }}">
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
4. Modificar vists **resources\views\products\pay.blade.php**:
    ```php
    <x-app-layout>
        <div class="container py-12 grid grid-cols-12 gap-6">
            <div class="col-span-7">
                <article class="card">
                    <div class="card-body">
                        <div class="flex">
                            <img class="w-48 h-28 object-cover" src="{{ asset($product->image) }}" alt="{{ asset($product->image) }}">
                            <div class="ml-4 flex justify-between items-center self-start flex-1">
                                <h1 class="text-gray-500 font-bold text-lg uppercase">{{$product->title}}</h1>
                                <p class="font-bold text-gray-500">{{$product->price}} USD</p>
                            </div>
                        </div>
                    
                        <hr class="my-4">

                        <p class="text-sm text-gray-500">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi incidunt doloribus vel omnis minus blanditiis accusamus? Sed, tempora, autem quam quisquam  <a class="text-blue-500 font-bold" href="">Terminos y condiciones</a></p>
                    </div>
                </article>
            </div>

            <div class="col-span-5">
                @livewire('product-pay', ['product' => $product])
            </div>
        </div>
    </x-app-layout>
    ```
5. Modificar vista **resources\views\articles\index.blade.php**:
    ```php
    <x-app-layout>
        <div class="max-w-5xl mx-auto px-4 lg:px-8 py-12">
            @foreach ($articles as $article)
                <article class="card mb-6">

                    <img class="h-72 w-full object-cover object-center" src="{{ asset($article->image) }}" alt="{{ asset($article->image) }}">

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
6. Modificar vista **resources\views\articles\show.blade.php**:
    ```php
    <x-app-layout>
        <div class="max-w-5xl mx-auto px-4 lg:px-8 py-12">
            <h1 class="text-4xl font-bold text-gray-600">{{$article->title}}</h1>

            <div class="text-lg text-gray-500 mb-2">
                {{$article->extract}}
            </div>

            <figure>
                <img class="h-80 w-full object-cover object-center" src="{{ asset($article->image) }}" alt="{{ asset($article->image) }}">
            </figure>

            <div class="text-gray-500 mt-4">
                {{$article->body}}
            </div>
        </div>
    </x-app-layout>
    ```
7. Modificar el archivo de estilos **resources\css\buttons.css**:
    ```css
    .btn {
        @apply font-bold py-2 px-4 rounded;
    }

    .btn-primary {
        /* @apply bg-blue-500 text-white; */
        background-color: rgb(121, 22, 15);
        color: white;
    }

    .btn-primary:hover {
        /* @apply bg-blue-700; */   
        background-color: rgb(70, 12, 8);
        color: white;
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
8. Modificar vista **resources\views\billing\index.blade.php**:
    ```php
    <x-app-layout>
        <div class="pb-12">
            {{-- @livewire('subscriptions') --}}

            <div class="w-full mx-auto px-5 py-10 text-gray-600 mb-10">
                <div class="text-center max-w-xl mx-auto">
                    <h1 class="text-5xl md:text-6xl font-bold mb-5">Precios</h1>
                    <h3 class="text-xl font-medium mb-10">
                        Selecciona un plan y empieza a disfrutar de los servicios que ofrece Sefar Universal
                    </h3>
                </div>
                <div class="max-w-4xl mx-auto md:flex">
                    {{-- Plan mensual --}}
                    <div class="w-full md:w-1/3 md:max-w-none bg-white px-8 md:px-10 py-8 md:py-10 mb-3 mx-auto md:my-6 rounded-md shadow-lg shadow-gray-600 md:flex md:flex-col">
                        <div class="w-full flex-grow">
                            <h2 class="text-center font-bold uppercase mb-4">PLAN MENSUAL</h2>
                            <h3 class="text-center font-bold text-4xl mb-5">$9.99</h3>
                            <ul class="text-sm px-5 mb-8">
                                <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Lorem ipsum</li>
                                <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Dolor sit amet</li>
                            </ul>
                        </div>
                        @livewire('subscriptions', ['price' => 'price_1Je6v9CF1N694F8geZ0KffEI'], key('price_1Je6v9CF1N694F8geZ0KffEI'))
                        {{-- <x-button-subscription name="Servicios Sefar Universal" price="price_1Je6v9CF1N694F8geZ0KffEI" /> --}}
                    </div>
            
                    {{-- Plan trimestral --}}
                    <div class="w-full md:w-1/3 md:max-w-none bg-white px-8 md:px-10 py-8 md:py-10 mb-3 mx-auto md:-mx-3 md:mb-0 rounded-md shadow-lg shadow-gray-600 md:relative md:z-50 md:flex md:flex-col">
                        <div class="w-full flex-grow">
                            <h2 class="text-center font-bold uppercase mb-4">PLAN TRIMESTRAL</h2>
                            <h3 class="text-center font-bold text-4xl md:text-5xl mb-5">$19.99</h3>
                            <ul class="text-sm px-5 mb-8">
                                <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Lorem ipsum</li>
                                <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Dolor sit amet</li>
                                <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Consectetur</li>
                                <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Adipisicing</li>
                                <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Elit repellat</li>
                            </ul>
                        </div>
                        @livewire('subscriptions', ['price' => 'price_1Je6v9CF1N694F8gA4SNnBw6'], key('price_1Je6v9CF1N694F8gA4SNnBw6'))
                        {{-- <x-button-subscription name="Servicios Sefar Universal" price="price_1Je6v9CF1N694F8gA4SNnBw6" /> --}}
                    </div>
            
                    {{-- Plan anual --}}
                    <div class="w-full md:w-1/3 md:max-w-none bg-white px-8 md:px-10 py-8 md:py-10 mb-3 mx-auto md:my-6 rounded-md shadow-lg shadow-gray-600 md:flex md:flex-col">
                        <div class="w-full flex-grow">
                            <h2 class="text-center font-bold uppercase mb-4">PLAN ANUAL</h2>
                            <h3 class="text-center font-bold text-4xl mb-5">$89.99</h3>
                            <ul class="text-sm px-5 mb-8">
                                <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Lorem ipsum</li>
                                <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Dolor sit amet</li>
                                <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Consectetur</li>
                                <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Adipisicing</li>
                                <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Much more...</li>
                            </ul>
                        </div>
                        @livewire('subscriptions', ['price' => 'price_1Je6v9CF1N694F8gyvdJbORd'], key('price_1Je6v9CF1N694F8gyvdJbORd'))
                        {{-- <x-button-subscription name="Servicios Sefar Universal" price="price_1Je6v9CF1N694F8gyvdJbORd" /> --}}
                    </div>
                </div>
            </div>

            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                @livewire('payment-method-create')

                <div class="my-8">
                    @livewire('payment-method-list')
                </div>

                @livewire('invoices')
            </div>
        </div>
    </x-app-layout>
    ```
9. Modificar el seeder **database\seeders\DatabaseSeeder.php**:
    ```php
    <?php

    namespace Database\Seeders;

    use App\Models\Article;
    use App\Models\Product;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\Storage;

    class DatabaseSeeder extends Seeder
    {
        /**
        * Seed the application's database.
        *
        * @return void
        */
        public function run()
        {
            // \App\Models\User::factory(10)->create();
            /* Storage::deleteDirectory('products');
            Storage::deleteDirectory('articles');

            Storage::makeDirectory('products');
            Storage::makeDirectory('articles');

            Product::factory(10)->create();
            Article::factory(10)->create(); */

            // Productos: 
            Product::create([
                'title' => 'Análisis por semana',
                'image' => 'products/producto01.png',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab dicta officiis explicabo quisquam recusandae tenetur voluptatibus architecto earum fugiat deserunt error dolor corporis, esse placeat vitae dolore. Aut, fuga officiis.',
                'price' => 59
            ]);
            
            Product::create([
                'title' => 'Carta de Naturaleza',
                'image' => 'products/producto02.png',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur ipsum laboriosam repellat, corrupti architecto eveniet quisquam placeat mollitia magnam hic adipisci eligendi assumenda accusamus cupiditate tempora ipsam culpa asperiores provident.',
                'price' => 99
            ]);

            Product::create([
                'title' => 'Fase de Genealogía',
                'image' => 'products/producto03.png',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo minima ipsum enim consequuntur aliquid atque tenetur officia, illo sequi assumenda nihil, doloremque quam, ut tempora! Adipisci recusandae quidem iste repudiandae!',
                'price' => 149
            ]);

            Product::create([
                'title' => 'Memorándum Administrativo',
                'image' => 'products/producto04.png',
                'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatum nobis beatae dicta sit quisquam ipsum ea alias totam quod dolorum earum eius minus distinctio, sequi debitis esse iste. Doloribus, vel!',
                'price' => 99
            ]);

            Product::create([
                'title' => 'Nacionalidad Italiana',
                'image' => 'products/producto05.png',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde tenetur, laborum facilis nisi iure ipsam inventore error minus sed vel praesentium, ad sint id. Reprehenderit voluptates repellat iste facilis nobis?',
                'price' => 19
            ]);

            Product::create([
                'title' => 'Nacionalidad Portuguesa',
                'image' => 'products/producto06.png',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus soluta voluptatum est. Ut provident, nihil velit nulla, alias ex modi illum veritatis similique, dolorum tempore expedita quidem iste excepturi corrupti.',
                'price' => 49
            ]);

            Product::create([
                'title' => 'Recurso de Alzada',
                'image' => 'products/producto07.png',
                'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. A repudiandae, ea ipsam expedita minus fugiat omnis voluptates, vitae cupiditate voluptatibus quis eius itaque unde pariatur. Reprehenderit atque facere vero sed?',
                'price' => 99
            ]);

            Product::create([
                'title' => 'Resolución Expresa',
                'image' => 'products/producto08.png',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex quae impedit nesciunt veniam, aliquid dolorem ad sed id illo? Vitae voluptatibus, recusandae molestiae ex rerum nulla esse eos eveniet dolores?',
                'price' => 99
            ]);

            Product::create([
                'title' => 'Servicio de Residencias',
                'image' => 'products/producto09.png',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio at exercitationem blanditiis odit quam hic eaque aut facere rerum eius. Facere ex nemo modi. Animi corrupti molestias cupiditate in doloremque.',
                'price' => 49
            ]);

            Product::create([
                'title' => 'Subsanación de Expediente',
                'image' => 'products/producto10.png',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet quibusdam provident voluptatibus similique dicta dolor illum quidem minima quaerat totam omnis laudantium, officiis nostrum ipsa autem eius dolorem vero modi?',
                'price' => 79
            ]);

            // Artículos: 
            Article::create([
                'title' => 'Análisis por semana',
                'image' => 'products/producto01.png',
                'extract' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab dicta officiis explicabo quisquam recusandae tenetur voluptatibus architecto earum fugiat deserunt error dolor corporis, esse placeat vitae dolore. Aut, fuga officiis.',
                'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet quibusdam provident voluptatibus similique dicta dolor illum quidem minima quaerat totam omnis laudantium, officiis nostrum ipsa autem eius dolorem vero modi?',
            ]);
            
            Article::create([
                'title' => 'Carta de Naturaleza',
                'image' => 'products/producto02.png',
                'extract' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur ipsum laboriosam repellat, corrupti architecto eveniet quisquam placeat mollitia magnam hic adipisci eligendi assumenda accusamus cupiditate tempora ipsam culpa asperiores provident.',
                'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet quibusdam provident voluptatibus similique dicta dolor illum quidem minima quaerat totam omnis laudantium, officiis nostrum ipsa autem eius dolorem vero modi?',
            ]);

            Article::create([
                'title' => 'Fase de Genealogía',
                'image' => 'products/producto03.png',
                'extract' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo minima ipsum enim consequuntur aliquid atque tenetur officia, illo sequi assumenda nihil, doloremque quam, ut tempora! Adipisci recusandae quidem iste repudiandae!',
                'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet quibusdam provident voluptatibus similique dicta dolor illum quidem minima quaerat totam omnis laudantium, officiis nostrum ipsa autem eius dolorem vero modi?',
            ]);

            Article::create([
                'title' => 'Memorándum Administrativo',
                'image' => 'products/producto04.png',
                'extract' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatum nobis beatae dicta sit quisquam ipsum ea alias totam quod dolorum earum eius minus distinctio, sequi debitis esse iste. Doloribus, vel!',
                'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet quibusdam provident voluptatibus similique dicta dolor illum quidem minima quaerat totam omnis laudantium, officiis nostrum ipsa autem eius dolorem vero modi?',
            ]);

            Article::create([
                'title' => 'Nacionalidad Italiana',
                'image' => 'products/producto05.png',
                'extract' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde tenetur, laborum facilis nisi iure ipsam inventore error minus sed vel praesentium, ad sint id. Reprehenderit voluptates repellat iste facilis nobis?',
                'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet quibusdam provident voluptatibus similique dicta dolor illum quidem minima quaerat totam omnis laudantium, officiis nostrum ipsa autem eius dolorem vero modi?',
            ]);

            Article::create([
                'title' => 'Nacionalidad Portuguesa',
                'image' => 'products/producto06.png',
                'extract' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus soluta voluptatum est. Ut provident, nihil velit nulla, alias ex modi illum veritatis similique, dolorum tempore expedita quidem iste excepturi corrupti.',
                'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet quibusdam provident voluptatibus similique dicta dolor illum quidem minima quaerat totam omnis laudantium, officiis nostrum ipsa autem eius dolorem vero modi?',
            ]);

            Article::create([
                'title' => 'Recurso de Alzada',
                'image' => 'products/producto07.png',
                'extract' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. A repudiandae, ea ipsam expedita minus fugiat omnis voluptates, vitae cupiditate voluptatibus quis eius itaque unde pariatur. Reprehenderit atque facere vero sed?',
                'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet quibusdam provident voluptatibus similique dicta dolor illum quidem minima quaerat totam omnis laudantium, officiis nostrum ipsa autem eius dolorem vero modi?',
            ]);

            Article::create([
                'title' => 'Resolución Expresa',
                'image' => 'products/producto08.png',
                'extract' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex quae impedit nesciunt veniam, aliquid dolorem ad sed id illo? Vitae voluptatibus, recusandae molestiae ex rerum nulla esse eos eveniet dolores?',
                'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet quibusdam provident voluptatibus similique dicta dolor illum quidem minima quaerat totam omnis laudantium, officiis nostrum ipsa autem eius dolorem vero modi?',
            ]);

            Article::create([
                'title' => 'Servicio de Residencias',
                'image' => 'products/producto09.png',
                'extract' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio at exercitationem blanditiis odit quam hic eaque aut facere rerum eius. Facere ex nemo modi. Animi corrupti molestias cupiditate in doloremque.',
                'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet quibusdam provident voluptatibus similique dicta dolor illum quidem minima quaerat totam omnis laudantium, officiis nostrum ipsa autem eius dolorem vero modi?',
            ]);

            Article::create([
                'title' => 'Subsanación de Expediente',
                'image' => 'products/producto10.png',
                'extract' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet quibusdam provident voluptatibus similique dicta dolor illum quidem minima quaerat totam omnis laudantium, officiis nostrum ipsa autem eius dolorem vero modi?',
                'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet quibusdam provident voluptatibus similique dicta dolor illum quidem minima quaerat totam omnis laudantium, officiis nostrum ipsa autem eius dolorem vero modi?',
            ]);
            
        }
    }
    ```
10. Subir las imagenes de productos y artículos de manera manual a Heroku.
11. Ejecutar:
    + $ npm run dev
12. Commit:
    + $ git add .
    + $ git commit -m "Personalización del proyecto"
    + $ git push -u origin main
14. Actualizar base de datos en Heroku:
    + $ heroku login
    + $ heroku git:remote -a paymet
    + $ heroku config:add FILESYSTEM_DRIVER=local
    + $ heroku run bash
    + $ composer update
    + $ php artisan migrate:fresh --seed
    + $ php artisan db:seed

***

## Material de interés

### Colores Sefar:
+ Rojo: R:121 G:22 B:15
+ Verde: R:22 G:43 B:27
+ Amarillo: R:247 G:176 B:52
+ Gris: R:63 G:61 B:61

### Repositorios de interes:
+ https://github.com/coders-free/payment
+ https://github.com/petrix12/pasarela_pago.git

### Para solventar problemas con tailwindcss:
+ $ npm install -D tailwindcss@latest postcss@latest autoprefixer@latest
+ $ npm run dev

### Para limpiar configuración y reestablecer el cache:
+ $ php artisan config:clear   
+ $ php artisan config:cache 

### En caso de no permitir compilar algo:
+ $ php artisan clear-compiled
+ $ composer dumpautoload

### Para correr seeders en Heroku
+ $ heroku run bash
+ $ composer update
+ $ php artisan db:seed

### Revertir el último commit:
+ $ git revert HEAD
+ $ git push -u origin main

***

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
    + $ heroku config:add APP_URL=https://paymet.herokuapp.com
    + $ heroku config:add FILESYSTEM_DRIVER=public
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


