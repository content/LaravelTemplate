<?php

namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Http\Request;

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
