<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Авторизация
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [App\Http\Controllers\Auth\AuthController::class, 'login']);
    Route::get('guest_id', [App\Http\Controllers\Auth\AuthController::class, 'guestId']); // Идентификатор для неавторизованного пользователя
    Route::group(['middleware' => ['auth']], function () {
        Route::post('logout', [App\Http\Controllers\Auth\AuthController::class, 'logout']);
        Route::post('refresh', [App\Http\Controllers\Auth\AuthController::class, 'refresh']);
        Route::post('me', [App\Http\Controllers\Auth\AuthController::class, 'me']);
    });
});

// Админка
Route::group(['middleware' => ['auth', 'can:use_admin_panel'], 'prefix' => 'admin'], function () {
    // История
    Route::get('audits', [App\Http\Controllers\Admin\AuditsController::class, 'index']);
    Route::get('audits/{audit}', [App\Http\Controllers\Admin\AuditsController::class, 'show']);
    // Статьи
    Route::apiResource('articles', App\Http\Controllers\Admin\ArticleController::class);
    // Баннеры
    Route::patch('banners/sort', [App\Http\Controllers\Admin\BannerController::class, 'sort']);
    Route::apiResource('banners', App\Http\Controllers\Admin\BannerController::class);

    // Бренды
    Route::apiResource('brands', App\Http\Controllers\Admin\BrandController::class);

    // Категории
    Route::group(['prefix' => 'categories'], function () {
        // Список категорий товаров с вложенностью
        Route::get('schema', [App\Http\Controllers\Admin\CategoryController::class, 'listWithSubCategoriesSchema']);
        // Список всех категорий товаров
        Route::get('list', [App\Http\Controllers\Admin\CategoryController::class, 'listAllSchema']);
        // Создание категории
        Route::post('', [App\Http\Controllers\Admin\CategoryController::class, 'store']);
        // Одна категория
        Route::get('{category}', [App\Http\Controllers\Admin\CategoryController::class, 'show'])
            ->where('category', '[0-9]+');
        // Обновление категории
        Route::patch('{category}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])
            ->where('category', '[0-9]+');
        Route::delete('{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'destroy']);
        // Список всех категорий
        Route::get('', [App\Http\Controllers\Admin\CategoryController::class, 'index']);
        // Список всех типов категорий
        Route::get('types', [App\Http\Controllers\Admin\CategoryController::class, 'typesList']);
    });
    // Категории новостей
    Route::apiResource('category_for_news', App\Http\Controllers\Admin\CategoryForNewsController::class);
    // Цвета товаров
    Route::apiResource('colors', App\Http\Controllers\Admin\ColorController::class);
    // Файлы
    Route::post('files/ckeditor', [App\Http\Controllers\Admin\FileController::class, 'storeFromCKEditor']);
    Route::apiResource('files', App\Http\Controllers\Admin\FileController::class);
    // Новости
    Route::apiResource('news', App\Http\Controllers\Admin\NewsController::class);
    Route::delete('news/{news}/image', [App\Http\Controllers\Admin\NewsController::class, 'deleteImage'])->name('admin.news.deleteImage');

    // Страницы
    Route::apiResource('pages', App\Http\Controllers\Admin\PageController::class);

    // Товары
    Route::group(['prefix' => 'products'], function () {
        // Список товаров
        Route::get('schema', [App\Http\Controllers\Admin\ProductController::class, 'listSchema']);
        // Создание товара
        Route::post('', [App\Http\Controllers\Admin\ProductController::class, 'store']);
        // Один товар
        Route::get('{product}', [App\Http\Controllers\Admin\ProductController::class, 'show'])
            ->where('product', '[0-9]+');
        // Обновление товара
        Route::patch('{product}', [App\Http\Controllers\Admin\ProductController::class, 'update'])
            ->where('product', '[0-9]+');
        // Удаление товара
        Route::delete('{product}', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])
            ->where('product', '[0-9]+');
        // Обновляет складскую структуру товара
        Route::get('{product}/updateStorage', [App\Http\Controllers\Admin\ProductController::class, 'updateProductStorage'])
            ->where('product', '[0-9]+');
        // Обновляет цены всех товаров
        Route::get('updateAllPrices', [App\Http\Controllers\Admin\ProductController::class, 'updateAllPrices']);

        // Список товаров с пагинацией (Не используется)
        Route::get('', [App\Http\Controllers\Admin\ProductController::class, 'index']);

        Route::post('{product}/add-video/desktop', [App\Http\Controllers\Admin\ProductController::class, 'addDesktopVideo']);
        Route::post('{product}/add-video/mobile', [App\Http\Controllers\Admin\ProductController::class, 'addMobileVideo']);
        Route::delete('{product}/remove-video/desktop', [App\Http\Controllers\Admin\ProductController::class, 'removeDesktopVideo']);
        Route::delete('{product}/remove-video/mobile', [App\Http\Controllers\Admin\ProductController::class, 'removeMobileVideo']);
        Route::post('{product}/update-video/desktop', [App\Http\Controllers\Admin\ProductController::class, 'updateDesktopVideo']);
        Route::post('{product}/update-video/mobile', [App\Http\Controllers\Admin\ProductController::class, 'updateMobileVideo']);
    });

    //Параметры
    Route::apiResource('product_params', App\Http\Controllers\Admin\ProductParamController::class);
    // Статусы товаров
    Route::apiResource('product_statuses', App\Http\Controllers\Admin\ProductStatusController::class);
    // Типы аренды
    Route::apiResource('rent_types', App\Http\Controllers\Admin\RentTypeController::class);
    // SEO
    Route::apiResource('seo', App\Http\Controllers\Admin\SeoController::class);
    // Размеры
    Route::apiResource('sizes', App\Http\Controllers\Admin\SizeController::class);
   // Обновление
    Route::post('update', [App\Http\Controllers\Admin\AdminUpdateController::class, 'index']);
    // Пользователи
    Route::apiResource('users', App\Http\Controllers\Admin\UserController::class);
    // Заказы
    Route::group(['prefix' => 'orders'], function () {
        Route::get('', [App\Http\Controllers\Admin\OrderController::class, 'index']); // Список заказов
        Route::get('{order}', [App\Http\Controllers\Admin\OrderController::class, 'show']); // Один заказ
    });
});

// Магазин
Route::group(['prefix' => 'shop'], function () {
    // Данные для всех страниц
    Route::get('page_data', App\Http\Controllers\Shop\PageData\PageDataController::class);

    // Поиск
    Route::get('search/products', [App\Http\Controllers\Shop\SearchController::class, 'searchProducts']);
    Route::get('search/categories', [App\Http\Controllers\Shop\SearchController::class, 'searchCategories']);
    Route::get('search/tips', [App\Http\Controllers\Shop\SearchController::class, 'searchTips']);

    // Избранное
    Route::get('favourites', [App\Http\Controllers\Shop\FavouritesController::class, 'index']);
    Route::post('add_to_favourites', [App\Http\Controllers\Shop\FavouritesController::class, 'store']);
    Route::delete('/favourites/{favourite}', [App\Http\Controllers\Shop\FavouritesController::class, 'destroy']);

    // Корзина
    Route::get('cart', [App\Http\Controllers\Shop\CartController::class, 'index']);
    Route::post('add_to_cart', [App\Http\Controllers\Shop\CartController::class, 'store']);
    Route::delete('/cart/{cart}', [App\Http\Controllers\Shop\CartController::class, 'destroy']);

    // Заказ
    Route::group(['prefix' => 'order'], function () {
        Route::get('', [App\Http\Controllers\Shop\OrderController::class, 'index']); // Список всех заказов текущего пользователя
        Route::post('', [App\Http\Controllers\Shop\OrderController::class, 'cartOrder']); // Отправка заказа из корзины
        Route::post('fast', [App\Http\Controllers\Shop\OrderController::class, 'fastOrder']); // Быстрая покупка или Обратный звонок
    });

    // Товар
    Route::group(['prefix' => 'product'], function () {
        Route::get('actual/{products}', [App\Http\Controllers\Shop\ProductController::class, 'actual']);
    });

});

Route::post('test', App\Http\Controllers\TestApiController::class);

