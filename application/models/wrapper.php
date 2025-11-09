<?php

/**
 * Calass model Wrapper
 * Embed data into HTML template
 *
 * @author Alex Kaydansky <kaydansky@gmail.com>
 * @package Capture Video
 * @version 1.0
 * @since 03/05/2018
 */
class WrapperModel
{
    /**
     * Convert regular array to compiler ready array
     *
     * @static
     * @param array $a
     * @return array
     */
    public function bracket(array $a) {
        foreach ($a as $k => $v) {
            $result['{' . $k . '}'] = $v;
        }

        return $result;
    }

    public function renderMessage($template) {
        $message = '';

        if (isset($_SESSION['message'])) {
            $message = $this->wrap($template, array('{MESSAGE}' => $_SESSION['message'] . '<hr>'), false);
            unset($_SESSION['message']);
        }

        return $message;
    }

    public function renderContent($template, array $a = null, $throw = false, $folder = '') {
        return $this->wrap($template, $a, $throw, $folder);
    }

    /**
     * Replace placeholders with data in HTML template file
     * o Return or throw compiled HTML page
     *
     * @static
     * @final
     * @param string $template
     * @param array $a
     * @param boolean $throw
     * @return string
     */
    public function wrap($template, array $a = null, $throw = true, $folder = '') {
        $path = $folder ?: TEMPLATES_PATH;
        $templatePath = $path . $template;

        if (!file_exists($templatePath)) {
            die('Template file "' . $template . '" not found.');
        }

        if (!$f = @fopen($templatePath, 'r')) {
            die('Failed open template file "' . $template . '".');
        }

        $a['{CSS_URI}'] = CSS_URI;
        $a['{JS_URI}'] = JS_URI;
        $a['{IMG_URI}'] = IMG_URI;
        $a['{BASE_URI}'] = BASE_URI;

        $string = fread($f, filesize($templatePath));
        fclose($f);

        $page = $a ? $this->fillPlaceholders($string, $a) : $string;

        if ($throw) {
            echo $page;

            return;
        }
        else {
            return $page;
        }
    }

    private function fillPlaceholders($string, array $a) {
        if (!count($a)) {
            return $string;
        }

        $content = str_replace(array_keys($a), array_values($a), $string);

        return $content;
    }
}
