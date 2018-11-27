<?php
/**
 * Alias to long class names 
 * Feel free to add in any number of classes
 * 
 * @return array
 */
return [
    'DB'                    => \Yuga\Database\Query\DB::class,
    'Route'                 => \Yuga\Route\Route::class,
    'PermanentDeleteTrait'  => '\Yuga\Database\Elegant\Traits\PermanentDeleteTrait',
    'App'                   => \Yuga\App::class,
    'Request'               => \Yuga\Http\Request::class,
    'Response'               => \Yuga\Http\Response::class,
    'Auth'                  => \Yuga\Models\Auth::class,
    'Hash'                  => \Yuga\Hash\Hash::class,
    'Redirect'              => \Yuga\Http\Redirect::class,
    'NotFoundHttpException' => \Yuga\Route\Exceptions\NotFoundHttpException::class,
];