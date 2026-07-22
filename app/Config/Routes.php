<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Auth
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::attemptLogin');
$routes->get('/logout', 'AuthController::logout');

// Admin (authenticated)
$routes->group('dashboard', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'DashboardController::index');
});

$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'DashboardController::index');

    // CKEditor upload
    $routes->post('upload/image', 'UploadController::image');

    // Posts
    $routes->get('posts', 'PostController::index');
    $routes->get('posts/create', 'PostController::create');
    $routes->post('posts/store', 'PostController::store');
    $routes->get('posts/edit/(:num)', 'PostController::edit/$1');
    $routes->post('posts/update/(:num)', 'PostController::update/$1');
    $routes->get('posts/delete/(:num)', 'PostController::delete/$1');

    // Categories
    $routes->get('categories', 'CategoryController::index');
    $routes->post('categories/store', 'CategoryController::store');
    $routes->post('categories/update/(:num)', 'CategoryController::update/$1');
    $routes->get('categories/delete/(:num)', 'CategoryController::delete/$1');

    // Guru
    $routes->get('guru', 'GuruController::index');
    $routes->post('guru/store', 'GuruController::store');
    $routes->post('guru/update/(:num)', 'GuruController::update/$1');
    $routes->get('guru/delete/(:num)', 'GuruController::delete/$1');

    // Staff
    $routes->get('staff', 'StaffController::index');
    $routes->post('staff/store', 'StaffController::store');
    $routes->post('staff/update/(:num)', 'StaffController::update/$1');
    $routes->get('staff/delete/(:num)', 'StaffController::delete/$1');

    // Jurusan
    $routes->get('jurusan', 'JurusanController::index');
    $routes->post('jurusan/store', 'JurusanController::store');
    $routes->post('jurusan/update/(:num)', 'JurusanController::update/$1');
    $routes->get('jurusan/delete/(:num)', 'JurusanController::delete/$1');

    // Fasilitas
    $routes->get('fasilitas', 'FasilitasController::index');
    $routes->post('fasilitas/store', 'FasilitasController::store');
    $routes->post('fasilitas/update/(:num)', 'FasilitasController::update/$1');
    $routes->get('fasilitas/delete/(:num)', 'FasilitasController::delete/$1');

    // Alumni
    $routes->get('alumni', 'AlumniController::index');
    $routes->post('alumni/store', 'AlumniController::store');
    $routes->post('alumni/update/(:num)', 'AlumniController::update/$1');
    $routes->get('alumni/delete/(:num)', 'AlumniController::delete/$1');

    // Partners
    $routes->get('partners', 'PartnerController::index');
    $routes->post('partners/store', 'PartnerController::store');
    $routes->post('partners/update/(:num)', 'PartnerController::update/$1');
    $routes->get('partners/delete/(:num)', 'PartnerController::delete/$1');

    // Testimoni
    $routes->get('testimoni', 'TestimoniController::index');
    $routes->post('testimoni/store', 'TestimoniController::store');
    $routes->post('testimoni/update/(:num)', 'TestimoniController::update/$1');
    $routes->get('testimoni/delete/(:num)', 'TestimoniController::delete/$1');

    // FAQ
    $routes->get('faq', 'FaqController::index');
    $routes->post('faq/store', 'FaqController::store');
    $routes->post('faq/update/(:num)', 'FaqController::update/$1');
    $routes->get('faq/delete/(:num)', 'FaqController::delete/$1');

    // Sliders
    $routes->get('sliders', 'SliderController::index');
    $routes->post('sliders/store', 'SliderController::store');
    $routes->post('sliders/update/(:num)', 'SliderController::update/$1');
    $routes->get('sliders/delete/(:num)', 'SliderController::delete/$1');

    // Gallery
    $routes->get('gallery', 'GalleryController::index');
    $routes->post('gallery/store', 'GalleryController::store');
    $routes->post('gallery/update/(:num)', 'GalleryController::update/$1');
    $routes->get('gallery/delete/(:num)', 'GalleryController::delete/$1');
    $routes->get('albums', 'GalleryController::albums');
    $routes->post('albums/store', 'GalleryController::storeAlbum');

    // Videos
    $routes->get('videos', 'VideoController::index');
    $routes->post('videos/store', 'VideoController::store');
    $routes->post('videos/update/(:num)', 'VideoController::update/$1');
    $routes->get('videos/delete/(:num)', 'VideoController::delete/$1');

    // Downloads
    $routes->get('downloads', 'DownloadController::index');
    $routes->post('downloads/store', 'DownloadController::store');
    $routes->post('downloads/update/(:num)', 'DownloadController::update/$1');
    $routes->get('downloads/delete/(:num)', 'DownloadController::delete/$1');

    // Menu
    $routes->get('menus', 'MenuController::index');
    $routes->post('menus/store', 'MenuController::store');
    $routes->post('menus/update/(:num)', 'MenuController::update/$1');
    $routes->get('menus/delete/(:num)', 'MenuController::delete/$1');
    $routes->get('menus/items/(:num)', 'MenuController::items/$1');
    $routes->post('menus/items/store/(:num)', 'MenuController::storeItem/$1');
    $routes->post('menus/items/update/(:num)', 'MenuController::updateItem/$1');
    $routes->get('menus/items/delete/(:num)', 'MenuController::deleteItem/$1');

    // Settings
    $routes->get('settings', 'SettingController::index');
    $routes->post('settings/update', 'SettingController::update');

    // Contacts
    $routes->get('contacts', 'ContactController::index');
    $routes->get('contacts/show/(:num)', 'ContactController::show/$1');
    $routes->get('contacts/delete/(:num)', 'ContactController::delete/$1');

    // Users
    $routes->get('users', 'UserController::index');
    $routes->post('users/store', 'UserController::store');
    $routes->post('users/update/(:num)', 'UserController::update/$1');
    $routes->get('users/delete/(:num)', 'UserController::delete/$1');

    // Roles & Permissions
    $routes->get('roles', 'RoleController::index');
    $routes->get('roles/permissions/(:num)', 'RoleController::permissions/$1');
    $routes->post('roles/permissions/(:num)/update', 'RoleController::updatePermissions/$1');

    // Visitors
    $routes->get('visitors', 'VisitorController::index');

    // Logs
    $routes->get('logs', 'LogController::index');
    $routes->get('logs/login', 'LogController::loginLogs');

    // Comments
    $routes->get('comments', 'CommentController::index');
    $routes->get('comments/approve/(:num)', 'CommentController::approve/$1');
    $routes->get('comments/spam/(:num)', 'CommentController::spam/$1');
    $routes->get('comments/delete/(:num)', 'CommentController::delete/$1');

    // Tags
    $routes->get('tags', 'TagController::index');
    $routes->post('tags/store', 'TagController::store');
    $routes->post('tags/update/(:num)', 'TagController::update/$1');
    $routes->get('tags/delete/(:num)', 'TagController::delete/$1');

    // PPDB
    $routes->get('ppdb', 'PpdbController::index');
    $routes->post('ppdb/settings', 'PpdbController::updateSettings');
    $routes->get('ppdb/registrations', 'PpdbController::registrations');
    $routes->post('ppdb/registrations/(:num)/update', 'PpdbController::updateRegistration/$1');
    $routes->get('ppdb/export', 'PpdbController::export');
});

