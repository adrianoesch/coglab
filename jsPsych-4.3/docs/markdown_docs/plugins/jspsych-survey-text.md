# jspsych-survey-text plugin

The survey-text plugin displays a set of questions with free response text fields. The subject types in answers.

## Parameters

This table lists the parameters associated with this plugin. Parameters with a default value of *undefined* must be specified. Other parameters can be left unspecified if the default value is acceptable.

Parameter | Type | Default Value | Description
----------|------|---------------|------------
questions | array | *undefined* | Each array is an array of strings. The strings are the prompts for the subject to respond to. Each string gets its own response field. Each set of strings (inner arrays) will be presented on the same page (trial). The length of the outer array sets the number of trials in the block.
preamble | string | empty string | HTML formatted string to display at the top of the page above all the questions.
rows | array | 1 | The number of rows for the response text box. Array dimensions must match `questions` array, with a numeric value for each entry indicating the number of rows for that question's box.
columns | array | 40 | The number of columns for the response text box. Array dimensions must match `questions` array, with a numeric value for each entry indicating the number of columns for that question's box.

## Data Generated

In addition to the [default data collected by all plugins](overview#datacollectedbyplugins), this plugin collects the following data for each trial.

Name | Type | Value
-----|------|------
responses | JSON string | A string in JSON format containing the responses for each question. The encoded object will have a separate variable for the response to each question, with the first question in the trial being recorded in `Q0`, the second in `Q1`, and so on. Each response is a string containing whatever the subject typed into the associated text box.
rt | numeric | The response time in milliseconds for the subject to make a response.

## Examples

### Basic example

```javascript
// defining groups of questions that will go together.
var page_1_questions = ["How old are you?", "Where were you born?"];
var page_2_questions = ["What is your favorite food?"];

var survey_block = {
    type: 'survey-text',
    questions: [page_1_questions, page_2_questions],
};
```

### Custom number of rows and columns

```javascript
// defining groups of questions that will go together.
var page_1_questions = ["How old are you?", "Where were you born?"];
var page_2_questions = ["What is your favorite food?"];

var survey_block = {
    type: 'survey-text',
    questions: [page_1_questions, page_2_questions],
    rows: [[5,3],[2]],
    columns: [[40,50],[60]]
};
```
