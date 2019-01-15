<?php
namespace Horttcore\Plugin;

/**
 * Class Plugin.
 *
 * Main plugin controller class that hooks the plugin's functionality into the WordPress request lifecycle.
 *
 * @since   1.0.0
 * @package Horttcore\Plugin
 * @author  Ralf Hortt <me@horttcore.de>
 */
class Plugin
{


    /**
     * Services
     * 
     * @since 1.0.0
     * @var array $services Registered services
     * @return Plugin
     */
    protected $services = [];


    /**
     * Register the plugin with the WordPress system.
     *
     * @since 1.0.0
     * @return Plugin
     */
    public function boot()
    {
        add_action('plugins_loaded', [$this, 'registerServices']);

        return $this;
    }


    /**
     * Add service
     *
     * @param strong $class Class name
     * @return Plugin
     **/
    public function addService( string $class )
    {
        $this->services[] = $class;

        return $this;
    }


    /**
     * Register the individual services of this plugin.
     *
     * @since 1.0.0
     */
    public function registerServices()
    {
        $services = $this->getServices();
        array_walk($services, function ($service) {
            (new $service)->init();
        });
    }


    /**
     * Get the list of services to register.
     *
     * @since 1.0.0
     *
     * @return array<string> Array of fully qualified class names.
     */
    private function getServices()
    {
        return $this->services;
    }


}
