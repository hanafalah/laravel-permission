<?php

namespace Zahzah\ModuleRegional\Supports;

use Zahzah\LaravelSupport\Supports\PackageManagement;

class BaseModuleRegional extends PackageManagement{
    /** @var array */
    protected $__module_regional_config = [];

    /**
     * A description of the entire PHP function.
     *
     * @param Container $app The Container instance
     * @throws Exception description of exception
     * @return void
     */
    public function __construct(){
        $this->setConfig('module-regional',$this->__module_regional_config);
    }    
}   