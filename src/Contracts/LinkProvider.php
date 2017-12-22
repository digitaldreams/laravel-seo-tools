<?php

namespace SEO\Contracts;

interface LinkProvider
{
    /**
     * Each array contains
     *
     * [
     * id=> Unique ID
     * object=> Class or Entity Name
     * link=>full verified link
     * title=>Page title
     * description=> Description of page
     * images=>[] array of images link
     * created_at=>Created_at time of the page
     * updated_at=>updated_at time of the page
     * ]
     *
     * @return \Illuminate\Support\Collection
     */
    public function all();

}