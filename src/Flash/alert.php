<?php

namespace Flash;


class alert 
{

    /**
     * Les messages errors et de succès
     * @var array
     */
    private $posts = [];

    /**
     * Alert Constructor
     * @param array $posts
     */
    public function __construct(array $posts = [])
    {
        $this->posts = $posts;
    }


    public function attach (): void
    {
        if (!empty($this->posts)) {
           $this->alerts($this->posts);
        }
    }


    private function alerts (array $data): void
    {
        $params = '';
        foreach ($data as $key => $message) {
           $params .=  <<< HTML
            <div class="alert alert-danger"> <em> {$message} </em> </div>
HTML;
        }

        echo $params;
    }



    /**
     * @param array $data
     * 
     * @return void
     */
    private function danger (array $data = []): void
    {
        echo "<div class='alert alert-danger'>";
        echo "<ul>";
        
        echo "</ul>";
        echo "</div>";
    }


    /**
     * @param array $data
     * 
     * @return void
     */
    private function success (array $data = []): void
    {
        echo "<div class='alert alert-success'>";
        echo "<ul>";
        foreach ($data as $message) {
            echo "<li><em> {$message} </em> </li>";
        }
        echo "</ul>";
        echo "</div>";
    }


    private function MessageSession (array $data = []): void
    {
        foreach ($data['flash'] as $key => $message) {
            <<< HTML
            <div class='alert alert-{$key}'>
            {$message}
            </div>
    HTML;
        }

    }




}

