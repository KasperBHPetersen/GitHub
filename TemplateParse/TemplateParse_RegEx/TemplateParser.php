<?php
class TemplateParser{

//Constructs the html template. Has optional arguments for marking variables in the template. Uses '{{' and '}}' by default.
function __construct($template, $openTag = '{{', $closeTag = '}}'){
    $this->template = $template;
    $this->openTag = $openTag;
    $this->closeTag = $closeTag;
}

//Replaces the template variables ('key') with associated values ('value') found in the associated array ($data). 
//Provides optional argument for sanitation using reqular expression RegEx ($pattern). 
//Uses /[^a-zA-Z0-9 .,!?\']+/ by default (Allows any combination for characters, digits, white space and .). 
//Copies the template to allow for testing of different $data or $pattern on the same object.  
public function parse($data, $pattern = '/[^a-zA-Z0-9 .,!?\']+/'){
    $html = $this->template;                                                         
    foreach ($data as $key => $value){
        if (preg_match_all($pattern, $value) >= 1 ){
            return 0;                                                               
        }else{
            $html = str_replace($this->openTag.$key.$this->closeTag,$value,$html);
        }
    }
    return $html;
}
}
?>