<?php

class Home extends Controller
{
  public function index()
  {
    $data = [
      'title' => 'Home',
      'users' => $this->model('UsersModel')->get()
    ];
    $this->view('template/header', $data);
    $this->view('home/index', $data);
    $this->view('template/footer');
  }

  public function detail($id)
  {
    $data = [
      'title' => 'User Detail',
      'user' => $this->model('UsersModel')->get($id)
    ];
    $this->view('template/header', $data);
    $this->view('home/detail', $data);
    $this->view('template/footer');
  }

  public function search()
  {
    $data = [
      'title' => 'Home',
      'users' => $this->model('UsersModel')->search($_POST['keyword'])
    ];
    $this->view('template/header', $data);
    $this->view('home/index', $data);
    $this->view('template/footer');
  }

  public function show($id)
  {
    echo json_encode($this->model('UsersModel')->get($id));
  }

  public function create()
  {
    $closeButton = '<button class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    if ($this->model('UsersModel')->insert($_POST) > 0) {
      $msg = 'Created successfuly.';
      Flashdata::setFlash('<div class="alert alert-success">' . $msg . $closeButton . '</div>');
    } else {
      $msg = 'Failed to created new data!';
      Flashdata::setFlash('<div class="alert alert-danger">' . $msg . $closeButton . '</div>');
    }
    header('Location: ' . BASE_URL . '/home');
  }

  public function update()
  {
    $closeButton = '<button class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    if ($this->model('UsersModel')->update($_POST) > 0) {
      $msg = 'Updated successfuly.';
      Flashdata::setFlash('<div class="alert alert-success">' . $msg . $closeButton . '</div>');
    } else {
      $msg = 'Failed to updated!';
      Flashdata::setFlash('<div class="alert alert-danger">' . $msg . $closeButton . '</div>');
    }
    header('Location: ' . BASE_URL . '/home');
  }

  public function delete($id)
  {
    $closeButton = '<button class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    if ($this->model('UsersModel')->delete($id) > 0) {
      $msg = 'Deleted successfuly.';
      Flashdata::setFlash('<div class="alert alert-success">' . $msg . $closeButton . '</div>');
    } else {
      $msg = 'Failed to deleted!';
      Flashdata::setFlash('<div class="alert alert-danger">' . $msg . $closeButton . '</div>');
    }
    header('Location: ' . BASE_URL . '/home');
  }
}
