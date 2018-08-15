<?php
require 'vendor/autoload.php';

use Faker\Factory as Faker;

$faker = Faker::create('ru_RU');

$url = 'http://localhost:8005';

for ($author_i=0; $author_i < 50; $author_i++) {
    $author = array(
        'title' => $faker->title,
        'description' => $faker->text,
        'login' => $faker->userName,
        'author_ip' => $faker->ipv4,
    );
    create_data($url, $author);

    $author['title'] = $faker->title;
    $author['description'] = $faker->text;
    create_data($url, $author);

    $author['title'] = $faker->title;
    $author['description'] = $faker->text;
    $author['login'] = $faker->userName;
    create_data($url, $author);

    $author['title'] = $faker->title;
    $author['description'] = $faker->text;
    create_data($url, $author);
}

function create_data($url, $author)
{
    $result = post_data($url . '/api/post_create/', $author);

    if (!empty($result['post_id'])) {
        for ($rating_i=0; $rating_i < 5; $rating_i++) {
            $rating = [
                'post_id' => $result['post_id'],
                'rating' => rand(1, 5),
            ];

            $data = post_data($url . '/api/add_rating/', $rating);
        }
    }
}

function post_data($url, $data)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0) AppleWebKit/604.3.5 (KHTML, like Gecko) Version/11.0.1 Safari/604.3.5');
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');

    $output = curl_exec($ch);
    curl_close($ch);

    return empty($output) ? array() : json_decode($output, true);
}
