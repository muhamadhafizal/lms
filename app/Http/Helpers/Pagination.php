<?php

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

if (! function_exists('customPaginate')) {
    /**
     * Custom paginate for collection.
     *
     * @param  mixed  $items
     * @param  int  $perpage
     * @param  string|null  $path
     * @param  int|null  $currentPage
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    function customPaginate($items, $perPage = 20, $path = null, $request = null)
    {

        $currentPage = $request->page;

        $path = $path ? $path : Paginator::resolveCurrentPage();
        $page = $currentPage ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $currentPage, [
            'path' => $path,
            'pageName' => 'page',
        ]);
    }
}
