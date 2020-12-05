<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;


class Report extends ResourceController
{
    public function get_current_report_pasien($user_id = null) 
    {
        try {
            $db      = \Config\Database::connect();
            $builder = $db->table('pasiens');
            $query   = $builder->getWhere(['user_id' => $user_id])->getResultArray();

            if ($db) {
                if (count($query)) {
                    $currentDataPasien = end($query);
                    $response = [
                        'status'   => true,
                        'data' => $currentDataPasien,
                        'detailMessage' => [
                            'Your request successfull !!'
                        ]
                    ];
                    return $this->respond($response, 200);
                } else {
                    throw new \Exception("Tidak ada data di temukan");
                }
            } else {
                throw new \CodeIgniter\Database\Exceptions\DatabaseException();
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
}
