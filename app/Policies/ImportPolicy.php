<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Services\Import;

class ImportPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function import($user, $import)
    {
        return !!$user->superUser;
    }
}
