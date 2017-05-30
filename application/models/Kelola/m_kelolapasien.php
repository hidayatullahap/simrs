<?php
class m_kelolapasien extends CI_Model
{
    public function getData($page=null, $limit=null, $sort=null)
    {   
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://localhost/simrs/api/v1/pasien?page='.$page.'&limit='.$limit.'&sort='.$sort.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $output = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($output===false) {
            echo "cURL Error: ". curl_error($ch);
        }
        curl_close($ch);
        $data=json_decode($output, true);
        return $data;
    }
}
