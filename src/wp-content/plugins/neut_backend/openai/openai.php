<?php

function call_openai_api($link) {
    // Your OpenAI API endpoint and API key
    $api_url = 'https://api.openai.com/v1/chat/completions'; // Replace with your actual endpoint
    $api_key = 'sk-wUywY5dj88NTIgC_ZlGyKF-g1fUq-aLRxXlpSLZ4deT3BlbkFJqdu3r5xEvh7zyqEpGbpSx2UfQkj0cjJdullkRMbBkA'; // Replace with your OpenAI API key
    $api_key = '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'; // Replace with your OpenAI API key

    // Create the prompt using the provided link (replace with your actual prompt logic)
    $prompt = "Analyze News Article Bias

               Task: Determine if the provided news article is left- or right-biased.

               Identify the Source: Analyze the publication or news outlet. What is its known political bias?

               Language and Tone Analysis:

               Scan for emotionally charged language. List examples.
               Is the tone neutral, or does it show clear bias?
               Coverage Assessment:

               Identify key topics emphasized in the article. Are any issues minimized?
               Are multiple perspectives presented, or is there a predominant viewpoint?
               Fact vs. Opinion:

               Quantify the balance between factual reporting and opinion.
               Are opinions presented clearly, or do they seem like facts?
               Source Evaluation:

               Review the sources cited. Are they reputable and diverse?
               Are there any significant omissions of expert voices or alternative viewpoints?
               Contextual Consideration:

               Analyze the political context surrounding the article. How does it relate to current narratives from either side?
               Conclusion Evaluation:

               Determine the overall stance of the article. Does it advocate for a specific policy or ideology?

               Plus get the main h1 title to return

               The response must be just a json formed this way:
               {
               \"title\": the exact title in the <h1> tag of the article, - for example: if you have <h1 >Da Israele pioggia di bombe sul Libano: quasi 500 morti, 35 sono bambini. Civili in fuga dal Sud in guerra</h1> the title is 'Da Israele pioggia di bombe sul Libano: quasi 500 morti, 35 sono bambini. Civili in fuga dal Sud in guerra'
               \"factual_points\": an integer from 0 to 100 where 0 is the most biased and 100 is the most neutral,
               \"political_points\": an integer from 0 to 100 where 0 is the most left and 100 is the most right,
               \"credibility_score\": an integer from 0 to 100 where 0 is the least credible and 100 is the most credible,
               \"fact_vs_opinion_score\": an integer from 0 to 100 where 0 is the most opinionated and 100 is the most factual,
               \"political_biased\": an integer from 0 to 100 where 0 is the most neutral and 100 is the most biased,
               }


                this is the url of the article to scan:" . esc_url($link);




    // Prepare the request body
    $body = json_encode(array(
        'model' => 'gpt-4-turbo', // Example model, change as needed
        'messages' => [
                ["role" => "user", "content" => $prompt],
            ],
        'max_tokens' => 500, // Adjust token limit as necessary
        'temperature' => 0
    ));

    // Set up the arguments for the request
    $args = array(
        'body'        => $body,
        'headers'     => array(
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $api_key,
        ),
        'timeout'     => 60,
    );

    // Make the request
    $response = wp_remote_post($api_url, $args);
//var_dump($response);
    // Check for errors
    if (is_wp_error($response)) {
        return 'Error: ' . $response->get_error_message();
    }

    // Get the response body
    $response_body = wp_remote_retrieve_body($response);
    $data = json_decode($response_body, true);

    //var_dump($data["choices"][0]["message"]["content"]);


    // Return the result (adjust based on the expected response structure)
    return $data["choices"][0]["message"]["content"];
}
