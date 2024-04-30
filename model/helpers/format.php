<?php
/**
* Format Class
*/
class Format{
    public function formatDate($date){ // dinh dang ngay
    return date('F j, Y,g:i a', strtotime($date));
    }

    public function textShorten($text, $limit = 400){ //chua doan text ngan
        $text = $text. "";
        $text = substr($text, 0, $limit);
        $text = substr($text, 0, strrpos($text, ''));
        $text = $text."......";
        return $text;
    }

    public function validation($data){ //giống form kt trống hay ko trống
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
     }
    
     public function title(){ // kiem tra ten cua server
        $path = $_SERVER['SCRIPT_FILENAME'];
        $title = basename($path, '.php');
        //$title = str_replace('_', ' ', $title);
        if ($title == 'index') {
         $title = 'home';
        }elseif ($title == 'contact') {
         $title = 'contact';
        }
        return $title = ucfirst($title);
       }
    }
    

?>