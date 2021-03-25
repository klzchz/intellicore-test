<?php

namespace App\Http\Resources\Company;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            '@id'   => route('companies.show', $this->resource, false),
            '@type' => 'Company',
            '@canEdit' => Auth::check() ? Auth::user()->is_admin : false,
            '@canDelete' => Auth::check() ? Auth::user()->is_admin : false,
            'name'  => $this->resource->name,
            'phone' => $this->resource->phone,
            'url'   => $this->resource->url,
            'email' => $this->resource->email,
            '@loggedin' => Auth::check(),
//            TODO: turn on once implemented
//            'rating' => $this->resource->rating,
//            'rating_count' => $this->resource->ratingCount,
//            'user_rating' => $this->resource->userRating
        ];
    }
}
