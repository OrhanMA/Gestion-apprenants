
<?php

trait Response
{
    public function render($view, $data = null)
    {
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                ${$key} = $value;
            }
        }

        include_once __DIR__ . '/../Views/' . $view . ".php";
    }
}
