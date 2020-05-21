<?php



//exec("cd /home/smartfarmesrs/public_html/snapshot/SF000;find -iname \"*.jpg\" -newermt \"2019-07-19 00:00:00\" ! -newermt \"2019-07-21 23:59:59\"|grep \"/12/\" ",$out);
$sitecode="SF000";
$allfiles = scanDirectories("snapshot");
print_r($allfiles);
print_r($dirs);
$start=strtotime('2019-07-19');
$end=strtotime('2019-07-21');
$min="08";

$dirs=[];

//print_r($out);
$allfiles = scanDirectories("snapshot");
print_r($allfiles);
print_r($dirs);

/*
 [0] => snapshot
    [1] => SF000
    [2] => 2019-07-19
    [3] => 001
    [4] => jpg
    [5] => 12
    [6] => 00
    [7] => 00[R][0@0][0].jpg
*/

//get range date 
function filter($var){
    global $start,$end,$min;

    $_file = explode("/",$var);

    $dt=strtotime($_file[2]);
   
    if( ( $dt >= $start ) && ( $dt <= $end ) && ($_file[5] == $min )) {
        return true;
    }
}

$all=array_filter($allfiles,"filter");

print_r($all);


//print_r($allfiles[1]);

function scanDirectories($rootDir, $allData=array()) {
   global $dirs,$sitecode;
    // set filenames invisible if you want
    $invisibleFileNames = array(".", "..", ".htaccess", ".htpasswd");
    // run through content of root directory
    $dirContent = scandir($rootDir);
    foreach($dirContent as $key => $content) {
        // filter all files not accessible
        $path = $rootDir.'/'.$content;
        if(!in_array($content, $invisibleFileNames)) {
            // if content is file & readable, add to array
            if(is_file($path) && is_readable($path)) {
                // save file name with path
                if ( strstr( $path, '.jpg' ) ) {
                    //get dir min
                    $_file = explode("/",$path);
                    if($_file[1] == $sitecode ){
                     $dirs[$_file[5]]=$_file[5];
                     $allData[] = $path;
                    }
                }
            // if content is a directory and readable, add path and name
            }elseif(is_dir($path) && is_readable($path)) {
                // recursive callback to open new directory
                $allData = scanDirectories($path, $allData);
            }
        }
    }
    return $allData;
}


?>
