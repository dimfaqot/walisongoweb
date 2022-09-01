<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


$routes->get('/', 'Home::index');
// $routes->get('/menu', 'Menu::index');
$menu = \App\Models\Menus::class;
$menu = new $menu;
$wherenotin = $wherenotin = ['Dashboard'];
$q = $menu->whereNotIn('menu', $wherenotin)->find();
foreach ($q as $i) {
    $routes->get('/' . strtolower(str_replace(" ", "", $i['menu'])), static function () {
        helper('routes');

        $request = \Config\Services::request();
        $uri = $request->uri->getSegment(1);
        $menu = menuFromUri($uri);
        if ($menu == 0) {
            session()->setFlashdata('gagal', 'Anda belum login!.');
            return redirect()->to(base_url('login'));
        }
        if ($menu == 1) {
            session()->setFlashdata('gagal', 'Akses dilindungi!.');
            return redirect()->to(base_url('dashboard'));
        }
        $set = \App\Models\Settings::class;
        $set = new $set;
        $data = [
            'data' => [
                'judul' => $menu['menu'],
                'html' => $set->html($menu['menu'])['html']
            ]
        ];
        return view('template', $data);
    });
}



$routes->get('/dashboard', 'Dashboard::index');
$routes->post('/dashboard/datashow', 'Dashboard::datashow');
$routes->post('/dashboard/select', 'Dashboard::select');
$routes->post('/dashboard/rows', 'Dashboard::rows');
$routes->post('/dashboard/save', 'Dashboard::save');
$routes->post('/dashboard/delete', 'Dashboard::delete');
$routes->post('/dashboard/dokumen', 'Dashboard::dokumen');
$routes->post('/dashboard/loadmore', 'Dashboard::loadmore');
$routes->post('/dashboard/copy', 'Dashboard::copy');
$routes->post('/dashboard/gantipassword', 'Dashboard::gantipassword');
$routes->post('/dashboard/fontsize', 'Dashboard::fontsize');
$routes->post('/dashboard/colortema', 'Dashboard::colortema');
$routes->post('/dashboard/preview', 'Dashboard::preview');
$routes->post('/dashboard/changepreview', 'Dashboard::changepreview');
$routes->post('/dashboard/selectpreview', 'Dashboard::selectpreview');
$routes->post('/dashboard/createabsen', 'Dashboard::createabsen');
$routes->post('/dashboard/bestoftahfidz', 'Dashboard::bestoftahfidz');

helper('routes');
// dd(printcontroller());
foreach (printcontroller() as $i) {
    $routes->post('/prints/' . $i, 'Prints::' . $i);
}

$routes->get('/login', 'Login::index');
$routes->post('/login/auth', 'Login::auth');
$routes->post('/login/logout', 'Login::logout');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
