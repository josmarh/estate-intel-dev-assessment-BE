<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\BookResource;
use App\Models\Books;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookName = request()->query('name');
        $country = request()->query('country');
        $publisher = request()->query('publisher');
        $releaseDate = request()->query('release-date');

        if( $bookName || $country || $publisher || $releaseDate ){
            
            $book = new Books;

            if(isset($bookName)){
                $books = $book->where('name', $bookName);
            }
            if(isset($country)){
                $books = $book->where('country', $country);
            }
            if(isset($publisher)){
                $books = $book->where('publisher', $publisher);
            }
            if(isset($releaseDate)){
                $books = $book->where('release_date', $releaseDate);
            }

            $books = $books->get();
        }else{
            $books = Books::all();
        }

        return response([
            'status' => 'success', 
            'status_code' => 200, 
            'data' => BookResource::collection($books)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name'         => 'required|max:100',
            'isbn'         => 'required|max:50',
            'authors'      => 'required',
            'publisher'    => 'required',
            'country'      => 'required',
            'release_date' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $books = Books::create([
            'name'            => $data['name'],
            'isbn'            => $data['isbn'],
            'authors'         => $data['authors'],
            'number_of_pages' => $data['number_of_pages'],
            'publisher'       => $data['publisher'],
            'country'         => $data['country'],
            'release_date'    => $data['release_date']
        ]);

        return response([
            'status_code' => 201,
            'status' => 'success',  
            'data' => new BookResource($books)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $book = Books::findOrFail($id);

            return response([
                'status_code' => 200,
                'status'      => 'success', 
                'data'        => new BookResource($book)
            ], 200);
        } catch (\Throwable $th) {
            return response([
                'status_code' => 404,
                'status'      => 'not found', 
                'data'        => []
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Books::findOrFail($id);

        $book->update($request->all());

        return response([
            'status'      => 'success', 
            'status_code' => 200,
            'message'     => 'The book '.$book->name.' was updated successfully',
            'data'        => new BookResource($book)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Books::findOrFail($id);

        if($book){
            return response()->json(null, 204);
        }else{
            return response([
                'status_code' => 404,
                'status'      => 'not found', 
                'data'        => []
            ], 200);
        }
        
    }
}

// Git clone
// cp .env-example to .env
// Generate secret-key
// Create Database
// Run php artisan migrate
// Run php artisan serve
// Open postman to test 
// Create book - POST http://127.0.0.1:8000/api/v1/books
// Get all books - GET http://127.0.0.1:8000/api/v1/books
// Get a specific books - GET http://127.0.0.1:8000/api/v1/books/1
// Filter books, by name, country, publisher, release date - 
//      http://127.0.0.1:8000/api/v1/books?name=:bookname, ?country=:countryname, ?publisher=:publishername, ?releasedate=:releasedate
// Update book - PUT http://127.0.0.1:8000/api/v1/books/1
// Delete book - DELETE http://127.0.0.1:8000/api/v1/books/1 

