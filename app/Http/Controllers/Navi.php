<?php

namespace App\Http\Controllers;

use App\Models\EastwoodsFacilities;
use App\Models\Frequently;
use App\Models\Teacher;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class Navi extends Controller
{
    public function startNaviServer(Request $request)
    {
        $frequentlies = Frequently::get();
        return view('navi.contents.home')->with(['frequentlies' => $frequentlies]);
    }

    public function naviProcess(Request $request)
    {
        $query = $request->input('query');
        $allowedPrompts = ['yes', 'just do it', 'ofcourse', 'please'];

        // get all user names
        $names = Teacher::pluck('name');
        $facilities = EastwoodsFacilities::pluck('facilities');
        // dd($names);

        if (is_null($query) || !in_array($request->input('prompt'), $allowedPrompts)) {
            // dd('ginagwaa');
            $client = new Client();
            $response = $client->post('http://localhost:5000/nlp', [
                'json' => [
                    'prompt' => $request->input('prompt'),
                    'persons' => $names,
                    'facilities' => $facilities,
                ]
            ]);

            $result = json_decode($response->getBody(), true);
            // dd($result['navi'][0]);
            return response()->json(['response' => $this->generateText($result['navi'][0])]);
            // return response()->json(['response' => $result['navi']], 200);
        } //else {
        //     // if continuation of question
        //     switch ($query) {
        //         case 'facilities':
        //             $data = EastwoodsFacilities::where('id', $id)->first();
        //             $answer = 'Here is the map ' . 'The ' . $data->facilities . ' is also available from ' . $data->operation_time;
        //             break;

        //             // query a persons
        //         case 'persons':
        //             // we should get the location using id
        //             $data = Teacher::where('id', $id)->first();
        //             $answer = $data->name.' position is a '.$data->position . 'located on the map below! is there anything i can do for you?';
        //             break;

        //             // query a persons located
        //         case 'query.persons.facilities.show':
        //             // we should get the location using id
        //             $data = Teacher::where('id', $id)->first();
        //             $answer = $data->name .' position is a '.$data->position. 'and located on the map below! is there anything i can do for you?';
        //             break;

        //         case 'continue':
        //             $data = Teacher::where('id', $id)->first();
        //             $answer = $data->name . 'located on the map below! is there anything i can do for you?';
        //             break;
        //         default:
        //             # code...
        //             break;
        //     }

        //     // return response
        //     $response = [
        //         'flag' => 'true',
        //         'answer' => $answer,
        //         'data' => $data,
        //     ];
        //     return response()->json(["response" => [$response]], 200);
        // }

    }

    // generating text
    public function generateText($data)
    {
        //     "flag" => "false"
        //   "query" => "persons"
        //   "answer" => "yeah!, sure.!"
        //   "data" => array:5 [
        //     "id" => 1
        //     "name" => "teacher1"
        //     "position" => "teacher"
        //     "created_at" => "2023-09-10T12:50:22.000Z"
        //     "updated_at" => "2023-09-10T13:57:21.000Z"

        // not found optional server response text
        $serverResponseText = $data['answer'];

        $recomposed = $this->randomText($data['query'], $data['data']);

        $response = [
            'flag' => 'true',
            'answer' => $recomposed,
            'data' => false,
        ];
        return $response;
    }

    // get random text response
    public function randomText($query, $data)
    {
        // dd($query);
        // person
        $openingForFalsePerson = [
            'I couldn\'t find any information about that person. Is there anything else I can assist you with?',
            'Im sorry, but I couldnt locate any details for that individual. How else can I help you?',
            'It seems I don\'t have any information on that person. Please provide more details or try another query.',
            'Unfortunately, I couldn\'t find any information on the person you mentioned. Can I assist you with something else?',
            'I couldn\'t find any records for that person. Please double-check the name or provide additional information.',
            'I apologize, but there are no records matching that person in my database. Can I assist you with something else?',
            'I couldn\'t locate any information for the person you specified. Is there another request youd like to make?',
            'Im sorry, but I couldnt find any information about that person. How else can I assist you?',
            'Unfortunately, I don\'t have any data on that person. Please provide more details or try a different query.',
            'It appears there are no records for that person. Can I help you with a different request?',
        ];
        // Person Found
        $openingForFoundPerson = [
            'Excellent news! Ive successfully retrieved comprehensive information about [name] in their role as [position].',
            'Im pleased to inform you that Ive located detailed records for [name] in their capacity as [position].',
            'Youre in good hands! I possess comprehensive information on [name] in their role as [position].',
            'Im delighted to share that Ive found the information you requested regarding [name] in their role as [position].',
            'Ive successfully retrieved detailed information for [name] in their capacity as [position].',
            'Rest assured, I have in-depth information about [name] in their role as [position].',
            'Ive successfully located [name] in their capacity as [position]. What specific details are you seeking?',
            'Youre in luck! Ive found comprehensive information about [name] in their role as [position].',
            'Ive diligently gathered extensive details for [name] in their role as [position].',
            'I possess thorough information on [name] in their capacity as [position]. How may I further assist you?',
        ];
        // facilities
        $openingForFalseFacility = [
            'I couldn\'t find any information about that facility. Is there anything else I can assist you with?',
            'Im sorry, but I couldnt locate any details for that facility. How else can I help you?',
            'It seems I don\'t have any information on that facility. Please provide more details or try another query.',
            'Unfortunately, I couldn\'t find any information on the facility you mentioned. Can I assist you with something else?',
            'I couldn\'t find any records for that facility. Please double-check the name or provide additional information.',
            'I apologize, but there are no records matching that facility in my database. Can I assist you with something else?',
            'I couldn\'t locate any information for the facility you specified. Is there another request youd like to make?',
            'Im sorry, but I couldnt find any information about that facility. How else can I assist you?',
            'Unfortunately, I don\'t have any data on that facility. Please provide more details or try a different query.',
            'It appears there are no records for that facility. Can I help you with a different request?',
        ];
        // facilities found
        $openingForFoundFacilityStart = [
            'Great news! I found information about that facility. Here are the details where you can find it [facilities] and the operation time is [operation_time]:',
            'Good news! I located information about the facility you mentioned. Here are the details where you can find it [facilities] and the operation time is [operation_time]:',
            'You\'re in luck! I have information on that facility. Here are the details where you can find it [facilities] and the operation time is [operation_time]:',
            'I found the information you were looking for about that facility. Here are the details where you can find it [facilities] and the operation time is [operation_time]:',
            'I\'ve found details for the facility you mentioned. Here are the details where you can find it [facilities] and the operation time is [operation_time]:',
            'You\'re in the right place! I have information about that facility. Here are the details where you can find it [facilities] and the operation time is [operation_time]:',
            'I found the facility you were looking for! Here are the details where you can find it [facilities] and the operation time is [operation_time]:',
            'You\'re in luck! I located information about that facility. Here are the details where you can find it [facilities] and the operation time is [operation_time]:',
            'I\'ve successfully located details for the facility you mentioned. Here are the details where you can find it [facilities] and the operation time is [operation_time]:',
            'Good news! I have information on that facility. Here are the details where you can find it [facilities] and the operation time is [operation_time]:',
        ];
        // person location found
        // $openingForFoundPersonLocation = [
        //     'Great news! I found information on navigating to [facilities] where you can find [persons]. The operation time is [operation_time].',
        //     'Good news! I located details for reaching [facilities] where you can find [persons]. The operation time is [operation_time].',
        //     'You\'re in luck! I have directions for [facilities] where you can locate [persons]. The operation time is [operation_time].',
        //     'I found navigation instructions for accessing [facilities] where you can find [persons]. The operation time is [operation_time].',
        //     'I\'ve found guidance on reaching [facilities] where you can discover [persons]. The operation time is [operation_time].',
        //     'You\'re in the right place! I have directions to [facilities] where you can locate [persons]. The operation time is [operation_time].',
        //     'I found the route to [facilities] where you can find [persons]. The operation time is [operation_time].',
        //     'You\'re in luck! I located information on how to get to [facilities] where you can find [persons]. The operation time is [operation_time].',
        //     'I\'ve successfully provided navigation details for [facilities] where you can find [persons]. The operation time is [operation_time].',
        //     'Good news! I have navigation instructions for reaching [facilities] where you can find [persons]. The operation time is [operation_time].',
        // ];

        // persons position at eastwoods
        $personsPositionAtEastwoods = [
            'The principal at Eastwoods is [name].',
            'At Eastwoods, the principal is [name].',
            'You are inquiring about the principal at Eastwoods, and that would be [name].',
            'The person in charge of the principal role at Eastwoods is [name].',
            'The current principal at Eastwoods is [name].',
            'Youll find [name] as the principal at Eastwoods.',
            'The role of principal at Eastwoods is held by [name].',
            'Eastwoods School is led by [name] as the principal.',
            'The principal at Eastwoods goes by the name of [name].',
            'At Eastwoods, [name] serves as the principal.'
        ];
        

        // ending part
        $endingPart = [
            'How can I assist you further?',
            'What else would you like to know?',
            'How may I help you with it?',
            'What would you like to do next?',
            'How can I assist you with it?',
            'How may I assist you further?',
            'What specific information do you need?',
            'What else can I do for you today?',
            'How can I assist you today?',
            'How may I help you with it?',
        ];

        // greetings
        $greetings = [
            "Hello there! Welcome to Eastwoods Guide, your dedicated resource for all things Eastwoods. How may I assist you today?",
            "Greetings! Eastwoods Guide is here to assist you with any questions or information related to Eastwoods. What can I do for you?",
            "Good day! Eastwoods Guide is your trusted companion for Eastwoods-related information and support. How can I enhance your day?",
            "Hi! Welcome to Eastwoods Guide, your friendly source for all things Eastwoods. How can I be of service to you?",
            "Hello! Eastwoods Guide is here to serve you. How can I assist you during your time at Eastwoods?",
            "Hey! I'm Eastwoods Guide, dedicated to making your Eastwoods experience smoother. How can I assist you today?",
            "Howdy! It's great to see you on campus. Eastwoods Guide is here to help. What can I do for you today?",
            "Hi there! Eastwoods Guide is ready to provide Eastwoods-related support. How can I make your day more productive?",
            "Hey there! Welcome to Eastwoods Guide. How can I assist you in navigating Eastwoods?",
            "Good to see you! Eastwoods Guide is here to provide Eastwoods-related information and assistance. What's on your mind?"
        ]; 

        // thanks
        $thanks = [
            "You're welcome! If you have any more questions, feel free to ask.",
            "No problem at all! If there's anything else I can assist you with, just let me know.",
            "You got it! If you need further assistance, don't hesitate to reach out.",
            "Glad I could help! If you have more inquiries, I'm here to assist.",
            "Anytime! If you have additional questions, feel free to ask.",
            "You're welcome! If there's anything else on your mind, don't hesitate to ask.",
            "No worries! If you require further assistance, feel free to reach out.",
            "It was my pleasure assisting you! If you have more questions later, I'll be here.",
            "You're welcome! If there's anything specific you'd like to know, just ask.",
            "Happy to help! If you ever need assistance in the future, don't hesitate to ask me."
        ];

        // bad words
        $badWordResponses = [
            "I'm here to provide useful information and assistance. Please refrain from using offensive language.",
            "Let's keep the conversation respectful and appropriate. How can I assist you further?",
            "I appreciate a polite and respectful conversation. How can I help you today?",
            "Using respectful language makes communication more effective. What can I assist you with?",
            "I'm here to help with your questions. Please keep the conversation civil and respectful.",
            "Respectful communication leads to better outcomes. How can I assist you today?",
            "Thank you for maintaining a courteous tone in our conversation. How can I assist you further?",
            "Your polite language is appreciated. How can I be of assistance to you?",
            "Let's keep our conversation respectful and focused on your needs. How can I assist you today?",
            "Politeness and respect go a long way in our conversation. How can I help you further?"
        ];      

        $length = 0;
        switch ($query) {

            case 'greetings':
                $length = mt_rand(0, count($greetings) - 1);
                $randomResponse = $greetings[$length];
                break;

            case 'persons.not':
                $length = mt_rand(0, count($openingForFalsePerson) - 1);
                // Get the random response
                $randomResponse = $openingForFalsePerson[$length];
                break;

            case 'persons.found':
                $length = mt_rand(0, count($openingForFoundPerson) - 1);
                // Get the random response
                $randomResponse = str_replace(
                    ['[name]', '[position]'],
                    [$data['name'], $data['position']],
                    $openingForFoundPerson[$length]
                ) .
                    '! ' . $endingPart[$length];
                break;

            case 'persons.position.found':
                $length = mt_rand(0, count($personsPositionAtEastwoods) - 1);
                // Get the random response
                $randomResponse = str_replace(
                    ['[name]'],
                    [$data['name']],
                    $personsPositionAtEastwoods[$length]
                ) .
                    '! ' . $endingPart[$length];
                break;

            case 'persons.position.not':
                $length = mt_rand(0, count($openingForFalsePerson) - 1);
                // Get the random response
                $randomResponse = $openingForFalsePerson[$length];
                break;

            // case 'persons.location.found':
            //     $length = mt_rand(0, count($openingForFoundPersonLocation) - 1);
            //     // Get the random response
            //     $randomResponse = str_replace(
            //         ['[facilities]', '[persons]', '[operation_time]'],
            //         [$data['facilities'], $data['persons']],
            //         $openingForFoundPersonLocation[$length]
            //     ) .
            //         '! ' . $endingPart[$length];
            //     break;

            case 'facilities.not':
                $length = mt_rand(0, count($openingForFalseFacility) - 1);
                $randomResponse = $openingForFalseFacility[$length];
                break;

            case 'facilities.found':
                $length = mt_rand(0, count($openingForFoundFacilityStart) - 1);
                $randomResponse = str_replace(
                    ['[facilities]', '[operation_time]'],
                    [$data['facilities'], $data['operation_time']],
                    $openingForFoundFacilityStart[$length]
                ) .
                    '! ' . $endingPart[$length];
                break;

            case 'badwords':
                $length = mt_rand(0, count($badWordResponses) - 1);
                $randomResponse = $badWordResponses[$length];
                break;

            case 'goodbye':
                $length = mt_rand(0, count($thanks) - 1);
                $randomResponse = $thanks[$length];
                break;

            default:
                // $length = mt_rand(0, count($thanks) - 1);
                // $randomResponse = $thanks[$length];
                break;
        }

        return $randomResponse;
    }
}
