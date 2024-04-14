<?php

namespace App\Policies\Seo;

use \SEO\Models\Page;
use Illuminate\Foundation\Auth\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
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
        return true;
    }

    /**
     * Determine whether the user can view the Page.
     *
     * @param  User $user
     * @param  Page $page
     * @return mixed
     */
    public function view(User $user, Page $page)
    {
        return false;
    }

    /**
     * Determine whether the user can create Page.
     *
     * @param  User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can store the Page.
     *
     * @param  User $user
     * @param  Page $page
     * @return mixed
     */
    public function store(User $user, Page $page)
    {
        return false;
    }

    /**
     * Determine whether the user can edit the Page.
     *
     * @param  User $user
     * @param  Page $page
     * @return mixed
     */
    public function edit(User $user, Page $page)
    {
        return false;
    }


    /**
     * Determine whether the user can update the Page.
     *
     * @param User $user
     * @param  Page $page
     * @return mixed
     */
    public function update(User $user, Page $page)
    {
        return false;
    }

    /**
     * Determine whether the user can bulkUpdate the Page.
     *
     * @param  User $user
     * @param  Page $page
     * @return mixed
     */
    public function bulkUpdate(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the Page.
     *
     * @param User $user
     * @param  Page $page
     * @return mixed
     */
    public function delete(User $user, Page $page)
    {
        return true;
    }

    /**
     * Determine whether the user can generate the Page.
     *
     * @param  User $user
     * @param  Page $page
     * @return mixed
     */
    public function generate(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can meta the Page.
     *
     * @param  User $user
     * @param  Page $page
     * @return mixed
     */
    public function meta(User $user, Page $page)
    {
        return true;
    }

    /**
     * Determine whether the user can upload the Page.
     *
     * @param  User $user
     * @param  Page $page
     * @return mixed
     */
    public function upload(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can download the Page.
     *
     * @param  User $user
     * @param  Page $page
     * @return mixed
     */
    public function download(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can images the Page.
     *
     * @param  User $user
     * @param  Page $page
     * @return mixed
     */
    public function images(User $user, Page $page)
    {
        return false;
    }

    /**
     * Determine whether the user can cache the Page.
     *
     * @param  User $user
     * @param  Page $page
     * @return mixed
     */
    public function cache(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can zip the Page.
     *
     * @param  User $user
     * @param  Page $page
     * @return mixed
     */
    public function zip(User $user)
    {
        return false;
    }

}
