<?php

class views {

    private $_view_name;
    private $_sended_variables = [];

    function __construct(string $view_name) {
        $this->_view_name = $view_name;
        return $this;
    }

    public function with($key, $value) {
        $this->_sended_variables[$key] = $value;
    }

    public function render():?string {
        if(file_exists(view_patch().'/'.$this->_view_name.'.php')) {
            ob_start();
            extract($this->_sended_variables);
            require view_patch().'/'.$this->_view_name.'.php';
            $content = ob_get_contents();
            ob_end_clean();
            return $content;
        }
        return null;
    }

    static public function include_to_view(string $view_name, string $section_name, string $content):?string {
        $parent_view = new self($view_name);
        $parent_view_content = $parent_view->render();
        if(is_string($parent_view_content)) {
            if($parent_view_content) {
                $anchors = getVariablesBetweenBrackes($parent_view_content, '{{{', '}}}');
                $change_from = [];
                $change_to = [];
                if (count($anchors)) {
                    foreach ($anchors as $anchor) {
                        $change_from[] = '{{{' . $anchor . '}}}';
                        if ($section_name == $anchor)
                            $change_to[] = $content;
                        else
                            $change_to[] = '';
                    }
                }
                return str_replace($change_from, $change_to, $parent_view_content);
            }
        }
    }

}