<?php
namespace App\Models;

use Exception;
use Illuminate\Support\Facades\Auth;

class User extends Model {

  protected $table = 'users';
  protected $primary = 'id';

  public function __construct()
  {

    parent::__construct();
  }

  public function auth() {
    $sessionId = isset($_SESSION['auth']) ? $_SESSION['auth'] : null;
    $user = null;
    if($sessionId) {
      try {
        $user = (object) $this->findBy('auth_token', $sessionId);
      } catch(Exception $e) {
        // empty
      }
    }
    return $user;
  }

  public function register($email, $username, $address, $phone, $password, $role='customer') {
    $encryptedPassword = password_hash($password, PASSWORD_BCRYPT);
    try {
      $stm = $this->db->prepare('INSERT INTO users(email, name, address, phone, password, role) VALUES(?, ?, ?, ?, ?, ?)');
      $stm->execute([$email, $username, $address, $phone, $encryptedPassword, $role]);
      return true;
    } catch(\Exception $e) {
      var_dump($e);
      return false;
    }
  }

  public function updateToken($args) {
    $stm = $this->db->prepare('UPDATE users SET auth_token = ? WHERE id = ?');
    $stm->execute($args);
  }

  public function logout() {
    $authUser = $this->auth();
    if($authUser) {
      $stm = $this->db->prepare('UPDATE users SET auth_token = ? WHERE id = ?');
      $stm->execute([null, $authUser->id]);
    }
    return true;
  }

  public function updateDetail(array $params) {
    $authUser = $this->auth();
    $this->runQuery('UPDATE users SET email = ?, name = ?, address = ?, phone = ? WHERE id = ?', array_merge($params, [$authUser->id]));
  }

  public function updatePassword($newPassword) {
    $authUser = $this->auth();
    $newPassword =password_hash($newPassword, PASSWORD_BCRYPT);
    
    $this->runQuery('UPDATE users SET password = ? WHERE id = ?', [$newPassword, $authUser->id]);
  }


}