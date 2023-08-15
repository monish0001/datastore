<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
 if (session_status() == PHP_SESSION_NONE) {
        session_start();
   }
 
require_once "utils/function.php";
require_once "utils/event.php";
require_once 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('resource');
$twig = new Twig_Environment($loader);
$uri = $_SERVER['REQUEST_URI'];
$uri = explode('/', $uri);
$errorMsg=0;
$pageFound=false;
if(empty($uri[1]))
{ 
  $pageFound=true;

  echo $twig->render('home.html', array('title' => 'HomePage'));
}elseif($uri[1]=='login'){


    if (!(!isset($_SESSION['Role']) || $_SESSION['Role'] == '')){

        if($_SESSION['Role']==2){
            $userId=$_SESSION["userId"];
           $Name=$_SESSION["Name"];
           $Email=$_SESSION["Email"]; 
           $pageFound=true;
           echo $twig->render('userPanel/dash.html',array('title' => 'userPanel','Name'=> $Name,
        'Email'=>$Email));
           return;
        }else if($_SESSION['Role']==1){
              $pageFound=true;
            echo $twig->render('adminPanel/dash.html',array('title' => 'adminPanel'));
             return;
        }
    }

  $pageFound=true;
  echo $twig->render('login.html', array('title' => 'Login'));

}elseif($uri[1]=='contact'){
  $pageFound=true;
  echo $twig->render('contact.html', array('title' => 'Contact Us'));

}elseif($uri[1]=='about'){
  $pageFound=true;
  echo $twig->render('about.html', array('title' => 'About Us'));

}
elseif($uri[1]=='gallery')
{
  $pageFound=true;
  echo $twig->render('gallery.html', array('title' => 'Gallery'));

}elseif($uri[1]=='test')
{
  $pageFound=true;
  echo $twig->render('test.html', array('title' => 'Error 404'));

}elseif($uri[1]=='logout')
{
  $pageFound=true;
  // remove all session variables
  session_unset();

  // destroy the session
  session_destroy();

  ?>

  <script type="text/javascript">
  
  window.addEventListener('load',function(){
    swal({
        title: "Logout Success!",
        text: "Hope Enjoyed!",
        icon: "success",
        button: "Okay!",
});
  })
</script>

  <?php
  echo $twig->render('home.html', array('title' => 'HomePage'));

}







elseif($uri[1]=='adminPanel'){

   if (!isset($_SESSION['Role']) || $_SESSION['Role'] == '')
        goto notFound;
          $userId=$_SESSION["userId"];
           $Name=$_SESSION["Name"];
           $Email=$_SESSION["Email"];

     if (empty($uri[2])){

        if($_SESSION["Role"]==1){
         
            $pageFound=true;
           echo $twig->render('adminPanel/dash.html',array('title' => 'adminPanel','Name'=> $Name,
        'Email'=>$Email));
      
        }
      }else if ($uri[2] == 'adduser') {

        if (empty($uri[3])){
        $pageFound=true;
        $Events = new Event;
        $data=$Events->getAllUsers();
        $villleges=$Events->getAllVillege();
        $Events=null;
      //  print_r($data);
        echo $twig->render('adminPanel/adduser.html',  array('title' => 'Add New User','Name'=> $Name,'Email'=>$Email,'users'=>$data,'villleges'=>$villleges));
      }else if(strstr($uri[3], 'updateuser')){

        $pageFound = true;
        $id = $_GET['id'];
        $Events = new Event;
        $data=$Events->getUserByUserId($id);
        $villleges=$Events->getAllVillege();
        $Events=null;
       // print_r($districts);
         echo $twig->render('adminPanel/updateuser.html',array('title' => 'Update User','Name'=> $Name,'Email'=>$Email,'data'=>$data,'villleges'=>$villleges));
        }
    }else if ($uri[2] == 'viewdata') {
        $pageFound=true;
        $Events = new Event;
        $data=$Events->getAllData();
        $Events=null;
        echo $twig->render('adminPanel/viewdata.html',  array('title' => 'All Data','Name'=> $Name,
        'Email'=>$Email,'data'=>$data));
    }else if ($uri[2] == 'managedata') {

        if (empty($uri[3])){
        $pageFound=true;
        $Events = new Event;
        $states=$Events->getAllState();
        $Events=null;
        echo $twig->render('adminPanel/managedata.html',  array('title' => 'Manage Data','Name'=> $Name,'Email'=>$Email,'states'=>$states));
        }else if(strstr($uri[3], 'districtlist')){

        $pageFound = true;
        $id = $_GET['id'];
        $Events = new Event;
        $districts=$Events->getAllDistrictByStateId($id);
        $Events=null;
        //print_r($districts);
         echo $twig->render('adminPanel/districtlist.html',array('title' => 'District List','Name'=> $Name,'Email'=>$Email,'districts'=>$districts));
        }else if(strstr($uri[3], 'villagelist')){

        $pageFound = true;
        $id = $_GET['id'];
        $Events = new Event;
        $villages=$Events->getAllVillegeByDistrictId($id);
        $Events=null;
       // print_r($villages);
        echo $twig->render('adminPanel/villagelist.html',array('title' => 'Village List','Name'=> $Name,'Email'=>$Email,'villages'=>$villages));
        }else if(strstr($uri[3], 'villagedata')){

        $pageFound = true;
        $id = $_GET['id'];
        $Events = new Event;
        $data=$Events->getDataByVillageId($id);
        $Events=null;
        echo $twig->render('adminPanel/villagedata.html',array('title' => 'Village Data','Name'=> $Name,'Email'=>$Email,'data'=>$data));
        }
    }


}elseif($uri[1]=='userPanel'){
    if (!isset($_SESSION['Role']) || $_SESSION['Role'] == '')
        goto notFound;
          $userId=$_SESSION["userId"];
           $Name=$_SESSION["Name"];
           $Email=$_SESSION["Email"];

     if (empty($uri[2])){

        if($_SESSION["Role"]==2){
         
            $pageFound=true;
           echo $twig->render('userPanel/dash.html',array('title' => 'userPanel','Name'=> $Name,
        'Email'=>$Email));
      
        }
      }else if ($uri[2] == 'adduser') {
        $pageFound=true;
        echo $twig->render('userPanel/dataAdd.html',  array('title' => 'Add New Data','Name'=> $Name,'Email'=>$Email,'userId'=>$userId));
    }else if ($uri[2] == 'viewdata') {
        $pageFound=true;
        $Events = new Event;
        $data=$Events->getDataByUserId( $userId);
        $Events=null;
        echo $twig->render('userPanel/viewdata.html',  array('title' => 'All State','Name'=> $Name,'Email'=>$Email,'data'=>$data));
    }


}


notFound:if(!$pageFound){
	echo $twig->render('404.html', array('title' => '404 Error'));
}
?>