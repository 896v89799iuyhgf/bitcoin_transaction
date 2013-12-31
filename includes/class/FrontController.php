<?php
class FrontController {
    function __construct()
    {

    }

    public function parseUri() {
        return $_REQUEST['route'];
    }
}
