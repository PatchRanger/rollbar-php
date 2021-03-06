<?php namespace Rollbar\Payload;

class ExceptionInfo implements \JsonSerializable
{
    private $class;
    private $message;
    private $description;
    private $utilities;

    public function __construct($class, $message, $description = null)
    {
        $this->utilities = new \Rollbar\Utilities();
        $this->setClass($class);
        $this->setMessage($message);
        $this->setDescription($description);
    }

    public function getClass()
    {
        return $this->class;
    }

    public function setClass($class)
    {
        $this->utilities->validateString($class, "class", null, false);
        $this->class = $class;
        return $this;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->utilities->validateString($message, "message", null, false);
        $this->message = $message;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->utilities->validateString($description, "description");
        $this->description = $description;
        return $this;
    }

    public function jsonSerialize()
    {
        $result = get_object_vars($this);
        unset($result['utilities']);
        return $this->utilities->serializeForRollbar($result);
    }
}
