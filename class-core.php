<?php
class Core {
    public function __construct()
    {
        $this->init();
    }
    
    private function init() {
        include_once 'config.php';
        include_once 'includes/nd-db.php';
        echo 'core';
    }
}

new Core();
