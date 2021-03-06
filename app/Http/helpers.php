<?php
class Helpers {

	/*
	| Formats json in a pretty way
	*/
	public static function format_json($json, $html = false, $tabspaces = null)
	{
	    $tabcount = 0;
	    $result = '';
	    $inquote = false;
	    $ignorenext = false;

	    if ($html) {
	        $tab = str_repeat("&nbsp;", ($tabspaces == null ? 4 : $tabspaces));
	        $newline = "<br/>";
	    } else {
	        $tab = ($tabspaces == null ? "\t" : str_repeat(" ", $tabspaces));
	        $newline = "\n";
	    }

	    for($i = 0; $i < strlen($json); $i++) {
	        $char = $json[$i];

	        if ($ignorenext) {
	            $result .= $char;
	            $ignorenext = false;
	        } else {
	            switch($char) {
	                case ':':
	                    $result .= $char . (!$inquote ? " " : "");
	                    break;
	                case '{':
	                    if (!$inquote) {
	                        $tabcount++;
	                        $result .= $char . $newline . str_repeat($tab, $tabcount);
	                    }
	                    else {
	                        $result .= $char;
	                    }
	                    break;
	                case '}':
	                    if (!$inquote) {
	                        $tabcount--;
	                        $result = trim($result) . $newline . str_repeat($tab, $tabcount) . $char;
	                    }
	                    else {
	                        $result .= $char;
	                    }
	                    break;
	                case ',':
	                    if (!$inquote) {
	                        $result .= $char . $newline . str_repeat($tab, $tabcount);
	                    }
	                    else {
	                        $result .= $char;
	                    }
	                    break;
	                case '"':
	                    $inquote = !$inquote;
	                    $result .= $char;
	                    break;
	                case '\\':
	                    if ($inquote) $ignorenext = true;
	                    $result .= $char;
	                    break;
	                default:
	                    $result .= $char;
	            }
	        }
	    }

	    return $result;
	}

    public static function getRandomIcon()
    {
        $icons = array(
            'fa-paint-brush','fa-puzzle-piece','fa-sun-o',
            'fa-user-secret','fa-mercury','fa-heartbeat',
            'fa-flask','fa-gamepad','fa-graduation-cap',
            'fa-adjust','fa-at','fa-bolt','fa-compass',
            'fa-sun-o','fa-music','fa-paper-plane-o',
            'fa-futbol-o','fa-smile-o','fa-recycle',
            'fa-star','fa-sun-o','fa-smile-o','fa-heart-o'
        );

        return $icons[array_rand($icons)];
    }

    public static function getRandomBackground()
    {
        $bgs = array(
            'success','danger','info','warning','pa-purple'
        );

        return $bgs[array_rand($bgs)];
    }

    public static function getOrderBackground($key)
    {
        $bgs = array(
            'warning','success','danger','info','pa-purple','primary'
        );

        return $bgs[$key%sizeof($bgs)];
    }
}