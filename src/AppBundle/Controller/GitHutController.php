<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GitHutController extends Controller
{
    /**
     * @Route("/", name="githut")
     */
    public function githutAction(Request $request)
    {
        // replace this example code with whatever you need
           $proprietes = [
            'avatar_url' => 'https://avatars.githubusercontent.com/u/76273?v=3',
            'name' => 'Belle Victor',
            'login' => 'bofiss',
            'details' => [
              'company'=> 'Ethick',
              'location' =>'Colmar, France'
            ],
            'social_data' =>[
              "public_repos"=> 27,
              "public_gists"=> 0,
              "followers"=> 5,
              "following"=> 1,
            ],
            // new data here
            'repo_count' => 100,
            'most_stars' => 50,
            'repos' => [
                [
                    'url' => 'https://codereviewvideos.com',
                    'name' => 'Code Review Videos',
                    'description' => 'some repo description',
                    'stargazers_count' => '999',
                ],
                [
                    'url' => 'http://bbc.co.uk',
                    'name' => 'The BBC',
                    'description' => 'not a real repo',
                    'stargazers_count' => '666',
                ],
                [
                    'url' => 'http://google.co.uk',
                    'name' => 'Google',
                    'description' => 'another fake repo description',
                    'stargazers_count' => '333',
                ],
            ],
          ];
        return $this->render('githut/index.html.twig', $proprietes);
    }
    /**
     * @Route("/profile", name="profile")
     */
    // public function profileAction(Request $request)
    // {
    //     // replace this example code with whatever you need
    //     $proprietes = [
    //       'avatar_url' => 'https://avatars.githubusercontent.com/u/76273?v=3',
    //       'name' => 'Belle Victor',
    //       'login' => 'bofiss',
    //       'details' => [
    //         'company'=> 'Ethick',
    //         'location' =>'Colmar, France'
    //       ],
    //       'social_data' =>[
    //         "public_repos"=> 27,
    //         "public_gists"=> 0,
    //         "followers"=> 5,
    //         "following"=> 1,
    //       ]
    //     ];
    //
    //       return $this->render('githut/profile.html.twig',$proprietes);
    //
    // }

}
