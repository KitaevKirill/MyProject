<?php
/**
 * Created by PhpStorm.
 * User: User1
 * Date: 28.11.2018
 * Time: 0:18
 */

return [
    '~^articles/(\d+)$~' => [\MyProject\Controllers\Api\ArticlesApiController::class, 'view'],
    '~^articles/add$~' => [\MyProject\Controllers\Api\ArticlesApiController::class, 'add'],
];