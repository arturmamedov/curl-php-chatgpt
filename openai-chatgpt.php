<?php

$api_key = 'YOUR API KEY';
$url = 'https://api.openai.com/v1/chat/completions'; // this the endpoint for gpt 3 model
// the curl headers
$headers = array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $api_key,
);


// the curl data - this model require this data to be sent
$data = [
    //'prompt' => 'Conosci Tenerife?',
    'messages' => [
        [
            "role" => "user",
            'content' => 'Conosci Tenerife?', // your question
        ],
    ],

    "model" => "gpt-3.5-turbo", // other models not for chat "text-ada-001", //not yet launched "gpt-3.5-turbo-instruct",
    "max_tokens" => 250, // limit of tokens to use
    "temperature" => 0.7 // 0 strctured <-> 1 creative
];

// CURL request
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($ch);
curl_close($ch);

$decoded_response = json_decode($response, true);

//$generated_text = $decoded_response['choices'][0]['text'];
//echo $generated_text;

print_r($decoded_response);

// response
/*
Array
(
    [id] => chatcmpl-...
    [object] => chat.completion
    [created] => 1694126010
    [model] => gpt-3.5-turbo-0613
    [choices] => Array
        (
            [0] => Array
                (
                    [index] => 0
                    [message] => Array
                        (
                            [role] => assistant
                            [content] => Sì, Tenerife è un'isola situata nell'arcipelago delle Canarie, che fa parte della Spagna. È la più grande delle Canarie e ha una popolazione di circa 900.000 abitanti. Tenerife è una popolare destinazione turistica grazie al suo clima subtropicale, alle sue spiagge e ai suoi paesaggi vulcanici mozzafiato. L'isola è famosa per il suo vulcano attivo, il Teide, che è anche il punto più alto della Spagna. Tenerife offre una varietà di attrazioni turistiche, tra cui parchi acquatici, parchi nazionali, giardini botanici e una vivace vita notturna.
                        )

                    [finish_reason] => stop
                )

        )

    [usage] => Array
        (
            [prompt_tokens] => 13
            [completion_tokens] => 167
            [total_tokens] => 180
        )

)
 */
