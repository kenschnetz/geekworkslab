<?php

    use App\Models\Category as CategoryModel;
    use App\Models\Post as PostModel;
    use Illuminate\Support\Facades\Route;

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

//    Route::get('/categories/{category_slug}', function ($category_slug) {
//        $category = CategoryModel::where('slug', $category_slug)->first();
//        return view('components.layout', [
//            'name' => 'Latest ' . $category->name,
//            'view' => 'post-list',
//            'properties' => [
//                'category' => $category
//            ]
//        ]);
//    })->name('categories');

    Route::get('/items', function () {
        return view('components.layout', [
            'name' => 'Latest Items',
            'view' => 'post-list',
            'properties' => [
                'model' => 'App\Models\Category',
                'model_id' => 1,
            ]
        ]);
    })->name('items');

    Route::get('/monsters', function () {
        return view('components.layout', [
            'name' => 'Latest Monsters',
            'view' => 'post-list',
            'properties' => [
                'model' => 'App\Models\Category',
                'model_id' => 2,
            ]
        ]);
    })->name('monsters');

    Route::get('/hooks', function () {
        return view('components.layout', [
            'name' => 'Latest Hooks',
            'view' => 'post-list',
            'properties' => [
                'model' => 'App\Models\Category',
                'model_id' => 3,
            ]
        ]);
    })->name('hooks');

    Route::get('/abilities', function () {
        return view('components.layout', [
            'name' => 'Latest Abilities',
            'view' => 'post-list',
            'properties' => [
                'model' => 'App\Models\Category',
                'model_id' => 4,
            ]
        ]);
    })->name('abilities');

    Route::get('/art', function () {
        return view('components.layout', [
            'name' => 'Latest Art',
            'view' => 'post-list',
            'properties' => [
                'model' => 'App\Models\Category',
                'model_id' => 5,
            ]
        ]);
    })->name('art');

    Route::get('/post/{post_slug}', function ($post_slug) {
        $post = PostModel::where('slug', $post_slug)
            ->with('User', 'Images', 'Contributors', 'Tags', 'Attributes', 'Comments', 'Upvotes')
            ->first();
        if (empty($post)) {
            abort('404');
        }
        return view('components.layout', [
            'name' => Str::singular($post->Category->name) . ": " . $post->title,
            'view' => 'post-view',
            'properties' => ['post' => $post]
        ]);
    })->name('post');

    Route::get('/profile/{user_id?}', function ($user_id = null) {
        return view('components.layout', [
            'name' => 'Profile',
            'view' => 'profile',
            'properties' => ['user_id' => $user_id]
        ]);
    })->name('profile');

    require __DIR__ . '/auth.php';
