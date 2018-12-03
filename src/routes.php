<?php

return [
    '~^$~' => [\MyProject\Controllers\MainController::class, 'main'],
    '~^poligon$~' => [\MyProject\Poligon::class, 'poligon'],
    '~^articles/(\d+)$~' => [\MyProject\Controllers\ArticlesController::class, 'view'],
    '~^articles/(\d+)/edit$~' => [\MyProject\Controllers\ArticlesController::class, 'edit'],
    '~^articles/create$~' => [\MyProject\Controllers\ArticlesController::class, 'create'],
    '~^articles/add$~' => [\MyProject\Controllers\ArticlesController::class, 'add'],
    '~^articles/(\d+)/delete$~' => [\MyProject\Controllers\ArticlesController::class, 'delete'],
    '~^users/register$~' => [\MyProject\Controllers\UsersController::class, 'signUp'],
    '~^users/(\d+)/activate/(.+)$~' => [\MyProject\Controllers\UsersController::class, 'activate'],
    '~^users/login~' => [\MyProject\Controllers\UsersController::class, 'login'],
    '~^users/logOut~' => [\MyProject\Controllers\UsersController::class, 'logOut'],
    '~^articles/(\d+)/addComments$~' => [\MyProject\Controllers\CommentsController::class, 'addComments'],
    '~^comments/(\d+)/edit$~' => [\MyProject\Controllers\CommentsController::class, 'edit'],
    '~^adminPanel$~' => [\MyProject\Controllers\AdminPanelController::class, 'adminPanel'],
    '~^adminPanel/changeTitle$~' => [\MyProject\Controllers\AdminPanelController::class, 'changeTitle'],
    '~^personalArea$~' => [\MyProject\Controllers\PersonalAreaController::class, 'personalArea'],
    '~^uploadAvatar$~' => [\MyProject\Controllers\PersonalAreaController::class, 'uploadAvatar'],
];
