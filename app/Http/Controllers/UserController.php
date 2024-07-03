<?php

namespace App\Http\Controllers;

// ============================================================================>> Core Library
use Illuminate\Http\Request; // For Getting requested Payload from Client
use Illuminate\Http\Response; // For Responsing data back to Client
use Illuminate\Support\Facades\Hash; // For Encripting data

// ============================================================================>> Third Party Library
use Carbon\Carbon; // Data Time format & Calculation

// ============================================================================>> Custom Library
// Controller
use App\Http\Controllers\MainController;

// Service
use App\Services\FileUpload; // Upload Image/File to File Micro Serivce

// Model
use App\Models\Type;
use App\Models\User;

class UserController extends MainController
{
    public function getUserType(){

        // ===>> Get Data from Database
        $data = Type::get();

        // ===>> Success Response Back to Client
        return response()->json($data, Response::HTTP_OK);

    }

    public function getData(Request $req){

        // ===>> Get Data from DB
        $data = User::select('id', 'name', 'phone', 'email', 'type_id', 'avatar', 'created_at', 'is_active')
        ->with([
            'type' // M:1
        ]);

        // ===>>> Filter
        // By Key for Name or Phone Number
        if ($req->key && $req->key != '') {
            $data = $data->where('name', 'LIKE', '%' . $req->key . '%')->Orwhere('phone', 'LIKE', '%' . $req->key . '%');
        }

        // Order Data from Latest ID
        $data = $data->orderBy('id', 'asc')

        // Pagination limited by 10
        ->paginate($req->limit ? $req->limit : 10,);
        
        // Get total count of users
        $totalUsers = User::count();

        // Success Response Back to Client
        // return response()->json($data, Response::HTTP_OK);
        return response()->json([
            'data' => $data,
            'total_users' => $totalUsers
        ], Response::HTTP_OK);
    }

    public function view($id = 0){

        // ===>> Get Data From Database
        $data = User::select('id', 'name', 'phone', 'email', 'type_id', 'avatar', 'created_at', 'is_active')->with(['type'])->find($id);

        // Check if Data is valid.
        if ($data) { // Yes

            // ===> Success Response Back to Client
            return response()->json($data, Response::HTTP_OK);

        } else { // No

            // ===> Failed Response Back to Client
            return response()->json([
                'status'  => 'fail',
                'message' => 'Data is not in the database.'
            ], Response::HTTP_BAD_REQUEST);

        }
    }

    public function create(Request $req){

        // === >> Check validation
        $this->validate(
            $req,
            [
                'type_id'       => 'required|min:1|max:20',
                'name'          => 'required|min:1|max:20',
                'phone'         => 'required|unique:user,phone',
                'password'      => 'required|min:6|max:20',
                'email'         => 'unique:user,email'
            ],
            [
                'name.required'     => 'Please input your name',
                'phone.required'    => 'Please input your phone number',
                'phone.unique'      => 'This phone number is already used in the system',
                'email.unique'      => 'This email is already in the system',
                'password.required' => 'Please input you password',
                'password.min'      => 'Please enter a password greater than or equal to 6',
                'password.max'      => 'Please enter a password of 20 or less.'
            ]
        );

        //==============================>> Start Adding data
        // Mapping between database table field and requested data from client
        $user            =   new User;
        $user->name      =   $req->name;
        $user->type_id   =   $req->type_id;
        $user->phone     =   $req->phone;
        $user->email     =   $req->email;
        $user->password  =   Hash::make($req->password); //Make sure no one can understand it even DB Admin.
        $user->is_active =   1;
        $user->avatar    =   'static/icon/user.png'; // Static Picture

        // ===>> Upload Avatar to File Service
        // Check if having request 'image' from client
        if ($req->image) { // Yes

            // Call to File Service
            $image      = FileUpload::uploadFile($req->image, 'users', $req->fileName);

            // Only valid url can be used.
            if ($image['url']) {
                $user->avatar = $image['url'];
            }

        }

        // ===>> Save to DB
        $user->save();

        // ===> Success Response Back to Client
        return response()->json([
            'user'  => User::select('id', 'name', 'phone', 'email', 'type_id', 'avatar', 'created_at', 'is_active')->with(['type'])->find($user->id),
            'message' => 'User: ' . $user->name . ' has been successfully created.'
        ], Response::HTTP_OK);

    }
    public function update(Request $req, $id = 0){

        // ==>> Check validation
        $this->validate(
            $req,
            [
                'name'     => 'required',
                'phone'    => 'required',
            ],
            [
                'name.required'     => 'Please input your name',
                'phone.required'    => 'please input your phone number',
            ]
        );

        // Unique Phone Number Validation
        $check  = User::where('id','!=',$id)->where('phone',$req->phone)->first();
        if($check){ // Yes

            // ===> Failed Response Back to Client
            return response()->json([
                'status'    => 'Failed!',
                'message'   => 'This phone number is already used in the system!',
            ], Response::HTTP_BAD_REQUEST);

        }

         // Unique Email Validation
        $check  = User::where('id','!=',$id)->where('email',$req->email)->first();
        if($check){ // Yes

            // ===> Failed Response Back to Client
            return response()->json([
                'status'    => 'Failed!',
                'message'   => 'This Email is already used in the system!',
            ], Response::HTTP_BAD_REQUEST);

        }

        //==============================>> Start Updating data
        // Get Data from DB
        $user = User::select('id', 'name', 'phone', 'email', 'type_id', 'avatar', 'created_at', 'is_active')->with(['type'])->find($id);
        if ($user) { // Yes

            // Mapping between database table field and requested data from client
            $user->name      =   $req->name;
            $user->type_id   =   $req->type_id;
            $user->phone     =   $req->phone;
            $user->email     =   $req->email;
            $user->is_active =   $req->is_active;

            // Call to File Service
            if ($req->image) {

                // Call File Service
                $image     = FileUpload::uploadFile($req->image, 'users', $req->fileName);

                // Only valid url can be used.
                if ($image['url']) {

                    // Mapping between database table field and uri from File Service
                    $user->avatar = $image['url'];

                }
            }

            // ===>> Save to DB
            $user->save();

            // ===>> Success Response Back to Client
            return response()->json([
                'status'    => 'Successfull!',
                'message'   => 'Data has beed edited',
                'user'      => $user,
            ], Response::HTTP_OK);

        } else { // No

            // ===>> Failed Response Back to Client
            return response()->json([
                'status'    => 'Failed!',
                'message'   => 'Input data is not correct!',
            ], Response::HTTP_BAD_REQUEST);

        }
    }
    // public function delete($id = 0){

    //     // ===>> Get Data from DB
    //     $data = User::find($id);

    //     //====>> Check if Data is Valid
    //     if ($data) { // Yes

    //         // Delete Data from DB
    //         $data->delete();

    //         // ===>> Success Response Back to Client
    //         return response()->json([
    //             'status'    => 'Successful!',
    //             'message'   => 'Data has been deleted!',
    //         ], Response::HTTP_OK);

    //     } else { // No

    //         // ===>> Failed Response Back to Client
    //         return response()->json([
    //             'status'    => 'Failed!',
    //             'message'   => 'Wrong Data!',
    //         ], Response::HTTP_BAD_REQUEST);

    //     }
    // }
    public function delete($id)
    {
        // Find the user by ID
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 'Failed!',
                'message' => 'User not found.'
            ], Response::HTTP_NOT_FOUND);
        }

        try {
            // Delete the user
            $user->delete();

            return response()->json([
                'status' => 'Successful!',
                'message' => 'User deleted successfully.'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Failed!',
                'message' => 'Error deleting user.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
