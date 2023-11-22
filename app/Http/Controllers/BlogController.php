<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
class BlogController extends Controller
{
    public function index(){
        $client = new Client();
        $response = $client->request('GET', 'https://www.investing.com/blog/');
        $htmlContent = $response->getBody()->getContents();

        $crawler = new Crawler($htmlContent);
        $articles = $crawler->filter('article.blogItem')->each(function ($node) {
            // Extract title
            $titleNode = $node->filter('a.title'); // Assuming the title is within an anchor tag with class 'title'
            $title = $titleNode->text();

            // Extract description
            $descriptionNode = $node->filter('div.textDiv p'); // Assuming the description is within a paragraph tag inside div.textDiv
            $description = $descriptionNode->text();

            // Extract link
            $link = $titleNode->attr('href');

            $imageNode = $node->filter('a.img img'); // Assuming the image is within an anchor tag with class 'img' containing an img tag
            $imageLink = $imageNode->attr('data-src');

            // Return an array with the extracted data
            return [
                'title' => $title,
                'description' => $description,
                'link' => $link,
                'image_link' => $imageLink,
            ];
        });

        // return $articles;
        return view('welcome', compact('articles'));
    }

    public function blogDetails($anyurl){
        $fullurl = 'blog/'.$anyurl;
        $client = new Client();
        $response = $client->request('GET', 'https://www.investing.com/'.$fullurl);
        $htmlContent = $response->getBody()->getContents();

        $crawler = new Crawler($htmlContent);
        $articles = $crawler->filter('section')->each(function ($node) {
            // Extract title
            $titleNode = $node->filter('div'); // Assuming the title is within an anchor tag with class 'title'
            $title = $titleNode->text();

            // // Extract description
            // $descriptionNode = $node->filter('div.textDiv p'); // Assuming the description is within a paragraph tag inside div.textDiv
            // $description = $descriptionNode->text();

            // // Extract link
            // $link = $titleNode->attr('href');

            // $imageNode = $node->filter('a.img img'); // Assuming the image is within an anchor tag with class 'img' containing an img tag
            // $imageLink = $imageNode->attr('data-src');

            // Return an array with the extracted data
            return [
                'title' => $title,
                // 'description' => $description,
                // 'link' => $link,
                // 'image_link' => $imageLink,
            ];
        });
        dd($articles);

    }
}
