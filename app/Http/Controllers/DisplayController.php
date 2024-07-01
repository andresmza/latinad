<?php

namespace App\Http\Controllers;

use App\Http\Requests\DisplayIndexRequest;
use App\Http\Requests\DisplayStoreRequest;
use App\Http\Requests\DisplayUpdateRequest;
use App\Models\Display;
use App\Traits\ApiResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class DisplayController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     * 
     * Handles the request to list all displays owned by the authenticated user.
     * Supports filtering by name and type and provides pagination.
     *
     * @param  DisplayIndexRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(DisplayIndexRequest $request)
    {
        $name = $request->query('name');
        $type = $request->query('type');
        $perPage = $request->query('perPage', 20);
        $page = $request->query('page', 1);

        $query = Display::where('user_id', Auth::id())
            ->name($name)
            ->type($type);

        $displays = $query->paginate($perPage, ['*'], 'page', $page);

        return $this->jsonResponse(Response::HTTP_OK, true, $displays, 'Displays retrieved successfully');
    }

    /**
     * Display the specified resource.
     * 
     * Fetches and returns a specific display belonging to the authenticated user.
     * Ensures that only displays owned by the user can be viewed.
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Display $display)
    {
        $this->authorize('view', $display);
        return $this->jsonResponse(Response::HTTP_OK, true, $display, 'Display retrieved successfully');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * Creates a new display using the validated data from the request.
     * Automatically assigns the authenticated user as the owner of the display.
     *
     * @param  DisplayStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(DisplayStoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        $display = Display::create($data);

        return $this->jsonResponse(Response::HTTP_CREATED, true, $display, 'Display created successfully');
    }

    /**
     * Update the specified resource in storage.
     * 
     * Updates the specific display data with the validated request data.
     * Ensures that only the owner can update the display.
     *
     * @param  DisplayUpdateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(DisplayUpdateRequest $request, Display $display)
    {
        $display->update($request->validated());

        return $this->jsonResponse(Response::HTTP_OK, true, $display, 'Display updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * Deletes a specific display owned by the authenticated user.
     * Ensures that only the owner can delete the display.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Display $display)
    {
        $this->authorize('delete', $display);

        $display->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
