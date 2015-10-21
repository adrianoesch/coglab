<!doctype html>
<html>
    <head>
        <title>My experiment</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="../jsPsych-4.3/jspsych.js"></script>
        <script src="../jsPsych-4.3/plugins/jspsych-text.js"></script>
        <script src="../jsPsych-4.3/plugins/jspsych-single-stim.js"></script>
        <link href="../jsPsych-4.3/css/jspsych.css" rel="stylesheet" type="text/css"></link>
    </head>
    <body>
    </body>
    <script>

        /* define welcome message block */
        var welcome_block = {
          type: "text",
          text: "Welcome to the experiment. Press any key to begin."
        };

        /* define instructions block */
        var instructions_block = {
          type: "text",
          text: "<p>In this experiment, a circle will appear in the center " +
              "of the screen.</p><p>If the circle is <strong>blue</strong>, " +
              "press the letter F on the keyboard as fast as you can.</p>" +
              "<p>If the circle is <strong>orange</strong>, do not press " +
              "any key.</p>" +
              "<div class='left center-content'><img src='img/blue.png'></img>" +
              "<p class='small'><strong>Press the F key</strong></p></div>" +
              "<div class='right center-content'><img src='img/orange.png'></img>" +
              "<p class='small'><strong>Do not press a key</strong></p></div>" +
              "<p>Press any key to begin.</p>",
          timing_post_trial: 2000
        };

        /* define test block */

        var test_stimuli = [
          {
            image: "../img/blue.png",
            data: { response: 'go' }
          },
          {
            image: "../img/orange.png",
            data: { response: 'no-go' }
          }
        ];

        var all_trials = jsPsych.randomization.repeat(test_stimuli, 5, true);

        var post_trial_gap = function() {
          return Math.floor( Math.random() * 1500 ) + 750;
        }

        var test_block = {
          type: "single-stim",
          stimuli: all_trials.image,
          choices: ['F'],
          data: all_trials.data,
          timing_response: 1500,
          timing_post_trial: post_trial_gap
        };

        /* define debrief block */

        function getAverageResponseTime() {

          var trials = jsPsych.data.getTrialsOfType('single-stim');

          var sum_rt = 0;
          var valid_trial_count = 0;
          for (var i = 0; i < trials.length; i++) {
            if (trials[i].response == 'go' && trials[i].rt > -1) {
              sum_rt += trials[i].rt;
              valid_trial_count++;
            }
          }
          return Math.floor(sum_rt / valid_trial_count);
        }

        var debrief_block = {
          type: "text",
          text: function() {
            return "<p>Your average response time was <strong>" +
            getAverageResponseTime() + "ms</strong>. Press " +
            "any key to complete the experiment. Thank you!</p>";
          }
        };

        /* create experiment definition array */
        var experiment = [];
        experiment.push(welcome_block);
        experiment.push(instructions_block);
        experiment.push(test_block);
        experiment.push(debrief_block);

        function saveData(filename, filedata){
         $.ajax({
            type: 'post',
            cache: false,
            url: '../store.php', // this is the path to the above PHP script
            data: {filename: filename, filedata: filedata}
         });
        }

        /* start the experiment */
        jsPsych.init({
          experiment_structure: experiment,
          on_finish: function(data){ saveData("filename.csv", jsPsych.data.dataAsCSV()) }
        });
      </script>
</html>
