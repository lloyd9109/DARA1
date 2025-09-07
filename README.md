<h1> Migrate After Pulling </h1>
php artisan migrate

<h1> Always Check Your .env File </h1>

DB_CONNECTION=mysql // Replace sqlite to mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=test // Check db
DB_USERNAME=root
DB_PASSWORD=

<h1> Always Remember RMC </h1>
R - Routes
 Route::('/', [Controller::class, 'index'])-name('index');
M - Models
 use APP\MODELS\MODELNAME;
C - Controller
 Combine all routes and models
  public function index() {
      $user = ModelName::where('name' = 'Gayle')-get();
      return view('landing_page', [
          'name' => $user,
      ]);

  Landing Page View:
      {{ $name ?? '' }}

      
