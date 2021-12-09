<?php

    use App\Models\Category as CategoryModel;
    use App\Models\Post as PostModel;
    use App\Models\User as UserModel;
    use Illuminate\Support\Facades\Auth;
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

    require __DIR__ . '/auth.php';

//    Route::get('/test', function () {
//        return UserModel::where('id', '!=', auth()->user()->id)->increment('unread_global_messages');
//    })->name('test');

    Route::get('/', function () {
        if (auth()->check()) {
            $view = view('components.layout', [
                'name' => 'Latest Submissions',
                'view' => 'post-list',
                'properties' => []
            ]);
        } else {
            $view = view('livewire.welcome');
        }
        return $view;
    })->name('home')->middleware('terms');

    Route::get('/terms', function () {
        return view('components.layout', [
            'name' => 'Terms and Conditions',
            'view' => 'terms',
            'properties' => []
        ]);
    })->name('terms');

    Route::get('/contact', function () {
        return view('components.layout', [
            'name' => 'Contact GWS Forge Team',
            'view' => 'contact',
            'properties' => []
        ]);
    })->name('contact');

    Route::get('/profile/{user_id?}', function ($user_id = null) {
        return view('components.layout', [
            'name' => 'Profile',
            'view' => 'profile',
            'properties' => ['user_id' => $user_id]
        ]);
    })->name('profile')->middleware('auth', 'terms');

    Route::get('/account', function () {
        return view('components.layout', [
            'name' => 'Account',
            'view' => 'account',
            'properties' => []
        ]);
    })->name('account')->middleware('auth', 'terms');

    Route::get('/messenger', function () {
        return view('components.layout', [
            'name' => 'Messenger',
            'view' => 'messenger',
            'properties' => []
        ]);
    })->name('messenger')->middleware('auth', 'terms');

    Route::get('/collections/{user_id?}', function ($user_id = null) {
        return view('components.layout', [
            'name' => 'Your Collections',
            'view' => 'collections',
            'properties' => ['user_id' => $user_id]
        ]);
    })->name('collections')->middleware('auth', 'terms');

    Route::get('/accept-terms', function () {
        return view('components.layout', [
            'name' => 'Accept Terms and Conditions',
            'view' => 'accept-terms',
            'properties' => []
        ]);
    })->name('accept-terms')->middleware('auth');

    Route::get('/dashboard', function () {
        return view('components.layout', [
            'name' => 'Dashboard',
            'view' => 'dashboard',
            'properties' => []
        ]);
    })->name('dashboard')->middleware('auth', 'terms');

    Route::get('/invite-user', function () {
        return view('components.layout', [
            'name' => 'Invite User',
            'view' => 'invite-user',
            'properties' => []
        ]);
    })->name('invite-user')->middleware('auth', 'terms');

    Route::get('/post/{post_id?}', function ($post_id = null) {
        return view('components.layout', [
            'name' => (empty($post_id) ? 'Create' : 'Edit') . ' Post',
            'view' => 'post-edit',
            'properties' => ['post_id' => $post_id]
        ]);
    })->name('post-edit')->middleware('auth', 'terms');

    Route::get('/forum', function () {
        return view('components.layout', [
            'name' => 'Community Forum',
            'view' => 'forum',
            'properties' => []
        ]);
    })->name('forum')->middleware('auth', 'terms');

    Route::get('/author-posts/{user_id}', function ($user_id) {
        $user = UserModel::where('id', $user_id)->first();
        if (empty($user)) {
            abort('404');
        }
        return view('components.layout', [
            'name' => Str::plural($user->name) . ' Posts',
            'view' => 'post-list',
            'properties' => [
                'user_posts_only' => true,
                'user_id' => $user->id
            ]
        ]);
    })->name('author-posts')->middleware('auth', 'terms');

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
    })->name('category')->middleware('auth', 'terms');

    Route::get('/{category_slug}/{post_slug}', function ($category_slug, $post_slug) {
        $post = PostModel::where('slug', $post_slug)->with('Category')->first();
        if (!CategoryModel::where('slug', $category_slug)->exists() || empty($post)) {
            abort('404');
        }
        return view('components.layout', [
            'name' => Str::singular($post->Category->name) . ": " . $post->title,
            'view' => 'post-view',
            'properties' => ['post_slug' => $post_slug, 'post_id' => $post->id]
        ]);
    })->name('post')->middleware('auth', 'terms');
