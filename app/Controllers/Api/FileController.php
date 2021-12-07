<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class FileController extends ResourceController
{
	public function index()
	{
		return $this->respond(["Files"]);
	}

	public function upload() {

		$client = $this->request->getPost('client_id');
		$category = $this->request->getPost('category_id');
		$file = $this->request->getFile('file');
		
		if ($file->isValid() && ! $file->hasMoved()) {
        	$newName = $file->getRandomName();
			$file->move(ROOTPATH."public/assets/$client/$category", $newName);
			return $this->respond([
				'status' => 201,
				'msg' => 'arquivo enviado com sucesso!',
				'path' => base_url("assets/$client/$category/$newName")
			]);
        } else {
			return $this->respond([
				'status' => 'failed', 
				'msg' => 'erro ao tentar enviar arquivo'
			]);
		}
	}
}
