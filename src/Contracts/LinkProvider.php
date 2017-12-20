<?php

namespace SEO\Contracts;
use Illuminate\Database\Eloquent\Model;

interface LinkProvider
{
    /**
     * Each array contains
     * @return \Illuminate\Support\Collection
     */
    public function all();

    /*
     * Create one link details
      * [
     * link=>full verified link
     * title=>Page title
     * description=> Description of page
     * images=>[] array of images link
     * created_at=>Created_at time of the page
     * updated_at=>updated_at time of the page
     * ]
     * @return array
     */
    public function one(Model $model);

    /**
     * Route name
     * @return mixed
     */
    public function route();

    /**
     * Model Name like User::class
     * @return mixed
     */
    public function model();
}