<?php

require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");

// Login
get('/', '/index.php');


//Header
get('/paymentMethods', '/app/views/admin/paymentmethods.php');
get('/contactForms', '/app/views/admin/contactforms.php');
get('/salesPhases', '/app/views/admin/salesphases.php');
get('/salesChannels', '/app/views/admin/saleschannels.php');
get('/saleClients', '/app/views/commercial/salesClients.php');
get('/sequences', '/app/views/sequences/sequences.php');
get('/categories', '/app/views/admin/categoriesclients.php');
get('/sellers', '/app/views/admin/users.php');

//Nav
get('/dashboard', 'app/views/commercial/dashboard.php');
get('/budget', '/app/views/commercial/budget.php');
get('/contacts', '/app/views/commercial/contacts.php');
get('/companies', '/app/views/commercial/companies.php');
get('/support', '/app/views/support/emailSupport.php');

get('/projects', '/app/views/commercial/business.php');
get('/projects-list', '/app/views/commercial/business.php');
get('/projects-kanban', '/app/views/commercial/businessKanban.php');

get('/schedule', '/app/views/commercial/schedule.php');
//get('/quotes', '/app/views/commercial/quotes.php');
get('/ordes', '/app/views/commercial/orders.php');
get('/billings', '/app/views/commercial/billings.php');

//Users
get('/forgot-pass', '/app/views/login/forgot-password.php');

// Dynamic GET. Example with 1 variable
// The $id will be available in user.php
//get('/user/$id', 'user.php');

// Dynamic GET. Example with 2 variables
// The $name will be available in user.php
// The $last_name will be available in user.php
//get('/user/$name/$last_name', 'user.php');

// Dynamic GET. Example with 2 variables with static
// In the URL -> http://localhost/product/shoes/color/blue
// The $type will be available in product.php
// The $color will be available in product.php
//get('/product/$type/color/:color', 'product.php');

// Dynamic GET. Example with 1 variable and 1 query string
// In the URL -> http://localhost/item/car?price=10
// The $name will be available in items.php which is inside the views folder
//get('/item/$name', 'views/items.php');

// any can be used for GETs or POSTs

// For GET or POST
// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST
//any('/404','views/404.php');
