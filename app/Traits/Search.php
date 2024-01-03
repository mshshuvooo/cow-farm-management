<?php

namespace App\Traits;

trait Search
{
    /**
     * @param string|null $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function search($model, $request) : \Illuminate\Database\Eloquent\Builder
    {
        $results = $model::where([
            [function ($query) use ($model,$request) {
                foreach ($model::$searchable as $field) {
                    $query->orWhere($field, 'LIKE', '%' . $request->query('search') . '%');
                }
            }],
        ]);
        return $results;
    }
}
