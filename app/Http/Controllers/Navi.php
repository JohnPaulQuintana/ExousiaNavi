<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\User;
use GuzzleHttp\Client;
use App\Models\Teacher;
use App\Models\Floorplan;
use App\Models\Frequently;
use Illuminate\Http\Request;
use App\Models\EastwoodsFacilities;
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
        $continuation = false;
        // for answer yes or no in facilities
        if (is_null($query) || !in_array($request->input('prompt'), $allowedPrompts)) {
            if($request->input('prompt') === 'yes'){
                $floor = Session::get('floor');
                $facility = Session::get('facility');
                $continuation = true;
                $dataArray = [
                    'navi' => [
                        [
                            'flag' => 'false',
                            'query' => 'yes',
                            'answer' => 'yes',
                            'data' => '',
                        ],
                    ],
                ];

                Session::forget('floor');
                Session::forget('facility');

                return response()->json(['response' => $this->generateText($dataArray['navi'][0]),'floor'=>$floor, 'facility'=>$facility, 'continuation'=>$continuation]);
            }elseif ($request->input('prompt') === 'no') {
                $floor = 'false';
                $facility = 'false';
                $continuation = false;
                $dataArray = [
                    'navi' => [
                        [
                            'flag' => 'false',
                            'query' => 'no',
                            'answer' => 'no',
                            'data' => '',
                        ],
                    ],
                ];

                Session::forget('floor');
                Session::forget('facility');

                return response()->json(['response' => $this->generateText($dataArray['navi'][0]),'floor'=>$floor, 'facility'=>$facility, 'continuation'=>$continuation]);
            }

            // Tokenize the prompt into words or tokens
            // $tokens = str_word_count($request->input('prompt'), 1); // This splits the prompt into an array of words
            // dd($tokens);
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
            $floor = '';
            $facility = '';
            // dd($result['navi'][0]);

            if (
                isset($result['navi'][0]['data']) &&
                isset($result['navi'][0]['data']['floor'])
            ) {
                // 'floor' key is present in the specified structure
                $floor = $result['navi'][0]['data']['floor'];
                // $floorId = $result['navi'][0]['data']['id'];
                $facility = $result['navi'][0]['data']['facilities'];
                // dd($floor);
                // Store $floor and $facility in the session
                session(['floor' => $floor, 'facility' => $facility]);
                $facilityFound = false;
                $floorFound = Floorplan::where('floor', $floor)->first();
                // dd($floorFound);
                if($floorFound){
                    foreach ($floorFound['gridDetails'] as $value) {
                        // dd($value);
                        if (isset($value['label']) && $value['label'] === $facility) {
                            // dd('found');
                            $facilityFound = true; // Set the flag to true if the facility is found
                            break; // Stop searching once found
                        }
                    }

                    if(!$facilityFound){   
                        // dd($value);
                        $response = [
                            "flag" => "false",
                            "query" => "facilities.layout.not",
                            "data" => $facility,
                        ];
                        return response()->json(['response' => $this->generateText($response),'floor'=>$floor, 'facility'=>$facility, 'continuation'=>'information']);    
                    }
                    
                    // dd($jsonData);
                }else{
                    // dd('not found!');
                    $response = [
                        "flag" => "false",
                        "query" => "facilities.layout.not",
                        "data" => $facility,
                    ];
                    return response()->json(['response' => $this->generateText($response),'floor'=>$floor, 'facility'=>$facility, 'continuation'=>'information']);
                }
            } else {
                // 'floor' key is not present in the specified structure
                $floor = false;
                $continuation = 'information';
            }

            // dd($result['navi'][0]);
            return response()->json(['response' => $this->generateText($result['navi'][0]),'floor'=>$floor, 'facility'=>$facility, 'continuation'=>$continuation]);
        } 

    }

    // process navigation
    public function naviProcessNavigation(Request $request)
{
    $requestedFloorLabel = $request->input('floor');
    $requestedFacilityLabel = $request->input('facility');
    
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
        'Is there anything else on your mind?',
        'Feel free to ask any other questions.',
        'Im here to help. Whats next?',
        'What can I do to make your day better?',
        'Dont hesitate to ask if you need more information.',
        'Your satisfaction is my priority. Whats your next query?',
        'Im at your service. Whats your request?',
        'Let me know how I can be of further assistance.',
        'What other assistance do you require today?',
        'Im here to assist you. Whats your next question?',
    ];

    // Find the target floor
    $targetFloor = Floorplan::where('floor', $requestedFloorLabel)->first();

    if (!$targetFloor) {
        return response()->json(['details' => [], 'message' => 'Target floor not found.']);
    }

    // Include the ground floor in the response
    $groundFloor = Floorplan::where('floor', 'ground-floor')->first();
    $responseData = [];
    $responseGuide = [];
    $length = 0;
    if ($groundFloor) {
        $responseData[] = $groundFloor->toArray();
    }

    // Include floors leading to the target floor
    $floors = Floorplan::where('floor', '<=', $requestedFloorLabel)->get();
    // dd($groundFloor['floor']);
    if (!$floors->isEmpty()) {
        $responseGuide[] = $this->generateTextStairs($groundFloor['floor'], $requestedFacilityLabel, false);
        foreach ($floors as $floor) {
            $floorData = $floor->toArray();
            $floorData['found'] = true;
            $responseData[] = $floorData;

            if ($floor->floor === $requestedFloorLabel) {
                // dd('ginagawa');
                $length = mt_rand(0, count($endingPart) - 1);
                $randomResponse = $endingPart[$length];

                $responseGuide[] = $this->generateTextStairs($floor->floor, $requestedFacilityLabel, true). ' !' . $randomResponse;
                break;
            }else{
                $responseGuide[] = $this->generateTextStairs($floor->floor, $requestedFacilityLabel, false); 
            }
        
        }

        // dd($responseGuide);
        
    } else {
        $responseData['found'] = false;
        $responseData['message'] = 'No matching floor found';
    }

    // dd($floorData); 
    return response()->json([
        'details' => $responseData, 
        'navigationMessage'=>$responseGuide]
    );
}


    // process information request for browsing
    public function naviProcessInformationRequest(Request $request){
        try {
            $reqInfo = $request->input('requestInfo');
            $modelClass = 'App\Models\\' . $request->input('modelClass');
            $informations = $modelClass::get();
            // dd($informations);
            return response()->json(['informations'=>$informations, 'modelClass'=>$request->input('modelClass')]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    // process for searching
    public function naviProcessInformationSearch(Request $request){
        // dd($request);
        $reqInfoId = $request->input('infoId');
        $modelClass = 'App\Models\\' . $request->input('infoModel');
        $findInformation = $modelClass::where('id',$reqInfoId)->first();
        $continuation = false;
        $facilityFound = false; // Initialize a flag to track if the facility is found

        switch ($request->input('infoModel')) {
            case 'EastwoodsFacilities':
                $floorFound = Floorplan::where('floor', $findInformation->floor)->first();
                // dd($floorFound['gridDetails']);
                if($floorFound){
                    foreach ($floorFound['gridDetails'] as $value) {
                        // dd($findInformation->facilities);
                        if (isset($value['label']) && $value['label'] == $findInformation->facilities) {
                            $facilityFound = true; // Set the flag to true if the facility is found
                            break; // Stop searching once found
                        }
                    }

                    if ($facilityFound) {
                        // dd('found');
                        $response = [
                            "flag" => "false",
                            "query" => "facilities.found",
                            "data" => $findInformation,
                        ];
                        session(['floor' => $findInformation->floor, 'facility' => $findInformation->facilities]);
                        return response()->json(['response' => $this->generateText($response),'floor'=>$findInformation->floor, 'facility'=>$findInformation->facilities, 'continuation'=>$continuation]);
                       // break; // Stop searching once found
                    }else{
                        // print($value['label']);

                        $response = [
                            "flag" => "false",
                            "query" => "facilities.layout.not",
                            "data" => $findInformation->facilities,
                        ];
                        return response()->json(['response' => $this->generateText($response),'floor'=>$findInformation->floor, 'facility'=>$findInformation->facilities, 'continuation'=>'information']);
                    }
                    // dd($jsonData);
                }else{
                    // dd('not found!');
                    $response = [
                        "flag" => "false",
                        "query" => "facilities.layout.not",
                        "data" => $findInformation->facilities,
                    ];
                    return response()->json(['response' => $this->generateText($response),'floor'=>$findInformation->floor, 'facility'=>$findInformation->facilities, 'continuation'=>'information']);
                }
                
                
            case 'Teacher':
                $response = [
                    "flag" => "false",
                    "query" => "persons.found",
                    "data" => $findInformation,
                ];
                $continuation = 'information';
                return response()->json(['response' => $this->generateText($response),'floor'=>$findInformation->floor, 'facility'=>$findInformation->facilities, 'continuation'=>$continuation]);
                
            
            default:
                # code...
                break;
        }

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
        // $serverResponseText = $data['answer'];
        // dd($data);
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

        $openingForFoundFacilityStart = [
            'Found [facilities] on [floor]. Operating hours: [operation_time]. Go there?',
            'Located [facilities] on [floor]. Operating hours: [operation_time]. Ready to go?',
            'Info: [facilities] on [floor]. Operating hours: [operation_time]. Lets head there?',
            "Details for [facilities] on [floor]. Operating hours: [operation_time]. Shall we go?",
            "Facility: [facilities] on [floor]. Hours: [operation_time]. Go now?",
            "Info: [facilities] on [floor]. Operating hours: [operation_time]. Ready to visit?",
            "Found [facilities] on [floor]. Operating hours: [operation_time]. Go there now?",
            "Located [facilities] on [floor]. Operating hours: [operation_time]. Ready to go now?",
            "Info: [facilities] on [floor]. Operating hours: [operation_time]. Time to head there?",
            "Details for [facilities] on [floor]. Operating hours: [operation_time]. Lets go!",
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
        
        // positive response for yes
        $positiveResponses = [
            "Great choice! You'll soon be able to view the facility on the map below, showcasing its location on [floor]. Enjoy exploring!",
            "Excellent! Get ready to explore the facility on the map below, featuring its location on [floor]. Have a great time exploring!",
            "Perfect! Take a moment to prepare for the map below, highlighting the facility's location on [floor]. Happy exploring!",
            "Awesome! The map displaying the facility on [floor] will be ready for you in just a moment. Dive in and explore!",
            "Fantastic! You'll soon have the opportunity to explore the facility on the map below. Simply click and interact with the map to get a closer look!",
            "Wonderful! The map showcasing the facility's location on [floor] will be available shortly. Click on the map to start your exploration!",
            "Terrific choice! The map highlighting the facility on [floor] will be ready in a moment. Enjoy your exploration!",
            "Brilliant! Get ready for the map featuring the facility on [floor]. It will be available shortly. Click on the map to explore further!",
            "Excellent decision! You can explore the facility on the map below after the message. Click and drag to navigate!",
            "Great! The map displaying the facility on [floor] will be ready after the message. Enjoy exploring!"

        ];
        
        // negative response for no
        $negativeResponses = [
            "No problem! If you change your mind or have any more questions, feel free to ask. I'm here to help!",
            "That's alright! If you have any other questions or need assistance with something else, just let me know.",
            "Sure thing! If you ever decide to explore further or need assistance later, don't hesitate to reach out.",
            "Understood! If you have more questions or need assistance in the future, feel free to come back anytime.",
            "Alright! If you ever want to see the map or have any other inquiries, I'm here to assist you.",
            "No worries! If you change your mind or need assistance with anything else, don't hesitate to ask.",
            "Okay! If you have any more questions or need assistance later, don't hesitate to reach out to me.",
            "Certainly! If you ever decide to view the map or have any other questions, I'm here to assist you.",
            "Got it! If you change your mind or need help with anything else, feel free to get in touch.",
            "That's perfectly fine! If you have any more questions or need assistance in the future, I'm here to help."
        ];

        //layout not found
        $layoutNotFoundMessages = [
            "I apologize, but it seems we don't currently have the layout information for this facility's location.",
            "We understand your request for the layout, but at this moment, the layout for this facility's location is unavailable.",
            "Regrettably, the layout details for this facility's location are not present in our database.",
            "We're sorry to inform you that we couldn't locate the layout for this facility's location.",
            "Unfortunately, the layout for this facility's location is not currently accessible in our records.",
            "Apologies, but we're currently missing the layout information for this facility's location.",
            "The layout for this facility's location is regrettably absent from our database.",
            "I regret to inform you that we are unable to provide the layout for this facility's location at this time.",
            "We've conducted a search, but the layout for this facility's location is nowhere to be found.",
            "We're actively working on obtaining the layout for this facility's location, but it's not yet available.",
            "The layout for this facility's location is currently undergoing updates, and we don't have the latest version.",
            "Layout data for this facility's location is temporarily out of reach. We apologize for any inconvenience.",
            "Our team is diligently searching for the layout of this facility's location, but it has proven elusive.",
            "The layout for this facility's location is in a pending state and hasn't been finalized yet.",
            "Please check back later for the layout details of this facility's location as we continue our efforts to obtain it.",
            "We sincerely apologize, but the layout information for this facility's location is currently unavailable.",
            "We understand your desire for the layout, but we're unable to provide it as of now.",
            "The layout for this facility's location is still in the process of being updated, and we don't have the latest version.",
            "We're sorry for the inconvenience, but the layout is currently not accessible to us.",
            "We're doing our best to acquire the layout for this facility's location, but it's not yet ready for retrieval.",
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
            'Is there anything else on your mind?',
            'Feel free to ask any other questions.',
            'Im here to help. Whats next?',
            'What can I do to make your day better?',
            'Dont hesitate to ask if you need more information.',
            'Your satisfaction is my priority. Whats your next query?',
            'Im at your service. Whats your request?',
            'Let me know how I can be of further assistance.',
            'What other assistance do you require today?',
            'Im here to assist you. Whats your next question?',
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

            case 'facilities.not':
                $length = mt_rand(0, count($openingForFalseFacility) - 1);
                $randomResponse = $openingForFalseFacility[$length];
                break;

            case 'facilities.found':
                $length = mt_rand(0, count($openingForFoundFacilityStart) - 1);
                $randomResponse = str_replace(
                    ['[facilities]', '[operation_time]', '[floor]'],
                    [$data['facilities'], $data['operation_time'], $data['floor']],
                    $openingForFoundFacilityStart[$length]
                ) .
                    '! ';
                break;

            case 'facilities.layout.not':
                $length = mt_rand(0, count($layoutNotFoundMessages) - 1);
                $randomResponse = $layoutNotFoundMessages[$length].'! '. $endingPart[$length];
                break;
           

            case 'badwords':
                $length = mt_rand(0, count($badWordResponses) - 1);
                $randomResponse = $badWordResponses[$length];
                break;

            case 'goodbye':
                $length = mt_rand(0, count($thanks) - 1);
                $randomResponse = $thanks[$length];
                break;

            case 'yes':
                $length = mt_rand(0, count($positiveResponses) - 1);
                $randomResponse = $positiveResponses[$length]. '! ';
                // $randomResponse = str_replace(
                //     ['[floor]'],
                //     [$data['floor']],
                //     $positiveResponses[$length]
                // ) . '! '. $endingPart[$length];
                break;

            case 'no':
                $length = mt_rand(0, count($negativeResponses) - 1);
                $randomResponse = $negativeResponses[$length] .'! '.$endingPart[$length];
                break;

            default:
                // $length = mt_rand(0, count($thanks) - 1);
                // $randomResponse = $thanks[$length];
                break;
        }

        return $randomResponse;
    }

    // generate response message on taking stairs
    public function generateTextStairs($floor, $facility, $found){

        // dd($facility);
        $length = 0;
        $floorguide = [
            "Here is your navigation guide in [floor], pointing towards the stairs to reach your destination.",
            "Your navigation guide for [floor] is ready, showing the way to the stairs to reach your desired location.",
            "In [floor], your navigation guide directs you towards the stairs for access.",
            "Welcome to [floor]! Your navigation guide is set to lead you to the stairs for your destination.",
            "For [floor], follow your navigation guide; it's indicating the stairs as the way to go.",
            "Your [floor] navigation guide has your path marked to the stairs; follow its directions.",
            "In [floor], your navigation guide highlights the stairs as your route.",
            "Upon arriving at [floor], trust your navigation guide to guide you to the stairs.",
            "To reach your goal on [floor], follow your navigation guide's path to the stairs.",
            "Your navigation guide for [floor] is ready to lead you to the stairs as the next step.",
            "Welcome to [floor]! Your navigation guide highlights the stairs on the map.",
            "In [floor], your navigation guide points towards the stairs; follow it.",
            "For [floor], the quickest route involves using the stairs, as shown by your navigation guide.",
            "In [floor], the stairs are your next step; let your navigation guide show you the way.",
            "At [floor], head to the stairs; your navigation guide has them marked for you.",
            "Upon reaching [floor], trust your navigation guide; it's leading you straight to the stairs.",
            "For [floor], follow your navigation guide to find the stairs on your way.",
            "Your navigation guide for [floor] has the stairs clearly marked for your convenience.",
            "In [floor], your destination is just a staircase away; your navigation guide knows the way.",
            "In [floor], use the stairs as guided by your navigation guide to reach your destination."
        ];

        $messagesGroundFloor = [
            "Here is your navigation guide on the ground floor to reach [facilities]. Follow the path indicated by the guide.",
            "To find [facilities] on the ground floor, trust your navigation guide's directions; it will lead you there.",
            "Your navigation guide on the ground floor is set to take you to [facilities]. Follow its route to reach your destination.",
            "For the ground floor, your navigation guide will guide you to [facilities]. Follow its instructions to get there.",
            "Welcome to the ground floor! Your navigation guide is ready to lead you to [facilities].",
            "On the ground floor, your navigation guide points you to [facilities]. Follow its directions to reach your destination.",
            "To reach [facilities] on the ground floor, follow the path highlighted by your navigation guide.",
            "Your navigation guide on the ground floor will direct you to [facilities]. Trust its instructions to find your way.",
            "On the ground floor, follow your navigation guide to reach [facilities]. It knows the best route.",
            "Your navigation guide for the ground floor is set to assist you in reaching [facilities]. Follow its guidance.",
            "Welcome to the ground floor! Your navigation guide is here to help you find [facilities].",
            "On the ground floor, your navigation guide points you in the right direction to locate [facilities].",
            "For the ground floor, the quickest route to [facilities] is shown by your navigation guide.",
            "On the ground floor, [facilities] is just a step away; let your navigation guide show you the way.",
            "At the ground floor, trust your navigation guide to lead you to [facilities].",
            "For the ground floor, follow your navigation guide to find [facilities].",
            "Your navigation guide for the ground floor has the location of [facilities] clearly marked for your convenience.",
            "On the ground floor, [facilities] is within reach; your navigation guide knows the way.",
            "On the ground floor, discovering [facilities] is easy; your navigation guide is here to assist you.",
            "On the ground floor, [facilities] is just moments away; your navigation guide is here to guide you."
        ];

        $foundfloorguide = [
            "Your guide to [floor] is ready. Follow the guide to reach [facility].",
            "Welcome to [floor]! Your guide is set to lead you to [facility].",
            "In [floor], your guide directs you towards [facility] as your destination.",
            "For [floor], follow your guide; it's indicating [facility] as the way to go.",
            "Your [floor] guide has your path marked to [facility]; follow its directions.",
            "In [floor], your guide highlights [facility] as your route to success.",
            "To reach your goal on [floor], follow your guide's path to [facility].",
            "Your guide for [floor] is ready to lead you to [facility] as the next step.",
            "Welcome to [floor]! Your guide highlights [facility] on the map.",
            "In [floor], your guide points you towards [facility]; follow it.",
            "For [floor], the quickest route involves using [facility], as shown by your guide.",
            "In [floor], [facility] is your next step; let your guide show you the way.",
            "At [floor], head to [facility]; your guide has it marked for you.",
            "Upon reaching [floor], trust your guide; it's leading you straight to [facility].",
            "For [floor], follow your guide to find [facility] on your way.",
            "Your guide for [floor] has [facility] clearly marked for your convenience.",
            "In [floor], your destination is just a [facility] away; your guide knows the way.",
            "In [floor], use [facility] as guided by your guide to reach your destination.",
            "Your guide to [facility] on [floor] is ready. Follow the guide to reach [facility].",
            "For [floor], your guide is your trusted companion to find [facility].",
        ];
        
        if ($floor === 'ground-floor') {
            $length = mt_rand(0, count($messagesGroundFloor) - 1);
            $randomResponse = str_replace('[facilities]', $facility, $messagesGroundFloor[$length]);
        } elseif ($floor !== 'ground-floor' && !$found) {
            $length = mt_rand(0, count($floorguide) - 1);
            $randomResponse = str_replace('[floor]', $floor, $floorguide[$length]);
        }
        
        if ($found) {
            $length = mt_rand(0, count($foundfloorguide) - 1);
            $randomResponse = str_replace(['[facility]', '[floor]'], [$facility, $floor], $foundfloorguide[$length]) . '! ';
        }
        
        return $randomResponse;
    }
}
