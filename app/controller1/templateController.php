<?php

class templateController
{
    public function ctrTemplateCommercial()
    {
        include __DIR__ . '../../views/templateCommercial.php';
    }

    public function ctrTemplateAdmin()
    {
        include __DIR__ . '../../views/templateAdmin.php';
    }
    
    public function ctrTemplateRemission()
    {
        include __DIR__ . '../../views/templateRemission.php';
    }
}
