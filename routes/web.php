<?php

    use App\Models\Category as CategoryModel;
    use App\Models\Post as PostModel;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Str;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

    Route::get('/profile/{user_id?}', function ($user_id = null) {
        return view('components.layout', [
            'name' => 'Profile',
            'view' => 'profile',
            'properties' => ['user_id' => $user_id]
        ]);
    })->name('profile');

    require __DIR__ . '/auth.php';

    Route::get('/dashboard', function () {
        return view('components.layout', [
            'name' => 'Dashboard',
            'view' => 'dashboard',
            'properties' => []
        ]);
    })->name('dashboard')->middleware('auth');

    Route::get('/', function () {
        return view('components.layout', [
            'name' => 'Latest Submissions',
            'view' => 'post-list',
            'properties' => []
        ]);
    })->name('home');

    Route::get('/{category_slug}', function ($category_slug) {
        $category = CategoryModel::where('slug', $category_slug)->first();
        if (empty($category)) {
            abort('404');
        }
        return view('components.layout', [
            'name' => 'Latest ' . $category->name,
            'view' => 'post-list',
            'properties' => [
                'category' => $category
            ]
        ]);
    })->name('category');

    Route::get('/{category_slug}/{post_slug}', function ($category_slug, $post_slug) {
        if (!CategoryModel::where('slug', $category_slug)->exists() || !PostModel::where('slug', $post_slug)->exists()) {
            abort('404');
        }
        return view('components.layout', [
            'name' => Str::singular(Str::title(str_replace('-', ' ', $category_slug))) . ": " . Str::title(str_replace('-', ' ', $post_slug)),//Str::singular($post->Category->name) . ": " . $post->title,
            'view' => 'post-view',
            'properties' => ['post_slug' => $post_slug]
        ]);
    })->name('post');
