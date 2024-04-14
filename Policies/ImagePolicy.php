<?php

namespace App\Policies\Seo;

use SEO\Models\PageImage as Image;
use Illuminate\Foundation\Auth\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ImagePolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function before(User $user)
    {
        if (method_exists($user, 'isSuperAdmin') && $user->isSuperAdmin()) {
            return true;
        }
    }

    /**
     * @param User $user
     * @return bool
     */
    public function index(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can create Image.
     *
     * @param  User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can store the Image.
     *
     * @param  User $user
     * @param  Image $image
     * @return mixed
     */
    public function store(User $user, Image $image)
    {
        return false;
    }

    /**
     * Determine whether the user can edit the Image.
     *
     * @param  User $user
     * @param  Image $image
     * @return mixed
     */
    public function edit(User $user, Image $image)
    {
        return false;
    }

    /**
     * Determine whether the user can update the Image.
     *
     * @param User $user
     * @param  Image $image
     * @return mixed
     */
    public function update(User $user, Image $image)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the Image.
     *
     * @param User $user
     * @param  Image $image
     * @return mixed
     */
    public function delete(User $user, Image $image)
    {
        return false;
    }

}
