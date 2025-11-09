<?php

/**
 * Class controller Router
 * o Routes script regarding HTTP request
 * o Dispatch methods
 * 
 * @author Alex Kaydansky <kaydansky@gmail.com>
 * @package Capture Video
 * @version 1.0
 * @since 03/05/2018
 */
class Router {
    
    private $templateMain = 'index.html';
    private $templateHeader = 'header.html';
    private $templateHeader3 = 'header3.html';
    private $templateHeader4 = 'header4.html';
    private $templateFooter = 'footer.html';
    private $template1 = '1.html';
    private $template2 = '2.html';
    private $template3 = '3.html';
    private $template4 = '4.html';
    private $uri = array('', '', '');
    private $content;
    private $template;
    public  $wrapper;

    /**
     * Class constructor
     * 
     * @access public
     * @param void
     * @return void
     */
    public function __construct() {
        require_once MODELS_PATH . 'mysql_pdo.php';
        require_once MODELS_PATH . 'db.php';
        require_once MODELS_PATH . 'pager.php';
        require_once MODELS_PATH . 'log.php';
        require_once MODELS_PATH . 'wrapper.php';
        require_once HELPER_PATH . 'sanitizer.php';
        
        $this->wrapper = new WrapperModel;
        $this->parseUri();
        $this->route();
        
        exit;
    }
    
    /**
     * URI parser
     * 
     * @access private
     * @return void
     * @throws Exception
     */
    private function parseUri() {
        $get = filter_input(INPUT_GET, 'uri', FILTER_SANITIZE_ENCODED);

        if (isset($get)) {
            $a = strval($get);
            $this->uri = array_replace($this->uri, explode('/', $a));
        }

        return;
    }

    private function route() {
        switch ($this->uri[0]) {
            default:
                require_once CONTROLLERS_PATH . 'names.php';
                $name = new NamesController();
                $name->read();
                $this->template = $this->template1;
                $this->content = $this->wrapper->bracket($name->output);
                break;
            case '2':
                $this->template = $this->template2;
                break;
            case '3':
                $this->templateHeader = $this->templateHeader3;
                $this->template = $this->template3;
                break;
            case '4':
                $this->templateHeader = $this->templateHeader4;
                $this->template = $this->template4;
                break;
            case 'upload-video':
                require_once CONTROLLERS_PATH . 'upload_video.php';
                $upload = new UploadVideoController();
                $upload->save('video');
                exit;
                break;
            case 'record-name':
                require_once CONTROLLERS_PATH . 'names.php';
                $name = new NamesController();
                $name->setName('name');
                $name->create();
                header('location: /');
                exit;
                break;
        }

        $this->renderPage($this->wrapper->renderContent($this->template, $this->content));
    }
    
    /**
     * Compile HTML output
     * 
     * @access public
     * @param string $content
     * @return void
     */
    private function renderPage($content) {   
        $this->wrapper->wrap($this->templateMain, array(
            '{HEADER}' => $this->wrapper->renderContent($this->templateHeader),
            '{CONTENT}' => $content,
            '{FOOTER}' => $this->wrapper->renderContent($this->templateFooter),
            )
        );
    }
}
