<?php

namespace App\Http\Controllers\User;

use App\Http\Presenter\User\Presenter;
use App\Models\User;
use League\Fractal\Resource\Item;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class Common {
    
    public static function convertUserModelToPresenter(User $user) {
        $transformer = Presenter::UserPresenter();
        $resource = new Item($user, $transformer);
        $fractal = new Manager();
        $data = $fractal->createData($resource)->toArray();
        return $data['data'];
    }
}
