<?php

namespace App\Support;

use Illuminate\Session\SessionManager as Session;
use Illuminate\Config\Repository as Config;
use Illuminate\Support\MessageBag;
use Exception;

class Toastr
{
    /**
     * The session manager.
     * @var \Illuminate\Session\SessionManager
     */
    protected $session;

    /**
     * The Config Handler.
     *
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * The messages in session.
     *
     * @var array
     */
    protected $messages = [];

    function __construct(Session $session, Config $config)
    {
        $this->session = $session;
        $this->config  = $config;
    }

    public function message()
    {
        $messages = $this->session->get('toastr::messages');

        if (! $messages) $messages = [];

        $script = '<script type="text/javascript">';

        foreach ($messages as $message) {

           $title = addslashes($message['title']) ?: null;

            $script .= 'toastr.' . $message['type'] .
                '(\'' . addslashes($message['message']) .
                "','$title" .
                '\');';


        }

        $script .= '</script>';
        return $script;
    }

    /**
     *
     * Add a flash message to session.
     *
     * @param string $type Must be one of info, success, warning, error.
     * @param string $message The flash message content.
     * @param string $title The flash message title.
     *
     * @return void
     */
    public function add($type, $message, $title = null)
    {
        $types = ['error', 'info', 'success', 'warning', 'primary', 'secondary', 'danger', 'light', 'dark'];

        if (! in_array($type, $types)) {
            throw new Exception("The $type remind message is not valid.");
        }

        $this->messages[] = [
            'type'    => $type,
            'title'   => $title,
            'message' => $message,
        ];

        $this->session->flash('toastr::messages', $this->messages);
    }

    /**
     * Add an info flash message to session.
     *
     * @param string $message The flash message content.
     * @param string $title The flash message title.
     *
     * @return void
     */
    public function info($message, $title = null)
    {
		if($message instanceof MessageBag)
		{
			$messageString = "";
			foreach ($message->getMessages() as $messageArray)
			{
				foreach ($messageArray as $currentMessage)
					$messageString .= $currentMessage."<br>";
			}

			$this->add('info', rtrim($messageString, "<br>"), $title);
		}
		else
			$this->add('info', $message, $title);
    }

    /**
     * Add a success flash message to session.
     *
     * @param string $message The flash message content.
     * @param string $title The flash message title.
     *
     * @return void
     */
    public function success($message, $title = null)
    {
		if($message instanceof MessageBag)
		{
			$messageString = "";
			foreach ($message->getMessages() as $messageArray)
			{
				foreach ($messageArray as $currentMessage)
					$messageString .= $currentMessage."<br>";
			}

			$this->add('success', rtrim($messageString, "<br>"), $title);
		}
		else
			$this->add('success', $message, $title);
    }

    /**
     * Add an warning flash message to session.
     *
     * @param string $message The flash message content.
     * @param string $title The flash message title.
     *
     * @return void
     */
    public function warning($message, $title = null)
    {
		if($message instanceof MessageBag)
		{
			$messageString = "";
			foreach ($message->getMessages() as $messageArray)
			{
				foreach ($messageArray as $currentMessage)
					$messageString .= $currentMessage."<br>";
			}

			$this->add('warning', rtrim($messageString, "<br>"), $title);
		}
		else
			$this->add('warning', $message, $title);
    }

    /**
     * Add an error flash message to session.
     *
     * @param string $message The flash message content.
     * @param string $title The flash message title.
     *
     * @return void
     */
    public function primary($message, $title = null)
    {
    	if($message instanceof MessageBag)
		{
			$messageString = "";
			foreach ($message->getMessages() as $messageArray)
			{
				foreach ($messageArray as $currentMessage)
					$messageString .= $currentMessage."<br>";
			}

			$this->add('primary', rtrim($messageString, "<br>"), $title);
		}
    	else
        	$this->add('primary', $message, $title);
    }

    /**
     * Add an error flash message to session.
     *
     * @param string $message The flash message content.
     * @param string $title The flash message title.
     *
     * @return void
     */
    public function secondary($message, $title = null)
    {
    	if($message instanceof MessageBag)
		{
			$messageString = "";
			foreach ($message->getMessages() as $messageArray)
			{
				foreach ($messageArray as $currentMessage)
					$messageString .= $currentMessage."<br>";
			}

			$this->add('secondary', rtrim($messageString, "<br>"), $title);
		}
    	else
        	$this->add('secondary', $message, $title);
    }

    /**
     * Add an error flash message to session.
     *
     * @param string $message The flash message content.
     * @param string $title The flash message title.
     *
     * @return void
     */
    public function error($message, $title = null)
    {
    	if($message instanceof MessageBag)
		{
			$messageString = "";
			foreach ($message->getMessages() as $messageArray)
			{
				foreach ($messageArray as $currentMessage)
					$messageString .= $currentMessage."<br>";
			}

			$this->add('secondary', rtrim($messageString, "<br>"), $title);
		}
    	else
        	$this->add('secondary', $message, $title);
    }

    /**
     * Add an error flash message to session.
     *
     * @param string $message The flash message content.
     * @param string $title The flash message title.
     *
     * @return void
     */
    public function danger($message, $title = null)
    {
        $this->error($message, $title = null);
    }

    /**
     * Add an error flash message to session.
     *
     * @param string $message The flash message content.
     * @param string $title The flash message title.
     *
     * @return void
     */
    public function light($message, $title = null)
    {
    	if($message instanceof MessageBag)
		{
			$messageString = "";
			foreach ($message->getMessages() as $messageArray)
			{
				foreach ($messageArray as $currentMessage)
					$messageString .= $currentMessage."<br>";
			}

			$this->add('light', rtrim($messageString, "<br>"), $title);
		}
    	else
        	$this->add('light', $message, $title);
    }

    /**
     * Add an error flash message to session.
     *
     * @param string $message The flash message content.
     * @param string $title The flash message title.
     *
     * @return void
     */
    public function dark($message, $title = null)
    {
    	if($message instanceof MessageBag)
		{
			$messageString = "";
			foreach ($message->getMessages() as $messageArray)
			{
				foreach ($messageArray as $currentMessage)
					$messageString .= $currentMessage."<br>";
			}

			$this->add('dark', rtrim($messageString, "<br>"), $title);
		}
    	else
        	$this->add('dark', $message, $title);
    }

    /**
     * Clear messages
     *
     * @return void
     */
    public function clear()
    {
        $this->messages = [];
    }
}
