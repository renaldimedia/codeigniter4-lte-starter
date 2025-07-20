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
        return view('admin/user/list', ['title' => $this->title]);
    }

    function list()
    {
        // Read values
        $draw = $this->request->getPost('draw');
        $start = $this->request->getPost('start');
        $length = $this->request->getPost('length');
        $searchValue = $this->request->getPost('search')['value'];

        // Sorting
        $order = $this->request->getPost('order');
        //  print_r($order);exit;
        $orderColumnIndex = $order[0]['column'];
        $orderColumnDir = $order[0]['dir'];
        $columns = $this->request->getPost('columns');
        //  print_r($columns);exit;
        $orderColumn = $columns[$orderColumnIndex]['data'];


        $datas = $this->user->list($searchValue, [['field' => $orderColumn, 'dir' => $orderColumnDir]], $length, $start);



        $response = [
            "draw" => intval($draw),
            "recordsTotal" => $datas['total'],
            "recordsFiltered" => $datas['totalF'],
            "data" => $datas['data']
        ];

        return $this->response->setJSON($response);
    }


    function form($id = null)
    {
        $data = [
            'title' => $this->title,
            'method' => 'post',
            'action' => '/admin/user'
        ];

        if ($id != null) {
            $user = $this->user->detail($id);
            $data['formedit'] = $user;
            $data['method'] = 'put';
            $data['action'] = '/admin/user/update/' . $id;
        }

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

    function update($id)
    {
        $rawdata = $this->request->getPost();
        $rules = [
            'full_name' => 'required|max_length[100]|min_length[3]',
            'email' => 'required|max_length[255]|valid_email',
            'username' => 'required|max_length[255]|min_length[5]',
            'phone' => 'required|max_length[20]|min_length[8]'
        ];

        if(!empty($rawdata['password'])){
            $rules['password'] = 'required|min_length[8]';
        }
        if (! $this->validateData($rawdata, $rules)) {
            // The validation failed.
            return view('admin/user/form', [
                'errors' => $this->validator->getErrors(),
                'formedit' => $rawdata,
                'method' => 'put',
                'action' => '/admin/user/update/' . $id
            ]);
        }
        
        $valid_data = $this->validator->getValidated();

        $users = auth()->getProvider();
        $user = (new UserModel())->find($id);
        $user->fill($valid_data);

        if($users->save($user)){
            return redirect()->to('/admin/user')->with('message', 'Berhasil mengubah data!');
        } else {
            return view('admin/user/form', [
                'errors' => $this->validator->getErrors(),
                'formedit' => $rawdata,
                'method' => 'put',
                'action' => '/admin/user/update/' . $id
            ]);
        }
    }

    function delete($id) {
        $users = auth()->getProvider();
        // $user = (new UserModel())->find($id);
        $users->delete($id, true);

        return $this->response->setJson([
            'message' => 'Berhasil menghapus data!',
            'status' => 'success'
        ]);
    }
}
