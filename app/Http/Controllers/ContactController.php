<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use DB;
use Validator;

class ContactController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @OA\Get(
     *     path="/api/contacts",
     *     summary="Get a list of contacts",
     *     tags={"Contacts"},
     *     @OA\Response(response="200", description="Successful operation", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Contact"))),
     *     @OA\Response(response="404", description="No contacts found"),
     *     @OA\Response(response="500", description="Error retrieving contacts")
     * )
     */
    public function index()
    {
        // Define empty array variable
        $emptyData = (object)[];
        try {
            $contacts = Contact::all();

            if ($contacts->isEmpty()) {
                return response()->json(['message' => 'No contacts found', 'data' => $emptyData], 404);
            }

            return response()->json(['message' => 'Contacts retrieved successfully', 'data' => $contacts], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'data' => $emptyData], 500);
        }
    }

    /**
     *
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function show($id)
    {
        $emptyData = (object)[];
        try {
            $contact = Contact::find($id);
            if (!$contact) {
                return response()->json(['message' => 'Contact not found', 'data' => $emptyData], 404);
            }

            return response()->json(['message' => 'Contact retrieved successfully', 'data' => $contact], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'data' => $emptyData], 500);
        }
    }

    /**
 * @OA\Post(
 *     path="/api/contacts",
 *     summary="Create a new contact",
 *     tags={"Contacts"},
 *     @OA\RequestBody(
 *         required=true,
 *         description="Contact data",
 *      @OA\JsonContent(ref="#/components/schemas/ContactRequest")
 *     ),
 *     @OA\Response(response="201", description="Contact created successfully", @OA\JsonContent(ref="#/components/schemas/Contact")),
 *     @OA\Response(response="422", description="Validation error", @OA\JsonContent(type="object", @OA\Property(property="message", type="string"), @OA\Property(property="errors", type="object"))),
 *     @OA\Response(response="500", description="Error creating contact", @OA\JsonContent(type="object", @OA\Property(property="message", type="string"), @OA\Property(property="error", type="string")))
 * )
 */
public function store(Request $request)
{
    // Define empty array variable
    $emptyData = (object)[];
    try {
        DB::beginTransaction();


        $contact = Contact::create($request->all());


        DB::commit();


        return response()->json(['message' => 'Contact created successfully', 'data' => $contact], 201);

    } catch (\Exception $e) {
        DB::rollBack();

        return response()->json(['message' => $e->getMessage(), 'data' => $emptyData], 500);
    }
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @OA\Put(
     *     path="/api/contacts/{id}",
     *     summary="Update an existing contact",
     *     tags={"Contacts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the contact",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Updated contact data",
     *         @OA\JsonContent(ref="#/components/schemas/ContactRequest")
     *     ),
     *     @OA\Response(response="200", description="Contact updated successfully", @OA\JsonContent(ref="#/components/schemas/Contact")),
     *     @OA\Response(response="404", description="Contact not found"),
     *     @OA\Response(response="422", description="Validation error", @OA\JsonContent(type="object", @OA\Property(property="message", type="string"), @OA\Property(property="errors", type="object"))),
     *     @OA\Response(response="500", description="Error updating contact", @OA\JsonContent(type="object", @OA\Property(property="message", type="string"), @OA\Property(property="error", type="string")))
     * )
     */

    public function update(Request $request, $id)
    {
        $emptyData = (object)[];
        try {
            $contact = Contact::find($id);

            if (!$contact) {
                return response()->json(['message' => 'Contact not found', 'data' => $emptyData], 404);
            }
            DB::beginTransaction();

            $contact->update($request->all());

            DB::commit();
            return response()->json(['message' => 'Contact updated successfully', 'data' => $contact], 200);

        } catch (\Exception $e) {
            
            DB::rollBack();

            return response()->json(['message' => $e->getMessage(), 'data' => $emptyData], 500);
        }
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @OA\Delete(
     *     path="/api/contacts/{id}",
     *     summary="Delete a contact",
     *     tags={"Contacts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the contact",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Contact deleted successfully"),
     *     @OA\Response(response="404", description="Contact not found"),
     *     @OA\Response(response="500", description="Error deleting contact")
     * )
     */
    public function destroy($id)
    {
        $emptyData = (object)[];
        try {
            
            $contact = Contact::find($id);

            if (!$contact) {
                return response()->json(['message' => 'Contact not found', 'data' => $emptyData], 404);
            }

            DB::beginTransaction();

           
            $contact->delete();

            DB::commit();

            return response()->json(['message' => 'Contact deleted successfully', 'data' => $emptyData], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage(), 'data' => $emptyData], 500);
        }
    }
}
