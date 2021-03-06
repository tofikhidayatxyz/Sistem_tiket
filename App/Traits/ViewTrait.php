<?php

namespace App\Traits;

use Jenssegers\Blade\Blade;

trait ViewTrait {

  protected $viewPath;
  protected $blade;
  protected $flashSessionData;

  public function __construct()
  {
    $this->viewPath = $_ENV['BASE_PATH'].'/resources/views';
    $this->cachePath = $_ENV['BASE_PATH'].'/storages/cache';
    
    $this->blade = new Blade($this->viewPath, $this->cachePath);    
    
    $this->blade->directive('success', function () {
      return '
        <?php
        $flash = isset($_SESSION[\'success\']) ? $_SESSION[\'success\'] : null;

        if($flash) {
          unset($_SESSION[\'success\']);

          echo "
            <div class=\'alert alert-success\'>
              {$flash}
            </div>
          ";
        }
        ?>
      ';
    });

    $this->blade->directive('error', function () {
      return '
        <?php
        $flash = isset($_SESSION[\'error\']) ? $_SESSION[\'error\'] : null;

        if($flash) {
          unset($_SESSION[\'error\']);
          echo "
            <div class=\'alert alert-danger\'>
              {$flash}
            </div>
          ";
        }
        ?>
      ';
    });

  }
  

  public function view($file, $arguments = []) {
 
    return $this->blade->make($file, $arguments)->render();
  }
}