<!doctype html>
<html>
    <head>
        <title>My experiment</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="../jsPsych-4.3/jspsych.js"></script>
        <script src="../jsPsych-4.3/plugins/jspsych-text.js"></script>
        <script src="../jsPsych-4.3/plugins/jspsych-single-stim.js"></script>
        <script src="../jsPsych-4.3/plugins/jspsych-fullscreen.js"></script>
        <link href="../jsPsych-4.3/css/jspsych.css" rel="stylesheet" type="text/css"></link>
    </head>
    <body>
    </body>
    <script>
      // settings
      var experiment_name = 'wordlist-matrix';
      var subjectID = 'hans_wurst';

      // prepare structures
        /* define welcome message block */
        var welcome_block = {
          type: "text",
          text: "Welcome to the experiment. Press any key to begin."
        };

        /* define instructions block */
        var instructions_block = {
          type: "text",
          text: "<p>Bli bla blo blu ...</p>",
          timing_post_trial: 2000
        };

        /* define test block */
        var words = ['eins','zwei','drei','vier','fuenf','sechs','sieben','acht','neun','zehn'];
        var colors = ['blue','blue','blue','blue','blue','red','red','red','red','red'];
        var color_dic = {'red':'#FF0000','blue':'#0000FF'}

        var words_shuffled = words.sort(function() { return(0.5-Math.random())})
        var colors_shuffled = colors.sort(function() { return(0.5-Math.random())})

        html_words = [];
        for(i=1;i<10;i++){
          html_words.push("<p style='color:"+
          color_dic[colors_shuffled[i]]+";'>"+
          words_shuffled[i]+"</p>")
        }

        var test_block = {
            type: 'single-stim',
            stimuli: html_words,
            is_html: true,
            timing_response: 2000,
            response_ends_trial: false
        }



        var activate_fullscreen = {
            type: 'fullscreen',
            showtext: '<p style="padding-top: 50px; text-align: center;">This experiment is now shon in fullscreen-mode',
            buttontext: "OK"
        }

        var end_fullscreen = {
            type: 'fullscreen',
            showtext: '<p style="padding-top: 50px; text-align: center;">exiting fullscreen-mode',
            buttontext: "OK",
            exit: true
          }


        /* create experiment definition array */
        var experiment = [];
        experiment.push(activate_fullscreen);
        experiment.push(welcome_block);
        experiment.push(instructions_block);
        experiment.push(test_block);
        experiment.push(end_fullscreen);

        function saveData(filename, filedata){
         $.ajax({
            type: 'post',
            cache: false,
            url: '../store.php', // this is the path to the above PHP script
            data: {filename: filename, filedata: filedata}
         });
        }

        filename = experiment_name.concat('/').concat(subjectID).concat('.csv')

        /* start the experiment */
        jsPsych.init({
          experiment_structure: experiment,
          on_finish: function(data){ saveData(filename, jsPsych.data.dataAsCSV()) }
        });
      </script>
</html>
