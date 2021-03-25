<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use Illuminate\Http\Response;

class RatingController extends Controller
{
    private $rating;
    public function __construct(Rating $rating){
        $this->rating = $rating;
    }

    public function store(Request $request,$id)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        $data['company_id'] = $id;

        $this->rating->create($data);

        return response()
            ->json([
                'message' => 'Rating successfully created',
                'data' => $data
            ], Response::HTTP_CREATED);
    }
}
