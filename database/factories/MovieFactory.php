<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $titles     = $this->faker->unique()->randomElement(['Startup', 'While You Were Sleeping', 'Vagabond', 'Dream High']);
        $desc       = '';
        $relyear    = '';
        $writer     = '';

        switch ($titles) {
            case 'Startup':
                $poster     = '../storage/startup.jpg';
                $desc       = '
                Needing to make $90k to open her own business, Seo Dal-Mi drops out of a university and takes up part-time work. She dreams of becoming someone like Steve Jobs.
                Nam Do-San is the founder of Samsan Tech. He is excellent with mathematics. He started Samsan Tech two years ago, but the company is not doing well. Somehow, Nam Do-San becomes Seo Dal-Mi’s first love. They cheer each others start and growth.';

                $relyear    = '2020';
                $writer     = 'Park Hye-Ryun';
                break;
            case 'While You Were Sleeping':
                $poster     = '../storage/wyws.jpg';
                $desc       = "
                Hong-Joo (Bae Suzy) lives with her mother and helps her run a pork restaurant. Hong-Joo is haunted by seeing the future deaths of others in her dreams. What's worse is that she does not know when the deaths will happen, but she tries to stop her dreams from becoming reality. One night, Hong-Joo dreams about the death of her own mother.
                ";

                $relyear    = '2017';
                $writer     = 'Park Hye-Ryun';
                break;
            case 'Vagabond':
                $poster     = '../storage/vagabond.jpg';
                $desc       = "
                Go Hae-Ri (Bae Suzy) is an NIS agent and is currently working undercover at the Korean embassy in Morocco. She is tasked by the embassy to help the bereaved families from the fatal flight. Cha Dal-Geon turns to Go Hae-Ri for help in finding the man he saw in Morocco who was a passenger on the flight. Soon, Cha Dal-Geon and Go Hae-Ri uncover a far darker and more sinister conspiracy than they expected.
                ";

                $relyear    = '2019';
                $writer     = 'Jang Young-Cheol, Jung Kyung-Soon';
                break;
            case 'Dream High':
                $poster     = '../storage/dream-high.jpg';
                $desc       = "
                'Dream High' takes place at Kirin High School of Art and follows the lives of students as they aspire to become superstars.

                Song Sam-Dong (Kim Soo-Hyun) lives in the country side and dreams of becoming an owner of a stock farm. He falls in love with Ko Hye-Mi (Bae Suji) at first sight and follows her to Kirin High School of Art. There he discovers his genius like musical talent.
                ";
                $relyear    = '2011';
                $writer     = 'Park Hye-Ryun';
                break;
            default:
                $poster = '../storage/no-poster.png';
        }

        return [
            'title' => $titles,
            'poster' => $poster,
            'description' => $desc,
            'year' => $relyear,
            'writer' => $writer
        ];
    }
}
