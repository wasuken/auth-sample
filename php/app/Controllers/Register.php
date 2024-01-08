<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use \App\Models\UserModel;

class Register extends ResourceController
{
  use ResponseTrait;
  /**
   * Return an array of resource objects, themselves in array format
   *
   * @return ResponseInterface
   */
  public function index()
  {
    //
    helper(['form']);
    $rules = [
      'email' => 'required|valid_email|is_unique[users.email]',
      'password' => 'required|min_length[8]',
      'password_confirm' => 'matches[password]',
    ];
    if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
    $data = [
      'email' => $this->request->getVar('email'),
      'password_hash' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
    ];
    $model = new UserModel();
    $registered = $model->save($data);
    $this->respondCreated($registered);
  }

  /**
   * Return the properties of a resource object
   *
   * @return ResponseInterface
   */
  public function show($id = null)
  {
    //
  }

  /**
   * Return a new resource object, with default properties
   *
   * @return ResponseInterface
   */
  public function new()
  {
    //
  }

  /**
   * Create a new resource object, from "posted" parameters
   *
   * @return ResponseInterface
   */
  public function create()
  {
    //
  }

  /**
   * Return the editable properties of a resource object
   *
   * @return ResponseInterface
   */
  public function edit($id = null)
  {
    //
  }

  /**
   * Add or update a model resource, from "posted" properties
   *
   * @return ResponseInterface
   */
  public function update($id = null)
  {
    //
  }

  /**
   * Delete the designated resource object from the model
   *
   * @return ResponseInterface
   */
  public function delete($id = null)
  {
    //
  }
}
