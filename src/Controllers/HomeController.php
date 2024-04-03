
<?php
class HomeController
{
    use Response;
    private $usersRepository;

    public function index()
    {

        $this->render('home');
    }

    public function pageNotFound()
    {
        $this->render('404');
    }
}
