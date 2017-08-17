**MODIFIACATIONS MADE**

* laravel/lumen-framework/config/view.php:
    * paths: got added realpath(base_path('views'))
    * compiled: changed from realpath(storage_path('views/blade_compiled')) to 'compiled' => realpath(('views/blade_compiled'))