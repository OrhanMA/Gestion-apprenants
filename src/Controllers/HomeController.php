
<?php
class HomeController
{
  use Response;

  public function index()
  {
    $this->render('home');
  }

  public function pageNotFound()
  {
    $this->render('404');
  }
}
