<?php

namespace App\Support;

use Illuminate\Session\Store;
use Exception;

class Alert
{
    /**
     * The session writer.
     *
     * @var SessionStore
     */
    private $session;

    /**
     * Create a new flash notifier instance.
     *
     * @param Store $session
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * @param             $title
     * @param             $content
     * @param bool|string $icon
     * @param string      $level
     * @param bool        $close
     */
    public function message($title, $content, $icon, $level = 'info', $close = true)
    {
        $types = ['error', 'info', 'success', 'warning', 'primary', 'secondary', 'danger', 'light', 'dark'];

        if (! in_array($level, $types)) {
            throw new Exception("The $level remind message is not valid.");
        }

        $this->session->flash('alert.title', $title);
        $this->session->flash('alert.content', $content);
        $this->session->flash('alert.level', $level);
        $this->session->flash('alert.close', $close);

        // if icon == true, get icon from level, else if icon is string, set icon
        if ((is_bool($icon) && $icon == true) || strlen($icon) > 1) {
            $icon = is_string($icon) ? $icon : $this->alert_icon($level);

            $this->session->flash('alert.icon', $icon);
        }
    }

    /**
     * @param             $title
     * @param             $content
     * @param bool|string $icon
     */
    public function info($title, $content = '', $icon = true)
    {
        $this->message($title, $content, $icon, 'info');
    }

    /**
     * @param             $title
     * @param             $content
     * @param bool|string $icon
     */
    public function success($title, $content = '', $icon = true)
    {
        $this->message($title, $content, $icon, 'success');
    }

    /**
     * @param             $title
     * @param             $content
     * @param bool|string $icon
     */
    public function error($title, $content = '', $icon = true)
    {
        $this->message($title, $content, $icon, 'danger');
    }

    /**
     * @param             $title
     * @param             $content
     * @param bool|string $icon
     */
    public function danger($title, $content = '', $icon = true)
    {
        $this->message($title, $content, $icon, 'danger');
    }

    /**
     * @param             $title
     * @param             $content
     * @param bool|string $icon
     */
    public function warning($title, $content = '', $icon = true)
    {
        $this->message($title, $content, $icon, 'warning');
    }

    /**
     * @param             $title
     * @param             $content
     * @param bool|string $icon
     */
    public function primary($title, $content = '', $icon = true)
    {
        $this->message($title, $content, $icon, 'primary');
    }

    /**
     * @param             $title
     * @param             $content
     * @param bool|string $icon
     */
    public function secondary($title, $content = '', $icon = true)
    {
        $this->message($title, $content, $icon, 'secondary');
    }

    /**
     * @param             $title
     * @param             $content
     * @param bool|string $icon
     */
    public function light($title, $content = '', $icon = true)
    {
        $this->message($title, $content, $icon, 'light');
    }

    /**
     * @param             $title
     * @param             $content
     * @param bool|string $icon
     */
    public function dark($title, $content = '', $icon = true)
    {
        $this->message($title, $content, $icon, 'dark');
    }

    /**
     * Get the icon for the notify level
     *
     * @param $level
     * @return string
     */
    private function alert_icon($level)
    {
        switch ($level) {
            case 'danger':
                return ' <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>';
                break;
            case 'warning':
                return '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>';
                break;
            case 'success':
                return ' <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>';
                break;
            default: // info / default
                return '  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>';
                break;
        }
    }

}
