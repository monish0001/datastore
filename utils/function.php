<?php
 if (session_status() == PHP_SESSION_NONE) {
      session_start();
   }
require_once "db.php";


function updateCount() {
    
    $db = new dataBase;
    $db->makeConnection();
    $sql1 = "update counter set ViewCount = ViewCount+1 where ViewCount = ViewCount";
    $res = $db->query($sql1);
    $sql2 = "Select ViewCount from counter";
    $result = $db->query($sql2);
    return $result;
}

function getCount() {

    $db = new dataBase;
    $db->makeConnection();
    $sql = "SELECT ViewCount from counter";
    $result = $db->query($sql);
    $db->close();
    $row = $result->fetch_assoc();
    return $row['ViewCount'];
}



function http_digest_parse($txt) {
    // protect against missing data
    $needed_parts = array('nonce' => 1, 'nc' => 1, 'cnonce' => 1, 'qop' => 1, 'username' => 1, 'uri' => 1, 'response' => 1);
    $data = array();
    $keys = implode('|', array_keys($needed_parts));
    preg_match_all('@(' . $keys . ')=(?:([\'"])([^\2]+?)\2|([^\s,]+))@', $txt, $matches, PREG_SET_ORDER);
    foreach ($matches as $m) {
        $data[$m[1]] = $m[3] ? $m[3] : $m[4];
        unset($needed_parts[$m[1]]);
    }
    return $needed_parts ? false : $data;
}
function auth_user() {
// function to parse the http auth header
    $realm = 'Restricted area';
//user => password
    $users = array('admin' => 'admin');
    if (empty($_SERVER['PHP_AUTH_DIGEST'])) {
        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: Digest realm="' . $realm .
            '",qop="auth",nonce="' . uniqid() . '",opaque="' . md5($realm) . '"');
        return false;
    }
// analyze the PHP_AUTH_DIGEST variable
    if (!($data = http_digest_parse($_SERVER['PHP_AUTH_DIGEST'])) ||
        !isset($users[$data['username']])) {
        return false;
    }
// generate the valid response
    $A1 = md5($data['username'] . ':' . $realm . ':' . $users[$data['username']]);
    $A2 = md5($_SERVER['REQUEST_METHOD'] . ':' . $data['uri']);
    $valid_response = md5($A1 . ':' . $data['nonce'] . ':' . $data['nc'] . ':' . $data['cnonce'] . ':' . $data['qop'] . ':' . $A2);
    if ($data['response'] != $valid_response) {
        return false;
    }
// ok, valid username & password
    return true;
}

?>