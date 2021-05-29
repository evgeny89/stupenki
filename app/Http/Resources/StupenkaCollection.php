<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StupenkaCollection extends ResourceCollection
{

    /**
     * Если нужно указать в качестве ключа, например, id, то раскоментировать атрибут
     */
    //public $preserveKeys = true;

    /**
     * Можно указать с какой моделью сопоставлять ресурс
     */
    //public $collects = Member::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
