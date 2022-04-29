<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\APIServices\RequestService;

class IcenFireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RequestService $requestService)
    {
        $bookName = request()->query('name');

        $url = 'https://www.anapioficeandfire.com/api/books?name='.$bookName;

        $request = $requestService->apiRequest($url);

        $data = $request->json();

        $newData = [];

        foreach($data as $data){
            $newData[] = array(
                'name'            => $data['name'],
                'isbn'            => $data['isbn'],
                'authors'         => $data['authors'],
                'number_of_pages' => $data['numberOfPages'],
                'publisher'       => $data['publisher'],
                'country'         => $data['country'],
                'release_date'    => $data['released']
            );
        }

        $response = [
            'status_code'   => count($newData) > 0 ? $request->status() : 404,
            'status'        => count($newData) > 0 ? 'success' : 'not found',
            'data'          => $newData
        ];
    
        return $response;
    }
}
