<?php 


class BrandController
{
    public function getAll()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/brands',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer 168|39bRzkQImit5EhZa9ZavW7C1K9XufY1LalEUbmld',
                'Cookie: XSRF-TOKEN=eyJpdiI6IlZ0dWlPNXlLdGttV25kcGRUUnJnWEE9PSIsInZhbHVlIjoidllhRkFMaTlmNDlDY25yblpoNnRhRHk4N2xQeWZ6VkhOWEZtaTNtNmxiUWdxWitrOFJ6TTZJMVd5ZVBibzVmVjRIK1N6MnNnTlJYUjUrVDEvOG1PeFZwNmtueUg2WnAxdUgvZllVRlRiSUhxbzZ4eVhuTmdYUGxiS2dEc0RTWEEiLCJtYWMiOiIzYTYwZTE5YmExYzkyYmU5ZmNhMWY4MjY5ZjFkZmQ1YzA4MTdlZTE0NmFkOTFhZGFjZGQyNGI0YWQ3YjI2MDM0IiwidGFnIjoiIn0%3D; apicrud_session=eyJpdiI6IjBMbHNYUnA5N1dSTmxlQXFGUFBSQUE9PSIsInZhbHVlIjoiV1lqMExDYlhYVHpmc3hmUWRqYlNUS3RVL3lqUStvck1zT1NDamVub1l3RkZqUVNGQytIVXp4eTZOalhLaGhOL0lpZ0ZwRlM3ajZVMkgrQzV3enFoMmEwRjN1SU44NWxVVzNoaG1KYW9CZTc2aCtzZU5idC82ZU52K2pnUFFSVDEiLCJtYWMiOiJmNmJmZjllMWQzY2E3Nzg5ODk1ZmI1MzQ5NWJkMGUxYWVlZDBhYWY1NTU1N2U1NGViZTRiZTUyNzE3OWJiMmMxIiwidGFnIjoiIn0%3D'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($response, true);

        return $response['data'] ?? [];
    }
}
