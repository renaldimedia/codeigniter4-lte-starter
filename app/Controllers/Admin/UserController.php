<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\BaseController;
use App\Models\UserModel;
use App\Services\UserService;
use CodeIgniter\Shield\Entities\User;

class UserController extends BaseController
{
    protected $user;
    protected $title = "Manajemen User";
    protected $model;

    public function __construct()
    {
        $this->user = new UserService();
    }
    public function index(): string
    {
        $data = [
            'datalist' => $this->user->list([
                'or' => [
                    ['field' => 'username', 'op' => '=', 'value' => 'ardir2'],
                    ['field' => 'username', 'op' => '=', 'value' => 'ardir']
                ],
                ['field' => 'full_name', 'op' => 'IS NOT', 'value' => null]
            ]),
            'title' => $this->title
        ];
        return view('admin/user/list', $data);
    }

    function form($id = null)
    {
        $data = [
            'title' => $this->title
        ];
        return view('admin/user/form', $data);
    }

    function create()
    {
        $rawdata = $this->request->getPost();
        if (! $this->validateData($rawdata, [
            'full_name' => 'required|max_length[100]|min_length[3]',
            'email' => 'required|max_length[255]|valid_email',
            'username' => 'required|max_length[255]|min_length[5]',
            'phone' => 'required|max_length[20]|min_length[8]',
            'password' => 'required|min_length[8]',
        ])) {
            // The validation failed.
            return view('admin/user/form', [
                'errors' => $this->validator->getErrors(),
                'formdata' => $rawdata
            ]);
        }

        $valid_data = $this->validator->getValidated();
        // print_r($valid_data);
        // exit;

        $users = auth()->getProvider();

        $payload = (new UserModel())->createNewUser([
            'username' => $valid_data['username'],
            'email'    => $valid_data['email'],
            'password' => $valid_data['password'],
            'full_name' => $valid_data['full_name'],
            'phone' => $valid_data['phone'],
            'address' => $valid_data['address'] ?? "",
        ]);

        $users->save($payload);

        $insertId = $users->getInsertID();

        // To get the complete user object with ID, we need to get from the database
        $user = $users->findById($insertId);

        // Add to default group
        $users->addToDefaultGroup($user);

        if ($insertId) {
            return redirect()->to('/admin/user')->with('message', 'Berhasil menambahkan data!');
        } else {
            return redirect()->to('/admin/user')->with('message', 'Gagal menambahkan data!');
        }
    }
}