// Public frontend
$routes->get('/', 'HomeController::index');
$routes->get('/profil', 'HomeController::profil');
$routes->get('/visi-misi', 'HomeController::visiMisi');
$routes->get('/sejarah', 'HomeController::sejarah');
$routes->get('/struktur-organisasi', 'HomeController::struktur');
$routes->get('/guru-staff', 'HomeController::guruStaff');
$routes->get('/jurusan', 'HomeController::jurusan');
$routes->get('/jurusan/(:num)', 'HomeController::jurusanDetail/$1');
$routes->get('/fasilitas', 'HomeController::fasilitas');
$routes->get('/berita', 'HomeController::berita');
$routes->get('/berita/(:segment)', 'HomeController::beritaDetail/$1');
$routes->get('/pengumuman', 'HomeController::pengumuman');
$routes->get('/pengumuman/(:segment)', 'HomeController::pengumumanDetail/$1');
$routes->get('/agenda', 'HomeController::agenda');
$routes->get('/prestasi', 'HomeController::prestasi');
$routes->get('/prestasi/(:segment)', 'HomeController::prestasiDetail/$1');
$routes->get('/galeri', 'HomeController::galeri');
$routes->get('/galeri-video', 'HomeController::galeriVideo');
$routes->get('/download', 'HomeController::download');
$routes->get('/download/file/(:num)', 'HomeController::downloadFile/$1');
$routes->get('/download/detail/(:num)', 'HomeController::downloadDetail/$1');
$routes->get('/alumni', 'HomeController::alumni');
$routes->get('/kontak', 'HomeController::kontak');
$routes->post('/kontak/send', 'HomeController::sendContact');
$routes->get('/faq', 'HomeController::faq');
$routes->get('/ppdb', 'HomeController::ppdb');
$routes->post('/ppdb/register', 'HomeController::ppdbRegister');
$routes->get('/sitemap', 'HomeController::sitemap');
$routes->get('/search', 'HomeController::search');
