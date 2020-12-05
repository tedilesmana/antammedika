<?php
// index : di gunakan untuk mengambil semua data
// new : di gunakan untuk mengambil data dengan limmit dan offset tertentu
// show : di gunakan untuk mengambil detail data
// edit : di gunakan untuk mengambil data yang akan di edit
// create : di gunakan untuk membuat data baru
// update : di gunakan untuk melakukan update data
// delete : di gunakan untuk menghapus data

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Libraries\FormValidation;

class Pasiens extends ResourceController
{
    protected $modelName = 'App\Models\PasienModel';
    protected $format    = 'json';

    public function __construct()
    {
        $this->form_validation = \Config\Services::validation();
    }

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function new()
    {
        return $this->respond($this->model->findAll(2, 0));
    }

    public function show($user_id = null)
    {
        return $this->respond($this->model->find($user_id));
    }

    public function edit($user_id = null)
    {
        return $this->respond($this->model->find($user_id));
    }

    public function create()
    {
        $user_id = $this->request->getPost('user_id');
        $name = $this->request->getPost('name');
        $age = $this->request->getPost('age');
        $phone = $this->request->getPost('phone');
        $antrian = $this->request->getPost('antrian');
        $description = $this->request->getPost('description');
        $address = $this->request->getPost('address');

        $this->form_validation->setRules([
            'user_id' => ['label' => 'user_id', 'rules' => 'required'],
            'name' => ['label' => 'name', 'rules' => 'required'],
            'age' => ['label' => 'age', 'rules' => 'required'],
            'phone' => ['label' => 'phone', 'rules' => 'required'],
            'antrian' => ['label' => 'antrian', 'rules' => 'required'],
            'description' => ['label' => 'description', 'rules' => 'required'],
            'address' => ['label' => 'address', 'rules' => 'required']
        ]);

        try {
            if (!$this->form_validation->withRequest($this->request)->run()) {
                throw new \Exception("your data is not valid please look at line errors then fill it back properly");
            } else {
                $data = [
                    'user_id' => $user_id,
                    'name' => $name,
                    'age' => $age,
                    'phone' => $phone,
                    'antrian' => $antrian,
                    'description' => $description,
                    'status' => 'waiting',
                    'address' => $address
                ];
                if ($this->model->insert($data)) {
                    $response = [
                        'status'   => true,
                        'data'     => $data,
                        'detailMessage' => [
                            'Your data has created !!'
                        ]
                    ];
                    return $this->respond($response, 200);
                } else {
                    throw new \CodeIgniter\Database\Exceptions\DatabaseException();
                }
            }
        } catch (\Exception $e) {
            $errors[] = $this->form_validation->getErrors();
            $errors[0]['errorMessage'] = $e->getMessage();

            $response = [
                'status'   => false,
                'data' => [
                    'errors' => $errors
                ],
                'detailMessage' => "Error in function --" . $e->getTrace()[0]["function"] .    "-- with information --" . $e->getMessage() . "--"
            ];
            return $this->respond($response, 203);
        }
    }

    public function update($user_id = null)
    {
        $data = $this->request->getRawInput();

        try {
            if (count($data) == 0) {
                throw new \Exception("Please cek your entry parameter was correct !");
            } else {
                if ($this->model->update($user_id, $data)) {
                    $response = [
                        'status'   => true,
                        'data'     => $data,
                        'detailMessage' => [
                            'Your data has updated !!'
                        ]
                    ];
                    return $this->respond($response, 200);
                } else {
                    throw new \CodeIgniter\Database\Exceptions\DatabaseException();
                }
            }
        } catch (\Exception $e) {
            $errors[0]['errorMessage'] = $e->getMessage();

            $response = [
                'status'   => false,
                'data' => [
                    'errors' => $errors
                ],
                'detailMessage' => "Error in function --" . $e->getTrace()[0]["function"] .    "-- with information --" . $e->getMessage() . "--"
            ];
            return $this->respond($response, 203);
        }
    }

    public function delete($user_id = null)
    {
        $this->model->delete($user_id);
        return $this->respond($this->model->purgeDeleted($user_id));
    }
}
