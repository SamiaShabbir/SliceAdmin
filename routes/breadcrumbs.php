<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

// Home > Blog
Breadcrumbs::for('toppings', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('All Toppings', route('getTopping'));
});

// Home > Blog > [Category]
// Breadcrumbs::for('search', function (BreadcrumbTrail $trail) {
//     $trail->parent('toppings');
//     $trail->push('', route('search'));
// });
