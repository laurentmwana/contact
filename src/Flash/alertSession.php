<?php

namespace Flash;


class AlertSession
{
    /**
     * @var array
     */
    private $SessionMessage;


    /**
     * @param array $SessionMessage
     */
    public function __construct(array $SessionMessage)
    {
        $this->SessionMessage = $SessionMessage;
    }


    /**
     * @return void
     */
    public function message (): void
    {
        foreach ($this->SessionMessage as $key => $value) {
            echo  <<< HTML
            <div class="alert alert-{$key}"><em> {$value} </em></div>
HTML;
        }
    }
}




