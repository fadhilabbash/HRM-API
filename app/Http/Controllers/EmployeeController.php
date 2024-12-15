<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditEmployeeRequest;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{
    use ApiResponses;

    /**
     * Display a listing of employees.
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        // Extract the search query from the request
        $searchQuery = $request->input('search');

        // Query the employees with optional search filter
        $employees = Employee::when($searchQuery, function ($query, $searchQuery) {
            $query->where('name', 'LIKE', '%' . $searchQuery . '%'); // Update 'name' with the appropriate column
        })->paginate(10);

        // Prepare pagination data
        $paginationData = [
            'current_page' => $employees->currentPage(),
            'last_page' => $employees->lastPage(),
            'per_page' => $employees->perPage(),
            'total' => $employees->total(),
        ];

        // Return the response with the filtered employees
        return $this->successResponse(
            EmployeeResource::collection($employees->items()),
            'تم استرجاع الموظفين بنجاح',
            Response::HTTP_OK,
            $paginationData
        );
    }

    /**
     * Store a newly created employee in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(StoreEmployeeRequest $request)
    {
        $validatedData = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $validatedData['image'] = $image->storeAs('uploads/employees/images', $imageName, 'public');
        }

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $validatedData['file'] = $file->storeAs('uploads/employees/files', $fileName, 'public');
        }

        $employee = Employee::create($validatedData);

        return $this->createdResponse(new EmployeeResource($employee), 'تم الحفظ بنجاح');
    }
    /**
     * Display the specified employee.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return $this->notFoundResponse(null, 'الموظف غير موجود');
        }


        return $this->okResponse(new EmployeeResource($employee), 'تم العثور على الموظف بنجاح');
    }

    /**
     * Update the specified employee in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(EditEmployeeRequest $request, $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return $this->notFoundResponse(null, 'الموظف غير موجود');
        }

        $validatedData = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $validatedData['image'] = $image->storeAs('uploads/employees/images', $imageName, 'public');

            if ($employee->image) {
                Storage::disk('public')->delete($employee->image);
            }
        }

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $validatedData['file'] = $file->storeAs('uploads/employees/files', $fileName, 'public');

            if ($employee->file) {
                Storage::disk('public')->delete($employee->file);
            }
        }

        $employee->update($validatedData);

        return $this->okResponse(new EmployeeResource($employee), 'تم التعديل بنجاح');
    }


    /**
     * Remove the specified employee from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return $this->notFoundResponse(null, 'الموظف غير موجود');
        }

        // Delete image
        if ($employee->image) {
            Storage::disk('public')->delete($employee->image);
        }

        // Delete file
        if ($employee->file) {
            Storage::disk('public')->delete($employee->file);
        }

        $employee->delete();

        return $this->okResponse(null, 'تم الحذف بنجاح');
    }
}
