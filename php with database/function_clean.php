<?php
    function clean($input) {
        
        if (is_array($input)) {
            return array_map('trim', $input);
        }
        return htmlspecialchars(trim($input));
    }
?>