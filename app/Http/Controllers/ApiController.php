<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function create(Request $request) {
        // Validating url
        $validator = Validator::make($request->all(), [
            'url' => 'required|url|max:255',
        ]);

        // Verifying errors
        if ($validator->fails()){
            // If errors we redirect the user to the home route with the error message
            return redirect()->route('home')->withInput()->withErrors($validator);
        } else {
            // We prepare the datas
            $url = $request->get('url');
            $slug = null;

            // Check if the url is already registrated
            $exists = Link::where('url', '=', $url);

            if ($exists->count() === 1) {
                // Get the slug if the url is find in database
                $slug = $exists->first()->slug;
            } else {
                // Insert the url in the database
                $created = Link::create([
                    'url' => $url
                ]);

                // Check if the link has been inserted
                if ($created) {
                    // Generate a new slug from the record id
                    $slug = base_convert($created->id, 10, 36);

                    // Update the record with the slug that has been generated
                    Link::where('id', '=', $created->id)->update([
                        'slug' => $slug
                    ]);
                }
            }

            if ($slug) {
                // Send the new shortened link to the user
                $data = [
                    'slug' => $slug,
                    'success' => 'Good Job! Let\'s paste your URL everywhere!',
                    'url' => env('APP_URL').'/'.$slug
                ];

                // Get the format from request
                $format = $request->get('format');

                // Check if $format is not empty
                if (!empty($format)) {
                    // If format is text then return url
                    if ($format == 'text') {
                        return $data['url'];
                    }
                    // If format is json return a json response
                    elseif($format == 'json') {
                        return Response::json([
                            'status_code' => '200',
                            'data' => ['url' => $data['url']]
                        ]);
                    }
                }

                // Return a json response by default
                return Response::json([
                    'status_code' => '200',
                    'data' => ['url' => $data['url']]
                ]);
            }
        }
        // Inform the user that something went wrong
        return Response::json([
            'status_code' => '500',
            'message' => 'Something went wrong'
        ]);
    }
}
