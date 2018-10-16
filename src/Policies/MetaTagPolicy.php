<?php

namespace App\Policies\Seo;

use \SEO\Models\MetaTag;
use Illuminate\Foundation\Auth\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MetaTagPolicy
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
     * Determine whether the user can create MetaTag.
     *
     * @param  User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can store the MetaTag.
     *
     * @param  User $user
     * @param  MetaTag $metaTag
     * @return mixed
     */
    public function store(User $user, MetaTag $metaTag)
    {
        return false;
    }

    /**
     * Determine whether the user can edit the MetaTag.
     *
     * @param  User $user
     * @param  MetaTag $metaTag
     * @return mixed
     */
    public function edit(User $user, MetaTag $metaTag)
    {
        return false;
    }

    /**
     * Determine whether the user can update the MetaTag.
     *
     * @param User $user
     * @param  MetaTag $metaTag
     * @return mixed
     */
    public function update(User $user, MetaTag $metaTag)
    {
        return false;
    }

    /**
     * Determine whether the user can global the MetaTag.
     *
     * @param  User $user
     * @param  MetaTag $metaTag
     * @return mixed
     */
    public function global(User $user, MetaTag $metaTag)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the MetaTag.
     *
     * @param User $user
     * @param  MetaTag $metaTag
     * @return mixed
     */
    public function delete(User $user, MetaTag $metaTag)
    {
        return false;
    }

}
