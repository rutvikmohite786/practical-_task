<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserData;
use App\Models\Category;
use App\Models\Hobby;
use Illuminate\Support\Facades\Validator;

class UserDataController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $hobbies = Hobby::all();
        return view('users.index', compact('categories', 'hobbies'));
    }

    public function getData()
    {
        $users = UserData::with(['category', 'hobbies'])->get();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:255',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'required|string|min:10|max:20|regex:/^[0-9+\-\s()]*$/',
            'category_id' => 'required|integer|exists:categories,id',
            'hobbies' => 'required|array|min:1',
            'hobbies.*' => 'integer|exists:hobbies,id',
        ], [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 3 characters',
            'name.max' => 'Name cannot exceed 255 characters',
            'profile_pic.image' => 'Profile picture must be an image',
            'profile_pic.mimes' => 'Profile picture must be jpeg, png, jpg, or gif',
            'profile_pic.max' => 'Profile picture size cannot exceed 2MB',
            'phone.required' => 'Phone number is required',
            'phone.min' => 'Phone number must be at least 10 digits',
            'phone.max' => 'Phone number cannot exceed 20 characters',
            'phone.regex' => 'Phone number format is invalid',
            'category_id.required' => 'Category is required',
            'category_id.exists' => 'Selected category is invalid',
            'hobbies.required' => 'At least one hobby is required',
            'hobbies.min' => 'Please select at least one hobby',
            'hobbies.*.exists' => 'Selected hobby is invalid',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $data = $request->only(['name', 'phone', 'category_id']);
            
            if ($request->hasFile('profile_pic')) {
                $file = $request->file('profile_pic');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/profiles'), $filename);
                $data['profile_pic'] = $filename;
            }

            $userData = UserData::create($data);
            $userData->hobbies()->attach($request->hobbies);

            return response()->json(['success' => true, 'message' => 'User data added successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to create user data: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $userData = UserData::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:255',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'required|string|min:10|max:20|regex:/^[0-9+\-\s()]*$/',
            'category_id' => 'required|integer|exists:categories,id',
            'hobbies' => 'required|array|min:1',
            'hobbies.*' => 'integer|exists:hobbies,id',
        ], [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 3 characters',
            'name.max' => 'Name cannot exceed 255 characters',
            'profile_pic.image' => 'Profile picture must be an image',
            'profile_pic.mimes' => 'Profile picture must be jpeg, png, jpg, or gif',
            'profile_pic.max' => 'Profile picture size cannot exceed 2MB',
            'phone.required' => 'Phone number is required',
            'phone.min' => 'Phone number must be at least 10 digits',
            'phone.max' => 'Phone number cannot exceed 20 characters',
            'phone.regex' => 'Phone number format is invalid',
            'category_id.required' => 'Category is required',
            'category_id.exists' => 'Selected category is invalid',
            'hobbies.required' => 'At least one hobby is required',
            'hobbies.min' => 'Please select at least one hobby',
            'hobbies.*.exists' => 'Selected hobby is invalid',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $data = $request->only(['name', 'phone', 'category_id']);
            
            if ($request->hasFile('profile_pic')) {
                if ($userData->profile_pic && file_exists(public_path('uploads/profiles/' . $userData->profile_pic))) {
                    unlink(public_path('uploads/profiles/' . $userData->profile_pic));
                }
                
                $file = $request->file('profile_pic');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/profiles'), $filename);
                $data['profile_pic'] = $filename;
            }

            $userData->update($data);
            $userData->hobbies()->sync($request->hobbies);
            
            $userData->load(['category', 'hobbies']);

            return response()->json([
                'success' => true, 
                'message' => 'User data updated successfully',
                'user' => $userData
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update user data: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:users_data,id',
        ], [
            'id.exists' => 'User data not found',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $userData = UserData::findOrFail($id);
            
            if ($userData->profile_pic && file_exists(public_path('uploads/profiles/' . $userData->profile_pic))) {
                unlink(public_path('uploads/profiles/' . $userData->profile_pic));
            }
            
            $userData->delete();

            return response()->json(['success' => true, 'message' => 'User data deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete user data: ' . $e->getMessage()], 500);
        }
    }

    public function bulkDestroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ids' => 'required|array|min:1',
            'ids.*' => 'integer|exists:users_data,id',
        ], [
            'ids.required' => 'No items selected for deletion',
            'ids.min' => 'Please select at least one item to delete',
            'ids.*.exists' => 'One or more selected items do not exist',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $users = UserData::whereIn('id', $request->ids)->get();
            
            foreach ($users as $user) {
                if ($user->profile_pic && file_exists(public_path('uploads/profiles/' . $user->profile_pic))) {
                    unlink(public_path('uploads/profiles/' . $user->profile_pic));
                }
            }
            
            UserData::whereIn('id', $request->ids)->delete();

            return response()->json(['success' => true, 'message' => 'Selected user data deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete selected user data: ' . $e->getMessage()], 500);
        }
    }

    public function getCategories()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function getHobbies()
    {
        $hobbies = Hobby::all();
        return response()->json($hobbies);
    }
}
