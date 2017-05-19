<?php
namespace App\Validation;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Routing\Router;
use Illuminate\Config\Repository;

class AllowedUsernameValidator
{
  private $router;

  private $files;

  private $config;

  public function __construct(Router $router, Filesystem $files, Repository $config)
  {
    $this->config = $config;
    $this->router = $router;
    $this->files = $files;
  }

  public function validate($attribute, $username)
  {
    $username = trim(strtolower($username));

    if ($this->isReservedUsername($username)) {
      return false;
    }

    if ($this->matchesRoute($username)) {
      return false;
    }

    if ($this->matchesPublicFileOrDirectory($username)) {
      return false;
    }

    return true;
  }

  private function isReservedUsername($username)
  {
    return in_array($username, $this->config->get('auth.reserved_usernames'));
  }

  private function matchesRoute($username)
  {

    foreach ($this->router->getRoutes() as $route) {

      if (strtolower($route->uri) === $username) {
        return true;
      }
    }

    return false;
  }

  private function matchesPublicFileOrDirectory($username)
  {
    foreach ($this->files->glob(public_path().'/*') as $path) {

      if (strtolower(basename($path)) === $username) {
        return true;
      }
    }

    return false;
  }
}
