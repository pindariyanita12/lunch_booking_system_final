<?php

namespace Tests\Unit;

use Tests\TestCase;
class APITest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }
    public function test_can_return_authurl()
    {

        $this->post(route('signin'))
            ->assertStatus(200);
    }
    public function test_can_return_token()
    {

        $data = [
            'grant_type' => $this->faker->sentence,
            'code' => $this->faker->paragraph,
            'tenant'=>'f4814d23-3835-4d87-a7dc-57a19c04684a',
            'client_id'=>'adc50096-ab75-4d92-bd40-6c4c3ba9b844',
            'client_secret'=>'HV48Q~a_PBWVnfROz0Oun-1B-ZdMO5fRhdvj0ciK',
            'redirect_uri'=>'http://localhost/lunch_booking_system/index.html'
        ];
        $this->post(route('getdata'),$data)
            ->assertStatus(200);
    }
    public function test_can_return_offdays()
    {

        $data = [
            'user_id' => 534,
            'token' => 'eyJ0eXAiOiJKV1QiLCJub25jZSI6IjdUbUdINFJocURDTVdNbjhYVXBsMkExOTNaejlhNXlhZ0RUcUVnZWRKVE0iLCJhbGciOiJSUzI1NiIsIng1dCI6ImpTMVhvMU9XRGpfNTJ2YndHTmd2UU8yVnpNYyIsImtpZCI6ImpTMVhvMU9XRGpfNTJ2YndHTmd2UU8yVnpNYyJ9.eyJhdWQiOiIwMDAwMDAwMy0wMDAwLTAwMDAtYzAwMC0wMDAwMDAwMDAwMDAiLCJpc3MiOiJodHRwczovL3N0cy53aW5kb3dzLm5ldC9mNDgxNGQyMy0zODM1LTRkODctYTdkYy01N2ExOWMwNDY4NGEvIiwiaWF0IjoxNjUzNjQzNzg5LCJuYmYiOjE2NTM2NDM3ODksImV4cCI6MTY1MzY0NzcyNiwiYWNjdCI6MCwiYWNyIjoiMSIsImFpbyI6IkUyWmdZRmdiOG1BQ3E2aFEraDM5OS85T01BbitMMXh2ZkRvMDcwQkcvSnBUYnYxM3Nya0EiLCJhbXIiOlsicHdkIl0sImFwcF9kaXNwbGF5bmFtZSI6Imx1bmNoX2Jvb2tpbmdfc3lzdGVtIiwiYXBwaWQiOiJhZGM1MDA5Ni1hYjc1LTRkOTItYmQ0MC02YzRjM2JhOWI4NDQiLCJhcHBpZGFjciI6IjEiLCJmYW1pbHlfbmFtZSI6IlBJTkRBUklZQSIsImdpdmVuX25hbWUiOiJOSVRBIiwiaWR0eXAiOiJ1c2VyIiwiaXBhZGRyIjoiMTQuOTkuMTAyLjIyNiIsIm5hbWUiOiJOSVRBIFBJTkRBUklZQSIsIm9pZCI6Ijg4Y2VkZTQyLWYyODktNDE0Mi1iZTY5LWIwZjNkOTFmMDEzNiIsInBsYXRmIjoiOCIsInB1aWQiOiIxMDAzMjAwMUM4MUFFOTM4IiwicmgiOiIwLkFWWUFJMDJCOURVNGgwMm4zRmVobkFSb1NnTUFBQUFBQUFBQXdBQUFBQUFBQUFCV0FEYy4iLCJzY3AiOiJDYWxlbmRhcnMuUmVhZFdyaXRlIE1haWwuUmVhZCBNYWlsYm94U2V0dGluZ3MuUmVhZCBvcGVuaWQgcHJvZmlsZSBVc2VyLlJlYWQgZW1haWwiLCJzaWduaW5fc3RhdGUiOlsia21zaSJdLCJzdWIiOiJXQ3ZZUHJqeXA0REdubHBRSUUzWXpOa1VEQ09SUE5tRkp6RzFEdkt5UkZzIiwidGVuYW50X3JlZ2lvbl9zY29wZSI6IkFTIiwidGlkIjoiZjQ4MTRkMjMtMzgzNS00ZDg3LWE3ZGMtNTdhMTljMDQ2ODRhIiwidW5pcXVlX25hbWUiOiJuaXRhLnBAc2ltZm9ybXNvbHV0aW9ucy5jb20iLCJ1cG4iOiJuaXRhLnBAc2ltZm9ybXNvbHV0aW9ucy5jb20iLCJ1dGkiOiJtRk9JbkdRdUZFaWdzejBhSS13QkFBIiwidmVyIjoiMS4wIiwid2lkcyI6WyJiNzlmYmY0ZC0zZWY5LTQ2ODktODE0My03NmIxOTRlODU1MDkiXSwieG1zX3N0Ijp7InN1YiI6IkduTHpxaDR6Y3BjUlBDZmwwQkZ5MWJZeVRfUWd0elRyYUFNZDQ5a3pWcXcifSwieG1zX3RjZHQiOjE0Nzg4OTA1ODR9.XRK74cbZwzSQa34lmrA_mQ9kwnI0mQp_LqOhHiH2uuW39u5S6YF6c-zBKoS1sM7_JACZEQWi6GxqziuWTdeD4nCQmulgeBMB0sFG0Sz5YdD1kauHFiLW0CatjY_uZpd1P6yQt0yQCm9d_qfWyAIHySDJ-zgkO7Lw9nBC1FQ-7qfAQBVm2UaXS2drgcVZpZ-kXPyYkplWsFn1TJWj1Yso1wDRiIifwliAbOP-GSn1iJpKTZ2Gm1H2Y2UFY5DxRuswrkMgDQUr21o0vGHZxPNbtBrvCSz9NIfQu49WiUNPzpPOcDHkBVpoVZx9fZwodZm4mKeFhUzc8ZL5K8vfylc-bA',
        ];
        $this->post(route('userOffday'),$data)
            ->assertStatus(200);
    }


    public function test_can_return_is_lunch_taken()
    {

        $data = [
            'user_id' => 534,
            'token' => 'eyJ0eXAiOiJKV1QiLCJub25jZSI6IjdUbUdINFJocURDTVdNbjhYVXBsMkExOTNaejlhNXlhZ0RUcUVnZWRKVE0iLCJhbGciOiJSUzI1NiIsIng1dCI6ImpTMVhvMU9XRGpfNTJ2YndHTmd2UU8yVnpNYyIsImtpZCI6ImpTMVhvMU9XRGpfNTJ2YndHTmd2UU8yVnpNYyJ9.eyJhdWQiOiIwMDAwMDAwMy0wMDAwLTAwMDAtYzAwMC0wMDAwMDAwMDAwMDAiLCJpc3MiOiJodHRwczovL3N0cy53aW5kb3dzLm5ldC9mNDgxNGQyMy0zODM1LTRkODctYTdkYy01N2ExOWMwNDY4NGEvIiwiaWF0IjoxNjUzNjQzNzg5LCJuYmYiOjE2NTM2NDM3ODksImV4cCI6MTY1MzY0NzcyNiwiYWNjdCI6MCwiYWNyIjoiMSIsImFpbyI6IkUyWmdZRmdiOG1BQ3E2aFEraDM5OS85T01BbitMMXh2ZkRvMDcwQkcvSnBUYnYxM3Nya0EiLCJhbXIiOlsicHdkIl0sImFwcF9kaXNwbGF5bmFtZSI6Imx1bmNoX2Jvb2tpbmdfc3lzdGVtIiwiYXBwaWQiOiJhZGM1MDA5Ni1hYjc1LTRkOTItYmQ0MC02YzRjM2JhOWI4NDQiLCJhcHBpZGFjciI6IjEiLCJmYW1pbHlfbmFtZSI6IlBJTkRBUklZQSIsImdpdmVuX25hbWUiOiJOSVRBIiwiaWR0eXAiOiJ1c2VyIiwiaXBhZGRyIjoiMTQuOTkuMTAyLjIyNiIsIm5hbWUiOiJOSVRBIFBJTkRBUklZQSIsIm9pZCI6Ijg4Y2VkZTQyLWYyODktNDE0Mi1iZTY5LWIwZjNkOTFmMDEzNiIsInBsYXRmIjoiOCIsInB1aWQiOiIxMDAzMjAwMUM4MUFFOTM4IiwicmgiOiIwLkFWWUFJMDJCOURVNGgwMm4zRmVobkFSb1NnTUFBQUFBQUFBQXdBQUFBQUFBQUFCV0FEYy4iLCJzY3AiOiJDYWxlbmRhcnMuUmVhZFdyaXRlIE1haWwuUmVhZCBNYWlsYm94U2V0dGluZ3MuUmVhZCBvcGVuaWQgcHJvZmlsZSBVc2VyLlJlYWQgZW1haWwiLCJzaWduaW5fc3RhdGUiOlsia21zaSJdLCJzdWIiOiJXQ3ZZUHJqeXA0REdubHBRSUUzWXpOa1VEQ09SUE5tRkp6RzFEdkt5UkZzIiwidGVuYW50X3JlZ2lvbl9zY29wZSI6IkFTIiwidGlkIjoiZjQ4MTRkMjMtMzgzNS00ZDg3LWE3ZGMtNTdhMTljMDQ2ODRhIiwidW5pcXVlX25hbWUiOiJuaXRhLnBAc2ltZm9ybXNvbHV0aW9ucy5jb20iLCJ1cG4iOiJuaXRhLnBAc2ltZm9ybXNvbHV0aW9ucy5jb20iLCJ1dGkiOiJtRk9JbkdRdUZFaWdzejBhSS13QkFBIiwidmVyIjoiMS4wIiwid2lkcyI6WyJiNzlmYmY0ZC0zZWY5LTQ2ODktODE0My03NmIxOTRlODU1MDkiXSwieG1zX3N0Ijp7InN1YiI6IkduTHpxaDR6Y3BjUlBDZmwwQkZ5MWJZeVRfUWd0elRyYUFNZDQ5a3pWcXcifSwieG1zX3RjZHQiOjE0Nzg4OTA1ODR9.XRK74cbZwzSQa34lmrA_mQ9kwnI0mQp_LqOhHiH2uuW39u5S6YF6c-zBKoS1sM7_JACZEQWi6GxqziuWTdeD4nCQmulgeBMB0sFG0Sz5YdD1kauHFiLW0CatjY_uZpd1P6yQt0yQCm9d_qfWyAIHySDJ-zgkO7Lw9nBC1FQ-7qfAQBVm2UaXS2drgcVZpZ-kXPyYkplWsFn1TJWj1Yso1wDRiIifwliAbOP-GSn1iJpKTZ2Gm1H2Y2UFY5DxRuswrkMgDQUr21o0vGHZxPNbtBrvCSz9NIfQu49WiUNPzpPOcDHkBVpoVZx9fZwodZm4mKeFhUzc8ZL5K8vfylc-bA',
        ];
        $this->post(route('lunchTaken'),$data)
            ->assertStatus(409);

    }
    public function test_signout_user()
    {

        $data = [
            'user_id' => 534,
            'token' => 'eyJ0eXAiOiJKV1QiLCJub25jZSI6IjdUbUdINFJocURDTVdNbjhYVXBsMkExOTNaejlhNXlhZ0RUcUVnZWRKVE0iLCJhbGciOiJSUzI1NiIsIng1dCI6ImpTMVhvMU9XRGpfNTJ2YndHTmd2UU8yVnpNYyIsImtpZCI6ImpTMVhvMU9XRGpfNTJ2YndHTmd2UU8yVnpNYyJ9.eyJhdWQiOiIwMDAwMDAwMy0wMDAwLTAwMDAtYzAwMC0wMDAwMDAwMDAwMDAiLCJpc3MiOiJodHRwczovL3N0cy53aW5kb3dzLm5ldC9mNDgxNGQyMy0zODM1LTRkODctYTdkYy01N2ExOWMwNDY4NGEvIiwiaWF0IjoxNjUzNjQzNzg5LCJuYmYiOjE2NTM2NDM3ODksImV4cCI6MTY1MzY0NzcyNiwiYWNjdCI6MCwiYWNyIjoiMSIsImFpbyI6IkUyWmdZRmdiOG1BQ3E2aFEraDM5OS85T01BbitMMXh2ZkRvMDcwQkcvSnBUYnYxM3Nya0EiLCJhbXIiOlsicHdkIl0sImFwcF9kaXNwbGF5bmFtZSI6Imx1bmNoX2Jvb2tpbmdfc3lzdGVtIiwiYXBwaWQiOiJhZGM1MDA5Ni1hYjc1LTRkOTItYmQ0MC02YzRjM2JhOWI4NDQiLCJhcHBpZGFjciI6IjEiLCJmYW1pbHlfbmFtZSI6IlBJTkRBUklZQSIsImdpdmVuX25hbWUiOiJOSVRBIiwiaWR0eXAiOiJ1c2VyIiwiaXBhZGRyIjoiMTQuOTkuMTAyLjIyNiIsIm5hbWUiOiJOSVRBIFBJTkRBUklZQSIsIm9pZCI6Ijg4Y2VkZTQyLWYyODktNDE0Mi1iZTY5LWIwZjNkOTFmMDEzNiIsInBsYXRmIjoiOCIsInB1aWQiOiIxMDAzMjAwMUM4MUFFOTM4IiwicmgiOiIwLkFWWUFJMDJCOURVNGgwMm4zRmVobkFSb1NnTUFBQUFBQUFBQXdBQUFBQUFBQUFCV0FEYy4iLCJzY3AiOiJDYWxlbmRhcnMuUmVhZFdyaXRlIE1haWwuUmVhZCBNYWlsYm94U2V0dGluZ3MuUmVhZCBvcGVuaWQgcHJvZmlsZSBVc2VyLlJlYWQgZW1haWwiLCJzaWduaW5fc3RhdGUiOlsia21zaSJdLCJzdWIiOiJXQ3ZZUHJqeXA0REdubHBRSUUzWXpOa1VEQ09SUE5tRkp6RzFEdkt5UkZzIiwidGVuYW50X3JlZ2lvbl9zY29wZSI6IkFTIiwidGlkIjoiZjQ4MTRkMjMtMzgzNS00ZDg3LWE3ZGMtNTdhMTljMDQ2ODRhIiwidW5pcXVlX25hbWUiOiJuaXRhLnBAc2ltZm9ybXNvbHV0aW9ucy5jb20iLCJ1cG4iOiJuaXRhLnBAc2ltZm9ybXNvbHV0aW9ucy5jb20iLCJ1dGkiOiJtRk9JbkdRdUZFaWdzejBhSS13QkFBIiwidmVyIjoiMS4wIiwid2lkcyI6WyJiNzlmYmY0ZC0zZWY5LTQ2ODktODE0My03NmIxOTRlODU1MDkiXSwieG1zX3N0Ijp7InN1YiI6IkduTHpxaDR6Y3BjUlBDZmwwQkZ5MWJZeVRfUWd0elRyYUFNZDQ5a3pWcXcifSwieG1zX3RjZHQiOjE0Nzg4OTA1ODR9.XRK74cbZwzSQa34lmrA_mQ9kwnI0mQp_LqOhHiH2uuW39u5S6YF6c-zBKoS1sM7_JACZEQWi6GxqziuWTdeD4nCQmulgeBMB0sFG0Sz5YdD1kauHFiLW0CatjY_uZpd1P6yQt0yQCm9d_qfWyAIHySDJ-zgkO7Lw9nBC1FQ-7qfAQBVm2UaXS2drgcVZpZ-kXPyYkplWsFn1TJWj1Yso1wDRiIifwliAbOP-GSn1iJpKTZ2Gm1H2Y2UFY5DxRuswrkMgDQUr21o0vGHZxPNbtBrvCSz9NIfQu49WiUNPzpPOcDHkBVpoVZx9fZwodZm4mKeFhUzc8ZL5K8vfylc-bA',
        ];
        $this->post(route('signout'),$data)
            ->assertStatus(200);
    }
}
