<?php
require 'config/database.php';  // Ensure the PDO connection is established
require 'src/helpers.php';

function fetchDataFromSheet()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://sheets.googleapis.com/v4/spreadsheets/106Mh9_ohUGkddFtVCRyzFLZHR25BRi4kJPUSWgDwE8o/values/sheetone?key=AIzaSyA-AggMMOtHNqI67OjgStQLhS44DYd7o98',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        echo "cURL Error: " . curl_error($curl);
        return null;
    }

    curl_close($curl);

    return json_decode($response, true);
}

function convertDate($date)
{
    // Convert date from dd/mm/yyyy to yyyy-mm-dd
    $parts = explode('/', $date);
    if (count($parts) === 3) {
        $day = (int)$parts[0];
        $month = (int)$parts[1];
        $year = (int)$parts[2];

        // Validate if it's a real date
        if (checkdate($month, $day, $year)) {
            return sprintf('%04d-%02d-%02d', $year, $month, $day);
        }
    }
    return null;
}

// Fetch data from API
$data = fetchDataFromSheet();


if (isset($data['values']) && count($data['values']) > 1) {
    // Database connection
    try {

        // Prepare SQL Insert Query
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO application (web_name, position, company_name, salary, status, job_link, date) VALUES (:web_name, :position, :company_name, :salary, :status, :job_link, :date)";
        $stmt = $pdo->prepare($sql);
        $success = 0;

        foreach ($data['values'] as $key => $value) {
            if ($key != 0 && count($value) > 0) {
                $data = [];
                $data['web_name'] = $pdo->quote($value[2]);
                $data['position'] = $pdo->quote($value[3]);
                $data['company_name'] = $pdo->quote($value[4]);
                $data['salary'] = $pdo->quote($value[5]);
                $data['status'] = $pdo->quote($value[6]);
                $data['job_link'] = $pdo->quote($value[7]);
                $data['date'] = empty($value[1]) ? null : $value[1];

                try {
                    $success += $stmt->execute($data);
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
        }


        echo "$success number of Data inserted successfully.";
    } catch (Exception $e) {
        echo "Database Error: " . $e->getMessage();
    }
} else {
    echo "No data found in the API response.";
}
