<?php

/*
|--------------------------------------------------------------------------
| Load The Cached Routes
|--------------------------------------------------------------------------
|
| Here we will decode and unserialize the RouteCollection instance that
| holds all of the route information for an application. This allows
| us to instantaneously load the entire route map into the router.
|
*/

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/sanctum/csrf-cookie' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::IScKxIeSybx5kL9O',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Y0wjreNxm8Cp8HAl',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'logout',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'register',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::X597VgmCRzf7k0bM',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password/reset' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.request',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'password.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password/email' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.email',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password/confirm' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.confirm',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::1fKnDnSlD4XxOI2p',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'profile',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/account' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::YwHERs8IJhT8A1tx',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::YtZ6YdwuSKPAj5HJ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/new_password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::KR9DIbKMdVuomNR5',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user_themme' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::icli5UUdImFAaUdT',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OUlQWJyCUntWziiU',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/users' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::x4W0FqNteAZbfNy0',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Lt02g654PjjOLWt9',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customers' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::5JR3z11nLMXZIuaU',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customers/upload-file' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::f1ABIUUXufGvMx5n',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/memberships/select' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::6OaB4jm1buj7Mre0',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/memberships' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Y4nxkFWB2kBRDWYN',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::0AFobLqzABak1zkc',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/payments' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::w9IPqxZU92iUBUKe',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/payments/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Z0mR4zYQcKVKkLAs',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/assistances' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::JHq7tPBQbNeSGesf',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::0icogPAtwbBJVeOj',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/sales' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::fNIZAoFDavBaxX8s',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/sales/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::IvIYtbY4GM9JsPeB',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/purchases' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::diSwAqMTjGOEIa0E',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/purchases/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jdqQH32TXudeP1NX',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/products' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZqNWBQIMU9xX45eV',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::IlCg1DiEi0C7QU0X',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/branches' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::fRcMOUrsvkcLDn3U',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::TBtodrPLh9GWpqHw',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/a(?|pi/(.*)(*:19)|ssistances/([^/]++)/delete(*:52))|/p(?|a(?|ssword/reset/([^/]++)(*:90)|yments/(?|update/([^/]++)(*:122)|delete/([^/]++)(*:145)))|urchases/(?|update/([^/]++)(*:182)|delete/([^/]++)(*:205))|roducts/(?|([^/]++)(*:233)|select(*:247)|([^/]++)/delete(*:270)))|/users/([^/]++)(?|(*:298)|/delete(*:313))|/customers/(?|([^/]++)(*:344)|select(*:358)|create(*:372)|update/([^/]++)(*:395)|delete/([^/]++)(*:418)|([^/]++)/(?|payments(*:446)|assistances(*:465)))|/memberships/([^/]++)(?|(*:499)|/delete(*:514))|/sales/(?|update/([^/]++)(*:548)|delete/([^/]++)(*:571))|/branches/(?|([^/]++)(*:601)|select(*:615)|([^/]++)/delete(*:638))|/(.*)(*:652))/?$}sDu',
    ),
    3 => 
    array (
      19 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ngNAlsv6k4ADC3r1',
          ),
          1 => 
          array (
            0 => 'any',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
            'POST' => 2,
            'PUT' => 3,
            'PATCH' => 4,
            'DELETE' => 5,
            'OPTIONS' => 6,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      52 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::715wZXghZnioCaiI',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      90 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.reset',
          ),
          1 => 
          array (
            0 => 'token',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      122 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ia09fNCvsOCEetCN',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      145 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Aae2KpVlmLm7kTCg',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      182 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::xdj1Xio5lqOZPc6j',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      205 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZEve5aYDzqCz1ufZ',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      233 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::HrCsVY3LUb4fo7i2',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      247 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::V8lXV1emFda3DcEw',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      270 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::TB9nzUXsiITwmX2x',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      298 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::dMqoRtaZjVjpe3VJ',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      313 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::bZdNA7HuZoBfCVXY',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      344 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::sOVqsnuhAlJfeS3j',
          ),
          1 => 
          array (
            0 => 'customer',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      358 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9qedB3uK27sOMEkV',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      372 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::cWw8xqA91b9aspRA',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      395 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hDSmFKgblHNZV64z',
          ),
          1 => 
          array (
            0 => 'customer',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      418 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::KPwvEJ9MnJQ4qoNz',
          ),
          1 => 
          array (
            0 => 'customer',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      446 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::B6FZ3ODrjIzUeVtb',
          ),
          1 => 
          array (
            0 => 'customer',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      465 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3FknbgYXMCXZEO70',
          ),
          1 => 
          array (
            0 => 'customer',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      499 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::uS5yaSHgGUWOSkVl',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      514 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::kHQeZpy1AC8o3NSu',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      548 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Wa8Zc59chzZoVODq',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      571 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::0gDwAPXepTKZZot4',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      601 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::8mKxcOQdVIQ5W2Sz',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      615 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3p7QfSeogOxFN5Yc',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      638 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::WaeO9UxE63PYwQpu',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      652 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::FvPeziirKn7N9jvi',
          ),
          1 => 
          array (
            0 => 'any',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
            'POST' => 2,
            'PUT' => 3,
            'PATCH' => 4,
            'DELETE' => 5,
            'OPTIONS' => 6,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'generated::IScKxIeSybx5kL9O' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'sanctum/csrf-cookie',
      'action' => 
      array (
        'uses' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'controller' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'namespace' => NULL,
        'prefix' => 'sanctum',
        'where' => 
        array (
        ),
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'generated::IScKxIeSybx5kL9O',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ngNAlsv6k4ADC3r1' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
        2 => 'POST',
        3 => 'PUT',
        4 => 'PATCH',
        5 => 'DELETE',
        6 => 'OPTIONS',
      ),
      'uri' => 'api/{any}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'O:47:"Laravel\\SerializableClosure\\SerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Signed":2:{s:12:"serializable";s:260:"O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:42:"function () {
        \\abort(404);
    }";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"000000000000063c0000000000000000";}";s:4:"hash";s:44:"guQrRLao8cDJZ8STn9XxnTZvm34qFS2R5bDxE4rgwhA=";}}',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::ngNAlsv6k4ADC3r1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'any' => '.*',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@showLoginForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@showLoginForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'login',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Y0wjreNxm8Cp8HAl' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@login',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@login',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::Y0wjreNxm8Cp8HAl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'logout' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@logout',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@logout',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'logout',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'register' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'register',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::X597VgmCRzf7k0bM' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\RegisterController@register',
        'controller' => 'App\\Http\\Controllers\\Auth\\RegisterController@register',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::X597VgmCRzf7k0bM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.request' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'password/reset',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.request',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.email' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'password/email',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail',
        'controller' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.email',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.reset' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'password/reset/{token}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.reset',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'password/reset',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@reset',
        'controller' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@reset',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.confirm' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'password/confirm',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.confirm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::1fKnDnSlD4XxOI2p' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'password/confirm',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::1fKnDnSlD4XxOI2p',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\DashboardController@index',
        'controller' => 'App\\Http\\Controllers\\DashboardController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'dashboard',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'profile' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@profile',
        'controller' => 'App\\Http\\Controllers\\UserController@profile',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'profile',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::YwHERs8IJhT8A1tx' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'account',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@account',
        'controller' => 'App\\Http\\Controllers\\UserController@account',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::YwHERs8IJhT8A1tx',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::YtZ6YdwuSKPAj5HJ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'account',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@update',
        'controller' => 'App\\Http\\Controllers\\UserController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::YtZ6YdwuSKPAj5HJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::KR9DIbKMdVuomNR5' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'new_password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@newPassword',
        'controller' => 'App\\Http\\Controllers\\UserController@newPassword',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::KR9DIbKMdVuomNR5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::icli5UUdImFAaUdT' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user_themme',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@getThemme',
        'controller' => 'App\\Http\\Controllers\\UserController@getThemme',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::icli5UUdImFAaUdT',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OUlQWJyCUntWziiU' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'user_themme',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@setThemme',
        'controller' => 'App\\Http\\Controllers\\UserController@setThemme',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::OUlQWJyCUntWziiU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::x4W0FqNteAZbfNy0' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'users',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@index',
        'controller' => 'App\\Http\\Controllers\\UserController@index',
        'namespace' => NULL,
        'prefix' => '/users',
        'where' => 
        array (
        ),
        'as' => 'generated::x4W0FqNteAZbfNy0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Lt02g654PjjOLWt9' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'users',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@newUser',
        'controller' => 'App\\Http\\Controllers\\UserController@newUser',
        'namespace' => NULL,
        'prefix' => '/users',
        'where' => 
        array (
        ),
        'as' => 'generated::Lt02g654PjjOLWt9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::dMqoRtaZjVjpe3VJ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'users/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@updateUser',
        'controller' => 'App\\Http\\Controllers\\UserController@updateUser',
        'namespace' => NULL,
        'prefix' => '/users',
        'where' => 
        array (
        ),
        'as' => 'generated::dMqoRtaZjVjpe3VJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::bZdNA7HuZoBfCVXY' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'users/{user}/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@destroy',
        'controller' => 'App\\Http\\Controllers\\UserController@destroy',
        'namespace' => NULL,
        'prefix' => '/users',
        'where' => 
        array (
        ),
        'as' => 'generated::bZdNA7HuZoBfCVXY',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::5JR3z11nLMXZIuaU' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerController@index',
        'controller' => 'App\\Http\\Controllers\\CustomerController@index',
        'namespace' => NULL,
        'prefix' => '/customers',
        'where' => 
        array (
        ),
        'as' => 'generated::5JR3z11nLMXZIuaU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::f1ABIUUXufGvMx5n' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'customers/upload-file',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerController@uploadFile',
        'controller' => 'App\\Http\\Controllers\\CustomerController@uploadFile',
        'namespace' => NULL,
        'prefix' => '/customers',
        'where' => 
        array (
        ),
        'as' => 'generated::f1ABIUUXufGvMx5n',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::sOVqsnuhAlJfeS3j' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customers/{customer}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerController@show',
        'controller' => 'App\\Http\\Controllers\\CustomerController@show',
        'namespace' => NULL,
        'prefix' => '/customers',
        'where' => 
        array (
        ),
        'as' => 'generated::sOVqsnuhAlJfeS3j',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9qedB3uK27sOMEkV' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customers/select',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerController@select',
        'controller' => 'App\\Http\\Controllers\\CustomerController@select',
        'namespace' => NULL,
        'prefix' => '/customers',
        'where' => 
        array (
        ),
        'as' => 'generated::9qedB3uK27sOMEkV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cWw8xqA91b9aspRA' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'customers/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerController@store',
        'controller' => 'App\\Http\\Controllers\\CustomerController@store',
        'namespace' => NULL,
        'prefix' => '/customers',
        'where' => 
        array (
        ),
        'as' => 'generated::cWw8xqA91b9aspRA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hDSmFKgblHNZV64z' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'customers/update/{customer}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerController@update',
        'controller' => 'App\\Http\\Controllers\\CustomerController@update',
        'namespace' => NULL,
        'prefix' => '/customers',
        'where' => 
        array (
        ),
        'as' => 'generated::hDSmFKgblHNZV64z',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::KPwvEJ9MnJQ4qoNz' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'customers/delete/{customer}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerController@destroy',
        'controller' => 'App\\Http\\Controllers\\CustomerController@destroy',
        'namespace' => NULL,
        'prefix' => '/customers',
        'where' => 
        array (
        ),
        'as' => 'generated::KPwvEJ9MnJQ4qoNz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::B6FZ3ODrjIzUeVtb' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customers/{customer}/payments',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\PaymentController@customerPayments',
        'controller' => 'App\\Http\\Controllers\\PaymentController@customerPayments',
        'namespace' => NULL,
        'prefix' => '/customers',
        'where' => 
        array (
        ),
        'as' => 'generated::B6FZ3ODrjIzUeVtb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3FknbgYXMCXZEO70' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customers/{customer}/assistances',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\AssistanceController@customerAsistances',
        'controller' => 'App\\Http\\Controllers\\AssistanceController@customerAsistances',
        'namespace' => NULL,
        'prefix' => '/customers',
        'where' => 
        array (
        ),
        'as' => 'generated::3FknbgYXMCXZEO70',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::6OaB4jm1buj7Mre0' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'memberships/select',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\MembershipController@select',
        'controller' => 'App\\Http\\Controllers\\MembershipController@select',
        'namespace' => NULL,
        'prefix' => '/memberships',
        'where' => 
        array (
        ),
        'as' => 'generated::6OaB4jm1buj7Mre0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Y4nxkFWB2kBRDWYN' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'memberships',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\MembershipController@index',
        'controller' => 'App\\Http\\Controllers\\MembershipController@index',
        'namespace' => NULL,
        'prefix' => '/memberships',
        'where' => 
        array (
        ),
        'as' => 'generated::Y4nxkFWB2kBRDWYN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0AFobLqzABak1zkc' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'memberships',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\MembershipController@store',
        'controller' => 'App\\Http\\Controllers\\MembershipController@store',
        'namespace' => NULL,
        'prefix' => '/memberships',
        'where' => 
        array (
        ),
        'as' => 'generated::0AFobLqzABak1zkc',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::uS5yaSHgGUWOSkVl' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'memberships/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\MembershipController@update',
        'controller' => 'App\\Http\\Controllers\\MembershipController@update',
        'namespace' => NULL,
        'prefix' => '/memberships',
        'where' => 
        array (
        ),
        'as' => 'generated::uS5yaSHgGUWOSkVl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::kHQeZpy1AC8o3NSu' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'memberships/{id}/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\MembershipController@destroy',
        'controller' => 'App\\Http\\Controllers\\MembershipController@destroy',
        'namespace' => NULL,
        'prefix' => '/memberships',
        'where' => 
        array (
        ),
        'as' => 'generated::kHQeZpy1AC8o3NSu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::w9IPqxZU92iUBUKe' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'payments',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\PaymentController@index',
        'controller' => 'App\\Http\\Controllers\\PaymentController@index',
        'namespace' => NULL,
        'prefix' => '/payments',
        'where' => 
        array (
        ),
        'as' => 'generated::w9IPqxZU92iUBUKe',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Z0mR4zYQcKVKkLAs' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'payments/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\PaymentController@store',
        'controller' => 'App\\Http\\Controllers\\PaymentController@store',
        'namespace' => NULL,
        'prefix' => '/payments',
        'where' => 
        array (
        ),
        'as' => 'generated::Z0mR4zYQcKVKkLAs',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ia09fNCvsOCEetCN' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'payments/update/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\PaymentController@update',
        'controller' => 'App\\Http\\Controllers\\PaymentController@update',
        'namespace' => NULL,
        'prefix' => '/payments',
        'where' => 
        array (
        ),
        'as' => 'generated::ia09fNCvsOCEetCN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Aae2KpVlmLm7kTCg' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'payments/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\PaymentController@destroy',
        'controller' => 'App\\Http\\Controllers\\PaymentController@destroy',
        'namespace' => NULL,
        'prefix' => '/payments',
        'where' => 
        array (
        ),
        'as' => 'generated::Aae2KpVlmLm7kTCg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::JHq7tPBQbNeSGesf' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'assistances',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\AssistanceController@index',
        'controller' => 'App\\Http\\Controllers\\AssistanceController@index',
        'namespace' => NULL,
        'prefix' => '/assistances',
        'where' => 
        array (
        ),
        'as' => 'generated::JHq7tPBQbNeSGesf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0icogPAtwbBJVeOj' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'assistances',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\AssistanceController@store',
        'controller' => 'App\\Http\\Controllers\\AssistanceController@store',
        'namespace' => NULL,
        'prefix' => '/assistances',
        'where' => 
        array (
        ),
        'as' => 'generated::0icogPAtwbBJVeOj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::715wZXghZnioCaiI' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'assistances/{id}/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\AssistanceController@destroy',
        'controller' => 'App\\Http\\Controllers\\AssistanceController@destroy',
        'namespace' => NULL,
        'prefix' => '/assistances',
        'where' => 
        array (
        ),
        'as' => 'generated::715wZXghZnioCaiI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::fNIZAoFDavBaxX8s' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'sales',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SaleController@index',
        'controller' => 'App\\Http\\Controllers\\SaleController@index',
        'namespace' => NULL,
        'prefix' => '/sales',
        'where' => 
        array (
        ),
        'as' => 'generated::fNIZAoFDavBaxX8s',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::IvIYtbY4GM9JsPeB' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'sales/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SaleController@store',
        'controller' => 'App\\Http\\Controllers\\SaleController@store',
        'namespace' => NULL,
        'prefix' => '/sales',
        'where' => 
        array (
        ),
        'as' => 'generated::IvIYtbY4GM9JsPeB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Wa8Zc59chzZoVODq' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'sales/update/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SaleController@update',
        'controller' => 'App\\Http\\Controllers\\SaleController@update',
        'namespace' => NULL,
        'prefix' => '/sales',
        'where' => 
        array (
        ),
        'as' => 'generated::Wa8Zc59chzZoVODq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0gDwAPXepTKZZot4' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'sales/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SaleController@delete',
        'controller' => 'App\\Http\\Controllers\\SaleController@delete',
        'namespace' => NULL,
        'prefix' => '/sales',
        'where' => 
        array (
        ),
        'as' => 'generated::0gDwAPXepTKZZot4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::diSwAqMTjGOEIa0E' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'purchases',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\PurchaseController@index',
        'controller' => 'App\\Http\\Controllers\\PurchaseController@index',
        'namespace' => NULL,
        'prefix' => '/purchases',
        'where' => 
        array (
        ),
        'as' => 'generated::diSwAqMTjGOEIa0E',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jdqQH32TXudeP1NX' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'purchases/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\PurchaseController@store',
        'controller' => 'App\\Http\\Controllers\\PurchaseController@store',
        'namespace' => NULL,
        'prefix' => '/purchases',
        'where' => 
        array (
        ),
        'as' => 'generated::jdqQH32TXudeP1NX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::xdj1Xio5lqOZPc6j' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'purchases/update/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\PurchaseController@update',
        'controller' => 'App\\Http\\Controllers\\PurchaseController@update',
        'namespace' => NULL,
        'prefix' => '/purchases',
        'where' => 
        array (
        ),
        'as' => 'generated::xdj1Xio5lqOZPc6j',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ZEve5aYDzqCz1ufZ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'purchases/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\PurchaseController@delete',
        'controller' => 'App\\Http\\Controllers\\PurchaseController@delete',
        'namespace' => NULL,
        'prefix' => '/purchases',
        'where' => 
        array (
        ),
        'as' => 'generated::ZEve5aYDzqCz1ufZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ZqNWBQIMU9xX45eV' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'products',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ProductController@index',
        'controller' => 'App\\Http\\Controllers\\ProductController@index',
        'namespace' => NULL,
        'prefix' => '/products',
        'where' => 
        array (
        ),
        'as' => 'generated::ZqNWBQIMU9xX45eV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::IlCg1DiEi0C7QU0X' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'products',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ProductController@store',
        'controller' => 'App\\Http\\Controllers\\ProductController@store',
        'namespace' => NULL,
        'prefix' => '/products',
        'where' => 
        array (
        ),
        'as' => 'generated::IlCg1DiEi0C7QU0X',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::HrCsVY3LUb4fo7i2' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'products/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ProductController@update',
        'controller' => 'App\\Http\\Controllers\\ProductController@update',
        'namespace' => NULL,
        'prefix' => '/products',
        'where' => 
        array (
        ),
        'as' => 'generated::HrCsVY3LUb4fo7i2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::V8lXV1emFda3DcEw' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'products/select',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ProductController@select',
        'controller' => 'App\\Http\\Controllers\\ProductController@select',
        'namespace' => NULL,
        'prefix' => '/products',
        'where' => 
        array (
        ),
        'as' => 'generated::V8lXV1emFda3DcEw',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::TB9nzUXsiITwmX2x' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'products/{id}/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ProductController@destroy',
        'controller' => 'App\\Http\\Controllers\\ProductController@destroy',
        'namespace' => NULL,
        'prefix' => '/products',
        'where' => 
        array (
        ),
        'as' => 'generated::TB9nzUXsiITwmX2x',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::fRcMOUrsvkcLDn3U' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'branches',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\BranchController@index',
        'controller' => 'App\\Http\\Controllers\\BranchController@index',
        'namespace' => NULL,
        'prefix' => '/branches',
        'where' => 
        array (
        ),
        'as' => 'generated::fRcMOUrsvkcLDn3U',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::TBtodrPLh9GWpqHw' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'branches',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\BranchController@store',
        'controller' => 'App\\Http\\Controllers\\BranchController@store',
        'namespace' => NULL,
        'prefix' => '/branches',
        'where' => 
        array (
        ),
        'as' => 'generated::TBtodrPLh9GWpqHw',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::8mKxcOQdVIQ5W2Sz' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'branches/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\BranchController@update',
        'controller' => 'App\\Http\\Controllers\\BranchController@update',
        'namespace' => NULL,
        'prefix' => '/branches',
        'where' => 
        array (
        ),
        'as' => 'generated::8mKxcOQdVIQ5W2Sz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3p7QfSeogOxFN5Yc' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'branches/select',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\BranchController@select',
        'controller' => 'App\\Http\\Controllers\\BranchController@select',
        'namespace' => NULL,
        'prefix' => '/branches',
        'where' => 
        array (
        ),
        'as' => 'generated::3p7QfSeogOxFN5Yc',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::WaeO9UxE63PYwQpu' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'branches/{id}/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\BranchController@destroy',
        'controller' => 'App\\Http\\Controllers\\BranchController@destroy',
        'namespace' => NULL,
        'prefix' => '/branches',
        'where' => 
        array (
        ),
        'as' => 'generated::WaeO9UxE63PYwQpu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::FvPeziirKn7N9jvi' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
        2 => 'POST',
        3 => 'PUT',
        4 => 'PATCH',
        5 => 'DELETE',
        6 => 'OPTIONS',
      ),
      'uri' => '{any}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'O:47:"Laravel\\SerializableClosure\\SerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Signed":2:{s:12:"serializable";s:260:"O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:42:"function () {
        \\abort(404);
    }";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000006510000000000000000";}";s:4:"hash";s:44:"7FCp1WhzuCewXqfMeQcJ26gslDUazsgxxLEjYScq9z4=";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::FvPeziirKn7N9jvi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'any' => '.*',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);
