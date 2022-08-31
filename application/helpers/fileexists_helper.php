
<?php
function __file_exists($jenis=null, $url=null){ 
    switch($jenis) {
        case 'photo':
            $file = _MYPATH."assets/images/default-foto.svg";
            break;
        case 'file':
            $file = _MYPATH."assets/images/default-image.svg";
            break;
        case 'logo':
            $file = _MYPATH."assets/images/default-logo.svg";
            break;
        case 'absensi':
            $file = _MYPATH."assets/images/default-foto-absensi.svg";
            break;
        case 'lokasi':
            $file = _MYPATH."assets/images/lokasi-not-found.svg";
            break;
        default:
            $file = _MYPATH."assets/images/default-image.svg";
    }

    return $file;
}
    // function __file_exists($jenis=null, $url=null){ 
    //     $ch = curl_init($url);
    //     curl_setopt($ch, CURLOPT_NOBODY, true);
    //     curl_exec($ch);
    //     $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    //     curl_close($ch);
    //     if($httpCode == 200){
    //         $file = $url;
    //     }else{
    //         switch($jenis) {
    //             case 'foto':
    //                 $file = base_url()."assets/images/default-foto.svg";
    //                 break;
    //             case 'file':
    //                 $file = base_url()."assets/images/default-image.svg";
    //                 break;
    //             case 'logo':
    //                 $file = base_url()."assets/images/default-logo.svg";
    //                 break;
    //             case 'absensi':
    //                 $file = base_url()."assets/images/default-foto-absensi.svg";
    //                 break;
    //             case 'lokasi':
    //                 $file = base_url()."assets/images/lokasi-not-found.svg";
    //                 break;
    //             default:
    //                 $file = base_url()."assets/images/default-image.svg";
    //         }
    //     }

    //     return $file;
    // }
