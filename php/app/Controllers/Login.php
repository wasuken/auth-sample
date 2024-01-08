<?php

namespace App\Controllers;

use Firebase\JWT\JWT;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use \App\Models\UserModel;

class Login extends ResourceController
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
      'email' => 'required|valid_email',
      'password' => 'required|min_length[8]'
    ];
    if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
    $model = new UserModel();
    $user = $model->where("email", $this->request->getVar('email'))->first();
    if(!$user) return $this->failNotFound('Email Not Found');

    $verify = password_verify($this->request->getVar('password'), $user['password_hash']);
    if(!$verify) return $this->fail('Wrong Password');

    $key = getenv('app.jwt.privatekey');
    $payload = array(
      "iat" => 1356999524,
      "nbf" => 1357000000,
      "uid" => $user['id'],
      "email" => $user['email']
    );

    $token = JWT::encode($payload, $key, 'HS256');

    return $this->respond($token);
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
