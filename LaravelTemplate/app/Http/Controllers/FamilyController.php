<?php

namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;

class FamilyController extends Controller
{
    // Example endpoint to display the family index page
    public function index()
    {
        $families = Family::all(); // Retrieve all families from the database

        return view('pages.family', compact('families')); // Pass the families data to the view
    }

    // Example API endpoint to create a new family
    public function create(Request $request)
    {
        $name = $request->input('name');
        $memberCount = $request->input('memberCount');

        // Process the family creation logic here
        $family = Family::create([
            'name' => $name,
            'member_count' => $memberCount
        ]);

        return response()->json([
            "success" => true,
            "family" => [
                "id" => $family->id, // Return the ID of the newly created family
                "name" => $family->name, // You may also pass the name back
                "memberCount" => $family->member_count 
            ]
        ]);
    }

    public function update(Request $request, $id) {
        // This method is current not implemented, but you can add the logic to update a family here.
        $user = $request->user(); // Get the authenticated user

        if(!Gate::allows('update', Family::find($id))) {
            // abort(403); --- You may also use the abort helper function to return a 403 Forbidden response if the user is not authorized to update the family.
            return response()->json([
                "success" => false,
                "message" => "Unauthorized"
            ], 403);
        }

        // If the user is authorized, you can proceed with the update logic here.

        $family = Family::find($id);
        $family->name = $request->input('name');
        $family->member_count = $request->input('memberCount');
        $family->save();

        return response()->json([
            "success" => true,
            "family" => [
                "id" => $family->id,
                "name" => $family->name,
                "memberCount" => $family->member_count
            ]
        ]);
    }

    public function delete($id) {
        $family = Family::find($id);

        if (!$family) {
            return response()->json([
                "success" => false,
                "message" => "Family not found"
            ], 404);
        }

        $family->delete();

        return response()->json([
            "success" => true,
            "message" => "Family deleted successfully"
        ]);
    }

    public function get($id) {
        $family = Family::find($id);

        if (!$family) {
            return response()->json([
                "success" => false,
                "message" => "Family not found"
            ], 404);
        }

        return response()->json([
            "success" => true,
            "family" => [
                "id" => $family->id,
                "name" => $family->name,
                "memberCount" => $family->member_count
            ]
        ]);
    }
}
