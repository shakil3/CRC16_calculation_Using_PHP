<?php
$rcvData = $_GET['crcData'];
function crc16($string){
    $CRC = 0xFFFF;
    $CRCLSB = 0x00;
    $covrteData =array();
    $makeByte = str_split($string,2);
    $noOfByte = count($makeByte);
    foreach ($makeByte as $key => $value) {
        $decimalData = hexdec($value);
        array_push($covrteData,$decimalData);
    }
    for ($i=0; $i<$noOfByte; $i++){
        $CRC = $CRC ^ $covrteData[$i];
        for ($j=0; $j < 8; $j++)
        {
            $CRCLSB = ($CRC & 0x0001);
            $CRC = (($CRC >> 1) & 0x7FFF);
            if ($CRCLSB)
            {
                $CRC = ($CRC ^ 0xA001);
            }
        }
    }
    return $CRC;
}

echo "[{\"CRC\":\"".base_convert(crc16($rcvData),10,16)."\"}]";

?>